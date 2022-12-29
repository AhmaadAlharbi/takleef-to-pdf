<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.rtl.min.css"
        integrity="sha384-gXt9imSW0VcJVHezoNQsP+TNrjYXoGcrqBZJpry9zJt8PCQjobwmhMGaDHTASo9N" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;900&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Cairo', sans-serif;

        }
    </style>
</head>

<body>
    <h1 class="text-center mt-4">SHIFT A</h1>
    <form method="POST" action="/submit">

        <div class="row container">

            <div class="col-md-5">
                <img src="{{ asset('images/booking.svg') }}" alt="Image">
                <div class="text-center">
                    <label>ادخل رقم الملف الخاص بالموظف</label>
                    <input name="fileNo" type="text" class="form-control d-block mt-2">
                    <button class="btn btn-primary btn-lg mt-2 " type="submit">Save</button>

                </div>

            </div>
            <div class="col-md-7 text-center mt-5">
                @csrf
                <table class="table table-striped text-center table-bordered  table-hover table-responsive">
                    <thead class="thead-dark">
                        <tr>
                            <th>#</th>
                            <th>اليوم</th>
                            <th>التاريخ</th>
                            <th>7:00 AM</th>
                            <th>7:00 PM</th>
                        </tr>
                    </thead>
                    @php
                    $i=1;
                    @endphp
                    <tbody>
                        @foreach ($dates as $date)
                        <tr class="{{ in_array($date->format('Y-m-d'), $disabledDates) ? 'table-info ' : '' }}">
                            <td>{{$i++}}</td>

                            {{-- <td>{{ $date->format('l') }}</td> --}}
                            @switch($date->format('l'))
                            @case('Sunday')
                            <td>
                                الأحد
                            </td>
                            @break
                            @case('Monday')
                            <td>
                                الاثنين
                            </td>
                            @break
                            @case('Tuesday')
                            <td>
                                الثلاثاء
                            </td>
                            @break
                            @case('Wednesday')
                            <td>
                                الأربعاء
                            </td>
                            @break
                            @case('Thursday')
                            <td>
                                الخميس
                            </td>
                            @break
                            @case('Friday')
                            <td>
                                الجمعة
                            </td>
                            @break
                            @case('Saturday')
                            <td>
                                السبت
                            </td>
                            @break
                            @endswitch
                            <td>{{ $date->format('Y-m-d') }}</td>
                            <td>

                                <input class="form-check-input" type="checkbox"
                                    name="checkbox1[{{ $date->format('Y-m-d') }}]" value="{{ $date->format('Y-m-d') }}"
                                    @if(in_array($date->format('Y-m-d'), $disabledDates))
                                disabled
                                @endif>
                            </td>
                            <td>
                                <input class="form-check-input" type="checkbox"
                                    name="checkbox2[{{ $date->format('Y-m-d') }}]" value="{{ $date->format('Y-m-d') }}"
                                    @if(in_array($date->format('Y-m-d'), $disabledDates))
                                disabled
                                @endif>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

        </div>
    </form>

</body>

</html>