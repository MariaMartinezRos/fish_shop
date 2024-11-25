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
                    @if(isset($transactions) && count($transactions) > 0)
                        @foreach($transactions as $transaction)
                            <h2>{{ __("TPV: ") }}{{ $transaction->tpv }}</h2><br/>
                            <h2>{{ __("Serial Number: ") }}{{ $transaction->serial_number }}</h2><br/>
                            <h2>{{ __("Terminal Number: ") }}{{ $transaction->terminal_number }}</h2><br/>
                            <h2>{{ __("Operation: ") }}{{ $transaction->operation }}</h2><br/>
                            <h2>{{ __("Amount (€): ") }}{{ $transaction->amount }}</h2><br/>
                            <h2>{{ __("Card Number: ") }}{{ $transaction->card_number }}</h2><br/>
                            <h2>{{ __("Date/Time: ") }}{{ $transaction->date_time }}</h2><br/>
                            <h2>{{ __("Transaction Number: ") }}{{ $transaction->transaction_number }}</h2><br/>
                            <h2>{{ __("Sale ID: ") }}{{ $transaction->sale_id }}</h2><br/>
                            <h2>{{ __("Created At: ") }}{{ $transaction->created_at }}</h2><br/>
                            <h2>{{ __("Updated At: ") }}{{ $transaction->updated_at }}</h2><br/><br/>
                        @endforeach
                    @else
                        <p>{{ __("No products found.") }}</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

{{--$table->id();--}}
{{--$table->string('tpv');--}}
{{--$table->string('serial_number');--}}
{{--$table->string('terminal_number');--}}
{{--$table->string('operation');--}}
{{--$table->decimal('amount', 10, 2);--}}
{{--$table->string('card_number');--}}
{{--$table->dateTime('date_time');--}}
{{--$table->string('transaction_number');--}}
{{--$table->unsignedBigInteger('sale_id')->index();--}}
{{--$table->timestamp('created_at')->nullable();--}}
{{--$table->timestamp('updated_at')->nullable();--}}
