@extends('layouts.app')
@section('content')
    <script src="https://api-maps.yandex.ru/2.1/?lang=ru_RU" type="text/javascript"></script>
    <section class="pt-5 pb-5 mt-0 align-items-center d-flex bg-dark cover my-height"
             style="margin-bottom: 45px; background-size: cover; background-position: center; background-image: url({{ url("img/bg_image/car2.jpg")}});">
        <div class="container-fluid">
            <div class="row  justify-content-center d-flex text-center h-100">
                <div class="col-12 col-md-8  h-50">
                    <div class="block_bg">
                        <h4 style="color: white; font-family: Century Gothic;" class="display-2  mb-2 mt-5 fro">
                            WASHER</h4>

                    </div>
                </div>
            </div>
        </div>

    </section>

    <section>
        <div style="margin-top: 25px; margin-bottom: 25px; text-align: center;">
            <h2>Выберете точку на карте</h2>
        </div>
        <div id="map" style="width: 100%; height: 400px"></div>
    </section>
    @push('scripts')
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
                    center: [59.9386, 30.3141],
                    // Уровень масштабирования. Допустимые значения:
                    // от 0 (весь мир) до 19.
                    zoom: 8,
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
                        @foreach($objects as $obj)
                    <?php
                    $phone = preg_replace("/[^0-9]/", '', $obj->phone_obj);
                    ?>
                var myPlacemark = new ymaps.Placemark([{{$obj['coordinates']}}], {
                        // Хинт показывается при наведении мышкой на иконку метки.
                        hintContent: 'Содержимое всплывающей подсказки',
                        // Балун откроется при клике по метке.
                        balloonContent: '<center><div>{{$obj->address_obj}}<br>{{$obj->working_hours}}<br><a href="tel:+{{$phone}}">{{$obj->phone_obj}}<br><a href="/id{{$obj->id}}" class="btn btn-outline-success btn-sm"> Перейти</a> </div></center>'
                    });

                // После того как метка была создана, добавляем её на карту.
                myMap.geoObjects.add(myPlacemark);
                @endforeach
            }
        </script>
    @endpush
@endsection
