<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;


use Carbon\Carbon;
use DateTime;
use App\Models\Emplopyee;
use App\Models\December;
use App\Models\TakleefList;
use Barryvdh\DomPDF\Facade\Pdf;
// use PDF;
use Dompdf\Dompdf;
use ArPHP\I18N\Arabic;

use Illuminate\Http\Request;

class DateContoller extends Controller

{
    public function december()
    {
        $title = "DECEMBER";
        // Dates that should be disabled
        $disabledDates = [
            '2022-12-02',
            '2022-12-06',
            '2022-12-10',
            '2022-12-14',
            '2022-12-18',
            '2022-12-22',
            '2022-12-26',
            '2022-12-30',
        ];

        $currentMonth = 12;
        $currentYear = 2022;
        $daysInMonth = Carbon::createFromDate($currentYear, $currentMonth, 1)->daysInMonth; // Get the number of days in September
        for ($i = 1; $i <= $daysInMonth + 1; $i++) {
            $dates[] = Carbon::createFromDate($currentYear, $currentMonth, $i);
        }

        return view('december', compact('dates', 'disabledDates', 'title'));
    }
    public function shiftA()
    {
        $title = "SHIFT-A";
        // Dates that should be disabled
        $disabledDates = [
            // '2023-01-03',
            // '2023-01-07',
            // '2023-01-11',
            // '2023-01-15',
            // '2023-01-19',
            // '2023-01-23',
            // '2023-01-27',
            // '2023-01-31',
        ];

        $currentMonth = 11; //September
        $currentYear = 2022;
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
            $firstValue = reset($mergedArray);
            $lastValue  =  end($mergedArray);
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
            return view('show', compact('mergedArray', 'date', 'selectedDates1', 'selectedDates2', 'unique_dates', 'employee', 'firstValue', 'lastValue'));
        } else {
            session()->flash('error', 'لايوجد موظف يحمل رقم الملف المدخل');
            return back();
        }
        // $fileNo = $request->fileNo;
        // $employee = December::where('fileNo', $fileNo)->orderBy('date')->get();
        // $employee_info = December::where('fileNo', $fileNo)->first();
        // $firstDate = December::where('fileNo', $fileNo)->orderBy('date', 'asc')->value('date');
        // $lastDate = December::where('fileNo', $fileNo)->orderByDesc('date')->value('date');

