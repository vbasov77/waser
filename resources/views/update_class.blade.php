@extends('layouts.app')
@section('content')

    <div class="container mt-5 mb-5" style="width: 400px">

        <form action="/upd_class" method="post">
            @csrf
            <div>
                <h3>Редактировать класс авто, время мойки, цену.</h3>
                <label for="class_auto">Название класса авто</label>(через запятую) <br>
                <input type="text" placeholder="Легковые, Минивены..." name="class_auto" value="{{ $class_auto ?? '' }}" size="50" class="form-control"><br>

                <label for="name_wash">Название мойки</label> (через запятую)<br>
                <input type="text" placeholder="Экспресс, Люкс..." name="name_wash" value="{{ $name_wash ?? '' }}" size="50"
                       class="form-control"><br>
            </div>
            <br>
            <input class="btn btn-outline-primary" type="submit" value="Продолжить">
        </form>
    </div>

@endsection
