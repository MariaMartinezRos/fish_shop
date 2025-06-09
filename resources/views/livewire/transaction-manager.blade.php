<div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
    <!-- Search and Add Button -->
    <div class="flex justify-between items-center mb-4">
        <div class="w-1/3">
            <x-input
                name="search"
                type="text"
                placeholder="{{ __('Search transactions...') }}"
                class="w-full"
                wire:model.live="search"
            />
        </div>
        <button wire:click="create" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
            {{ __('Add Transaction') }}
        </button>
    </div>

    <!-- Flash Message -->
    @if (session()->has('message'))
        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-4" role="alert">
            <p>{{ session('message') }}</p>
        </div>
    @endif

    @if (session()->has('error'))
        <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-4" role="alert">
            <div class="flex">
                <div class="flex-shrink-0">
                    <svg class="h-5 w-5 text-red-500" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                    </svg>
                </div>
                <div class="ml-3">
                    <p class="text-sm">{{ session('error') }}</p>
                </div>
            </div>
        </div>
    @endif

    <!-- Form - Only shown when creating or editing -->
    @if($editing || $creating)
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg mb-4">
            <div class="p-6">
                <h2 class="text-xl font-semibold mb-4">
                    {{ $editing ? __('Edit Transaction') : __('Create New Transaction') }}
                </h2>
                <form wire:submit="{{ $editing ? 'update' : 'store' }}">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <x-label for="tpv" value="{{ __('TPV') }}" required />
                            <x-input
                                name="tpv"
                                type="text"
                                class="mt-1 block w-full"
                                required
                                wire:model="tpv"
                                placeholder="e.g., PESCADERIA BENITO ALHAMA"
                            />
                            <x-input-error :messages="$errors->get('tpv')" class="mt-2" />
                        </div>

                        <div>
                            <x-label for="serial_number" value="{{ __('Serial Number') }}" required  />
                            <x-input
                                name="serial_number"
                                type="text"
                                class="mt-1 block w-full"
                                required
                                wire:model="serial_number"
                                placeholder="e.g., SN123456"
                            />
                            <x-input-error :messages="$errors->get('serial_number')" class="mt-2" />
                        </div>

                        <div>
                            <x-label for="terminal_number" value="{{ __('Terminal Number') }}" required />
                            <x-input
                                name="terminal_number"
                                type="text"
                                class="mt-1 block w-full"
                                required
                                wire:model="terminal_number"
                                placeholder="e.g., TERM-001"
                            />
                            <x-input-error :messages="$errors->get('terminal_number')" class="mt-2" />
                        </div>

                        <div>
                            <x-label for="operation" value="{{ __('Operation') }}" required  />
                            <select
                                name="operation"
                                class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-700 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50"
                                required
                                wire:model="operation"
                            >
                                <option value="">{{ __('Select Operation') }}</option>
                                <option value="{{  __('SALE') }}">{{ __('Sale') }}</option>
                                <option value="{{  __('REFUND') }}">{{ __('Refund') }}</option>
                            </select>
                            <x-input-error :messages="$errors->get('operation')" class="mt-2" />
                        </div>

                        <div>
                            <x-label for="amount" value="{{ __('Amount') }}" required  />
                            <x-input
                                name="amount"
                                type="number"
                                step="0.01"
                                class="mt-1 block w-full"
                                required
                                wire:model="amount"
                                placeholder="e.g., 99.99"
                            />
                            <x-input-error :messages="$errors->get('amount')" class="mt-2" />
                        </div>

                        <div>
                            <x-label for="card_number" value="{{ __('Card Number') }}" required  />
                            <x-input
                                name="card_number"
                                type="text"
                                class="mt-1 block w-full"
                                required
                                wire:model="card_number"
                                placeholder="e.g., 1234567890123456"
                            />
                            <x-input-error :messages="$errors->get('card_number')" class="mt-2" />
                        </div>

                        <div>
                            <x-label for="date_time" value="{{ __('Date') }}" required  />
                            <x-date
                                name="date_time"
                                type="datetime-local"
                                wire:model="date_time"
                                class="w-full"
                                :error="$errors->first('date_time')"
                            />
                        </div>


                        <div>
                            <x-label for="transaction_number" value="{{ __('Transaction Number') }}" required  />
                            <x-input
                                name="transaction_number"
                                type="text"
                                class="mt-1 block w-full"
                                required
                                wire:model="transaction_number"
                                placeholder="e.g., TXN-001"
                            />
                            <x-input-error :messages="$errors->get('transaction_number')" class="mt-2" />
                        </div>

                        <div>
                            <x-label for="sale_id" value="{{ __('Sale ID') }}" required />
                            <x-input
                                name="sale_id"
                                type="number"
                                class="mt-1 block w-full"
                                required
                                wire:model="sale_id"
                                placeholder="e.g., 123"
                            />
                            <x-input-error :messages="$errors->get('sale_id')" class="mt-2" />
                        </div>

                        <div class="col-span-2 flex justify-end space-x-2 pt-4 border-t">
                            <button type="button" wire:click="cancel" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                                {{ __('Cancel') }}
                            </button>
                            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                {{ $editing ? __('Update Transaction') : __('Create Transaction') }}
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    @endif

    <!-- Transactions List -->
    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6">
            <div class="overflow-x-auto">
                <table class="min-w-full bg-white dark:bg-gray-700 rounded-lg">
                    <thead class="bg-gray-100 dark:bg-gray-600">
                        <tr>
                            <th class="px-4 py-2 text-left">{{ __('TPV') }}</th>
                            <th class="px-4 py-2 text-left">{{ __('Operation') }}</th>
                            <th class="px-4 py-2 text-left">{{ __('Amount') }}</th>
                            <th class="px-4 py-2 text-left">{{ __('Card Number') }}</th>
                            <th class="px-4 py-2 text-left">{{ __('Date Time') }}</th>
                            <th class="px-4 py-2 text-left">{{ __('Actions') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($transactions as $transaction)
                            <tr class="border-t hover:bg-gray-50 dark:hover:bg-gray-600">
                                <td class="px-4 py-2">{{ $transaction->tpv }}</td>
                                <td class="px-4 py-2">{{ $transaction->operation }}</td>
                                <td class="px-4 py-2 font-semibold text-green-600">€{{ number_format($transaction->amount, 2) }}</td>
                                <td class="px-4 py-2">**** **** **** {{ substr($transaction->card_number, -4) }}</td>
                                <td class="px-4 py-2">{{ $transaction->date_time }}</td>
                                <td class="px-4 py-2">
                                    <div class="flex space-x-2">
                                        <button wire:click="edit({{ $transaction->id }})" class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded">
                                            {{ __('Edit') }}
                                        </button>
                                        <button wire:click="delete({{ $transaction->id }})" wire:confirm="{{ __('Are you sure you want to delete this transaction?') }}" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
                                            {{ __('Delete') }}
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-4 py-3 text-center text-gray-500">
                                    {{ __('No transactions found.') }}
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-4">
                {{ $transactions->links() }}
            </div>
        </div>
    </div>
</div>
