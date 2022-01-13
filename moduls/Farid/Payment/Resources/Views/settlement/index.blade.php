@extends('Dashboard::master')
@section('content')
    <div class="main-content">
        <div class="tab__box">
            <div class="tab__items">
                <a class="tab__item is-active" href="checkouts.html"> همه تسویه ها</a>
                <a class="tab__item " href="checkouts.html">تسویه های جدید</a>
                <a class="tab__item " href="checkouts.html">تسویه های واریز شده</a>
                <a class="tab__item " href="checkout-request.html">درخواست تسویه جدید</a>
            </div>
        </div>
        <div class="bg-white padding-20">
            <div class="t-header-search">
                <form action="" onclick="event.preventDefault();">
                    <div class="t-header-searchbox font-size-13">
                        <input type="text" class="text search-input__box font-size-13"
                               placeholder="جستجوی در تسویه حساب ها">
                        <div class="t-header-search-content ">
                            <input type="text" class="text" placeholder="شماره کارت">
                            <input type="text" class="text" placeholder="شماره">
                            <input type="text" class="text" placeholder="تاریخ">
                            <input type="text" class="text" placeholder="ایمیل">
                            <input type="text" class="text margin-bottom-20" placeholder="نام و نام خانوادگی">
                            <btutton class="btn btn-tot">جستجو</btutton>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <div class="table__box">
            <table class="table">
                <thead role="rowgroup">
                <tr role="row" class="title-row">
                    <th>شناسه تسویه</th>
                    <th>تاریخ درخواست واریز</th>
                    <th>تاریخ واریز شده</th>
                    <th>مبلغ (تومان )</th>
                    <th>وضعیت</th>
                    <th>عملیات</th>
                </tr>
                </thead>
                <tbody>
                @foreach($allSettlements as $item)
                <tr role="row">
                    <td><a href="">{{$item->transaction_id? $item->transaction_id : '-' }}</a></td>
                    <td><a href="">{{$item->created_at}}</a></td>
                    <td><a href="">{{$item->settled_at? $item->settled_at : '-' }}</a></td>
                    <td><a href="">{{$item->amount}}</a></td>
                    <td><a href="" class="@if($item->status == 'settled')text-success
                                          @elseif($item->status == 'pending')text-warning
                                          @else text-error @endif">{{$item->status  }}</a></td>
                    <td>
                        <a href="" class="item-delete mlg-15" title="حذف"></a>
                        <a href="show-comment.html"  class="item-reject mlg-15" title="رد"></a>
                        <a onclick="event.preventDefault();settlementControll({{$item->id}},'accept')"  class="item-confirm mlg-15" title="تایید">
{{--                            todo transaction_id--}}
                        </a>
                        <a href="edit-comment.html" class="item-edit " title="ویرایش"></a>
                    </td>
                </tr>

                @endforeach

                </tbody>
            </table>
        </div>
    </div>

@endsection
@section('js')
<script>

</script>
@endsection
