@component('mail::message')
# {{ __('New Vacation Request') }}

{{ __('Hello') }},

{{ __('The employee') }} {{ $employee->name }} {{ __('has requested vacation.') }}

**{{ __('Request details') }}:**

- **{{ __('Employee') }}:** {{ $employee->name }}
- **{{ __('Start date') }}:** {{ $vacationRequest->start_date->format('d/m/Y') }}
- **{{ __('End date') }}:** {{ $vacationRequest->end_date->format('d/m/Y') }}
- **{{ __('Days requested') }}:** {{ $days_requested }}
- **{{ __('Reason') }}:** {{ $vacationRequest->comments }}

@component('mail::button', ['url' => route('users.index')])
{{ __('View Request') }}
@endcomponent

{{ __('Please review this request and take appropriate action.') }}

{{ __('Regards') }},<br>
{{ config('app.name') }}
@endcomponent 