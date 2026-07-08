<?php

namespace Tests\Feature\Api\V1;

use App\Enums\QuoteStatus;
use App\Enums\UserRole;
use App\Models\BusinessAccount;
use App\Models\Category;
use App\Models\Product;
use App\Models\PurchaseOrder;
use App\Models\Quote;
use App\Models\User;
use App\Services\QuoteService;
use Database\Seeders\RolePermissionSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Artisan;
use Laravel\Passport\Client;
use Laravel\Passport\Passport;
use Mockery;
use Tests\TestCase;

class ExternalB2bApiTest extends TestCase
{
    use RefreshDatabase;

    private static bool $passportKeysGenerated = false;

    protected function setUp(): void
    {
        parent::setUp();

        if (! self::$passportKeysGenerated) {
            Artisan::call('passport:keys', ['--force' => true]);
            self::$passportKeysGenerated = true;
        }

        $this->seed(RolePermissionSeeder::class);
    }

    public function test_unauthenticated_api_request_returns_401(): void
    {
        $this->getJson('/api/v1/catalog/products')
            ->assertUnauthorized();
    }

    public function test_token_without_required_scope_returns_403(): void
    {
        $user = $this->inventoryManager();

        Passport::actingAs($user, ['stock:read']);

        $this->getJson('/api/v1/catalog/products')
            ->assertForbidden();
    }

    public function test_b2b_client_can_read_catalog_with_catalog_read_scope(): void
    {
        $user = $this->businessBuyer();
        $category = Category::factory()->create(['name' => 'API Category']);
        Product::factory()->create([
            'category_id' => $category->id,
            'sku' => 'API-SKU-001',
            'name' => 'API Product',
        ]);

        Passport::actingAs($user, ['catalog:read']);

        $this->getJson('/api/v1/catalog/products')
            ->assertOk()
            ->assertJsonPath('data.0.sku', 'API-SKU-001')
            ->assertJsonPath('meta.total', 1);
    }

    public function test_service_client_can_read_catalog_with_client_credentials_scope(): void
    {
        $client = Client::factory()->asClientCredentials()->create();
        $category = Category::factory()->create(['name' => 'Service API Category']);
        Product::factory()->create([
            'category_id' => $category->id,
            'sku' => 'SERVICE-SKU-001',
            'name' => 'Service API Product',
        ]);

        Passport::actingAsClient($client, ['catalog:read']);

        $this->withHeader('Authorization', 'Bearer service-token')
            ->getJson('/api/v1/catalog/products')
            ->assertOk()
            ->assertJsonPath('data.0.sku', 'SERVICE-SKU-001')
            ->assertJsonPath('meta.total', 1);
    }

    public function test_business_buyer_can_create_quote(): void
    {
        $user = $this->businessBuyer();
        $product = Product::factory()->create(['sku' => 'RFQ-SKU-001']);

        Passport::actingAs($user, ['orders:write']);

        $this->postJson('/api/v1/b2b/quotes', [
            'lines' => [
                ['product_id' => $product->id, 'quantity' => 5],
            ],
        ])
            ->assertCreated()
            ->assertJsonPath('data.status', QuoteStatus::Draft->value)
            ->assertJsonPath('data.items.0.product.sku', 'RFQ-SKU-001');

        $this->assertDatabaseHas('quotes', [
            'business_account_id' => $user->businessAccount->id,
            'status' => QuoteStatus::Draft->value,
        ]);
    }

    public function test_business_buyer_cannot_see_another_buyer_purchase_order(): void
    {
        $buyer = $this->businessBuyer();
        $otherBuyer = $this->businessBuyer();
        $ownPo = PurchaseOrder::factory()->create(['business_account_id' => $buyer->businessAccount->id]);
        $otherPo = PurchaseOrder::factory()->create(['business_account_id' => $otherBuyer->businessAccount->id]);

        Passport::actingAs($buyer, ['orders:write']);

        $response = $this->getJson('/api/v1/b2b/purchase-orders')
            ->assertOk();

        $ids = collect($response->json('data'))->pluck('id');

        $this->assertTrue($ids->contains($ownPo->id));
        $this->assertFalse($ids->contains($otherPo->id));
    }

    public function test_api_quote_creation_uses_same_quote_service_as_web_flow(): void
    {
        $user = $this->businessBuyer();
        $product = Product::factory()->create();
        $quote = Quote::factory()->create(['business_account_id' => $user->businessAccount->id]);

        $mock = Mockery::mock(QuoteService::class);
        $mock->shouldReceive('request')
            ->once()
            ->withArgs(function (BusinessAccount $businessAccount, array $lines) use ($user, $product) {
                return $businessAccount->is($user->businessAccount)
                    && $lines === [['product_id' => $product->id, 'quantity' => 2]];
            })
            ->andReturn($quote);

        $this->app->instance(QuoteService::class, $mock);

        Passport::actingAs($user, ['orders:write']);

        $this->postJson('/api/v1/b2b/quotes', [
            'lines' => [
                ['product_id' => $product->id, 'quantity' => 2],
            ],
        ])
            ->assertCreated()
            ->assertJsonPath('data.id', $quote->id);
    }

    private function inventoryManager(): User
    {
        $user = User::factory()->create();
        $user->addRole(UserRole::InventoryManager->value);

        return $user;
    }

    private function businessBuyer(): User
    {
        $user = User::factory()->create();
        $user->addRole(UserRole::BusinessBuyer->value);
        BusinessAccount::factory()->create(['user_id' => $user->id]);
        $user->load('businessAccount');

        return $user;
    }
}
