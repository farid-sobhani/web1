@extends('Dashboard::master')

@section('css')
    <link rel="stylesheet" href="/panel/css/toast-plugin.css">
@endsection
@section('content')


    <div class="breadcrumb">
        <ul>
            <li><a href="/home" title="پیشخوان">پیشخوان</a></li>
            <li><a href="{{route('category.index')}}" title="دسته بندی ها">دسته بندی ها</a></li>

        </ul>
    </div>
    <div class="main-content font-size-13 col-12" >
    <div class="tab__box">
        <div class="tab__items">
            <a class="tab__item is-active" href="users.html">همه کاربران</a>
            <a class="tab__item" href="">مدیران</a>
            <a class="tab__item" href="">مدرسین</a>
            <a class="tab__item" href="">نویسنده</a>
            <a class="tab__item" href="">کاربران تاییده نشده</a>
            <a class="tab__item" href="">کاربران تایید شده</a>
            <a class="tab__item" href="create-user.html">ایجاد کاربر جدید</a>
        </div>
    </div>
    <div class="d-flex flex-space-between item-center flex-wrap padding-30 border-radius-3 bg-white">
        <div class="t-header-search">
            <form action="{{route('user.search')}}"  method="post">
                @csrf
                <div class="t-header-searchbox font-size-13">
                    <input type="text" class="text search-input__box font-size-13" placeholder="جستجوی کاربر">
                    <div class="t-header-search-content ">
                        <input type="text" name="email"  class="text"  placeholder="ایمیل">
                        <input type="text" name="mobile"  class="text" placeholder="شماره">

                        <input type="text" name="name"  class="text margin-bottom-20" placeholder="نام و نام خانوادگی">
                        <button type="submit" class="btn btn-tot">جستجو</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="table__box">
        <table class="table">
            <thead role="rowgroup">
            <tr role="row" class="title-row">
                <th>شناسه</th>
                <th>نام و نام خانوادگی</th>
                <th>ایمیل</th>
                <th>شماره موبایل</th>
                <th>سطح کاربری</th>
                <th>تاریخ عضویت</th>
                <th>ای پی</th>
                <th>درحال یادگیری</th>
                <th>وضعیت حساب</th>
                <th>عملیات</th>
            </tr>
            </thead>
            <tbody>
            @foreach($users as $user)
            <tr role="row" class="">
                <td>{{$user->id}}</td>
                <td>{{$user->name}}</td>
                <td>{{$user->email}}</td>
                <td>{{$user->mobile}}</td>
                <td>{{$user->roles->pluck('name')}}</td>
                <td>{{$user->email_verified_at}}</td>
                <td>{{$user->ip}}</td>
                <td>5 دوره</td>
                <td class="text-success" id="{{$user->id}}"
                @if($user->status == "banned" || $user->status == "inactive" )
                style="color: red !important;"
                @endif">{{$user->status}}</td>
                <td>
                    <a href="" onclick="event.preventDefault();deleteItem(event , '{{route('user.destroy',$user->id)}}')" class="item-delete mlg-15" title="حذف"></a>
                    <a href="" onclick="event.preventDefault();activate('{{route('user.changeStatus',[$user->id ,'active'])}}',{{$user->id}} , 'active')" class="item-confirm mlg-15" title="تایید"></a>
                    <a href="" onclick="event.preventDefault();activate('{{route('user.changeStatus',[$user->id,'banned'])}}',{{$user->id}} , 'banned')" class="item-reject mlg-15" title="مسدود کردن"></a>
                    <a href="{{route('user.edit' , $user->id)}}" class="item-edit " title="ویرایش"></a>
                </td>
            </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>

@endsection
@section('js')
<script src="/panel/js/toast-plugin.js"></script>


@endsection
