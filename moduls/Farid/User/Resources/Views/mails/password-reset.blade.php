@component('mail::message')
# کد بازیابی رمزعبور شما در سیویل وب



@component('mail::panel')
{{$code}}
@endcomponent

باتشکر,<br>
{{ config('app.name') }}
@endcomponent
