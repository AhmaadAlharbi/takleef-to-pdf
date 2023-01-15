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

    <style>
        .flex {
            display: flex;
            justify-content: center;
            align-items: center;

        }



        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Cairo', sans-serif;
            background-color: white;
        }

        #print {
            background: url("/images/background.png");
            background-size: cover;
            background-position: center;
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

        button:nth-child(2) {
            background-color: #ff7907;
        }

        @media print {

            button,
            .edit-btn {
                display: none;
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

            @page {
                /* Letter size paper */

            }

            body {
                -webkit-print-color-adjust: exact;
            }

            header,
            footer {
                display: none;
            }

            /* #print {

                background-image: url("https://raw.githubusercontent.com/AhmaadAlharbi/takleef-to-pdf/main/public/images/background.png");
                background-size: cover;
                background-position: center;
            } */

            .page-break {
                page-break-after: always;
            }

            /* table {
                table-layout: fixed;
                width: 100%;
                max-width: 800px;
                font-size: 16px;

            } */

            /* table {
                page-break-inside: auto;
            }

            tr {
                page-break-inside: avoid;
                page-break-after: auto
            } */

            .page {
                page-break-after: always;
            }

            img {
                max-width: 100%;
            }


        }
    </style>
</head>

<body>


    {{-- <button class="btn btn-danger" onclick="generatePDF()">Generate PDF</button> --}}
    <button onclick="window.print()">حفظ PDF</button>
    <a href="{{route('editDate',['id'=>$employee_info->fileNo])}}" class="btn edit-btn btn-primary">
        تعديل
    </a>
    <!-- 
    <a href="{{route('user.pdf')}}" class="btn btn-danger">Generate
        PDF</a> -->
    <div class="row container border-dark text-center mx-auto d-block">
        <div id="print" class="row page ">
            <img class="header-img" src="{{ asset('images/header.png') }}" alt="Image">
            <h5 class=" font-weight-bold mb-3 mt-5">قطاع شبكات النقل الكهربائية</h5>
            <h5 class="font-weight-bold mb-3">تكليف بمهمة خارج مقر العمل</h5>
            <div class="row mb-3 ">
                <div class="col">
                    <h5>السيد / مدير ادارة شؤون العاملين</>
                        <h5>تحية طيبة وبعد</h5>

                </div>
                <div class="col">
                    <h5>المحترم</h5>
                </div>
            </div>
            <h5 class="font-weight-bold mb-3">الموضوع/ تكليف بمهمة خارج مقر العمل</h5>
            <div class="">
                <p>الاسم:{{$employee_info->name}}</p>
                <p>الرقم المدني:{{$employee_info->civilId}}</p>
                <p>رقم الملف:{{$employee_info->fileNo}}</p>
                <p class="">بالإشارة إلى الموضوع أعلاه ، نرسل لكم جدول بأسم الموظف الذي لديه تكليف بمهمات خارج مقر
                    العمل
                    لقسم (الوقاية ) إدارة صيانة محطات التحويل الرئيسية </p>

                <div class=" flex space-x">
                    <div class="mx-4">من الفترة</div>
                    <div class="">{{$firstDate}} </div>
                    <div class="mx-4"> إلى</div>
                    <div class="">{{$lastDate}} </div>
                </div>
                <p class="mt-4">وذلك لإجراء اللازم</p>
                <p>مع أطيب التمنيات،،،</p>
                <h5 class="d-flex justify-content-end " style="margin-top:40px;">مدير إدارة صيانة محطات التحويل
                    الرئيسية
                </h5>

            </div>
            <div class="footer-img">
                <img src="{{ asset('images/footer.png') }}" style="margin-top:150px;" alt="Image">
            </div>
        </div>
        {{--page 2--}}
        {{-- page2 --}}
        <div class="row page page-break mx-auto d-block">
            <img src="{{ asset('images/header2.png') }}" alt="Image">
            <h4 class="mt-5 font-weight-bold mb-4">قطاع شبكات النقل الكهربائية</h4>
            <h4 class="font-weight-bold">تكليف بمهمة خارج مقر العمل</h4>
            <div class="row mt-4 ">
                <div class="col">
                    <h5>السيد / مدير ادارة شؤون العاملين</h5>
                    <h5>تحية طيبة وبعد</h5>
                </div>
                <div class="col">
                    <h5>المحترم</h5>
                </div>
            </div>
            <h5 class="font-weight-bold mb-3">الموضوع/ تكليف بمهمة خارج مقر العمل</h5>
            <div class="mt-3">
                <p>الاسم:{{$employee_info->name}}</p>
                <p>الرقم المدني:{{$employee_info->civilId}}</p>
                <p>رقم الملف:{{$employee_info->fileNo}}</p>
                <p class="">بالإشارة إلى الموضوع أعلاه ، نرسل لكم جدول بأسم الموظف الذي لديه تكليف بمهمات خارج مقر
                    العمل
                    لقسم (الوقاية ) إدارة صيانة محطات التحويل الرئيسية </p>

                <div class=" flex space-x">
                    <div class="mx-4">من الفترة</div>
                    <div class="">{{$firstDate}} </div>
                    <div class="mx-4"> إلى</div>
                    <div class="">{{$lastDate}} </div>
                </div>
                <p>وذلك لإجراء اللازم</p>
                <p>مع أطيب التمنيات،،،</p>

            </div>
            <h5 class="d-flex justify-content-end " style="margin-top:40px;">مدير إدارة صيانة محطات التحويل
                الرئيسية
            </h5>
            <h5 class="d-flex justify-content-start mr-5 " style="margin-top:60px;">
                المسؤول المباشر
            </h5>
        </div>
        {{-- page 3 --}}
        <img class="header-img" src="{{ asset('images/header2.png') }}" alt="Image">
        <h5 class=" font-weight-bold mb-3 mt-5">قطاع شبكات النقل الكهربائية</h5>
        <h5 class="font-weight-bold mb-3">تكليف بمهمة خارج مقر العمل</h5>
        <div class="row mb-3 ">
            <div class="col">
                <h5>السيد / مدير ادارة شؤون العاملين</>
                    <h5>تحية طيبة وبعد</h5>

            </div>
            <div class="col">
                <h5>المحترم</h5>
            </div>
        </div>
        <h5 class="font-weight-bold mb-3">الموضوع/ تكليف بمهمة خارج مقر العمل</h5>
        <div class="">
            <p>الاسم:{{$employee_info->name}}</p>
            <p>الرقم المدني:{{$employee_info->civilId}}</p>
            <p>رقم الملف:{{$employee_info->fileNo}}</p>
            <table id="tableId" class="table  text-center table-bordered  table-hover table-responsive">
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
                @isset($employee)
                @foreach($employee as $x)

                <tbody>
                    <tr>
                        @php
                        $i++;
                        @endphp

                        <td>{{$i}}</td>
                        @switch( \Carbon\Carbon::parse($x->date)->englishDayOfWeek)

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
                        <td>{{$x->date}}</td>
                        <td>{{$x->employee_in}}</td>
                        <td>{{$x->employee_out}}</td>

                    </tr>

                </tbody>
                @endforeach
                @endisset

            </table>
            <div class="row mt-5">
                <div class="col">
                    <p>موافقة رئيس القسم</p>
                </div>
                <div class="col">
                    <p>اعتماد مدير الادراة</p>

                </div>
            </div>
        </div>
    </div>
    <script>
        var table = document.getElementById("tableId");
var rows = table.getElementsByTagName("tr");

for (var i = 0; i < rows.length; i++) {
    if (i === 8) {
        rows[i].style.pageBreakBefore = "always";
    }
}
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous">
    </script>

</body>

</html>