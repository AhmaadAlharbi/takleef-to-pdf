<!doctype html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="utf-8">

    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.rtl.min.css" integrity="sha384-gXt9imSW0VcJVHezoNQsP+TNrjYXoGcrqBZJpry9zJt8PCQjobwmhMGaDHTASo9N" crossorigin="anonymous">
    <!-- <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin> -->
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;900&display=swap" rel="stylesheet"> -->
    <meta charset="UTF-8">

    <style>
        /* @font-face {
            font-family: 'Cairo';
            src: url('{{ $font_path }}') format('truetype');
        } */


        @font-face {
            font-family: 'Cairo';
            src: url('https://fonts.googleapis.com/css2?family=Cairo&display=swap') format('truetype');
        }



        body {
            font-family: 'Cairo', Arial, Helvetica, sans-serif !important;
        }



        #print {
            background: url("/images/background.png");
            background-size: cover;
            background-position: center;
        }

        @media print {
            @page {
                margin: 1cm;
            }

            #print {
                background-image: url("/images/background.png");
                background-size: cover;
                background-position: center;
            }

            .page:last-of-type {
                page-break-after: avoid;
            }

            .page:last-child {
                page-break-after: auto;
            }

            .page:first-of-type {
                page-break-before: avoid;
            }

            .page-break {
                page-break-after: always;
            }

            table {
                table-layout: fixed;
                width: 100%;
                max-width: 800px;
                font-size: 16px;

            }
        }

        button {
            background-color: #4CAF50;
            /* Green */
            border: none;
            color: white;
            padding: 15px 32px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;

        }
    </style>
</head>

