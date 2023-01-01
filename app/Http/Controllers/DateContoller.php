<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use DateTime;
use App\Models\Emplopyee;
use Barryvdh\DomPDF\Facade\Pdf;
// use PDF;
use Dompdf\Dompdf;
use ArPHP\I18N\Arabic;

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

        $checkbox1 = $request->input('checkbox1', []);
        $checkbox2 = $request->input('checkbox2', []);
        $fileNo = $request->fileNo;
        if ($fileNo == null) {
            $fileNo = '48531';
        }

        $employee = Emplopyee::where('fileNo', $fileNo)->first();
        // $checkbox1 and $checkbox2 are arrays of dates that were selected in the form
        // You can use the array_values function to get an array of just the selected dates
        $request->session()->put('employee', $employee);

        $selectedDates1 = array_values($checkbox1);
        $request->session()->put('selectedDates1', $selectedDates1);

        $selectedDates2 = array_values($checkbox2);
        $request->session()->put('selectedDates2', $selectedDates2);

        $mergedArray  = array_merge($selectedDates1, $selectedDates2);
        $request->session()->put('mergedArray', $mergedArray);

        $firstValue = reset($mergedArray);
        $request->session()->put('firstValue', $firstValue);

        $lastValue  =  end($mergedArray);
        $request->session()->put('lastValue', $lastValue);

        $unique_dates  = array_unique($mergedArray);
        usort($unique_dates, function ($a, $b) {
            $date1 = new DateTime($a);
            $date2 = new DateTime($b);
            return $date1 <=> $date2;
        });
        $request->session()->put('unique_dates', $unique_dates);

        $date = Carbon::now();
        return view('show', compact('mergedArray', 'date', 'selectedDates1', 'selectedDates2', 'unique_dates', 'employee', 'firstValue', 'lastValue'));
    }

    public function generatepdf(Request $request)
    {
        set_time_limit(120);

        $employee =   $request->session()->get('employee');
        $firstValue = $request->session()->get('firstValue');
        $lastValue = $request->session()->get('lastValue');
        $selectedDates1 = $request->session()->get('selectedDates1');
        $selectedDates2 = $request->session()->get('selectedDates2');
        $unique_dates = $request->session()->get('unique_dates');
        $font_path = asset('fonts/Cairo-Regular.ttf');

        $data = [
            'employee' => $employee,
            'firstValue' =>  $firstValue,
            'lastValue' =>  $lastValue,
            'selectedDates1' => $selectedDates1,
            'selectedDates2' => $selectedDates2,
            'unique_dates' => $unique_dates,
            'font_path' => $font_path

        ];

        $dompdf = new Dompdf([
            'enable_fontsubsetting' => false
        ]);
        $fonts_path = public_path('fonts');

        $dompdf->set_option('defaultFont', 'Cairo');
        $dompdf->set_option('isRtl', true);

        $dompdf->set_option('fontPath', $fonts_path);

        $pdf = PDF::loadView('showpdf', $data);

        // return $pdf->download('d.pdf');
        return $pdf->stream();
    }
}
