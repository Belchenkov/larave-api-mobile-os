@component('mail::message')
# Мобильное приложение сотрудника ГК Основа

***
{{ $comment }}
***

Заявка сформирована с помощью Мобильного приложения сотрудника ГК Основа<br>

Пользователем: {{$fio}}<br>

Должность: {{$position_name}}<br>

тел. {{$phone_work}}

Мобильный  {{$phone_mobile}}
@endcomponent