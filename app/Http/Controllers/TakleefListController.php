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
    public function takleefList()
    {
        $title = "شهر يناير";
        return view('search', compact('title'));
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
    public function getTakleef(Request $request)
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
            $currentMonth = 1; //September
            $currentYear = 2023;
            $daysInMonth = Carbon::createFromDate($currentYear, $currentMonth, 1)->daysInMonth; // Get the number of days in September
            for ($i = 1; $i <= $daysInMonth; $i++) {
                $date = Carbon::createFromDate($currentYear, $currentMonth, $i);
                $dates[] = $date->format('Y-m-d');
            }
            $attendance = array();
            foreach ($dates as $date) {
                $attendance[$date] = TakleefList::where('employee_id', $employee_info->id)->whereDate('date', $date)->first();
            }
            return view('editDate', compact('dates', 'employee_info', 'attendance', 'fileNo'));
        } else {
            session()->flash('error', '   رقم الملف غير موجود ');
            return redirect()->back();
        }
    }

    public function show($id)
    {
        $employee = Emplopyee::findOrFail($id);
        $employee_takleef = TakleefList::where('employee_id', $id)
            ->where(function ($query) {
                $query->whereNotNull('employee_in')
                    ->orWhereNotNull('employee_out');
            })
            ->orderBy('date')
            ->get();
        $currentMonth = 1; //September
        $currentYear = 2023;
        $daysInMonth = Carbon::createFromDate($currentYear, $currentMonth, 1)->daysInMonth; // Get the number of days in September
        for ($i = 1; $i <= $daysInMonth; $i++) {
            $dates[] = Carbon::createFromDate($currentYear, $currentMonth, $i);
        }
        $firstValue = reset($dates)->format('Y-m-d');;
        $lastValue  =  end($dates)->format('Y-m-d');;
        $employee_info = TakleefList::where('employee_id', $employee->id)->first();
        return view('show', compact('employee_takleef', 'employee_info', 'firstValue', 'lastValue'));
    }
    public function edit($id)
    {
        $employee_info =  Emplopyee::where('id', $id)->first();
        $currentMonth = 1; //September
        $currentYear = 2023;
        $daysInMonth = Carbon::createFromDate($currentYear, $currentMonth, 1)->daysInMonth; // Get the number of days in September
        for ($i = 1; $i <= $daysInMonth; $i++) {
            $date = Carbon::createFromDate($currentYear, $currentMonth, $i);
            $dates[] = $date->format('Y-m-d');
        }
        $attendance = array();
        foreach ($dates as $date) {
            $attendance[$date] = TakleefList::where('employee_id', $employee_info->id)->whereDate('date', $date)->first();
        }
        return view('editDate', compact('dates', 'employee_info', 'attendance'));
    }
    private function updateAttendance($attendance, $input, $column, $value)
    {
        if (!empty($input)) {
            $attendance->each(function ($record) use ($input, $column, $value) {
                if (in_array($record->date, $input)) {
                    $record->update([$column => $value]);
                } else {
                    $record->update([$column => null]);
                }
            });
            foreach ($attendance as $takleef) {
                if ($takleef->employee_in === null && $takleef->employee_out === null) {
                    $takleef->delete();
                }
            }
        } else {
            TakleefList::whereIn('date', $attendance->pluck('date'))->update(['employee_in' => null]);
        }
    }
    private function createNewAttendanceRecords($employeeId, $input, $column, $value)
    {
        if (!empty($input)) {
            foreach ($input as $date) {
                $attendance = TakleefList::where('employee_id', $employeeId)->where('date', $date)->first();

                if (!$attendance) {
                    TakleefList::create([
                        'employee_id' => $employeeId,
                        'date' => $date,
                        $column => $value,
                    ]);
                }
            }
        }
    }

    public function update(Request $request, $id)
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
        $currentMonth = 1; //September
        $currentYear = 2023;
        $daysInMonth = Carbon::createFromDate($currentYear, $currentMonth, 1)->daysInMonth; // Get the number of days in September
        for ($i = 1; $i <= $daysInMonth; $i++) {
            $date = Carbon::createFromDate($currentYear, $currentMonth, $i);
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
        // check if employee_in array is not empty
        if (!empty($employee_in) || !empty($employee_out)) {
            $employee_in = $employee_in ?: array();
            $employee_out = $employee_out ?: array();
            $dates = array_merge($employee_in, $employee_out);
            TakleefList::where('employee_id', $id)->update(['employee_in' => null, 'employee_out' => null]);

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

        if (empty($employee_in) && empty($employee_out)) {
            TakleefList::where('employee_id', $id)->update(['employee_in' => null, 'employee_out' => null]);
            TakleefList::where('employee_id', $id)->whereNull('employee_in')->whereNull('employee_out')->delete();
        }


        return redirect('/edit-takleef' . '/' . $id)->withInput()->with('success', 'تم التعديل بنجاح')->with(compact('dates', 'employee_info', 'attendance'));
    }
}



