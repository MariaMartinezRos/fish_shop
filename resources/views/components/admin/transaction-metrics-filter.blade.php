<div class="bg-white p-4 rounded-lg shadow mb-4">
    <div class="flex items-center mb-4">
        <input type="checkbox" 
               id="use_transaction_metrics" 
               name="use_transaction_metrics" 
               value="1" 
               class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
               {{ request('use_transaction_metrics') ? 'checked' : '' }}>
        <label for="use_transaction_metrics" class="ml-2 text-sm font-medium text-gray-700">
            Usar métricas de transacciones
        </label>
    </div>

    <div id="metrics-filters" class="space-y-4 {{ request('use_transaction_metrics') ? '' : 'hidden' }}">
        <div class="grid grid-cols-2 gap-4">
            <div>
                <label for="start_date" class="block text-sm font-medium text-gray-700">Fecha inicio</label>
                <input type="datetime-local" 
                       name="start_date" 
                       id="start_date" 
                       value="{{ request('start_date') }}"
                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
            </div>
            <div>
                <label for="end_date" class="block text-sm font-medium text-gray-700">Fecha fin</label>
                <input type="datetime-local" 
                       name="end_date" 
                       id="end_date" 
                       value="{{ request('end_date') }}"
                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
            </div>
        </div>

        <div>
            <label for="min_amount" class="block text-sm font-medium text-gray-700">Importe mínimo (€)</label>
            <input type="number" 
                   step="0.01" 
                   name="min_amount" 
                   id="min_amount" 
                   value="{{ request('min_amount') }}"
                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Tipos de operación</label>
            <div class="space-y-2">
                <div class="flex items-center">
                    <input type="checkbox" 
                           id="operation_sale" 
                           name="operation_types[]" 
                           value="SALE" 
                           class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                           {{ in_array('SALE', request('operation_types', [])) ? 'checked' : '' }}>
                    <label for="operation_sale" class="ml-2 text-sm text-gray-700">Venta</label>
                </div>
                <div class="flex items-center">
                    <input type="checkbox" 
                           id="operation_refund" 
                           name="operation_types[]" 
                           value="REFUND" 
                           class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                           {{ in_array('REFUND', request('operation_types', [])) ? 'checked' : '' }}>
                    <label for="operation_refund" class="ml-2 text-sm text-gray-700">Devolución</label>
                </div>
            </div>
        </div>

        <div class="flex items-center">
            <input type="checkbox" 
                   id="include_user_metrics" 
                   name="include_user_metrics" 
                   value="1" 
                   class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                   {{ request('include_user_metrics') ? 'checked' : '' }}>
            <label for="include_user_metrics" class="ml-2 text-sm font-medium text-gray-700">
                Incluir métricas de usuario
            </label>
        </div>
    </div>
</div>

@push('scripts')
<script>
    document.getElementById('use_transaction_metrics').addEventListener('change', function() {
        document.getElementById('metrics-filters').classList.toggle('hidden', !this.checked);
    });
</script>
@endpush 