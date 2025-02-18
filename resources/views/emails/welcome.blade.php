@component('mail::message')
    # {{ __('Thanks for creating an account')}}, {{ $user->name }}!!

    {{ __('You can now login to your account using the button below:')}}

    @component('mail::button', ['url' => url('login')])
        Login
    @endcomponent

    {{ __('Thanks')}},<br>
    {{ config('app.name') }}
@endcomponent
