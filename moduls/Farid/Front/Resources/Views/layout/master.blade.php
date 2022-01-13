<!doctype html>
<html lang="fa">
@include('Front::head')
<body >
@include('Front::header')
<form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
    @csrf
    <button type="submit">exit</button>
</form>

<main id="index">
    @yield('content')
</main>
<div class="toast">
    <div>
        <div class="toast__icon"></div>
        <div class="toast__message"></div>
        <div class="toast__close" onclick="toast__close()" ></div>
    </div>


</div>
@include('Front::footer')
<div id="Modal3">
    adasdasdasda
</div>
<div class="overlay"></div>
<script src="/js/jquery-3.4.1.min.js"></script>
<script src="/js/js.js"></script>
<script src="/js/countDownTimer.js"></script>
<script src="/js/modal.js"></script>

</body>
</html>
