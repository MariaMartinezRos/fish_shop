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
                Usar búsqueda por nombre
            </label>
        </div>

        <div id="search-filters" class="space-y-4 {{ request('use_search_scope') ? '' : 'hidden' }}">
            <div>
                <label for="search" class="block text-sm font-medium text-gray-700">Buscar</label>
                <input type="text" 
                       name="search" 
                       id="search" 
                       value="{{ request('search') }}"
                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
            </div>
        </div>

        <div class="flex items-center">
            <input type="checkbox" 
                   id="use_category_scope" 
                   name="use_category_scope" 
                   value="1" 
                   class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                   {{ request('use_category_scope') ? 'checked' : '' }}>
            <label for="use_category_scope" class="ml-2 text-sm font-medium text-gray-700">
                Filtrar por categoría
            </label>
        </div>

        <div id="category-filters" class="space-y-4 {{ request('use_category_scope') ? '' : 'hidden' }}">
            <div>
                <label for="category_id" class="block text-sm font-medium text-gray-700">Categoría</label>
                <select name="category_id" 
                        id="category_id"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                    <option value="">Todas</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ request('category_id') == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="flex items-center">
            <input type="checkbox" 
                   id="use_supplier_scope" 
                   name="use_supplier_scope" 
                   value="1" 
                   class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                   {{ request('use_supplier_scope') ? 'checked' : '' }}>
            <label for="use_supplier_scope" class="ml-2 text-sm font-medium text-gray-700">
                Filtrar por proveedor
            </label>
        </div>

        <div id="supplier-filters" class="space-y-4 {{ request('use_supplier_scope') ? '' : 'hidden' }}">
            <div>
                <label for="supplier" class="block text-sm font-medium text-gray-700">Proveedor</label>
                <input type="text" 
                       name="supplier" 
                       id="supplier" 
                       value="{{ request('supplier') }}"
                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    document.getElementById('use_search_scope').addEventListener('change', function() {
        document.getElementById('search-filters').classList.toggle('hidden', !this.checked);
    });

    document.getElementById('use_category_scope').addEventListener('change', function() {
        document.getElementById('category-filters').classList.toggle('hidden', !this.checked);
    });

    document.getElementById('use_supplier_scope').addEventListener('change', function() {
        document.getElementById('supplier-filters').classList.toggle('hidden', !this.checked);
    });
</script>
@endpush 