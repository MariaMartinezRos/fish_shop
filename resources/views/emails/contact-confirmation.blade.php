@component('mail::message')
# {{ __('Thank you for contacting us!')}}

{{ __('Your message has been successfully sent. We will get back to you shortly.')}}

{{ __('To return to our website, click on the following link:')}}

@component('mail::button', ['url' => url('login')])
    Login
@endcomponent

{{ __('If you need any further assistance, please don\'t hesitate to contact us.')}}

{{ __('Contact details')}}
Email: {{ config('app.mail') }}

{{ __('Thanks')}},<br>
{{ config('app.name') }}
@endcomponent
