@extends('User::Front.master')
@section('content')
    <div class="account">
        <form action="{{ route('register') }}" class="form" method="post">
            @csrf
            <a class="account-logo" href="/">
                <img src="img/weblogo.png" alt="">
            </a>
            <div class="form-content form-account">
                <input type="text" class="txt form-control @error('name') is-invalid @enderror" name="name"
                       value="{{ old('name') }}" required autocomplete="name" autofocus placeholder="نام و نام خانوادگی*"
                >
                @error('name')
                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                @enderror
                <input type="text" class="txt txt-l @error('email') is-invalid @enderror"
                       name="email" value="{{ old('email') }}" required autocomplete="email"
                       placeholder="ایمیل*">
                @error('email')
                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                @enderror
                <input type="text" class="txt txt-l @error('mobile') is-invalid @enderror"
                       name="mobile" value="{{ old('mobile') }}" required autocomplete="mobile"
                       placeholder="موبایل">
                @error('mobile')
                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                @enderror

                <span class="rules">رمز عبور باید حداقل ۶ کاراکتر و
                    ترکیبی از حروف بزرگ، حروف کوچک، اعداد و کاراکترهای غیر الفبا مانند !@#$%^&*() باشد.</span>
                <br>
                <input type="text" class="txt txt-l @error('password') is-invalid @enderror" name="password" required
                       autocomplete="new-password" placeholder="رمز عبور*">
                @error('password')
                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                @enderror

                <input type="text" class="txt txt-l @error('password') is-invalid @enderror"
                       name="password_confirmation" required autocomplete="new-password" placeholder="تکرار رمزعبور*">
                <br>
                <button type="submit" class="btn continue-btn">ثبت نام و ادامه</button>

            </div>
            <div class="form-footer">
                <a href="{{route('login')}}">صفحه ورود</a>
            </div>
        </form>
    </div>

@endsection
