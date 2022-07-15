@extends('layouts.app')
@section('content')
    <section class="pt-5 pb-5 mt-0 align-items-center d-flex bg-dark cover"
             style=" height:100vh; background-size: cover; background-position: center; background-image: url({{ url("img/bg_image/1936_large_1496063032.jpg")}});">
        <div class="container-fluid">
            <div class="row  justify-content-center d-flex text-center h-100">
                <div class="col-12 col-md-8  h-50">
                    <div class="block_bg">
                        <h1 style="color: white; font-family: Century Gothic;" class="display-2  mb-2 mt-5 fro">
                            Мойка на Салова</h1>
                        <form action="/set" method="post">
                            <h3 style="color: white">Выберете категорию</h3>
                            @csrf
                            <input type="radio" id="initial" name="class_auto" value="1" required/><span
                                    style="color: white">Легковые</span>
                            <input type="radio" id="initial" name="class_auto" value="2" required/><span
                                    style="color: white">Кроссоверы</span><br>
                            <input type="radio" id="initial" name="class_auto" value="3" required/><span
                                    style="color: white">Джипы</span>
                            <input type="radio" id="initial" name="class_auto" value="4" required/><span
                                    style="color: white">Минивэны</span><br>
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
                        Санкт-Петербург<br>
                        улица Салова 44 к1 лит Ж<br>
                        Тел: <a href='tel:+79046043575'> +7(904)604-35-75</a><br>
                        Время работы: 24 часа
                        <br>
                    </div>
                </div>

            </div>
            <div class="col-lg">
                <iframe src="https://yandex.ru/map-widget/v1/?um=constructor%3A5d7af83fcecbbaa01d91a3775dfe88b323aaa76f6d3d8494ff78bbc571799607&amp;source=constructor"
                        width="100%" height="400" frameborder="0"></iframe>
            </div>
        </div>

    </div>
@endsection
