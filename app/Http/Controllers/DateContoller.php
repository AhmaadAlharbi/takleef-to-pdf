<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use DateTime;

use Illuminate\Http\Request;

class DateContoller extends Controller
{
    public function index()
    {
        // Dates that should be disabled
        $disabledDates = [
            '2022-09-01',
            '2022-09-05',
            '2022-09-09',
            '2022-09-13',
            '2022-09-17',
            '2022-09-21',
            '2022-09-25',
            '2022-09-29',
            '2022-09-17',
        ];

        $currentMonth = 9; // September
        $currentYear = 2022;
        $daysInMonth = Carbon::createFromDate($currentYear, $currentMonth, 1)->daysInMonth; // Get the number of days in September

        for ($i = 1; $i <= $daysInMonth; $i++) {
            $dates[] = Carbon::createFromDate($currentYear, $currentMonth, $i);
        }

        return view('myview', compact('dates', 'disabledDates'));
    }
    public function submit(Request $request)
    {

        $checkbox1 = $request->input('checkbox1', []);
        $checkbox2 = $request->input('checkbox2', []);

        // $checkbox1 and $checkbox2 are arrays of dates that were selected in the form

        // You can use the array_values function to get an array of just the selected dates
        $selectedDates1 = array_values($checkbox1);
        $selectedDates2 = array_values($checkbox2);
        $mergedArray = array_merge($selectedDates1, $selectedDates2);

        usort($mergedArray, function ($a, $b) {
            $date1 = new DateTime($a);
            $date2 = new DateTime($b);
            return $date1 <=> $date2;
        });
        $date = Carbon::now();

        return view('show', compact('mergedArray', 'date', 'selectedDates1', 'selectedDates2'));
    }
}