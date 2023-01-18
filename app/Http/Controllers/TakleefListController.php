<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


use Carbon\Carbon;
use DateTime;
use App\Models\Emplopyee;
use App\Models\December;
use App\Models\TakleefList;

class TakleefListController extends Controller
{
    public function shiftA()
    {
        $title = "SHIFT-A";
        // Dates that should be disabled
        $disabledDates = [
            '2023-01-03',
            '2023-01-07',
            '2023-01-11',
            '2023-01-15',
            '2023-01-19',
            '2023-01-23',
            '2023-01-27',
            '2023-01-31',
        ];

        $currentMonth = 1; //September
        $currentYear = 2023;
        $daysInMonth = Carbon::createFromDate($currentYear, $currentMonth, 1)->daysInMonth; // Get the number of days in September
        for ($i = 1; $i <= $daysInMonth + 1; $i++) {
            $dates[] = Carbon::createFromDate($currentYear, $currentMonth, $i);
        }

        return view('myview', compact('dates', 'disabledDates', 'title'));
    }
    public function shiftB()
    {
        $title = "SHIFT-B";

        // Dates that should be disabled
        $disabledDates = [
            '2023-01-02',
            '2023-01-06',
            '2023-01-10',
            '2023-01-14',
            '2023-01-18',
            '2023-01-22',
            '2023-01-26',
            '2023-01-30',
        ];

        $currentMonth = 1; //September
        $currentYear = 2023;
        $daysInMonth = Carbon::createFromDate($currentYear, $currentMonth, 1)->daysInMonth; // Get the number of days in September
        for ($i = 1; $i <= $daysInMonth + 1; $i++) {
            $dates[] = Carbon::createFromDate($currentYear, $currentMonth, $i);
        }

        return view('myview', compact('dates', 'disabledDates', 'title'));
    }
    public function shiftC()
    {
        $title = "SHIFT-C";

        // Dates that should be disabled
        $disabledDates = [
            '2023-01-04',
            '2023-01-08',
            '2023-01-12',
            '2023-01-16',
            '2023-01-20',
            '2023-01-24',
            '2023-01-28',
            '2023-02-01',
        ];

        $currentMonth = 1; //September
        $currentYear = 2023;
        $daysInMonth = Carbon::createFromDate($currentYear, $currentMonth, 1)->daysInMonth; // Get the number of days in September
        for ($i = 1; $i <= $daysInMonth + 1; $i++) {
            $dates[] = Carbon::createFromDate($currentYear, $currentMonth, $i);
        }

        return view('myview', compact('dates', 'disabledDates', 'title'));
    }
    public function shiftD()
    {
        $title = "SHIFT-D";

        // Dates that should be disabled
        $disabledDates = [
            '2023-01-05',
            '2023-01-09',
            '2023-01-13',
            '2023-01-17',
            '2023-01-21',
            '2023-01-25',
            '2023-01-29',
        ];

        $currentMonth = 1; //September
        $currentYear = 2023;
        $daysInMonth = Carbon::createFromDate($currentYear, $currentMonth, 1)->daysInMonth; // Get the number of days in September
        for ($i = 1; $i <= $daysInMonth + 1; $i++) {
            $dates[] = Carbon::createFromDate($currentYear, $currentMonth, $i);
        }

        return view('myview', compact('dates', 'disabledDates', 'title'));
    }
    public function publicShift()
    {
        $title = "غير محدد";

        // Dates that should be disabled
        $disabledDates = [];

        $currentMonth = 1; //September
        $currentYear = 2023;
        $daysInMonth = Carbon::createFromDate($currentYear, $currentMonth, 1)->daysInMonth; // Get the number of days in September
        for ($i = 1; $i <= $daysInMonth + 1; $i++) {
            $dates[] = Carbon::createFromDate($currentYear, $currentMonth, $i);
        }

        return view('myview', compact('dates', 'disabledDates', 'title'));
    }
    public function submit(Request $request)
    {
        $checkbox1 = $request->input('checkbox1', []);
        $checkbox2 = $request->input('checkbox2', []);
        $fileNo = $request->fileNo;
        $employee = Emplopyee::where('fileNo', $fileNo)->first();
        // $checkbox1 and $checkbox2 are arrays of dates that were selected in the form
        // You can use the array_values function to get an array of just the selected dates
        if ($employee) {
            $selectedDates1 = array_values($checkbox1);
            $selectedDates2 = array_values($checkbox2);
            $mergedArray  = array_merge($selectedDates1, $selectedDates2);
            $unique_dates  = array_unique($mergedArray);
            usort($unique_dates, function ($a, $b) {
                $date1 = new DateTime($a);
                $date2 = new DateTime($b);
                return $date1 <=> $date2;
            });
            $currentMonth = 1; //September
            $currentYear = 2023;
            $daysInMonth = Carbon::createFromDate($currentYear, $currentMonth, 1)->daysInMonth; // Get the number of days in September
            for ($i = 1; $i <= $daysInMonth; $i++) {
                $dates[] = Carbon::createFromDate($currentYear, $currentMonth, $i);
            }
            $firstValue = reset($dates)->format('Y-m-d');;
            $lastValue  =  end($dates)->format('Y-m-d');;
            foreach ($selectedDates1 as $date) {
                $takleef = TakleefList::firstOrCreate([
                    'user_id' => 139,
                    'date' => $date,
                    'employee_in' => 'بداية الدوام',
                ]);
            }
            foreach ($selectedDates2 as $date) {
                $takleef = TakleefList::firstOrCreate([
                    'user_id' => 139,
                    'date' => $date,
                    'employee_out' => 'نهاية الدوام',
                ]);
            }
            $request->session()->put('unique_dates', $unique_dates);
            $date = Carbon::now();
            $employee_takleef = TakleefList::where('user_id', $employee->id)
                ->where(function ($query) {
                    $query->whereNotNull('employee_in')
                        ->orWhereNotNull('employee_out');
                })
                ->orderBy('date')
                ->get();
            $employee_info = TakleefList::where('user_id', $employee->id)->first();
            $firstDate = December::where('fileNo', $fileNo)->orderBy('date', 'asc')->value('date');
            $lastDate = December::where('fileNo', $fileNo)->orderByDesc('date')->value('date');
            return view('show', compact('mergedArray', 'date', 'selectedDates1', 'employee_takleef', 'selectedDates2', 'unique_dates', 'employee_info', 'employee', 'firstValue', 'lastValue'));
        } else {
            session()->flash('error', 'لايوجد موظف يحمل رقم الملف المدخل');
            return back();
        }
    }
    public function editDate($id)
    {
        $employee = Emplopyee::where('id', $id)->first();
        $employee_info = Emplopyee::where('id', $id)->first();
        $disabledDates = [];
        $currentMonth = 1; //September
        $currentYear = 2023;
        $daysInMonth = Carbon::createFromDate($currentYear, $currentMonth, 1)->daysInMonth; // Get the number of days in September
        for ($i = 1; $i <= $daysInMonth; $i++) {
            $date = Carbon::createFromDate($currentYear, $currentMonth, $i);
            $dates[] = $date->format('Y-m-d');
        }
        $attendance = array();
        foreach ($dates as $date) {
            $attendance[$date] = TakleefList::where('user_id', $id)->whereDate('date', $date)->first();
        }
        return view('editDate', compact('dates', 'employee_info', 'employee', 'disabledDates', 'attendance'));
    }
}