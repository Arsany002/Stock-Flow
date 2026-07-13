<?php

namespace Database\Seeders;

use App\Models\CompanyWorkingHour;
use Illuminate\Database\Seeder;

/**
 * Default company schedule: Saturday-Thursday 09:00-18:00 Africa/Cairo,
 * Friday closed. day_of_week follows Carbon's convention
 * (0=Sunday..6=Saturday).
 */
class CompanyWorkingHourSeeder extends Seeder
{
    public function run(): void
    {
        $openDays = [0, 1, 2, 3, 4, 6]; // Sunday..Thursday + Saturday

        foreach ($openDays as $day) {
            CompanyWorkingHour::query()->updateOrCreate(
                ['day_of_week' => $day],
                ['opens_at' => '09:00:00', 'closes_at' => '18:00:00', 'is_open' => true, 'timezone' => 'Africa/Cairo'],
            );
        }

        CompanyWorkingHour::query()->updateOrCreate(
            ['day_of_week' => 5], // Friday
            ['opens_at' => null, 'closes_at' => null, 'is_open' => false, 'timezone' => 'Africa/Cairo'],
        );
    }
}