        // return view('showDecember', compact('employee', 'employee_info', 'firstDate', 'lastDate'));
    }
    public function submitDecember(Request $request)
    {
        $fileNo = $request->fileNo;
        $employee = December::where('fileNo', $fileNo)
            ->where(function ($query) {
                $query->whereNotNull('employee_in')
                    ->orWhereNotNull('employee_out');
            })
            ->orderBy('date')
            ->get();
        $employee_info = December::where('fileNo', $fileNo)->first();
        $firstDate = December::where('fileNo', $fileNo)->orderBy('date', 'asc')->value('date');
        $lastDate = December::where('fileNo', $fileNo)->orderByDesc('date')->value('date');

        return view('showDecember', compact('employee', 'employee_info', 'firstDate', 'lastDate'));
    }

    public function addEmployee(Request $request)
    {
        $data = $request->validate(
            [
                'name' => 'required',
                'civilId' => 'required',
                'fileNo' => 'required'
            ],
            [
                'name' => 'يرجى ادخال اسم الموظف',
                'civilId' => 'يرجى ادخل الرقم المدني الخاص بالموظف',
                'fileNo' => 'يرجى ادخال رقم الملف الخاص بالموظف',

            ]
        );




        try {
            $employee = Emplopyee::create($data);
        } catch (\Illuminate\Database\QueryException $e) {
            if ($e->errorInfo[1] == 1062) {
                // Duplicate entry error
                session()->flash('error', 'الرقم المدني او رقم الملف موجود مسبقاً');
                return redirect()->back();
            }
        }

        return redirect()->back();
    }

    public function editDate($id)
    {
        $employee = December::where('fileNo', $id)->orderBy('date')->get();
        $employee_info = December::where('fileNo', $id)->first();
        $disabledDates = [];
        $currentMonth = 12; //September
        $currentYear = 2022;
        $daysInMonth = Carbon::createFromDate($currentYear, $currentMonth, 1)->daysInMonth; // Get the number of days in September
        for ($i = 1; $i <= $daysInMonth; $i++) {
            $date = Carbon::createFromDate($currentYear, $currentMonth, $i);
            $dates[] = $date->format('Y-m-d');
        }
        $attendance = array();
        foreach ($dates as $date) {
            $attendance[$date] = December::where('fileNo', $id)->whereDate('date', $date)->first();
        }
        return view('editDate', compact('dates', 'employee_info', 'employee', 'disabledDates', 'attendance'));
    }
    public function updateDate(Request $request, $id)
    {
        $employee_db = December::where('fileNo', $id)->orderBy('date')->get();
        $employee_in = $request->input('employee_in');
        $employee_out = $request->input('employee_out');
        // check if employee_in array is not empty
        if (!empty($employee_in)) {
            foreach ($employee_db as $db_date) {
                $employee_in_value = in_array($db_date->date, $employee_in) ? 'بداية الدوام' : null;
                December::where('fileNo', $id)->where('date', $db_date->date)
                    ->update(['employee_in' => $employee_in_value]);
            }
        } else {
            December::where('fileNo', $id)->update(['employee_in' => null]);
        }
        // check if employee_out array is not empty
        if (!empty($employee_out)) {
            foreach ($employee_db as $db_date) {
                $employee_out_value = in_array($db_date->date, $employee_out) ? 'نهاية الدوام' : null;
                December::where('fileNo', $id)->where('date', $db_date->date)
                    ->update(['employee_out' => $employee_out_value]);
            }
        } else {
            December::where('fileNo', $id)->update(['employee_out' => null]);
        }
        // check if employee_in array is not empty
        if (!empty($employee_in)) {
            foreach ($employee_in as $date) {
                $attend = December::where('fileNo', $id)->where('date', $date)->first();
                if (!$attend) {
                    $attend = December::create([
                        'fileNo' => $id,
                        'date' => $date,
                        'employee_in' => 'بداية الدوام',

                    ]);
                }
            }
        }
        // check if employee_out array is not empty
        ////
        if (!empty($employee_out)) {

            foreach ($employee_out as $date) {
                $attend = December::where('fileNo', $id)->where('date', $date)->first();
                if (!$attend) {
                    $attend = December::create([
                        'fileNo' => $id,
                        'date' => $date,
                        'employee_out' => 'نهاية الدوام'
                    ]);
                }
            }
        }
        if (empty($employee_in) && empty($employee_out)) {
            December::where('fileNo', $id)->update(['employee_in' => null, 'employee_out' => null]);
            December::where('fileNo', $id)->whereNull('employee_in')->whereNull('employee_out')->delete();
            return redirect('/')->with('success', 'Attendance updated successfully');
        }

        return redirect('/')->with('success', 'Attendance updated successfully');
    }




    // public function generatepdf(Request $request)
    // {
    //     set_time_limit(120);

    //     $employee =   $request->session()->get('employee');
    //     $firstValue = $request->session()->get('firstValue');
    //     $lastValue = $request->session()->get('lastValue');
    //     $selectedDates1 = $request->session()->get('selectedDates1');
    //     $selectedDates2 = $request->session()->get('selectedDates2');
    //     $unique_dates = $request->session()->get('unique_dates');
    //     $font_path = asset('fonts/Cairo-Regular.ttf');

    //     $data = [
    //         'employee' => $employee,
    //         'firstValue' =>  $firstValue,
    //         'lastValue' =>  $lastValue,
    //         'selectedDates1' => $selectedDates1,
    //         'selectedDates2' => $selectedDates2,
    //         'unique_dates' => $unique_dates,
    //         'font_path' => $font_path

    //     ];

    //     $dompdf = new Dompdf([
    //         'enable_fontsubsetting' => false
    //     ]);
    //     $fonts_path = public_path('fonts');

    //     $dompdf->set_option('defaultFont', 'Cairo');
    //     $dompdf->set_option('isRtl', true);

    //     $dompdf->set_option('fontPath', $fonts_path);

    //     $pdf = PDF::loadView('showpdf', $data);

    //     // return $pdf->download('d.pdf');
    //     return $pdf->stream();
    // }
}