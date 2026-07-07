import { useForm, Head } from '@inertiajs/react';
import GuestLayout from '@/Layouts/GuestLayout';
import Input from '@/Components/Input';
import Button from '@/Components/Button';

export default function Login() {
    const { data, setData, post, processing, errors, reset } = useForm({
        email: '',
        password: '',
        remember: false,
    });

    function submit(event) {
        event.preventDefault();
        post('/login', {
            onFinish: () => reset('password'),
        });
    }

    return (
        <GuestLayout>
            <Head title="Log in" />

            <h1 className="mb-6 text-lg font-semibold text-gray-900">Log in to StockFlow</h1>

            <form onSubmit={submit} className="flex flex-col gap-4">
                <Input
                    label="Email"
                    type="email"
                    name="email"
                    autoComplete="username"
                    value={data.email}
                    error={errors.email}
                    onChange={(e) => setData('email', e.target.value)}
                    autoFocus
                    required
                />

                <Input
                    label="Password"
                    type="password"
                    name="password"
                    autoComplete="current-password"
                    value={data.password}
                    error={errors.password}
                    onChange={(e) => setData('password', e.target.value)}
                    required
                />

                <label className="flex items-center gap-2 text-sm text-gray-600">
                    <input
                        type="checkbox"
                        checked={data.remember}
                        onChange={(e) => setData('remember', e.target.checked)}
                        className="rounded border-gray-300"
                    />
                    Remember me
                </label>

                <Button type="submit" disabled={processing} className="mt-2 w-full">
                    Log in
                </Button>
            </form>
        </GuestLayout>
    );
}
