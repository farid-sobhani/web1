<div class="box-filter">
    <div class="b-head">
        <h2>جدید ترین دوره ها</h2>
        <a href="all-courses.html">مشاهده همه</a>
    </div>
    <div class="posts">
        @foreach($latestCourses as $course)
        <div class="col">
            <a href="{{route('courses.show',$course->id)}}">
                <div class="course-status">
                    تکمیل شده
                </div>
                <div class="discountBadge">
                    <p>45%</p>
                    تخفیف
                </div>
                <div class="card-img"><img src="img/banner/reactjs.png" alt="reactjs"></div>
                <div class="card-title"><h2>{{$course->title}}</h2></div>
                <div class="card-body">
                    <img src="@if(is_object($course->teacher->image))
                    {{$course->teacher->image->thumb}}
                    @else /panel/img/pro.jpg
            @endif" alt="{{$course->teacher->name}}">
                    <span>{{$course->teacher->name}}</span>
                </div>
                <div class="card-details">
                    <div class="time">{{$course->getDuration()}}</div>
                    <div class="price">
                        <div class="discountPrice">{{$course->price}}</div>
                        <div class="endPrice">{{$course->price}}</div>
                    </div>
                </div>
            </a>
        </div>
        @endforeach
    </div>
</div>
