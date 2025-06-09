<div>
<div>
    <div class="calendar-container">
        @if($error)
            <div class="bg-yellow-100 border-l-4 border-yellow-500 text-yellow-700 p-4 mb-4" role="alert">
                <p>{{ $error }}</p>
            </div>
        @endif

        <div class="flex justify-between items-center mb-6">
            <button wire:click="previousMonth" class="px-4 py-2 bg-gray-200 rounded-lg hover:bg-gray-300 transition-colors">
                &lt;
            </button>
            <h2 class="text-2xl font-semibold text-gray-800">{{ ucfirst($monthName) }} {{ $year }}</h2>
            <button wire:click="nextMonth" class="px-4 py-2 bg-gray-200 rounded-lg hover:bg-gray-300 transition-colors">
                &gt;
            </button>
        </div>

        <div class="grid grid-cols-7 gap-2">
            <div class="text-center font-semibold text-gray-600">{{ __('Sun') }}</div>
            <div class="text-center font-semibold text-gray-600">{{ __('Mon') }}</div>
            <div class="text-center font-semibold text-gray-600">{{ __('Tue') }}</div>
            <div class="text-center font-semibold text-gray-600">{{ __('Wed') }}</div>
            <div class="text-center font-semibold text-gray-600">{{ __('Thu') }}</div>
            <div class="text-center font-semibold text-gray-600">{{ __('Fri') }}</div>
            <div class="text-center font-semibold text-gray-600">{{ __('Sat') }}</div>

            @foreach($calendarDays as $week)
                @foreach($week as $day)
                    <div wire:click="selectDay({{ $day }})" class="{{ $day ? $this->getDayClasses($day) : 'bg-gray-100' }}">
                        {{ $day }}
                    </div>
                @endforeach
            @endforeach
        </div>

        @if($selectedDay && $holidayInfo)
            <div class="mt-6 p-4 bg-white rounded-lg shadow-md">
                <h3 class="text-lg font-semibold text-gray-800 mb-2">{{ $holidayInfo['name'] }}</h3>
                <div class="text-sm text-gray-600">
                    <p><span class="font-medium">{{__('Tipe:')}}</span> {{ $holidayInfo['type'] === 'public' ? __('National Holiday') : __('Regional Holiday') }}</p>
                    <p><span class="font-medium">{{__('Date:')}}</span> {{ Carbon\Carbon::parse($holidayInfo['date'])->format('d/m/Y') }}</p>
                </div>
            </div>
        @endif
    </div>
</div>

<style>
    .calendar-container {
        padding: 20px;
        background: white;
    }

    .calendar-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 20px;
    }

    .calendar-nav-btn {
        background: #e0f2f1;
        border: none;
        padding: 8px 16px;
        border-radius: 4px;
        cursor: pointer;
        font-weight: bold;
        color: #00695c;
    }

    .calendar-nav-btn:hover {
        background: #b2dfdb;
    }

    .calendar-grid {
        width: 100%;
    }

    .calendar-weekdays {
        display: grid;
        grid-template-columns: repeat(7, 1fr);
        text-align: center;
        font-weight: bold;
        margin-bottom: 10px;
        color: #00695c;
    }

    .calendar-days {
        display: flex;
        flex-direction: column;
        gap: 2px;
    }

    .calendar-week {
        display: grid;
        grid-template-columns: repeat(7, 1fr);
        gap: 2px;
    }

    .calendar-day {
        aspect-ratio: 1;
        display: flex;
        align-items: center;
        justify-content: center;
        border: 1px solid #e0e0e0;
        border-radius: 4px;
        font-size: 0.9rem;
    }

    .calendar-day.empty {
        background: #f5f5f5;
        border: none;
    }

    .calendar-day.holiday {
        background: #ffebee;
        color: #c62828;
        font-weight: bold;
    }
</style>
    </div>
