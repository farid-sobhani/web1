@extends('Front::layout.master')
@section('content')
    <article class="container article">
        @include('Front::ads')
        @include('Front::slider')
        @include('Front::newCourses')
        @include('Front::popularCourses')


    </article>
    @include('Front::latestArticles')

@endsection
