@extends('layouts.app')
@section('content')
    <script src="https://api-maps.yandex.ru/2.1/?lang=ru_RU" type="text/javascript"></script>
    <section class="pt-5 pb-5 mt-0 align-items-center d-flex bg-dark cover"
             style="height:100vh; background-size: cover; background-position: center; background-image: url({{ url("img/bg_image/1936_large_1496063032.jpg")}});">

        <div class="container-fluid">
            <div class="row  justify-content-center d-flex text-center h-100">
                <div class="col-12 col-md-8  h-50">
                    <div class="block_bg">
                        <h1 style="color: white; font-family: Century Gothic;" class="display-2  mb-2 mt-5 fro">
                            {{$data['name_obj']}}</h1>
                        <form action="/set" method="post">
                            <h3 style="color: white">Выберете категорию</h3>

                            @csrf
                            @php $i = 0
                            @endphp
                            <input type="hidden" name="obj_id" value="{{$data->id}}">
                            @foreach($auto as $item)
                                <div class="custom-control custom-radio">
                                    <input type="radio" class="custom-control-input" id="initial{{$i}}" name="class_auto" value="{{$item}}" required/>
                                    <label for="initial{{$i}}" class="custom-control-label" style="color: white"><b>{{$item}}</b></label><br>

                                </div>
                                @php $i++
                                @endphp
                            @endforeach
                            <br>
                            <input class="btn btn-outline-primary btn-sm" type="submit" value="Продолжить">
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </section>

    <div style="margin-top: 40px">
        <div class="row gx-0 justify-content-center">
            <div class="col-lg">
                <div style="margin-bottom: 40px" class="d-flex h-100">
                    <div class="project-text w-100 my-auto text-center">
                        @php
                        $phone = preg_replace("/[^0-9]/", '', $data['phone_obj']);
                        @endphp
                        {{$data->address_obj}}<br>
                        Тел: <a href='tel:+{{$phone}}'> {{$data['phone_obj']}}</a><br>
                        Время работы: {{$data->working_hours}}
                        <br>
                    </div>
                </div>

            </div>
            <div class="col-lg">
                <section>
                    <div id="map" style="width: 100%; height: 400px"></div>
                </section>

                <script>

                    // Функция ymaps.ready() будет вызвана, когда
                    // загрузятся все компоненты API, а также когда будет готово DOM-дерево.
                    ymaps.ready(init);

                    function init() {
                        // Создание карты.
                        // https://tech.yandex.ru/maps/doc/jsapi/2.1/dg/concepts/map-docpage/
                        var myMap = new ymaps.Map("map", {
                            // Координаты центра карты.
                            // Порядок по умолчнию: «широта, долгота».
                            center: [{{$data['coordinates']}}],
                            // Уровень масштабирования. Допустимые значения:
                            // от 0 (весь мир) до 19.
                            zoom: 15,
                            // Элементы управления
                            // https://tech.yandex.ru/maps/doc/jsapi/2.1/dg/concepts/controls/standard-docpage/
                            controls: [

                                'zoomControl', // Ползунок масштаба
                                'rulerControl', // Линейка
                                'routeButtonControl', // Панель маршрутизации
                                'trafficControl', // Пробки
                                'typeSelector', // Переключатель слоев карты
                                'fullscreenControl', // Полноэкранный режим

                                // Поисковая строка
                                new ymaps.control.SearchControl({
                                    options: {
                                        // вид - поисковая строка
                                        size: 'large',
                                        // Включим возможность искать не только топонимы, но и организации.
                                        provider: 'yandex#search'
                                    }
                                })

                            ]
                        });

                        // Добавление метки
                        // https://tech.yandex.ru/maps/doc/jsapi/2.1/ref/reference/Placemark-docpage/

                            @php
                            $phone = preg_replace("/[^0-9]/", '', $data['phone_obj']);
                            @endphp
                        var myPlacemark = new ymaps.Placemark([{{$data['coordinates']}}], {
                                // Хинт показывается при наведении мышкой на иконку метки.
                                hintContent: '{{$data['address_obj']}}',
                                // Балун откроется при клике по метке.
                                balloonContent: '<center><div>{{$data['address_obj']}}<br>{{$data['working_hours']}}<br><a href="tel:+{{$phone}}">{{$data['phone_obj']}}<br></div></center>'
                            });

                        // После того как метка была создана, добавляем её на карту.
                        myMap.geoObjects.add(myPlacemark);

                    }
                </script>
            </div>
        </div>

    </div>
@endsection
