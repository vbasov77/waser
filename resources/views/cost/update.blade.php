@extends('layouts.app')
@section('content')

    <section class="about-section text-center" id="about">
        <div class="container px-4 px-lg-5">
            <div class="row gx-4 gx-lg-5 justify-content-center">
                <div class="col-lg-8">
                    <form action="{{route('update_cost')}}" method="post">
                        @csrf
                        <h3>Таблица цен</h3>
                        <input type="hidden" name="obj_id" value="{{$obj_id}}">
                        @if(!empty($name))
                            @for($i = 0; $i < count ($name); $i++)
                                <label for="type_auto"><b>{{$name[$i]}}:</b></label><br>
                                <i><small>Цена/время(в минутах) через - "/"</small></i>
                                <input placeholder="1500/45" type="text"
                                       onkeyup="this.value = this.value.replace (/[^0-9/]/, '')" class="form-control"
                                       name="cost[]" value="{{$cost[$i] ?? '' }}"
                                ><br>
                                <br>
                            @endfor
                        @endif
                        <br>
                        <input class="btn btn-outline-primary" type="submit" value="Сохранить">
                    </form>
                    <button class="btn btn-primary btn-sm" style="color: white; "
                            onclick="window.location.href = '/cabinet';">
                        Назад
                    </button>

                </div>
            </div>
        </div>
    </section>

@endsection
