@component('mail::message')
# {{ __('Thank you for contacting us!')}}

{{ __('Your message has been successfully sent. We will get back to you shortly.')}}

{{ __('To return to our website, click on the following link:')}}
{{ url('login') }}

{{ __('If you need any further assistance, please don\'t hesitate to contact us.')}}

{{ __('Contact details')}}
Email: {{ config('app.mail') }}

{{ __('Thanks')}},
{{ config('app.name') }}
@endcomponent
