<div class="max-w-2xl mx-auto p-6">
    <h2 class="text-2xl font-bold mb-6 text-gray-800">{{ __('Vacation Request Form') }}</h2>

    @if (session()->has('message'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
            <span class="block sm:inline">{{ session('message') }}</span>
        </div>
    @endif

    @if (session()->has('error'))
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
            <span class="block sm:inline">{{ session('error') }}</span>
        </div>
    @endif

    <form wire:submit.prevent="submit" class="space-y-6">
        <div>
            <label for="start_date" class="block text-sm font-medium text-gray-700">{{ __('Start Date') }}</label>
            <x-date
                name="start_date"
                wire:model="start_date"
                :error="$errors->first('start_date')"
            />
        </div>

        <div>
            <label for="end_date" class="block text-sm font-medium text-gray-700">{{ __('End Date') }}</label>
            <x-date
                name="end_date"
                wire:model="end_date"
                :error="$errors->first('end_date')"
            />
        </div>

        <div>
            <label for="comments" class="block text-sm font-medium text-gray-700">{{ __('Comments') }}</label>
            <textarea id="comments"
                      wire:model="comments"
                      rows="4"
                      class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500"
                      placeholder="{{ __('Please provide details about your vacation request...') }}"></textarea>
            @error('comments') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <div>
            <x-checkbox
                name="policy_acknowledged"
                wire:model="policy_acknowledged"
                :label="__('I acknowledge that I have read and agree to the company vacation policy')"
                class="text-green-600 focus:ring-green-500"
            />
            @error('policy_acknowledged') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <div class="flex space-x-4">
            <button type="submit"
                    @if($hasApprovedVacation) disabled @endif
                    class="inline-flex justify-center py-2 px-4 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white {{ $hasApprovedVacation ? 'bg-gray-400 cursor-not-allowed' : 'hover:text-white bg-green-600 hover:bg-green-700' }} focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                {{ $hasApprovedVacation ? __('You have an approved vacation request') : __('Submit Request') }}
            </button>

            <button type="button"
                    wire:click="downloadPdf"
                    class="inline-flex justify-center py-2 px-4 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-blue-500 hover:text-white focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                {{ __('Download PDF') }}
            </button>
        </div>
    </form>
</div>
