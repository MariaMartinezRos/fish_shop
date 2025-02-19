<div>
    <div>
        <label for="tvp">{{ ('Filter by Fish Shop') }}</label>
        <select wire:model="tvp" id="tvp">
            <option value="">{{ __('All') }}</option>
            <option value="PESCADERIA BENITO ALHAMA">{{ __('Pescadería Benito')}} ALHAMA</option>
            <option value="PESCADERIA BENITO LIBRILLA">{{ __('Pescadería Benito')}} LIBRILLA</option>
        </select>

        <table border="1">
            <thead>
            <tr>
                <th>{{ __('ID')}}</th>
                <th>{{ __('TVP')}}</th>
                <th>{{ __('Serial Number')}}</th>
                <th>{{ __('Terminal Number')}}</th>
                <th>{{ __('Operation')}}</th>
                <th>{{ __('Amount (€)')}}</th>
                <th>{{ __('Card Number')}}</th>
                <th>{{ __('Date Time')}}</th>
                <th>{{ __('Transaction Number')}}</th>
                <th>{{ __('Sale ID')}}</th>
                <th>{{ __('Created At')}}</th>
                <th>{{ __('Updated At')}}</th>
            </tr>
            </thead>
            <tbody>
            @if($transactions->isEmpty())
                <p>{{ __('No transactions found')}}.</p>
            @else
            @foreach ($transactions as $transaction)
                <tr>
                    <td>{{ $transaction['id'] }}</td>
                    <td>{{ $transaction['tvp'] }}</td>
                    <td>{{ $transaction['serial_number'] }}</td>
                    <td>{{ $transaction['terminal_number'] }}</td>
                    <td>{{ $transaction['operation'] }}</td>
                    <td>{{ $transaction['amount'] }}</td>
                    <td>{{ $transaction['card_number'] }}</td>
                    <td>{{ $transaction['date_time'] }}</td>
                    <td>{{ $transaction['transaction_number'] }}</td>
                    <td>{{ $transaction['sale_id'] }}</td>
                    <td>{{ $transaction['created_at'] }}</td>
                    <td>{{ $transaction['updated_at'] }}</td>
                </tr>
            @endforeach
                @endif
            </tbody>
        </table>
    </div>
</div>
