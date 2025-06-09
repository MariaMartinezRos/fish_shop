<div class="bg-white p-4 rounded-lg shadow mb-4">
    <div class="space-y-4">
        <div class="flex items-center">
            <input type="checkbox" 
                   id="use_search_scope" 
                   name="use_search_scope" 
                   value="1" 
                   class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                   {{ request('use_search_scope') ? 'checked' : '' }}>
            <label for="use_search_scope" class="ml-2 text-sm font-medium text-gray-700">
                Buscar por TPV
            </label>
        </div>

        <div id="search-filters" class="space-y-4 {{ request('use_search_scope') ? '' : 'hidden' }}">
            <div>
                <label for="tpv" class="block text-sm font-medium text-gray-700">TPV</label>
                <input type="text" 
                       name="tpv" 
                       id="tpv" 
                       value="{{ request('tpv') }}"
                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
            </div>
        </div>

        <div class="flex items-center">
            <input type="checkbox" 
                   id="use_terminal_scope" 
                   name="use_terminal_scope" 
                   value="1" 
                   class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                   {{ request('use_terminal_scope') ? 'checked' : '' }}>
            <label for="use_terminal_scope" class="ml-2 text-sm font-medium text-gray-700">
                Filtrar por terminal
            </label>
        </div>

        <div id="terminal-filters" class="space-y-4 {{ request('use_terminal_scope') ? '' : 'hidden' }}">
            <div>
                <label for="terminal_number" class="block text-sm font-medium text-gray-700">Terminal</label>
                <input type="text" 
                       name="terminal_number" 
                       id="terminal_number" 
                       value="{{ request('terminal_number') }}"
                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
            </div>
        </div>

        <div class="flex items-center">
            <input type="checkbox" 
                   id="use_operation_scope" 
                   name="use_operation_scope" 
                   value="1" 
                   class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                   {{ request('use_operation_scope') ? 'checked' : '' }}>
            <label for="use_operation_scope" class="ml-2 text-sm font-medium text-gray-700">
                Filtrar por operación
            </label>
        </div>

        <div id="operation-filters" class="space-y-4 {{ request('use_operation_scope') ? '' : 'hidden' }}">
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
        </div>

        <div class="flex items-center">
            <input type="checkbox" 
                   id="use_date_scope" 
                   name="use_date_scope" 
                   value="1" 
                   class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                   {{ request('use_date_scope') ? 'checked' : '' }}>
            <label for="use_date_scope" class="ml-2 text-sm font-medium text-gray-700">
                Filtrar por fecha
            </label>
        </div>

        <div id="date-filters" class="space-y-4 {{ request('use_date_scope') ? '' : 'hidden' }}">
            <div class="grid grid-cols-2 gap-4">
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
        </div>
    </div>
</div>

@push('scripts')
<script>
    document.getElementById('use_search_scope').addEventListener('change', function() {
        document.getElementById('search-filters').classList.toggle('hidden', !this.checked);
    });

    document.getElementById('use_terminal_scope').addEventListener('change', function() {
        document.getElementById('terminal-filters').classList.toggle('hidden', !this.checked);
    });

    document.getElementById('use_operation_scope').addEventListener('change', function() {
        document.getElementById('operation-filters').classList.toggle('hidden', !this.checked);
    });

    document.getElementById('use_date_scope').addEventListener('change', function() {
        document.getElementById('date-filters').classList.toggle('hidden', !this.checked);
    });
</script>
@endpush 