@extends('Front::layout.master')
@section('content')
    <main id="single">
        <div class="content">

            <div class="container">
                <article class="article">
                    <div class="ads mb-10">
                        <a href="" rel="nofollow noopener"><img src="img/ads/1440px/test.jpg" alt=""></a>
                    </div>
                    <div class="h-t">
                        <h1 class="title">{{$course->title}}</h1>
                        <div class="breadcrumb">
                            <ul>
                                <li><a href="" title="خانه">خانه</a></li>
                                <li><a href="" title="برنامه نویسی">برنامه نویسی</a></li>
                                <li><a href="" title="وب">وب</a></li>
                            </ul>
                        </div>
                    </div>

                </article>
            </div>


            <div class="main-row container">
                <div class="sidebar-right">
                    <div class="sidebar-sticky">
                        <div class="product-info-box">
                            <div class="discountBadge d-none">
                                <p>45%</p>
                                تخفیف
                            </div>
                            <div class="sell_course d-none">
                                <strong>قیمت :</strong>
                                <del class="discount-Price">900,000</del>
                                <p class="price">
                        <span class="woocommerce-Price-amount amount">495,000
                            <span class="woocommerce-Price-currencySymbol">تومان</span>
                        </span>
                                </p>
                            </div>
                            @auth()

                                @if(auth()->user()->id == $course->teacher->id || auth()->user()->hasPermissionTo(\Farid\RolePermissions\Models\Permission::PERMISSION_MANAGE_COURSES))
                                    <p class="mycourse ">شما مدرس این دوره هستید</p>
                                @endif

                                @if(!empty($register))
                                    <p class="mycourse">شما این دوره رو خریداری کرده اید</p>
                                @elseif(!$register)
                                    <button class="btn buy btn-buy">خرید دوره</button>
                                @endif
                            @endauth
                            @guest()
                                <p class="mycourse">برای شرکت در دوره ابتدا باید وارد شوید</p>
                            @endguest
                            <div class="average-rating-sidebar">
                                <div class="rating-stars">
                                    <div class="slider-rating">
                                        <span class="slider-rating-span slider-rating-span-100" data-value="100%"
                                              data-title="خیلی خوب"></span>
                                        <span class="slider-rating-span slider-rating-span-80" data-value="80%"
                                              data-title="خوب"></span>
                                        <span class="slider-rating-span slider-rating-span-60" data-value="60%"
                                              data-title="معمولی"></span>
                                        <span class="slider-rating-span slider-rating-span-40" data-value="40%"
                                              data-title="بد"></span>
                                        <span class="slider-rating-span slider-rating-span-20" data-value="20%"
                                              data-title="خیلی بد"></span>
                                        <div class="star-fill"></div>
                                    </div>
                                </div>

                                <div class="average-rating-number">
                                    <span class="title-rate title-rate1">امتیاز</span>
                                    <div class="schema-stars">
                                        <span class="value-rate text-message"> 4 </span>
                                        <span class="title-rate">از</span>
                                        <span class="value-rate"> 555 </span>
                                        <span class="title-rate">رأی</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="product-info-box">
                            <div class="product-meta-info-list">
                                <div class="total_sales">
                                    تعداد دانشجو : <span>{{$course->student_count}}</span>
                                </div>
                                <div class="meta-info-unit one">
                                    <span class="title">تعداد جلسات منتشر شده :  </span>
                                    <span class="vlaue">{{$course->lessons_count}}</span>
                                </div>
                                <div class="meta-info-unit two">
                                    <span class="title">مدت زمان دوره تا الان : </span>
                                    <span class="vlaue">{{$course->getDuration()}}</span>
                                </div>
                                <div class="meta-info-unit three">
                                    <span class="title">مدت زمان کل دوره : </span>
                                    <span class="vlaue">-</span>
                                </div>
                                <div class="meta-info-unit four">
                                    <span class="title">مدرس دوره : </span>
                                    <span class="vlaue">{{$course->teacher->name}}</span>
                                </div>
                                <div class="meta-info-unit five">
                                    <span class="title">وضعیت دوره : </span>
                                    <span class="vlaue">{{$course->status}}</span>
                                </div>

                            </div>
                        </div>
                        <div class="course-teacher-details">
                            <div class="top-part">
                                <a href="">
                                    <img alt="محمد نیکو"
                                         class="img-fluid lazyloaded"
                                         src="
                                       @if(is_object($course->teacher->image))
                                         {{$course->teacher->image->thumb}}
                                         @else /panel/img/pro.jpg
                                    @endif" loading="lazy">
                                    <noscript>
                                        <img class="img-fluid" src="img/profile.jpg" alt="محمد نیکو"></noscript>
                                </a>
                                <div class="name">
                                    <a href="" class="btn-link">
                                        <h6>{{$course->teacher->name}}</h6>
                                    </a>
                                    <span class="job-title">{{$course->teacher->headline}}</span>
                                </div>
                            </div>
                            <div class="job-content">
                                <!--                        <p>عاشق برنامه نویسی</p>-->
                            </div>
                        </div>
                        <div class="short-link">
                            <div class="">
                                <span>لینک کوتاه</span>
                                <input class="short--link" value="">
                                <a href="" class="short-link-a" data-link=""></a>
                            </div>
                        </div>


                    </div>
                </div>
                <div class="content-left">
                    <div class="preview">
                        <video width="100%" controls>
                            <source src="" type="video/mp4">
                        </video>
                    </div>
                    @guest()
                    <a href="{{route('login')}}" class="episode-download">
                        برای دانلود جلسات ابتدا در سایت ثبت نام کنید یا با اکانت خود وارد شوید
                        </a>
                    @endguest
                    <div class="course-description">
                        <div class="course-description-title">توضیحات دوره</div>
                        <p>
                            {{$course->body}}
                        </p>

                        <div class="tags">
                            <ul>
                                <li><a href="">ری اکت</a></li>
                                <li><a href="">reactjs</a></li>
                                <li><a href="">جاوااسکریپت</a></li>
                                <li><a href="">javascript</a></li>
                                <li><a href="">reactjs چیست</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="episodes-list">
                        <div class="episodes-list--title">فهرست جلسات</div>
                        <div class="episodes-list-section">
                            @foreach($lesson as $item)
                                <div class="episodes-list-item
                            @if($item->free == 0 && (!$register ||
                            is_null(auth()->user())
                            )) lock @endif">
                                    <div class="section-right">
                                        <span class="episodes-list-number">{{$item->number}}</span>
                                        <div class="episodes-list-title">
                                            {{$item->title}}
                                        </div>
                                    </div>
                                    <div class="section-left">
                                        <div class="episodes-list-details">
                                            <div class="episodes-list-details">
                                            <span class="detail-type">
                                                @if($item->free)رایگان
                                                @else
                                                    نقدی
                                                @endif

                                            </span>
                                                <span class="detail-time">
                                                {{$item->getDuration()}}</span>
                                                @auth()

                                                <a class="detail-download"
                                                   href="{{route('lessons.download',$item->media_id)}}">
                                                    <i class="icon-download"></i>
                                                </a>
                                                @endauth
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach


                        </div>
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="comments">
                    <div class="comment-main">
                        <div class="ct-header">
                            <h3>نظرات ( 180 )</h3>
                            <p>نظر خود را در مورد این مقاله مطرح کنید</p>
                        </div>
                        <form action="" method="post">
                            <div class="ct-row">
                                <div class="ct-textarea">
                                    <textarea class="txt ct-textarea-field"></textarea>
                                </div>
                            </div>
                            <div class="ct-row">
                                <div class="send-comment">
                                    <button class="btn i-t">ثبت نظر</button>
                                </div>
                            </div>

                        </form>
                    </div>

                    <div class="comments-list">
                        <div id="Modal2" class="modal">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <p>ارسال پاسخ</p>
                                    <div class="close">&times;</div>
                                </div>
                                <div class="modal-body">
                                    <form method="post" action="">
                                        <textarea class="txt hi-220px" placeholder="متن دیدگاه"></textarea>
                                        <button class="btn i-t">ثبت پاسخ</button>
                                    </form>
                                </div>

                            </div>
                        </div>
                        <ul class="comment-list-ul">
                            <div class="div-btn-answer">
                                <button class="btn-answer">پاسخ به دیدگاه</button>
                            </div>
                            <li class="is-comment">
                                <div class="comment-header">
                                    <div class="comment-header-avatar">
                                        <img src="img/profile.jpg">
                                    </div>
                                    <div class="comment-header-detail">
                                        <div class="comment-header-name">کاربر : گوگل گوگل گوگل گوگل</div>
                                        <div class="comment-header-date">10 روز پیش</div>
                                    </div>
                                </div>
                                <div class="comment-content">
                                    <p>
                                        لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان
                                        گرافیک است. چاپگرها و متون بلکه روزنامه و مجله در ستون و سطرآنچنان که لازم است و
                                        برای شرایط فعلی تکنولوژی مورد نیاز و کاربردهای متنوع با هدف بهبود ابزارهای
                                        کاربردی می باشد.
                                    </p>
                                </div>
                            </li>
                            <li class="is-answer">
                                <div class="comment-header">
                                    <div class="comment-header-avatar">
                                        <img src="img/laravel-pic.png">
                                    </div>
                                    <div class="comment-header-detail">
                                        <div class="comment-header-name">مدیر سایت : محمد نیکو</div>
                                        <div class="comment-header-date">10 روز پیش</div>
                                    </div>
                                </div>
                                <div class="comment-content">
                                    <p>
                                        لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان
                                        گرافیک است. چاپگرها و متون بلکه روزنامه و مجله در ستون و سطرآنچنان که لازم است و
                                        برای شرایط فعلی تکنولوژی مورد نیاز و کاربردهای متنوع با هدف بهبود ابزارهای
                                        کاربردی می باشد.
                                        لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان
                                        گرافیک است. چاپگرها و متون بلکه روزنامه و مجله در ستون و سطرآنچنان که لازم است و
                                        برای شرایط فعلی تکنولوژی مورد نیاز و کاربردهای متنوع با هدف بهبود ابزارهای
                                        کاربردی می باشد.
                                    </p>
                                </div>
                            </li>
                            <li class="is-comment">
                                <div class="comment-header">
                                    <div class="comment-header-avatar">
                                        <img src="img/profile.jpg">
                                    </div>
                                    <div class="comment-header-detail">
                                        <div class="comment-header-name">کاربر : گوگل</div>
                                        <div class="comment-header-date">10 روز پیش</div>
                                    </div>
                                </div>
                                <div class="comment-content">
                                    <p>
                                        لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان
                                        گرافیک است. چاپگرها و متون بلکه روزنامه و مجله در ستون و سطرآنچنان که لازم است و
                                        برای شرایط فعلی تکنولوژی مورد نیاز و کاربردهای متنوع با هدف بهبود ابزارهای
                                        کاربردی می باشد.
                                    </p>
                                </div>
                            </li>

                        </ul>
                        <ul class="comment-list-ul">
                            <div class="div-btn-answer">
                                <button class="btn-answer">پاسخ به دیدگاه</button>
                            </div>
                            <li class="is-comment">
                                <div class="comment-header">
                                    <div class="comment-header-avatar">
                                        <img src="img/profile.jpg">
                                    </div>
                                    <div class="comment-header-detail">
                                        <div class="comment-header-name">کاربر : گوگل</div>
                                        <div class="comment-header-date">10 روز پیش</div>
                                    </div>
                                </div>
                                <div class="comment-content">
                                    <p>
                                        لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان
                                        گرافیک است. چاپگرها و متون بلکه روزنامه و مجله در ستون و سطرآنچنان که لازم است و
                                        برای شرایط فعلی تکنولوژی مورد نیاز و کاربردهای متنوع با هدف بهبود ابزارهای
                                        کاربردی می باشد.
                                    </p>
                                </div>
                            </li>
                            <li class="is-answer">
                                <div class="comment-header">
                                    <div class="comment-header-avatar">
                                        <img src="img/laravel-pic.png">
                                    </div>
                                    <div class="comment-header-detail">
                                        <div class="comment-header-name">مدیر سایت : محمد نیکو</div>
                                        <div class="comment-header-date">10 روز پیش</div>
                                    </div>
                                </div>
                                <div class="comment-content">
                                    <p>
                                        لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان
                                        گرافیک است. چاپگرها و متون بلکه روزنامه و مجله در ستون و سطرآنچنان که لازم است و
                                        برای شرایط فعلی تکنولوژی مورد نیاز و کاربردهای متنوع با هدف بهبود ابزارهای
                                        کاربردی می باشد.
                                        لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان
                                        گرافیک است. چاپگرها و متون بلکه روزنامه و مجله در ستون و سطرآنچنان که لازم است و
                                        برای شرایط فعلی تکنولوژی مورد نیاز و کاربردهای متنوع با هدف بهبود ابزارهای
                                        کاربردی می باشد.
                                    </p>
                                </div>
                            </li>

                        </ul>


                    </div>
                </div>
            </div>

        </div>
    </main>
    <div id="Modal3" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <p>کد تخفیف را وارد کنید</p>
                <div class="close">&times;</div>
            </div>
            <div class="modal-body">
                <form method="post" action="{{ route("courses.buy", $course->id) }}">
                    @csrf
                    <div><input type="text" class="txt" placeholder="کد تخفیف را وارد کنید"></div>
                    <button class="btn i-t ">اعمال</button>

                    <table class="table text-center table-bordered table-striped" style="color: black">
                        <tbody>
                        <tr>
                            <th>قیمت کل دوره</th>
                            <td> {{$course->price}} تومان</td>
                        </tr>
                        <tr>
                            <th>درصد تخفیف</th>
                            <td>{{$course->percent}} %</td>
                        </tr>
                        <tr>
                            <th> مبلغ تخفیف</th>
                            <td class="text-red">  {{$fp = round($course->price * ($course->percent/100))}} تومان</td>
                        </tr>
                        <tr>
                            <th> قابل پرداخت</th>
                            <td class="text-blue"> {{$course->price - $fp}} تومان</td>
                        </tr>
                        </tbody>
                    </table>
                    <button type="submit" class="btn btn i-t ">پرداخت آنلاین</button>
                </form>
            </div>

        </div>
    </div>

    <div class="overlay"></div>
@endsection

