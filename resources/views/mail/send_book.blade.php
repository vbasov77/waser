
Здравствуйте, {{ $send_mail ['name_user']}}!<br>
<br>
Вы записались на мойку автомобиля по адресу:<br>
{{$send_mail ['address']}}<br>
<br>
Дата: {{$send_mail ['date_book']}} <br>
Время: {{ $send_mail ['time_wash']}}<br>
<br>
Итого: {{$send_mail ['total_cost']}} руб<br>
<br>
Чтобы управлять своим бронированием, пройдите в <a href="{{request()->root()}}/my_orders">Мои заказы</a>
<br>
<br>
С уважением,<br>
администрация сайта {{config('app.name')}}!