/*****
 * 
 * old update function before refactoring
 *  $name = $request->input('name');
        $civilId = $request->input('civilId');
        $fileNo = $request->input('fileNo');
        $employee_info = Emplopyee::findOrFail($id);
        $currentMonth = 1; //September
        $currentYear = 2023;
        $daysInMonth = Carbon::createFromDate($currentYear, $currentMonth, 1)->daysInMonth; // Get the number of days in September
        for ($i = 1; $i <= $daysInMonth; $i++) {
            $date = Carbon::createFromDate($currentYear, $currentMonth, $i);
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
        // check if employee_in array is not empty
        if (!empty($employee_in)) {
            foreach ($takleef_db as $db_date) {
                $employee_in_value = in_array($db_date->date, $employee_in) ? 'بداية الدوام' : null;
                TakleefList::where('employee_id', $id)->where('date', $db_date->date)
                    ->update(['employee_in' => $employee_in_value]);
            }
        } else {
            TakleefList::where('employee_id', $id)->update(['employee_in' => null]);
        }
        // check if employee_out array is not empty
        if (!empty($employee_out)) {
            foreach ($takleef_db as $db_date) {
                $employee_out_value = in_array($db_date->date, $employee_out) ? 'نهاية الدوام' : null;
                TakleefList::where('employee_id', $id)->where('date', $db_date->date)
                    ->update(['employee_out' => $employee_out_value]);
            }
        } else {
            TakleefList::where('employee_id', $id)->update(['employee_out' => null]);
        }
        // check if employee_in array is not empty
        if (!empty($employee_in)) {
            foreach ($employee_in as $date) {
                $attend = TakleefList::where('employee_id', $id)->where('date', $date)->first();
                if (!$attend) {
                    $attend = TakleefList::create([
                        'employee_id' => $id,
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
                $attend = TakleefList::where('employee_id', $id)->where('date', $date)->first();
                if (!$attend) {
                    $attend = TakleefList::create([
                        'employee_id' => $id,
                        'date' => $date,
                        'employee_out' => 'نهاية الدوام'
                    ]);
                }
            }
        }
        if (empty($employee_in) && empty($employee_out)) {
            TakleefList::where('employee_id', $id)->update(['employee_in' => null, 'employee_out' => null]);
            TakleefList::where('employee_id', $id)->whereNull('employee_in')->whereNull('employee_out')->delete();
            return redirect('/')->with('success', 'Attendance updated successfully');
        }
        //delete if both of employee_in and employee_out are empty and delete it
        foreach ($takleef_db as $takleef) {
            if ($takleef->employee_in === null && $takleef->employee_out === null) {
                $takleef->delete();
            }
        }

        return redirect('/edit-takleef' . '/' . $id)->withInput()->with('success', 'تم التعديل بنجاح')->with(compact('dates', 'employee_info', 'attendance'));
 * 
 * 
 * #######################################################
 * refactor code
 *  // Retrieve the employee information
        $employee = Emplopyee::findOrFail($id);
        // Update employee information if there are any changes
        $employee->update($request->only(['name', 'civilId', 'fileNo']));
        // Retrieve the current month and year
        $currentMonth = 1;
        $currentYear = 2023;
        // Retrieve the dates of the current month
        $dates = Carbon::createFromDate($currentYear, $currentMonth, 1)->daysInMonth;
        $dates = array_map(function ($day) use ($currentYear, $currentMonth) {
            return Carbon::createFromDate($currentYear, $currentMonth, $day)->format('Y-m-d');
        }, range(1, $dates));
        // Retrieve attendance records
        $attendance = TakleefList::where('employee_id', $employee->id)->whereIn('date', $dates)->get();
        // Update attendance records
        $this->updateAttendance($attendance, $request->input('employee_in'), 'employee_in', 'بداية الدوام');
        $this->updateAttendance($attendance, $request->input('employee_out'), 'employee_out', 'نهاية الدوام');
        // Create new attendance records if necessary
        $this->createNewAttendanceRecords($employee->id, $request->input('employee_in'), 'employee_in', 'بداية الدوام');
        $this->createNewAttendanceRecords($employee->id, $request->input('employee_out'), 'employee_out', 'نهاية الدوام');
        return redirect('/edit-takleef' . '/' . $id)->withInput()->with('success', 'تم التعديل بنجاح');
 */