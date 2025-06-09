<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Transacciones') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form method="GET" action="{{ route('admin.transactions.index') }}" class="mb-6">
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 mb-4">
                            <div>
                                <label for="tpv" class="block text-sm font-medium text-gray-700">TPV</label>
                                <input type="text" 
                                       name="tpv" 
                                       id="tpv" 
                                       value="{{ request('tpv') }}"
                                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                            </div>

                            <div>
                                <label for="terminal_number" class="block text-sm font-medium text-gray-700">Terminal</label>
                                <input type="text" 
                                       name="terminal_number" 
                                       id="terminal_number" 
                                       value="{{ request('terminal_number') }}"
                                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                            </div>

                            <div>
                                <label for="operation" class="block text-sm font-medium text-gray-700">Operación</label>
                                <select name="operation" 
                                        id="operation"
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                    <option value="">Todas</option>
                                    <option value="SALE" {{ request('operation') == 'SALE' ? 'selected' : '' }}>Venta</option>
                                    <option value="REFUND" {{ request('operation') == 'REFUND' ? 'selected' : '' }}>Devolución</option>
                                </select>
                            </div>

                            <div>
                                <label for="date_from" class="block text-sm font-medium text-gray-700">Fecha desde</label>
                                <input type="datetime-local" 
                                       name="date_from" 
                                       id="date_from" 
                                       value="{{ request('date_from') }}"
                                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                            </div>

                            <div>
                                <label for="date_to" class="block text-sm font-medium text-gray-700">Fecha hasta</label>
                                <input type="datetime-local" 
                                       name="date_to" 
                                       id="date_to" 
                                       value="{{ request('date_to') }}"
                                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                            </div>
                        </div>

                        <x-admin.transaction-metrics-filter />
                        
                        <div class="mt-4">
                            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                Filtrar
                            </button>
                        </div>
                    </form>

                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">TPV</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Terminal</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Operación</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Importe</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Fecha</th>
                                    @if(request('use_transaction_metrics') && request('include_user_metrics'))
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Total Transacciones</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Total Importe</th>
                                    @endif
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach($transactions as $transaction)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap">{{ $transaction->tpv }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">{{ $transaction->terminal_number }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">{{ $transaction->operation }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">{{ number_format($transaction->amount, 2) }}€</td>
                                        <td class="px-6 py-4 whitespace-nowrap">{{ $transaction->date_time }}</td>
                                        @if(request('use_transaction_metrics') && request('include_user_metrics'))
                                            <td class="px-6 py-4 whitespace-nowrap">{{ $transaction->user->total_user_transactions }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap">{{ number_format($transaction->user->transactions_sum_amount, 2) }}€</td>
                                        @endif
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="mt-4">
                        {{ $transactions->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout> 