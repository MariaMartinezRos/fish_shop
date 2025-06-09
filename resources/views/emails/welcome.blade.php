@component('mail::message')
# {{ __('Thanks for creating an account')}}, {{ $user->name }}!!

{{ __('You can now login to your account using the button below:')}}

{{ __('Login') }}: {{ url('login') }}

{{ __('Thanks')}},
{{ config('app.name') }}
@endcomponent
