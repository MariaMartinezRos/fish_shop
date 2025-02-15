@component('mail::message')
    # Thanks for creating an account, {{ $user->name }}!!

    You can now login to your account using the button below:

    @component('mail::button', ['url' => url('login')])
        Login
    @endcomponent

    Thanks,<br>
    {{ config('app.name') }}
@endcomponent
