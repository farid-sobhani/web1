<!doctype html>
<html lang="fa">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="/css/style.css">
    <link rel="stylesheet" href="/css/ltr.css">
    <link rel="stylesheet" href="/css/font/font.css">
    <title>صفحه ثبت نام</title>
</head>
<body>
<main>

    <div class="account act">
        <form action="{{route('password.r')}}" class="form" method="post">
            @csrf
            <a class="account-logo" href="/">
                <img src="/img/weblogo.png" alt="">
            </a>
            <input type="hidden" name="id" value="{{$id}}">
            <div class="card-header">
                <p class="activation-code-title">کد فرستاده شده به ایمیل  <span>Mohammadniko3@gmail.com</span>
                    را وارد کنید . ممکن است ایمیل به پوشه spam فرستاده شده باشد
                </p>
            </div>
            <div class="form-content form-content1">
                <input class="activation-code-input" name="reset_code" placeholder="کد بازیابی">
                <br>
                <button class="btn i-t">تایید</button>
{{--                <form method="post" action="{{route('verification.resend')}}">--}}
{{--                    <a type="submit">ارسال مجدد کد</a>--}}
{{--                </form>--}}

            </div>
            <div class="form-footer">
                <a href="{{route('login')}}">صفحه ورود</a>
            </div>
        </form>
    </div>
</main>
</body>
<script src="/js/jquery-3.4.1.min.js"></script>
<script src="/js/activation-code.js"></script>
</html>
