<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Transactions') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{ __("The transactions section") }}
                </div>
                <div class="p-6 text-gray-900 dark:text-gray-100">

{{--                    @livewire('admin-transactions')--}}
{{--                    <livewire:admin-transactions :transactions="$transactions" />--}}

                    <div>
                        <div>
                            <label for="tvp">{{ __('Filter by Fish Shop') }}</label>
                            <select wire:change="filter(value)" id="tvp">
                                <option value="">{{ __('All') }}</option>
                                <option value="PESCADERIA BENITO ALHAMA">{{ __('Pescadería Benito')}} ALHAMA</option>
                                <option value="PESCADERIA BENITO LIBRILLA">{{ __('Pescadería Benito')}} LIBRILLA</option>
                            </select>

                            <table border="1">
                                <thead>
                                <tr>
                                    <th>{{ __('ID')}}</th>
{{--                                    <th>{{ __('TVP')}}</th>--}}
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
                                            <td>{{ $transaction->id }}</td>
{{--                                            <td>{{ $transaction->tvp }}</td>--}}
                                            <td>{{ $transaction->serial_number }}</td>
                                            <td>{{ $transaction->terminal_number }}</td>
                                            <td>{{ $transaction->operation }}</td>
                                            <td>{{ $transaction->amount }}</td>
                                            <td>{{ $transaction->card_number }}</td>
                                            <td>{{ $transaction->date_time }}</td>
                                            <td>{{ $transaction->transaction_number }}</td>
                                            <td>{{ $transaction->sale_id }}</td>
                                            <td>{{ $transaction->created_at }}</td>
                                            <td>{{ $transaction->updated_at }}</td>

                                        </tr>
                                    @endforeach
                                @endif
                                </tbody>
                            </table>
                        </div>
                    </div>



                    {{--                    @if(isset($transactions) && count($transactions) > 0)--}}
{{--                        @foreach($transactions as $transaction)--}}
{{--                            <h2>{{ __("TPV: ") }}{{ $transaction->tpv }}</h2><br/>--}}
{{--                            <h2>{{ __("Serial Number: ") }}{{ $transaction->serial_number }}</h2><br/>--}}
{{--                            <h2>{{ __("Terminal Number: ") }}{{ $transaction->terminal_number }}</h2><br/>--}}
{{--                            <h2>{{ __("Operation: ") }}{{ $transaction->operation }}</h2><br/>--}}
{{--                            <h2>{{ __("Amount (€): ") }}{{ $transaction->amount }}</h2><br/>--}}
{{--                            <h2>{{ __("Card Number: ") }}{{ $transaction->card_number }}</h2><br/>--}}
{{--                            <h2>{{ __("Date/Time: ") }}{{ $transaction->date_time }}</h2><br/>--}}
{{--                            <h2>{{ __("Transaction Number: ") }}{{ $transaction->transaction_number }}</h2><br/>--}}
{{--                            <h2>{{ __("Sale ID: ") }}{{ $transaction->sale_id }}</h2><br/><br/>--}}
{{--                        @endforeach--}}
{{--                    @else--}}
{{--                        <p>{{ __("No products found.") }}</p>--}}
{{--                    @endif--}}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>


