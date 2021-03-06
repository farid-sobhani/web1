@extends('User::Front.master')

@section('content')
    <div class="account act">
        <form action="{{ route('verification.verify') }}" class="form" method="post">
            @csrf
            <a class="account-logo" href="/">
                <img src="/img/weblogo.png" alt="">
            </a>
            <div class="card-header">
                <p class="activation-code-title">کد فرستاده شده به ایمیل  <span>Mohammadniko3@gmail.com</span>
                    را وارد کنید . ممکن است ایمیل به پوشه spam فرستاده شده باشد
                </p>
            </div>
            <div class="form-content form-content1">
                <input class="activation-code-input" placeholder="فعال سازی" required name="verify_code" >
                @error('verify_code')

                <span class="invalid-feedback" role="alert">
                    <strong>
                        {{$message}}
                    </strong>
                </span>
                @enderror
                <br>
                <button class="btn i-t">تایید</button>
                <a href="#" onclick="document.getElementById('resend').submit();event.preventDefault()"
                   >ارسال مجدد کد</a>
                <form method="post" action="{{route('verification.resend')}}" id="resend">
                    @csrf
                </form>
            </div>
            <div class="form-footer">
                <a href="login.html">صفحه ثبت نام</a>
            </div>
        </form>
    </div>
@endsection
@section('js')

    <script src="/js/jquery-3.4.1.min.js"></script>
    <script src="/js/activation-code.js"></script>

    @endsection
