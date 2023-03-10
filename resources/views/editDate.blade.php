<!doctype html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>.</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.rtl.min.css"
        integrity="sha384-gXt9imSW0VcJVHezoNQsP+TNrjYXoGcrqBZJpry9zJt8PCQjobwmhMGaDHTASo9N" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;900&display=swap" rel="stylesheet">
    <!-- <link rel="stylesheet" href="{{ asset('css/app.css') }}"> -->
</head>

<body>

    <div class="container">
        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <form method="POST" action="{{route('update',['id'=>$employee_info->id, 'month' => $month])}}">
            @csrf
            <div class="row container text-center mx-auto d-flex justify-content-center align-items-center">
                <div class="col-md-5">


                    <img src="{{ asset('images/booking.svg') }}" alt="Image">

                    <label>الاسم</label>
                    <input name="name" type="text" class="form-control my-2" value="{{$employee_info->name}}">
                    <label>الرقم المدني</label>
                    <input name="civilId" type="text" value=" {{$employee_info->civilId}}" class="form-control my-2">
                    <label>رقم الملف </label>
                    <input name="fileNo" type="text" class="form-control my-2" value="{{$employee_info->fileNo}}">
                    <button type="submit" class="btn btn-dark  btn-lg mt-2" data-toggle="modal"
                        data-target="#exampleModal">
                        تعديل
                    </button>
                    <a href="/show/{{$employee_info->id}}/{{$month}}" class="btn btn-success btn-lg mt-2">PDF</a>

                </div>

                <div class="col-md-6 text-center mt-5">
                    <table class="table text-center table-bordered  table-hover table-responsive">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>اليوم</th>
                                <th>التاريخ</th>
                                <th>حضور</th>
                                <th>انصراف</th>
                            </tr>
                        </thead>
                        @php
                        $i = 0;
                        @endphp
                        @foreach($dates as $date)
                        <tbody>
                            <tr>
                                @php
                                $i++;
                                @endphp
                                <td>{{$i}}</td>
                                @switch( \Carbon\Carbon::parse($date)->englishDayOfWeek)
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

                                <td>{{$date}}</td>
                                <td>

                                    @if(is_array($attendance) && in_array($date,array_column($attendance, 'date')))
                                    @if($attendance[$date]->employee_in === 'بداية الدوام')
                                    <input type="checkbox" name="employee_in[]" value="{{$date}}" checked>
                                    @else
                                    <input type="checkbox" name="employee_in[]" value="{{$date}}">
                                    @endif
                                    @else
                                    <input type="checkbox" name="employee_in[]" value="{{$date}}">
                                    @endif

                                </td>
                                <td>

                                    @if(is_array($attendance) && in_array($date,array_column($attendance, 'date')))
                                    @if($attendance[$date]->employee_out === 'نهاية الدوام')
                                    <input type="checkbox" name="employee_out[]" value="{{$date}}" checked>
                                    @else
                                    <input type="checkbox" name="employee_out[]" value="{{$date}}">
                                    @endif
                                    @else
                                    <input type="checkbox" name="employee_out[]" value="{{$date}}">
                                    @endif
                                </td>


                            </tr>
                        </tbody>
                        @endforeach
                    </table>
                </div>

            </div>
        </form>

    </div>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
    <script>
        window.addEventListener('load', function() {
            var success_message = "{{ session()->get('success') }}";
            var error_message = "{{ session()->get('error') }}";
            if (success_message) {
                Swal.fire({
                    icon: 'success',
                    title: success_message,
                    showConfirmButton: false,
                    timer: 1500
                });
            }
            if (error_message) {
                Swal.fire({
                    icon: 'error',
                    title: error_message,
                    showConfirmButton: false,
                    timer: 1500
                });
            }
        });
    </script>

</body>

</html>