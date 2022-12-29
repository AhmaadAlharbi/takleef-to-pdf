<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use DateTime;
use App\Models\Emplopyee;
use Barryvdh\DomPDF\Facade\Pdf;

use Illuminate\Http\Request;

class DateContoller extends Controller

{
    private $firstValue = 's';
    private $lastValue = 's';
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
        $data = ['key' => 'value'];

        $checkbox1 = $request->input('checkbox1', []);
        $checkbox2 = $request->input('checkbox2', []);
        $fileNo = $request->fileNo;
        if ($fileNo == null) {
            $fileNo = '48531';
        }
        global $employee;
        $employee = Emplopyee::where('fileNo', $fileNo)->first();
        // $checkbox1 and $checkbox2 are arrays of dates that were selected in the form
        // You can use the array_values function to get an array of just the selected dates
        global $selectedDates1;
        $selectedDates1 = $selectedDates1a = array_values($checkbox1);
        global $selectedDates2;
        $selectedDates2 = array_values($checkbox2);
        global $mergedArray;
        $mergedArray  = array_merge($selectedDates1, $selectedDates2);
        global $firstValue;
        $firstValue = $firstValue1 = reset($mergedArray);
        global $lastValue;
        $lastValue = $lastValue1 =  end($mergedArray);
        global $unique_dates;
        $unique_dates = $unique_dates1 = array_unique($mergedArray);
        usort($unique_dates, function ($a, $b) {
            $date1 = new DateTime($a);
            $date2 = new DateTime($b);
            return $date1 <=> $date2;
        });
        $date = Carbon::now();

        return view('show', compact('mergedArray', 'data', 'date', 'selectedDates1', 'selectedDates2', 'unique_dates', 'employee', 'firstValue', 'lastValue'));
    }

    public function generatepdf($id)
    {
        $employee = Emplopyee::where('fileNo', $id)->first();
        global $firstValue;
        global $lastValue;
        $firstValue11 = $firstValue;
        $lastValue11 = $lastValue;
        $data = [
            'employee' => $employee,
            'firstValue' => $firstValue11,
            'lastValue' => $lastValue11

        ];
        $pdf = PDF::loadView('show', $data);

        // return $pdf->download('d.pdf');
        return $pdf->stream();
    }
}