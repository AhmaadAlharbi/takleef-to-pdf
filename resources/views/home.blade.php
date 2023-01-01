<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.rtl.min.css" integrity="sha384-gXt9imSW0VcJVHezoNQsP+TNrjYXoGcrqBZJpry9zJt8PCQjobwmhMGaDHTASo9N" crossorigin="anonymous">
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
    <div class="row border px-4 py-2 mt-4 d-flex justify-content-center align-items-center text-center">
        <div class="col">
            <img src="{{ asset('images/hero-welcome.svg') }}" alt="Image">
            <h1>تكاليف قسم الوقاية</h1>
            <div class="mt-5">
                <a href="/dates" class="btn btn-outline-primary">Shift A</a>
                <button class="btn btn-outline-secondary">Shift B</button>
                <button class="btn btn-outline-dark">Shift C</button>
                <button class="btn btn-outline-success">Shift D</button>
            </div>
        </div>

    </div>
</body>

</html>