<body>


    {{-- <button class="btn btn-danger" onclick="generatePDF()">Generate PDF</button> --}}
    <button onclick="window.print()">Print</button>

    <a href="{{route('user.pdf')}}" class="btn btn-danger">Generate
        PDF</a>

    <div class="row  container  border-dark text-center mx-auto d-block" style="margin-top:50px;">
        <div id="print" class="row page-break">
            <img src="https://raw.githubusercontent.com/AhmaadAlharbi/takleef-to-pdf/main/public/images/header.png" alt="Image">
            <p class="mt-5">قطاع شبكات النقل الكهربائية</p>
            <p>تكليف بمهمة خارج مقر العمل</p>
            <div class="row mt-4 mb-5">
                <div class="col">
                    <h5>السيد / مدير ادارة شؤون العاملين</h5>
                    <h5>تحية طيبة وبعد</h5>

                </div>
                <div class="col">
                    <h5>المحترم</h5>
                </div>
            </div>
            <h4>الموضوع: تكليف بمهمة خارج مقر العمل</h4>
            <div class="mt-5">
                <h4>الاسم:{{$employee->name}}</h4>
                <h4>الرقم المدني:{{$employee->civilId}}</h4>
                <h4>رقم الملف:{{$employee->fileNo}}</h4>
                <p class="mt-5">بالإشارة إلى الموضوع أعلاه ، نرسل لكم جدول بأسم الموظف الذي لديه تكليف بمهمات خارج مقر
                    العمل
                    لقسم (الوقاية ) – إدارة صيانة محطات التحويل الرئيسية – للفترة</p>
                <p>
                    {{$firstValue}} إلى {{$lastValue}}
                </p>
                <p>وذلك لإجراء اللازم</p>
                <p>مع أطيب التنميات،،،</p>
                <h3 class="d-flex justify-content-end " style="margin-top:150px;">مدير إدارة صيانة محطات التحويل
                    الرئيسية
                </h3>
            </div>
            <div style="margin-top: 130px;">
                <img src="https://raw.githubusercontent.com/AhmaadAlharbi/takleef-to-pdf/main/public/images/footer.png" alt="Image">

            </div>
        </div>

        {{-- page2 --}}
        <div class="row page-break mx-auto d-block">
            <img style="margin-top:200px;" src="https://raw.githubusercontent.com/AhmaadAlharbi/takleef-to-pdf/main/public/images/header2.png" alt="Image">
            <h3 class="mt-5">قطاع شبكات النقل الكهربائية</h3>
            <h4>تكليف بمهمة خارج مقر العمل</h4>
            <div class="row mt-4 mb-5">
                <div class="col">
                    <h5>السيد / مدير ادارة شؤون العاملين</h5>
                    <h5>تحية طيبة وبعد</h5>
                </div>
                <div class="col">
                    <h5>المحترم</h5>
                </div>
            </div>
            <h4>الموضوع: تكليف بمهمة خارج مقر العمل</h4>
            <div class="mt-5">
                <h4>الاسم:{{$employee->name}}</h4>
                <h4>الرقم المدني:{{$employee->civilId}}</h4>
                <h4>رقم الملف:{{$employee->fileNo}}</h4>
                <p class="mt-5">بالإشارة إلى الموضوع أعلاه ، نرسل لكم جدول بأسم الموظف الذي لديه تكليف بمهمات خارج مقر
                    العمل
                    لقسم (الوقاية ) – إدارة صيانة محطات التحويل الرئيسية – للفترة</p>
                <p>
                    {{$firstValue}} إلى {{$lastValue}}
                </p>
                <p>وذلك لإجراء اللازم</p>
                <p>مع أطيب التنميات،،،</p>
                <h3 class="d-flex justify-content-end " style="margin-top:150px;">مدير إدارة صيانة محطات التحويل
                    الرئيسية
                </h3>
                <h5 class="d-flex justify-content-start mr-5 " style="margin-top:60px;">
                    المسؤول المباشر
                </h5>
            </div>

        </div>
        {{-- page3 --}}
        <div class="row page  mx-auto d-block">
            <img style="margin-top:300px;" src="https://raw.githubusercontent.com/AhmaadAlharbi/takleef-to-pdf/main/public/images/header2.png" alt="Image">

            <h3 class="mt-5">قطاع شبكات النقل الكهربائية</h3>
            <h4>تكليف بمهمة خارج مقر العمل</h4>
            <div class="row mt-4 mb-5">
                <div class="col">
                    <h5>السيد / مدير ادارة شؤون العاملين</h5>
                    <h5>تحية طيبة وبعد</h5>

                </div>
                <div class="col">
                    <h5>المحترم</h5>
                </div>
            </div>
            <h4>الموضوع: تكليف بمهمة خارج مقر العمل</h4>
            <div class="mt-5">
                <h4>الاسم:{{$employee->name}}</h4>
                <h4>الرقم المدني:{{$employee->civilId}}</h4>
                <h4>رقم الملف:{{$employee->fileNo}}</h4>
            </div>
            <table class="table  text-center table-bordered  table-hover table-responsive mt-5">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>اليوم</th>
                        <th>التاريخ</th>
                        <th>7:00 AM</th>
                        <th>7:00 PM</th>
                    </tr>
                </thead>
                @php
                $i = 0;
                @endphp
                @isset($unique_dates)
                @foreach($unique_dates as $date)

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

                        @if(in_array($date,$selectedDates1))
                        <td>

                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="black" class="bi bi-check2-circle" viewBox="0 0 16 16">
                                <path d="M2.5 8a5.5 5.5 0 0 1 8.25-4.764.5.5 0 0 0 .5-.866A6.5 6.5 0 1 0 14.5 8a.5.5 0 0 0-1 0 5.5 5.5 0 1 1-11 0z" />
                                <path d="M15.354 3.354a.5.5 0 0 0-.708-.708L8 9.293 5.354 6.646a.5.5 0 1 0-.708.708l3 3a.5.5 0 0 0 .708 0l7-7z" />
                            </svg>
                        </td>
                        @else
                        <td>-</td>
                        @endif
                        @if(in_array($date,$selectedDates2))
                        <td> <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="black" class="bi bi-check2-circle" viewBox="0 0 16 16">
                                <path d="M2.5 8a5.5 5.5 0 0 1 8.25-4.764.5.5 0 0 0 .5-.866A6.5 6.5 0 1 0 14.5 8a.5.5 0 0 0-1 0 5.5 5.5 0 1 1-11 0z" />
                                <path d="M15.354 3.354a.5.5 0 0 0-.708-.708L8 9.293 5.354 6.646a.5.5 0 1 0-.708.708l3 3a.5.5 0 0 0 .708 0l7-7z" />
                            </svg></i></td>
                        @else
                        <td>-</td>
                        @endif
                    </tr>

                </tbody>
                @endforeach
                @endisset

            </table>
        </div>


    </div>



</body>

</html>