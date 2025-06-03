<div>
    <h2 class="text-lg font-medium text-gray-900 mb-4">Solicitud de Vacaciones</h2>
    <form wire:submit="submit" class="space-y-6">
        <div>
            <label for="start_date" class="block text-sm font-medium text-gray-700">Fecha de Inicio</label>
            <input type="date" wire:model="start_date" id="start_date" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
            @error('start_date') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <div>
            <label for="end_date" class="block text-sm font-medium text-gray-700">Fecha de Fin</label>
            <input type="date" wire:model="end_date" id="end_date" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
            @error('end_date') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <div>
            <label for="comments" class="block text-sm font-medium text-gray-700">Comentarios</label>
            <textarea wire:model="comments" id="comments" rows="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"></textarea>
            @error('comments') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <div>
            <div class="flex items-center">
                <input type="checkbox" wire:model="policy_acknowledged" id="policy_acknowledged" class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500">
                <label for="policy_acknowledged" class="ml-2 block text-sm text-gray-900">
                    Acepto la política de vacaciones
                </label>
            </div>
            @error('policy_acknowledged') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        @if($total_days > 0)
            <div class="text-sm text-gray-600">
                Total días: {{ $total_days }}
            </div>
        @endif

        <div>
            <button type="submit" class="inline-flex justify-center rounded-md border border-transparent bg-indigo-600 py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                Enviar Solicitud
            </button>
        </div>
    </form>
</div> 