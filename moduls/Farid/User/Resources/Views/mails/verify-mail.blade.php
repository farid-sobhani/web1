@component('mail::message')
# کد فعال سازی شما در سیویل وب



@component('mail::panel')
{{$code}}
@endcomponent

باتشکر,<br>
{{ config('app.name') }}
@endcomponent
