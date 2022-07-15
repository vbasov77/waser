@extends('layouts.app')
@section('content')

    <section class="about-section text-center" id="about">
        <div class="container px-4 px-lg-5">
            <div class="row gx-4 gx-lg-5 justify-content-center">
                <div class="col-lg-8">
                    <time-component></time-component>
                    <form action="/company" method="post">
                        @csrf
                        <h3>Данные организации</h3>
                        <label for="name">Название</label><br>
                        <input type="text" class="form-control" name="name" id="name"
                               value="{{ $data[0]['name_company'] ?? '' }}"
                               size="50"><br>
                        <br>
                        <label for="phone"><b>Телефон</b></label><br>
                        <div>
                            <input type="text" name="phone" method="post" class="tel form-control"
                                   value="{{ $data[0]['phone_company'] ?? '' }}"><br>
                        </div>
                        <br>
                        <h3>Настройка календаря</h3>
                        <label for="time_open">Время открытия</label><br>

                        <div>
                            <input type="text" id="datetimepicker" value="{{ $data[0]['time_open'] ?? '' }}"
                                   name="time_open"
                                   class="form-control" autocomplete="off">
                        </div>
                        <br>
                        <label for="time_closed">Время закрытия</label><br>
                        <div>
                            <input type="text" id="datetimepicker2" value="{{ $data[0]['time_closed'] ?? '' }}"
                                   name="time_closed"
                                   class="form-control" autocomplete="off">
                        </div>
                        <br>
                        <div>
                            <label for="step">Шаг</label><br>

                            <select name="step" class="form-control">
                                <option value=""><?= $data[0]['step'] ?? '' ?></option>
                                <option value="10">10</option>
                                <option value="15">15</option>
                                <option value="20">20</option>
                                <option value="25">25</option>
                                <option value="30">30</option>
                                <option value="35">35</option>
                                <option value="40">40</option>
                                <option value="45">45</option>
                                <option value="50">50</option>
                                <option value="55">55</option>
                                <option value="60">60</option>
                            </select>
                        </div>
                        <br>


                        <br>
                        <input class="btn btn-outline-primary" type="submit" value="Продолжить">
                    </form>

                </div>
            </div>
        </div>
    </section>
    @push('scripts')
        <script src="{{ asset('js/time_setting.js') }}" defer></script>
        <script src="{{ asset('js/time_closed.js') }}" defer></script>
        <script src="{{ asset('js/mask.js') }}" defer></script>
    @endpush
@endsection
