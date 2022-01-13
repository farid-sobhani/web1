@extends('User::Front.master')

@section('content')
    <div class="account">
        <form action="{{ route('password.update') }}" class="form" method="POST">
            @csrf

            <a class="account-logo" href="/">
                <img src="/img/weblogo.png" alt="">
            </a>
            <div class="form-content form-account">

                <span class="rules">رمز عبور باید حداقل ۶ کاراکتر و
                    ترکیبی از حروف بزرگ، حروف کوچک، اعداد و کاراکترهای غیر الفبا مانند !@#$%^&*() باشد.</span>
                <br>
                <input type="text" class="txt txt-l @error('password') is-invalid @enderror" name="password" required
                       autocomplete="new-password" placeholder="رمز عبور جدید">
                @error('password')
                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                @enderror

                <input type="text" class="txt txt-l @error('password') is-invalid @enderror"
                       name="password_confirmation" required autocomplete="new-password" placeholder="تکرار رمزعبور جدید">
                <br>
                <button type="submit" class="btn continue-btn">تایید و ادامه</button>

            </div>
        </form>
    </div>

@endsection
