<div class="bg-white p-4 rounded-lg shadow mb-4">
    <div class="space-y-4">
        <div class="flex items-center">
            <input type="checkbox" 
                   id="use_inventory_metrics" 
                   name="use_inventory_metrics" 
                   value="1" 
                   class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                   {{ request('use_inventory_metrics') ? 'checked' : '' }}>
            <label for="use_inventory_metrics" class="ml-2 text-sm font-medium text-gray-700">
                Filtrar por métricas de inventario
            </label>
        </div>

        <div id="inventory-metrics" class="space-y-4 {{ request('use_inventory_metrics') ? '' : 'hidden' }}">
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label for="stock_threshold" class="block text-sm font-medium text-gray-700">Umbral de stock</label>
                    <input type="number" 
                           name="stock_threshold" 
                           id="stock_threshold" 
                           value="{{ request('stock_threshold') }}"
                           class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                </div>
                <div>
                    <label for="days_on_sale_threshold" class="block text-sm font-medium text-gray-700">Días en venta</label>
                    <input type="number" 
                           name="days_on_sale_threshold" 
                           id="days_on_sale_threshold" 
                           value="{{ request('days_on_sale_threshold') }}"
                           class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                </div>
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label for="min_price" class="block text-sm font-medium text-gray-700">Precio mínimo</label>
                    <input type="number" 
                           step="0.01"
                           name="min_price" 
                           id="min_price" 
                           value="{{ request('min_price') }}"
                           class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                </div>
                <div>
                    <label for="max_price" class="block text-sm font-medium text-gray-700">Precio máximo</label>
                    <input type="number" 
                           step="0.01"
                           name="max_price" 
                           id="max_price" 
                           value="{{ request('max_price') }}"
                           class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                </div>
            </div>

            <div class="flex items-center">
                <input type="checkbox" 
                       id="include_sales_metrics" 
                       name="include_sales_metrics" 
                       value="1" 
                       class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                       {{ request('include_sales_metrics') ? 'checked' : '' }}>
                <label for="include_sales_metrics" class="ml-2 text-sm font-medium text-gray-700">
                    Incluir métricas de ventas
                </label>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    document.getElementById('use_inventory_metrics').addEventListener('change', function() {
        document.getElementById('inventory-metrics').classList.toggle('hidden', !this.checked);
    });
</script>
@endpush 