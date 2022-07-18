@extends('layouts.app')
@section('content')
    <style>
        .ur {
            -webkit-user-select: none;
        }

        .border_none input[type="text"] {
            border: none;
        }
    </style>

    <section class="about-section text-center">
        <div class="container px-4 px-lg-5">
            <div class="row gx-4 gx-lg-5 justify-content-center">
                <div class="col-lg-8">
                    @if(!empty($error))
                        <div style="background-color:  red; text-align: center; color: white; padding: 15px">{{ $error }}</div>
                    @endif
                    <form action="/booking" class="form js-form-validate" method="post">
                        @csrf
                        <input type="hidden" name="obj_id" value="{{$obj_id ?? ''}}">
                        <input type="hidden" name="time_client" value="{{$time_client}}">
                        <input type="hidden" name="more_obj" value="{{$more_obj}}">
                        <input type="hidden" name="cost" value="{{$cost}}">

                        <div class="border_none">
                            <label for="date"><b>Дата:</b></label>
                            <input value="{{$_POST['el']}}" readonly="readonly" type="text" name="el"
                                   method="post"><br>
                        </div>

                        <input value="{{$class_auto }}" readonly="readonly" type="hidden" name="class_auto"
                               method="post"><br>


                        <input value="{{$class_wash}}" readonly="readonly" type="hidden" name="class_wash"
                               method="post"><br>

                        <div class="text-calendar">
                            <b>Дата: {{$_POST['el'] }}</b>
                        </div>
                        <div class="text-calendar">
                            <b>Время мойки: {{ gmdate('H:i',  $time_client * 60)}}</b><br>
                        </div>
                        <div class="text-calendar">
                            <b>Класс авто: {{$class_auto }}</b>
                        </div>
                        <div class="text-calendar">
                            <b>Тип мойки: {{ $class_wash}}</b><br><br>
                        </div>
                        <div class="text-calendar">
                            <b>Сумма: {{ $cost }} руб</b><br><br>
                        </div>

                        <h3> Выберете время </h3>
                        <div>
                            <input type="text" id="datetimepicker" name="timepicker" class="form-control">
                        </div>
                        <br>
                        <br>

                        @if (!empty($profile))
                            <h3> Проверьте данные </h3>
                            <div>
                                <label for="date"><b>Имя:</b></label><br>
                                <input type="text" name="name" placeholder="Иван Иванович Иванов" class="form-control"
                                       method="post"
                                       value="{{ Auth::user()->name }}" readonly><br><br>
                            </div>
                            <div>
                                <label for="date"><b>Телефон:</b></label><br>
                                <input type="tel" placeholder="+7 (000) 000-0000" name="phone" method="post"
                                       class="tel form-control"
                                       value="{{$profile['phone_user']}}" readonly><br>
                            </div>
                            <br>

                            <div>
                                <label for="date"><b>Email</b></label><br>
                                <input TYPE="email" placeholder="Email" name="email_user" method="post"
                                       class="form-control"
                                       value="{{$profile['email']}}" readonly><br>
                            </div>
                            <div>
                                <label for="auto"><b>Номер авто</b></label><br>
                                <input TYPE="text" placeholder="А111AA178" name="auto_user" method="post"
                                       class="form-control"
                                       value="{{$profile['auto_user']}}" readonly><br>
                            </div>
                        @else
                            <h3> Заполните форму </h3>
                            <div>
                                <label for="date"><b>Имя:</b></label><br>
                                <input type="text" name="name" placeholder="Иван Иванович Иванов" class="form-control"
                                       method="post" autocomplete="off"
                                       value="{{$_POST ['name'] ?? ''}}" required><br><br>
                            </div>

                            <div>
                                <label for="date"><b>Телефон:</b></label><br>
                                <input type="tel" placeholder="+7 (000) 000-0000" name="phone" method="post"
                                       class="tel form-control" autocomplete="off"
                                       value="{{ $_POST ['phone'] ?? ''}}" required><br>
                            </div>
                            <div>
                                <label for="date"><b>Email</b></label><br>
                                <input TYPE="email" placeholder="Email" name="email_user" method="post"
                                       class="form-control" autocomplete="off"
                                       value="{{ $_POST ['email_user'] ?? ''}}" required><br>
                            </div>
                            <div>
                                <label for="auto"><b>Номер авто</b></label><br>
                                <input type="text" placeholder="А777AA" name="auto_user" method="post"
                                       class="form-control" id="gosnomer"
                                       value="{{ $_POST ['auto_user'] ?? ''}}" style="text-transform:uppercase"
                                       autocomplete="off" required><br>
                            </div>
                        @endif
                        <br>
                        <br>
                        <input class="btn btn-outline-primary" type="submit" value="Продолжить">
                    </form>
                </div>

            </div>
        </div>
    </section>
    @push('scripts')
        <script>
            var array = @json($time);
        </script>
        <script src="{{ asset('js/masks/mask_auto.js') }}" defer></script>
        <script src="{{ asset('js/time.js') }}" defer></script>
        <script src="{{ asset('js/mask.js') }}" defer></script>
    @endpush

@endsection

