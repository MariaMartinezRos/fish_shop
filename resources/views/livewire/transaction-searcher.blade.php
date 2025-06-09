<div>
    <div class="p-6 bg-white shadow-lg rounded-lg">
        <div class="mb-4">
            <x-checkbox
                name="todays_transactions"
                wire:model.live="todays_transactions"
                :label="__('Show only today\'s SALES')"
                class="text-green-600 focus:ring-green-500"
            />
        </div>

        <div class="mb-4">
            <label for="tpv" class="block text-lg font-semibold text-gray-700">{{ __('Filter by Fish Shop') }}</label>
            <x-select-livewire
                name="tpv"
                wire:model.live="tpv"
                :options="[
                    '' => __('All'),
                    'PESCADERIA BENITO ALHAMA' => __('Pescadería Benito ALHAMA'),
                    'PESCADERIA BENITO LIBRILLA' => __('Pescadería Benito LIBRILLA')
                ]"
            />
        </div>

        <div class="overflow-x-auto">
            <table class="min-w-full bg-white border border-gray-200 shadow-md rounded-lg">
                <thead class="bg-blue-600 text-white">
                <tr>
                    <th class="px-4 py-2 text-left">{{ __('ID') }}</th>
                    <th class="px-4 py-2 text-left">{{ __('TPV') }}</th>
                    <th class="px-4 py-2 text-left">{{ __('Serial Number') }}</th>
                    <th class="px-4 py-2 text-left">{{ __('Terminal Number') }}</th>
                    <th class="px-4 py-2 text-left">{{ __('Operation') }}</th>
                    <th class="px-4 py-2 text-left">{{ __('Amount (€)') }}</th>
                    <th class="px-4 py-2 text-left">{{ __('Card Number') }}</th>
                    <th class="px-4 py-2 text-left">{{ __('Date Time') }}</th>
                    <th class="px-4 py-2 text-left">{{ __('Transaction Number') }}</th>
                    <th class="px-4 py-2 text-left">{{ __('Created At') }}</th>
                    <th class="px-4 py-2 text-left">{{ __('Updated At') }}</th>
                </tr>
                </thead>
                <tbody>
                @if($transactions->isEmpty())
                    <tr>
                        <td colspan="12" class="px-4 py-3 text-center text-gray-500">{{ __('No transactions found') }}.</td>
                    </tr>
                @else
                    @foreach ($transactions as $transaction)
                        <tr class="border-t hover:bg-gray-100">
                            <td class="px-4 py-2">{{ $transaction->id }}</td>
                            <td class="px-4 py-2">{{ $transaction->tpv }}</td>
                            <td class="px-4 py-2">{{ $transaction->serial_number }}</td>
                            <td class="px-4 py-2">{{ $transaction->terminal_number }}</td>
                            <td class="px-4 py-2">{{ $transaction->operation }}</td>
                            <td class="px-4 py-2 font-semibold text-green-600">€{{ number_format($transaction->amount, 2) }}</td>
                            <td class="px-4 py-2">**** **** **** {{ substr($transaction->card_number, -4) }}</td>
                            <td class="px-4 py-2">{{ $transaction->date_time }}</td>
                            <td class="px-4 py-2">{{ $transaction->transaction_number }}</td>
                            <td class="px-4 py-2 text-gray-500">{{ $transaction->created_at->format('d M Y, H:i') }}</td>
                            <td class="px-4 py-2 text-gray-500">{{ $transaction->updated_at->format('d M Y, H:i') }}</td>
                        </tr>
                    @endforeach
                @endif
                </tbody>
            </table>
        </div>
    </div></div>
