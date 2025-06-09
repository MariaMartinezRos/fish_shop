@component('mail::message')
# {{ __('Weekly Transactions Report') }}

{{ __('From') }}: {{ $summary['start'] }}
{{ __('To') }}: {{ $summary['end'] }}

- {{ __('Total Amount') }}: {{ number_format($summary['total_sales'], 2) }}€
- {{ __('Number of Transactions') }}: {{ $summary['transaction_count'] }}

{{ __('Date/Time') }} | TPV | Terminal | {{ __('Operation') }} | {{ __('Amount') }} | {{ __('Card') }} | Txn No.
-----------|-----|----------|-----------|--------|------|----------
@foreach ($summary['transactions'] as $txn)
{{ \Carbon\Carbon::parse($txn->date_time)->format('Y-m-d H:i') }} | {{ $txn->tpv }} | {{ $txn->terminal_number }} | {{ $txn->operation }} | {{ number_format($txn->amount, 2) }}€ | ****{{ substr($txn->card_number, -4) }} | {{ $txn->transaction_number }}
@endforeach

{{ __('Thanks') }},
PESCADERIAS BENITO
@endcomponent

