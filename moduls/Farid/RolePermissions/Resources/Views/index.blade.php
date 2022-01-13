@extends('Dashboard::master')

@section('css')
    <link rel="stylesheet" href="/panel/css/toast-plugin.css">
@endsection
@section('content')
    <div class="breadcrumb">
        <ul>
            <li><a href="/home" title="پیشخوان">پیشخوان</a></li>
            <li><a href="{{route('role-permissions.index')}}" title="نقش های کاربری">نقش های کاربری</a></li>

        </ul>
    </div>
    <div class="content">
        <div class="main-content col-12 padding-0 categories">
            <div class="row no-gutters  ">
                <div class="col-8 margin-left-10 margin-bottom-15 border-radius-3">
                    <p class="box__title">دسته بندی ها</p>
                    <div class="table__box">
                        <table class="table">
                            <thead role="rowgroup">
                            <tr role="row" class="title-row">
                                <th>شناسه</th>
                                <th>نقش کاربری</th>
                                <th>مجوزها</th>

                                <th>عملیات</th>
                            </tr>
                            </thead>
                            <tbody>

                            @foreach($roles as $role)
                                <tr role="row" class="">
                                    <td><a href="">{{$role->id}}</a></td>
                                    <td><a href="">{{$role->name}}</a></td>

                                    <td>
                                        <ul>
                                            @foreach($role->permissions as $permission)
                                            <li>@lang($permission->name)</li>
                                            @endforeach
                                        </ul>
                                    </td>
                                    <td>
                                        <a href="" class="item-delete mlg-15" onclick="event.preventDefault();deleteItem(event,'{{route('role-permissions.destroy',$role->id)}}' )" title="حذف"></a>
                                        <a href="" target="_blank" class="item-eye mlg-15" title="مشاهده"></a>
                                        <a href="{{route('role-permissions.edit',$role->id)}}" class="item-edit " title="ویرایش"></a>
                                    </td>
                                </tr>
                            @endforeach


                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="col-4 bg-white">
                    <p class="box__title">ایجاد نقش جدید</p>
                    <form action="{{route('role-permissions.store')}}" method="post" class="padding-30">
                        @csrf
                        <input type="text" name="name" required placeholder="عنوان" class="text" value="{{old('name')}}">
                        @error('name')
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror
                        @foreach($permissions as $permission)
                        <label class="ui-checkbox">
                            <p style="margin-right: 30px">@lang($permission->name)</p>
                            <input type="checkbox" name="permissions[{{$permission->name}}]"  value="{{$permission->name}}"
                            @if(is_array(old('permissions')) && array_key_exists($permission->name,old('permissions')))
                                checked
                                @endif
                            >
                            <span class="checkmark"></span>
                        </label>
                        @endforeach
                        <br>
                        @error('permissions')
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror
                        <br>
                        <hr>
                        <button class="btn btn-tot">اضافه کردن</button>

                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

