<div>
    @if($showModal)
        <div class="fixed inset-0 bg-gray-500 bg-opacity-50 transition-opacity backdrop-blur-sm" aria-hidden="true"></div>

        <div class="fixed inset-0 z-50 overflow-y-auto">
            <div class="flex min-h-full items-center justify-center p-4 text-center sm:p-0">
                <div class="relative transform overflow-hidden rounded-lg bg-white px-4 pb-4 pt-5 text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-lg sm:p-6">
                    @if($modalType === 'pending')
                        <div>
                            <div class="mt-3 text-center sm:mt-5">
                                <h3 class="text-lg font-semibold leading-6 text-gray-900 mb-4">{{ __('Vacation Request from') }} {{ $vacationRequest->user->name }}</h3>
                                <div class="mt-4 bg-gray-50 p-4 rounded-lg">
                                    <p class="text-sm text-gray-600">
                                        <strong>{{ __('Start Date') }}:</strong> {{ $vacationRequest->start_date->format('Y-m-d') }}<br>
                                        <strong>{{ __('End Date') }}:</strong> {{ $vacationRequest->end_date->format('Y-m-d') }}<br>
                                        <strong>{{ __('Duration') }}:</strong> {{ $vacationRequest->totalDays() }} {{ __('days') }}<br>
                                        <strong>{{ __('Comments') }}:</strong> {{ $vacationRequest->comments }}
                                    </p>
                                </div>
                            </div>
                            <div class="mt-5 sm:mt-6 flex justify-center space-x-4">
                                <button type="button" 
                                        wire:click="rejectRequest" 
                                        class="inline-flex justify-center rounded-md bg-red-600 px-4 py-2 text-sm font-semibold text-white shadow-sm hover:bg-red-500 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2">
                                    {{ __('Reject') }}
                                </button>
                                <button type="button" 
                                        wire:click="approveRequest" 
                                        class="inline-flex justify-center rounded-md bg-green-600 px-4 py-2 text-sm font-semibold text-white shadow-sm hover:bg-green-500 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2">
                                    {{ __('Approve') }}
                                </button>
                            </div>
                        </div>
                    @elseif($modalType === 'approved')
                        <div>
                            <div class="mt-3 text-center sm:mt-5">
                                <h3 class="text-lg font-semibold leading-6 text-gray-900 mb-4">{{ __('Approved Vacation for') }} {{ $vacationRequest->user->name }}</h3>
                                <div class="mt-4 bg-gray-50 p-4 rounded-lg">
                                    <p class="text-sm text-gray-600">
                                        <strong>{{ __('Return Date') }}:</strong> {{ $vacationRequest->end_date->addDay()->format('Y-m-d') }}<br>
                                        <strong>{{ __('Total Days') }}:</strong> {{ $vacationRequest->start_date->diffInDays($vacationRequest->end_date) + 1 }} {{ __('days') }}<br>
                                        <strong>{{ __('Start Date') }}:</strong> {{ $vacationRequest->start_date->format('Y-m-d') }}<br>
                                        <strong>{{ __('End Date') }}:</strong> {{ $vacationRequest->end_date->format('Y-m-d') }}
                                    </p>
                                </div>
                            </div>
                            <div class="mt-5 sm:mt-6">
                                <button type="button" wire:click="$set('showModal', false)" class="inline-flex w-full justify-center rounded-md bg-gray-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-gray-500 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2">
                                    {{ __('Close') }}
                                </button>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    @endif
</div>
