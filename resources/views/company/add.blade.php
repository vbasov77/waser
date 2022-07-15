@extends('layouts.app')
@section('content')

    <section class="about-section text-center" id="about">
        <div class="container px-4 px-lg-5">
            <div class="row gx-4 gx-lg-5 justify-content-center">
                <div class="col-lg-8">
                    <time-component></time-component>
                    <form action="/add_object" method="post">
                        @csrf
                        <h3>Новый объект</h3>
                        <label for="name_obj"><b>Название</b></label><br>
                        <input type="text" class="form-control" name="name_obj" value="{{$_POST['name_obj'] ?? '' }}"
                               required><br>
                        <br>
                        <label for="address_obj"><b>Адрес</b></label><br>
                        <div>
                            <input type="text" name="address_obj" class="form-control"
                                   value="{{ $_POST['address_obj'] ?? '' }}" required><br>
                        </div>
                        <br>
                        <label for="phone_obj"><b>Телефон</b></label><br>
                        <div>
                            <input type="phone" name="phone_obj" class="tel form-control"
                                   value="{{$_POST['phone_obj'] ?? '' }}" required><br>
                        </div>
                        <br>

                        <label for="coordinates"><b>Координаты</b></label><br>
                        <div>
                            <input type="text" name="coordinates" class="form-control"
                                   autocomplete="off"
                                   value="{{ $_POST['coordinates'] ?? '' }}" required><br>
                        </div>
                        <br>
                        <h3>Настройка расписания</h3>
                        <br>
                        <div>
                            <label for="working_hours"><b>Время работы</b></label><br>
                            <input type="text" name="working_hours" class="form-control"
                                   id="working" autocomplete="off"
                                   value="{{ $_POST['working_hours'] ?? ''}}" required><br>
                        </div>
                        <br>
                        <div>
                            <label for="load"><b>Нагрузка</b></label><br>
                            <i><small>Сколько объект может обслуживать одновременно</small></i>
                            <input type="text" name="load_obj" class="form-control"
                                   autocomplete="off"
                                   value="{{ $_POST['load_obj'] ?? '' }}" required><br>
                        </div>


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
        <script src="{{ asset('js/masks/working.js') }}" defer></script>
    @endpush
@endsection
