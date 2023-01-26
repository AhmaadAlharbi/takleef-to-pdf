<!DOCTYPE html>
<html lang="en" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.rtl.min.css"
        integrity="sha384-gXt9imSW0VcJVHezoNQsP+TNrjYXoGcrqBZJpry9zJt8PCQjobwmhMGaDHTASo9N" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;900&display=swap" rel="stylesheet">
    <title>تكاليف قسم الوقاية</title>
    <style>
        body {
            font-family: 'Cairo', sans-serif;

        }

        img {
            max-width: 100%;
        }
    </style>
</head>

<body>
    @if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif
    <div class="row border px-4 py-2 mt-4 d-flex justify-content-center align-items-center text-center">
        <div class="col">
            <img src="{{ asset('images/hero-welcome.svg') }}" alt="Image">
            <h1>تكاليف قسم الوقاية</h1>
            <div class="mt-5">
                <div class="" role="group" aria-label="Basic example">
                    <div class="col">
                        <a href="/search/1"
                            class="btn {{ Carbon\Carbon::now()->month == 1 ? 'btn-primary' : 'btn-dark' }}">يناير
                            {{Carbon\Carbon::now()->year}}</a>
                        <a href="/search/2"
                            class="btn {{ Carbon\Carbon::now()->month == 2 ? 'btn-primary' : 'btn-dark' }}">فبراير
                            {{Carbon\Carbon::now()->year}}</a>
                        <a href="/search/3"
                            class="btn {{ Carbon\Carbon::now()->month == 3 ? 'btn-primary' : 'btn-dark' }}">مارس
                            {{Carbon\Carbon::now()->year}}</a>
                    </div>
                    <div class="col mt-3">
                        <a href="/search/4"
                            class="btn {{ Carbon\Carbon::now()->month == 4 ? 'btn-primary' : 'btn-dark' }}">ابريل
                            {{Carbon\Carbon::now()->year}}</a>
                        <a href="/search/5"
                            class="btn {{ Carbon\Carbon::now()->month == 5 ? 'btn-primary' : 'btn-dark' }}">مايو
                            {{Carbon\Carbon::now()->year}}</a>
                        <a href="/search/6"
                            class="btn {{ Carbon\Carbon::now()->month == 6 ? 'btn-primary' : 'btn-dark' }}">يونيو
                            {{Carbon\Carbon::now()->year}}</a>
                    </div>
                    <div class="col mt-3">
                        <a href="/search/7"
                            class="btn {{ Carbon\Carbon::now()->month == 7 ? 'btn-primary' : 'btn-dark' }}">يوليو
                            {{Carbon\Carbon::now()->year}}</a>
                        <a href="/search/8"
                            class="btn {{ Carbon\Carbon::now()->month == 8 ? 'btn-primary' : 'btn-dark' }}">أغسطس
                            {{Carbon\Carbon::now()->year}}</a>
                        <a href="/search/9"
                            class="btn {{ Carbon\Carbon::now()->month == 9 ? 'btn-primary' : 'btn-dark' }}">سبتمبر
                            {{Carbon\Carbon::now()->year}}</a>
                    </div>
                    <div class="col mt-3">
                        <a href="/search/10"
                            class="btn {{ Carbon\Carbon::now()->month == 10 ? 'btn-primary' : 'btn-dark' }}">اكتوبر
                            {{Carbon\Carbon::now()->year}}</a>
                        <a href="/search/11"
                            class="btn {{ Carbon\Carbon::now()->month == 11 ? 'btn-primary' : 'btn-dark' }}">نوفمبر
                            {{Carbon\Carbon::now()->year}}</a>
                        <a href="/search/12"
                            class="btn {{ Carbon\Carbon::now()->month == 12 ? 'btn-primary' : 'btn-dark' }}">ديسمبر
                            {{Carbon\Carbon::now()->year}}</a>
                    </div>

                </div>
                {{-- <a href="/dates-shift-a" class="btn btn-outline-primary">Shift A</a>
                <a href="/dates-shift-b" class="btn btn-outline-secondary">Shift B</a>
                <a href="/dates-shift-c" class="btn btn-outline-dark">Shift C</a>
                <a href="/dates-shift-d" class="btn btn-outline-success">Shift D</a>
                <a href="/dates" class="btn btn-outline-danger">غير محدد</a> --}}
                {{-- <a href="/takleef-december" class="btn btn-danger">شهر ديسمبر 12</a> --}}
                {{-- <a href="/takleef-list" class="btn btn-danger">عرض تكاليف شهر 1 أو التعديل عليها</a> --}}
            </div>
        </div>

    </div>
</body>

</html>