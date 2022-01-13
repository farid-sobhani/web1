@extends('Dashboard::master')

@section('css')
    <link rel="stylesheet" href="/panel/css/toast-plugin.css">
@endsection
@section('content')
    <div class="main-content font-size-13">
        <div class="row no-gutters bg-white margin-bottom-20">
            <div class="col-12">
                <p class="box__title">ایجاد کاربر</p>
                <form action="{{route('user.update',$user->id)}}" class="padding-30" method="post">
                    @csrf
                    @method('PATCH')

                    <input type="text" name="name" value="{{$user->name}}" class="text" placeholder="نام و نام خانوادگی">
                    @error('name')
                    <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                    <input type="text" name="email" value="{{$user->email}}" class="text" placeholder="ایمیل">
                    @error('email')
                    <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                    <input type="text" name="mobile" value="{{$user->mobile}}" class="text" placeholder="شماره موبایل">
                    @error('mobile')
                    <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                    <select name="role" id="">
                        <option value="">انتخاب نقش کاربری</option>
                        @foreach($roles as $role)

                            <option value="{{$role->name}}"

                                {{ $user->hasRole($role->name) ? 'selected' : '' }}>@lang($role->name)</option>
                        @endforeach
                    </select>
                    <button type="submit" class="btn btn-tot">بروزرسانی کاربر</button>
                </form>

            </div>
        </div>
        <div class="row no-gutters">
            <div class="col-6 margin-left-10 margin-bottom-20">
                <p class="box__title">درحال یادگیری</p>
                <div class="table__box">
                    <table class="table">
                        <thead role="rowgroup">
                        <tr role="row" class="title-row">
                            <th>شناسه</th>
                            <th>نام دوره</th>
                            <th>نام مدرس</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr role="row" class="">
                            <td><a href="">1</a></td>
                            <td><a href="">دوره لاراول</a></td>
                            <td><a href="">صیاد اعظمی</a></td>
                        </tr>
                        <tr role="row" class="">
                            <td><a href="">1</a></td>
                            <td><a href="">دوره لاراول</a></td>
                            <td><a href="">صیاد اعظمی</a></td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="col-6 margin-bottom-20">
                <p class="box__title">دوره های مدرس</p>
                <div class="table__box">
                    <table class="table">
                        <thead role="rowgroup">
                        <tr role="row" class="title-row">
                            <th>شناسه</th>
                            <th>نام دوره</th>
                            <th>نام مدرس</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr role="row" class="">
                            <td><a href="">1</a></td>
                            <td><a href="">دوره لاراول</a></td>
                            <td><a href="">صیاد اعظمی</a></td>
                        </tr>
                        <tr role="row" class="">
                            <td><a href="">1</a></td>
                            <td><a href="">دوره لاراول</a></td>
                            <td><a href="">صیاد اعظمی</a></td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

@endsection
@section('js')
    <script src="/panel/js/toast-plugin.js"></script>


@endsection
