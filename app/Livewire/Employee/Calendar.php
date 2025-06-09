<?php

namespace App\Livewire\Employee;

use Livewire\Component;
use Illuminate\Support\Facades\Http;
use Carbon\Carbon;

class Calendar extends Component
{
    public $holidays = [];
    public $currentMonth;
    public $currentYear;
    public $error = null;
    public $selectedDay = null;
    public $holidayInfo = null;

    public function mount()
    {
        $this->currentMonth = Carbon::now()->month;
        $this->currentYear = Carbon::now()->year;
        $this->fetchHolidays();
    }

    public function fetchHolidays()
    {
        try {
            $response = Http::get('https://api.generadordni.es/v2/holidays/holidays', [
                'country' => 'ES',
                'year' => $this->currentYear
            ]);

            if ($response->successful()) {
                $this->holidays = $response->json();
                $this->error = null;
            } else {
                $this->error = __('The holidays will be available soon!');
                $this->holidays = [];
            }
        } catch (\Exception $e) {
            $this->error =__('The holidays will be available soon!');
            $this->holidays = [];
        }
    }

    public function nextMonth(): void
    {
        $date = Carbon::create($this->currentYear, $this->currentMonth, 1)->addMonth();
        $this->currentMonth = $date->month;
        $this->currentYear = $date->year;
        $this->fetchHolidays();
    }

    public function previousMonth(): void
    {
        $date = Carbon::create($this->currentYear, $this->currentMonth, 1)->subMonth();
        $this->currentMonth = $date->month;
        $this->currentYear = $date->year;
        $this->fetchHolidays();
    }

    public function selectDay($day): void
    {
        if (!$day) return;

        $this->selectedDay = $day;
        $this->holidayInfo = $this->getHolidayInfo($day);
    }

    public function getHolidayInfo($day)
    {
        if (empty($this->holidays)) {
            return null;
        }

        $date = Carbon::create($this->currentYear, $this->currentMonth, $day)->format('Y-m-d');
        foreach ($this->holidays as $holiday) {
            if (Carbon::parse($holiday['date'])->format('Y-m-d') === $date) {
                return $holiday;
            }
        }
        return null;
    }

    public function isHoliday($day): bool
    {
        return $this->getHolidayInfo($day) !== null;
    }

    public function isWeekend($day): bool
    {
        $date = Carbon::create($this->currentYear, $this->currentMonth, $day);
        return $date->isSunday() || $date->isMonday();
    }

    public function getDayClasses($day): string
    {
        if (!$day) {
            return 'bg-gray-100';
        }

        $classes = ['text-center p-2 rounded-lg cursor-pointer hover:opacity-80 transition-opacity'];

        if ($this->isHoliday($day)) {
            $classes[] = 'bg-red-500 text-white';
        } elseif ($this->isWeekend($day)) {
            $classes[] = 'bg-blue-500 text-white';
        } else {
            $classes[] = 'bg-gray-200';
        }

        if ($this->selectedDay === $day) {
            $classes[] = 'ring-2 ring-offset-2 ring-gray-400';
        }

        return implode(' ', $classes);
    }

    public function render(): \Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
    {
        $firstDayOfMonth = Carbon::create($this->currentYear, $this->currentMonth, 1);
        $lastDayOfMonth = $firstDayOfMonth->copy()->endOfMonth();

        $daysInMonth = $lastDayOfMonth->day;
        $firstDayOfWeek = $firstDayOfMonth->dayOfWeek;

        $calendarDays = [];
        $currentDay = 1;

        // Fill in the calendar grid
        for ($i = 0; $i < 6; $i++) {
            $week = [];
            for ($j = 0; $j < 7; $j++) {
                if (($i === 0 && $j < $firstDayOfWeek) || $currentDay > $daysInMonth) {
                    $week[] = null;
                } else {
                    $week[] = $currentDay;
                    $currentDay++;
                }
            }
            $calendarDays[] = $week;
            if ($currentDay > $daysInMonth) {
                break;
            }
        }

        return view('livewire.employee.calendar-view', [
            'calendarDays' => $calendarDays,
            'monthName' => $firstDayOfMonth->locale('es')->monthName,
            'year' => $this->currentYear,
            'error' => $this->error
        ]);
    }
}
