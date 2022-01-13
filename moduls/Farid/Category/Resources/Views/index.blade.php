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
<div class="content">
    <div class="main-content padding-0 categories">
        <div class="row no-gutters  ">
            <div class="col-8 margin-left-10 margin-bottom-15 border-radius-3">
                <p class="box__title">دسته بندی ها</p>
                <div class="table__box">
                    <table class="table">
                        <thead role="rowgroup">
                        <tr role="row" class="title-row">
                            <th>شناسه</th>
                            <th>نام دسته بندی</th>
                            <th>نام انگلیسی دسته بندی</th>
                            <th>دسته پدر</th>
                            <th>عملیات</th>
                        </tr>
                        </thead>
                        <tbody>

                        @foreach($categories as $category)
                        <tr role="row" class="">
                            <td><a href="">{{$category->id}}</a></td>
                            <td><a href="">{{$category->title}}</a></td>
                            <td>{{$category->slug}}</td>
                            <td>{{$category->parent}}</td>
                            <td>
                                <a href="" class="item-delete mlg-15" onclick="event.preventDefault();deleteItem(event,'{{route('category.destroy',$category->id)}}' )" title="حذف"></a>
                                <a href="" target="_blank" class="item-eye mlg-15" title="مشاهده"></a>
                                <a href="{{route('category.edit',$category->id)}}" class="item-edit " title="ویرایش"></a>
                            </td>
                        </tr>
                        @endforeach


                        </tbody>
                    </table>
                </div>
            </div>
            <div class="col-4 bg-white">
                <p class="box__title">ایجاد دسته بندی جدید</p>
                <form action="{{route('category.store')}}" method="post" class="padding-30">
                    @csrf
                    <input type="text" name="title" required placeholder="نام دسته بندی" class="text">
                    <input type="text" name="slug" required placeholder="نام انگلیسی دسته بندی" class="text">
                    <p class="box__title margin-bottom-15">انتخاب دسته پدر</p>
                    <select name="parent_id" id="parent_id">
                        <option value="">ندارد</option>
                        @foreach($categories as $category)
                        <option value="{{$category->id}}">{{$category->title}}</option>
                        @endforeach
                    </select>
                    <button class="btn">اضافه کردن</button>

                </form>
            </div>
        </div>
    </div>
</div>
@endsection
@section('js')
<script src="/panel/js/toast-plugin.js"></script>


@endsection
