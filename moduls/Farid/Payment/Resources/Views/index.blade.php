@extends('Dashboard::master')
@section('breadcrumb')
    <li><a href="{{ route('courses.index') }}" title="دوره ها">دوره ها</a></li>
    <li><a href="#" title="ویرایش دوره">ویرایش دوره</a></li>
@endsection
@section('content')
    <div class="main-content font-size-13">
        <div class="row no-gutters  margin-bottom-10">
            <div class="col-3 padding-20 border-radius-3 bg-white margin-left-10 margin-bottom-10">
                <p>کل فروش ۳۰ روز گذشته  سایت </p>
                <p>{{number_format($totalSalesOf30LastDays)}} تومان</p>
            </div>
            <div class="col-3 padding-20 border-radius-3 bg-white margin-left-10 margin-bottom-10">
                <p>درامد خالص ۳۰ روز گذشته سایت</p>
                <p>{{number_format($totalSiteNetIncome)}} تومان</p>
            </div>
            <div class="col-3 padding-20 border-radius-3 bg-white margin-left-10 margin-bottom-10">
                <p>کل فروش سایت</p>
                <p>{{number_format($totalSale)}} تومان</p>
            </div>
            <div class="col-3 padding-20 border-radius-3 bg-white margin-bottom-10">
                <p> کل درآمد خالص سایت</p>
                <p>{{number_format($totalNetIncome)}} تومان</p>
            </div>
        </div>
        <div class="row no-gutters border-radius-3 font-size-13">
            <div class="col-12 bg-white padding-30 margin-bottom-20">

                    <div id="container"></div>

            </div>

        </div>
        <div class="d-flex flex-space-between item-center flex-wrap padding-30 border-radius-3 bg-white">
            <p class="margin-bottom-15">همه تراکنش ها</p>
            <div class="t-header-search">
                <form action="{{route('payments.index')}}" >
                    <div class="t-header-searchbox font-size-13">
                        <input type="text" class="text search-input__box font-size-13" placeholder="جستجوی تراکنش">
                        <div class="t-header-search-content ">
                            <input type="text" name="email"  class="text"  placeholder="ایمیل">
                            <input type="text" name="price"  class="text"  placeholder="مبلغ به تومان">
                            <input type="text" name="invoice_id"  class="text" placeholder="شماره">
                            <input type="text" name=""  class="text" placeholder="از تاریخ : 1399/10/11">
                            <input type="text" name="" class="text margin-bottom-20"  placeholder="تا تاریخ : 1399/10/12">
                            <button type="submit" class="btn btn-tot">جستجو</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="table__box">
            <table width="100%" class="table">
                <thead role="rowgroup">
                <tr role="row" class="title-row">
                    <th>شناسه پرداخت</th>
                    <th>نام و نام خانوادگی</th>
                    <th>ایمیل پرداخت کننده</th>
                    <th>مبلغ (تومان)</th>
                    <th>درامد شما</th>
                    <th>درامد سایت</th>
                    <th>نام دوره</th>
                    <th>تاریخ و ساعت</th>
                    <th>وضعیت</th>
                </tr>
                </thead>
                <tbody>
                @foreach($payments as $item)
                <tr role="row">
                    <td><p> {{$item->id}}</p></td>
                    <td><p>{{$item->buyer->name}}</p></td>
                    <td><p>{{$item->buyer->email}}</p></td>
                    <td><p>{{$item->amount}}</p></td>
                    <td><p>{{$item->seller_share}}</p></td>
                    <td><p>{{$item->site_share}}</p></td>
                    <td><p>{{$item->course->title}}</p></td>
                    <td><p>{{$item->created_at}}</p></td>
                    <td><p class="@if($item->status == 'success') text-success @else text-error @endif ">@lang($item->status)</p></td>

                </tr>
                @endforeach


                </tbody>
            </table>
        </div>
    </div>
@endsection
@section('js')
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/modules/series-label.js"></script>
    <script src="https://code.highcharts.com/modules/exporting.js"></script>
    <script src="https://code.highcharts.com/modules/export-data.js"></script>
    <script src="https://code.highcharts.com/modules/accessibility.js"></script>
    <script>
        Highcharts.chart('container', {
            title: {
                text: 'نمودار فروش 30 روز گذشته'
            },
            tooltip: {
                useHTML: true,
                style: {
                    fontSize: '14px',
                    fontFamily: 'tahoma',
                    direction: 'rtl',
                },
                formatter: function () {
                    return (this.x ? "تاریخ: " +  this.x + "<br>" : "")  + "مبلغ: " + this.y
                }
            },
            xAxis: {
                categories: [
                @foreach ($last30days->keys() as $item)
                    '{{$item}}',
                @endforeach
                ]
            },
            labels: {
                items: [{

                    style: {
                        left: '50px',
                        top: '18px',
                        color: ( // theme
                            Highcharts.defaultOptions.title.style &&
                            Highcharts.defaultOptions.title.style.color
                        ) || 'black'
                    }
                }]
            },
            series: [{
                type: 'column',
                name: 'کل',
                data: [
                    @foreach($last30days as $item)
                    {{$item['total']}},
                    @endforeach
                ],
            },{
                type: 'column',
                name: 'سهم شما',
                data: [
                    @foreach($last30days as $item)
                    {{$item['site_share']}},
                    @endforeach
                ]
            },{
                type: 'column',
                name: 'سهم سایت',
                data: [
                    @foreach($last30days as $item)
                    {{$item['seller_share']}},
                    @endforeach
                ]
            },
                {
                    type: 'spline',
                    name: 'کل فروش',
                    data: [
                        @foreach($last30days as $item)
                        {{$item['total']}},
                        @endforeach
                    ],
                    marker: {
                        lineWidth: 2,
                        lineColor: Highcharts.getOptions().colors[3],
                        fillColor: 'white'
                    }
                }]
        });
    </script>
@endsection
@section('css')
    <link rel="stylesheet" href="/panel/css/highcharts.css">
@endsection

