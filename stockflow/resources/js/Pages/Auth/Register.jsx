import { useForm, Head, Link } from '@inertiajs/react';
import GuestLayout from '@/Layouts/GuestLayout';
import Input from '@/Components/Input';
import Button from '@/Components/Button';

export default function Register() {
    const { data, setData, post, processing, errors, reset } = useForm({
        name: '',
        email: '',
        password: '',
        password_confirmation: '',
    });

    function submit(event) {
        event.preventDefault();
        post('/register', {
            onFinish: () => reset('password', 'password_confirmation'),
        });
    }

    return (
        <GuestLayout>
            <Head title="Create an account" />

            <h1 className="mb-6 text-lg font-semibold text-gray-900">Create your StockFlow account</h1>

            <form onSubmit={submit} className="flex flex-col gap-4">
                <Input
                    label="Name"
                    type="text"
                    name="name"
                    autoComplete="name"
                    value={data.name}
                    error={errors.name}
                    onChange={(e) => setData('name', e.target.value)}
                    autoFocus
                    required
                />

                <Input
                    label="Email"
                    type="email"
                    name="email"
                    autoComplete="username"
                    value={data.email}
                    error={errors.email}
                    onChange={(e) => setData('email', e.target.value)}
                    required
                />

                <Input
                    label="Password"
                    type="password"
                    name="password"
                    autoComplete="new-password"
                    value={data.password}
                    error={errors.password}
                    onChange={(e) => setData('password', e.target.value)}
                    required
                />

                <Input
                    label="Confirm password"
                    type="password"
                    name="password_confirmation"
                    autoComplete="new-password"
                    value={data.password_confirmation}
                    error={errors.password_confirmation}
                    onChange={(e) => setData('password_confirmation', e.target.value)}
                    required
                />

                <Button type="submit" disabled={processing} className="mt-2 w-full">
                    Create account
                </Button>
            </form>

            <p className="mt-6 text-center text-sm text-gray-600">
                Already have an account?{' '}
                <Link href="/login" className="font-medium text-gray-900 underline">
                    Log in.
                </Link>
            </p>
        </GuestLayout>
    );
}
