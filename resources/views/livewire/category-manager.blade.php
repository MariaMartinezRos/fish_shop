<div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
    <!-- Search and Add Button -->
    <div class="flex justify-between items-center mb-4">
        <div class="w-1/3">
            <x-input 
                name="search"
                type="text" 
                placeholder="{{ __('Search categories...') }}" 
                class="w-full"
                wire:model.live="search"
            />
        </div>
        <button wire:click="create" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
            {{ __('Add Category') }}
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
                    {{ $editing ? __('Edit Category') : __('Create New Category') }}
                </h2>
                <form wire:submit="{{ $editing ? 'update' : 'store' }}">
                    <div class="grid grid-cols-1 gap-6">
                        <div>
                            <x-label for="name" value="{{ __('Name') }}" />
                            <x-input 
                                name="name"
                                type="text" 
                                class="mt-1 block w-full" 
                                required
                                wire:model="name"
                                placeholder="e.g., fresh-fish"
                            />
                            <p class="mt-1 text-sm text-gray-500">{{ __('The unique identifier for the category (e.g., fresh-fish, frozen-fish)') }}</p>
                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                        </div>

                        <div>
                            <x-label for="display_name" value="{{ __('Display Name') }}" />
                            <x-input 
                                name="display_name"
                                type="text" 
                                class="mt-1 block w-full"
                                wire:model="display_name"
                                placeholder="e.g., Fresh Fish"
                            />
                            <p class="mt-1 text-sm text-gray-500">{{ __('The name that will be shown to customers') }}</p>
                            <x-input-error :messages="$errors->get('display_name')" class="mt-2" />
                        </div>

                        <div>
                            <x-label for="description" value="{{ __('Description') }}" />
                            <x-input 
                                name="description"
                                type="text" 
                                class="mt-1 block w-full"
                                wire:model="description"
                                placeholder="e.g., Fresh fish caught daily"
                            />
                            <p class="mt-1 text-sm text-gray-500">{{ __('A brief description of the category') }}</p>
                            <x-input-error :messages="$errors->get('description')" class="mt-2" />
                        </div>

                        <div class="flex justify-end space-x-2 pt-4 border-t">
                            <button type="button" wire:click="cancel" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                                {{ __('Cancel') }}
                            </button>
                            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                {{ $editing ? __('Update Category') : __('Create Category') }}
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    @endif

    <!-- Categories List -->
    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6">
            <div class="space-y-4">
                @forelse($categories as $category)
                    <div class="flex items-center justify-between p-4 bg-white dark:bg-gray-700 rounded-lg shadow">
                        <div>
                            <h3 class="text-lg font-semibold">{{ $category->name }}</h3>
                            @if($category->display_name)
                                <p class="text-gray-600 dark:text-gray-300">{{ $category->display_name }}</p>
                            @endif
                            @if($category->description)
                                <p class="text-sm text-gray-500 dark:text-gray-400">{{ $category->description }}</p>
                            @endif
                        </div>
                        <div class="flex space-x-2">
                            <button wire:click="edit({{ $category->id }})" class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded">
                                {{ __('Edit') }}
                            </button>
                            <button wire:click="delete({{ $category->id }})" wire:confirm="Are you sure you want to delete this category?" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
                                {{ __('Delete') }}
                            </button>
                        </div>
                    </div>
                @empty
                    <div class="text-center text-gray-500 dark:text-gray-400">
                        {{ __('No categories found.') }}
                    </div>
                @endforelse
            </div>

            <div class="mt-4">
                {{ $categories->links() }}
            </div>
        </div>
    </div>
</div>
