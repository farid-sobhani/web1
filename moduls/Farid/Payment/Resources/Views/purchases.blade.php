@extends('Dashboard::master')
@section('content')
    <div class="table__box">
        <table class="table">
            <thead>
            <tr class="title-row">
                <th>عنوان دوره</th>
                <th>تاریخ پرداخت</th>
                <th>مقدار پرداختی</th>
                <th>وضعیت پرداخت</th>
            </tr>
            </thead>
            <tbody>
            @foreach($payments as $payment)
            <tr>
                <td>{{ $payment->course->title }}</td>
                <td>{{ $payment->created_at }}</td>
                <td>{{ number_format($payment->amount) }} تومان</td>
                <td class="{{ $payment->status == \Farid\Payment\Models\Payment::STATUS_SUCCESS  ? "text-success" :"text-error" }}">@lang($payment->status)</td>
            </tr>
            @endforeach
            </tbody>
        </table>


    </div>
@endsection
