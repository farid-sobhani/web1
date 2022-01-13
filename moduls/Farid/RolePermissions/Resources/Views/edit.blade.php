@extends('Dashboard::master')
@section('content')
    <div class="content">
        <div class="main-content padding-0 categories">
            <div class="row no-gutters  ">
<div class="col-4 bg-white">
    <p class="box__title">ویرایش نقش</p>
    <form action="{{route('update.role',$role->id)}}" method="post" class="padding-30">
        @csrf

        <input type="text" name="name" value="{{$role->name}}" required placeholder="نام نقش" class="text">
        @error('name')
        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
        @enderror
        @foreach($permissions as $permission)
            <label class="ui-checkbox">
                <p style="margin-right: 30px">@lang($permission->name)</p>
                <input type="checkbox" name="permissions[{{$permission->name}}]"  value="{{$permission->name}}"
                       @if($role->hasPermissionTo($permission->name))
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

        <button type="submit" class="btn btn-tot">بروزرسانی</button>

    </form>
</div>
            </div></div></div>
@endsection
