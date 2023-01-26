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
    public $currentYear;
    public function __construct()
    {
        $this->currentYear = Carbon::now()->year;
    }

    public function takleefList($number)
    {
        $month = 0;
        switch ($number) {
            case '1':
                $title = "شهر يناير";
                $month = 1;
                break;
            case '2':
                $title = "شهر فبراير";
                $month = 2;
                break;
            case '3':
                $title = "شهر مارس";
                $month = 3;
                break;
            case '4':
                $title = "شهر ابريل";
                $month = 4;
                break;
            case '5':
                $title = "شهر مايو";
                $month = 5;
                break;
            case '6':
                $title = "شهر يونيو";
                $month = 6;
                break;
            case '7':
                $title = "شهر يوليو";
                $month = 7;
                break;
            case '8':
                $title = "شهر اغسطس";
                $month = 8;
                break;
            case '9':
                $title = "شهر سبتمبر";
                $month = 9;
                break;
            case '10':
                $title = "شهر اكتوبر";
                $month = 10;
                break;
            case '11':
                $title = "شهر نوفمبر";
                $month = 11;
                break;
            case '12':
                $title = "شهر ديسمبر";
                $month = 12;
                break;
            default:
                abort(404);
        }

        return view('search', compact('title', 'month'));
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
                $takleef = TakleefList::where([
                    'employee_id' => $employee->id,
                    'date' => $date,
                ])->first();
                if ($takleef) {
                    if (!is_null($takleef->employee_out)) {
                        $takleef->employee_in = 'بداية الدوام';
                        $takleef->save();
                    }
                } else {
                    TakleefList::create([
                        'employee_id' => $employee->id,
                        'date' => $date,
                        'employee_in' => 'بداية الدوام',
                    ]);
                }
            }
            foreach ($selectedDates2 as $date) {
                $takleef = TakleefList::where([
                    'employee_id' => $employee->id,
                    'date' => $date,
                ])->first();
                if ($takleef) {
                    if (!is_null($takleef->employee_in)) {
                        $takleef->employee_out = 'نهاية الدوام';
                        $takleef->save();
                    }
                } else {
                    TakleefList::create([
                        'employee_id' => $employee->id,
                        'date' => $date,
                        'employee_out' => 'نهاية الدوام',
                    ]);
                }
            }
            $request->session()->put('unique_dates', $unique_dates);
            $date = Carbon::now();
            $employee_takleef = TakleefList::where('employee_id', $employee->id)
                ->where(function ($query) {
                    $query->whereNotNull('employee_in')
                        ->orWhereNotNull('employee_out');
                })
                ->orderBy('date')
                ->get();

            $employee_info = TakleefList::where('employee_id', $employee->id)->first();
            // $firstDate = December::where('fileNo', $fileNo)->orderBy('date', 'asc')->value('date');
            // $lastDate = December::where('fileNo', $fileNo)->orderByDesc('date')->value('date');
            session()->flash('success', 'Done');

            return view('show', compact('employee_takleef', 'employee_info', 'firstValue', 'lastValue'));
        } else {
            session()->flash('error', ' يرجى التأكد من ادخال رقم الملف الخاص بالموظف بالشكل الصحيح');
            return back();
        }
    }
    public function getTakleef(Request $request, $month)
    {


        $data = $request->validate(
            [
                'fileNo' => 'required',

            ],
            [

                'fileNo' => 'يرجى ادخال رقم الملف الخاص بالموظف'
            ]
        );
        $fileNo = $request->fileNo;
        $employee_info =  Emplopyee::where('fileNo', $fileNo)->first();
        if ($employee_info) {
            $currentMonth = $month;
            $currentYear = 2023;
            $daysInMonth = Carbon::createFromDate($currentYear, $currentMonth, 1)->daysInMonth; // Get the number of days in September
            for ($i = 1; $i <= $daysInMonth; $i++) {
                $date = Carbon::createFromDate($currentYear, $currentMonth, $i);
                $dates[] = $date->format('Y-m-d');
            }
            //to show all dates from current month to specific month
            // for ($month = 3; $month <= 9; $month++) {
            //     $daysInMonth = Carbon::createFromDate($currentYear, $month, 1)->daysInMonth;
            //     for ($i = 1; $i <= $daysInMonth; $i++) {
            //         $date = Carbon::createFromDate($currentYear, $month, $i);
            //         $dates[] = $date->format('Y-m-d');
            //     }
            // }
            $attendance = array();
            foreach ($dates as $date) {
                $attendance[$date] = TakleefList::where('employee_id', $employee_info->id)->whereDate('date', $date)->first();
            }
            return view('editDate', compact('dates', 'employee_info', 'attendance', 'fileNo', 'month'));
        } else {
            session()->flash('error', '   رقم الملف غير موجود ');
            return redirect()->back();
        }
    }

    public function show($id, $month)
    {
        $employee = Emplopyee::findOrFail($id);
        $employee_takleef = TakleefList::where('employee_id', $id)
            ->where(function ($query) {
                $query->whereNotNull('employee_in')
                    ->orWhereNotNull('employee_out');
            })
            ->whereMonth('date', $month)
            ->orderBy('date')
            ->get();
        $currentMonth = $month; //September
        $daysInMonth = Carbon::createFromDate($this->currentYear, $currentMonth, 1)->daysInMonth; // Get the number of days in September
        for ($i = 1; $i <= $daysInMonth; $i++) {
            $dates[] = Carbon::createFromDate($this->currentYear, $currentMonth, $i);
        }
        $firstValue = reset($dates)->format('Y-m-d');;
        $lastValue  =  end($dates)->format('Y-m-d');;
        $employee_info = TakleefList::where('employee_id', $employee->id)->first();
        return view('show', compact('employee_takleef', 'employee_info', 'firstValue', 'lastValue', 'month'));
    }
    public function edit($id, $month)
    {
        $employee_info =  Emplopyee::where('id', $id)->first();
        $currentMonth = $month;
        $daysInMonth = Carbon::createFromDate($this->currentYear, $currentMonth, 1)->daysInMonth; // Get the number of days in September
        for ($i = 1; $i <= $daysInMonth; $i++) {
            $date = Carbon::createFromDate($this->currentYear, $currentMonth, $i);
            $dates[] = $date->format('Y-m-d');
        }
        $attendance = array();
        foreach ($dates as $date) {
            $attendance[$date] = TakleefList::where('employee_id', $employee_info->id)->whereDate('date', $date)->first();
        }
        return view('editDate', compact('dates', 'employee_info', 'attendance', 'month'));
    }


    public function update(Request $request, $id, $month)
    {

        $request->validate([
            'name' => 'required',
            'civilId' => 'required',
            'fileNo' => 'required'
        ], [
            'name.required' => 'يرجى ادخال اسم الموظف',
            'civilId.required' => 'يرجى ادخال الرقم المدني للموظف',
            'fileNo.required' => 'يرجى ادخال رقم الملف للموظف'
        ]);

        $name = $request->input('name');
        $civilId = $request->input('civilId');
        $fileNo = $request->input('fileNo');
        $employee_info = Emplopyee::findOrFail($id);
        $currentMonth = $month; //September
        $daysInMonth = Carbon::createFromDate($this->currentYear, $currentMonth, 1)->daysInMonth; // Get the number of days in September
        for ($i = 1; $i <= $daysInMonth; $i++) {
            $date = Carbon::createFromDate($this->currentYear, $currentMonth, $i);
            $dates[] = $date->format('Y-m-d');
        }
        $attendance = array();
        foreach ($dates as $date) {
            $attendance[$date] = TakleefList::where('employee_id', $employee_info->id)->whereDate('date', $date)->first();
        }
        //check if there is update on employee data
        $updatedData = [];
        if ($employee_info->name !== $name) {
            $updatedData['name'] = $name;
        }
        if ($employee_info->civilId !== $civilId) {
            $updatedData['civilId'] = $civilId;
        }
        if ($employee_info->fileNo !== $fileNo) {
            $updatedData['fileNo'] = $fileNo;
        }

        if (!empty($updatedData)) {
            $employee_info->update($updatedData);
        }
        //retrive dates of employee takleef and comare it with the input 
        $takleef_db = TakleefList::where('employee_id', $id)->get();
        $employee_in = $request->input('employee_in');
        $employee_out = $request->input('employee_out');
        if (empty($employee_in) && empty($employee_out)) {
            TakleefList::where('employee_id', $id)->update(['employee_in' => null, 'employee_out' => null]);
            TakleefList::where('employee_id', $id)->whereNull('employee_in')->whereNull('employee_out')->delete();
        }

        // check if employee_in array is not empty
        if (!empty($employee_in) || !empty($employee_out)) {
            $employee_in = $employee_in ?: array();
            $employee_out = $employee_out ?: array();
            $dates = array_merge($employee_in, $employee_out);
            TakleefList::where('employee_id', $id)->whereMonth('date', $month)->update(['employee_in' => null, 'employee_out' => null]);

            foreach ($dates as $date) {
                $attend = TakleefList::where('employee_id', $id)->where('date', $date)->first();
                if (!$attend) {
                    $attend = TakleefList::create([
                        'employee_id' => $id,
                        'date' => $date,
                        'employee_in' => in_array($date, $employee_in) ? 'بداية الدوام' : null,
                        'employee_out' => in_array($date, $employee_out) ? 'نهاية الدوام' : null
                    ]);
                } else {
                    $attend->update([
                        'employee_in' => in_array($date, $employee_in) ? 'بداية الدوام' : null,
                        'employee_out' => in_array($date, $employee_out) ? 'نهاية الدوام' : null
                    ]);
                }
            }
        }


        return redirect('/edit-takleef' . '/' . $id . '/' . $month)->withInput()->with('success', 'تم التعديل بنجاح')->with(compact('dates', 'employee_info', 'attendance'));
    }
}
