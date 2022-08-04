@extends('layouts.app')
@section('content')
    <section class="about-section text-center" id="about">
        <div class="container px-4 px-lg-5">
            <div class="row gx-4 gx-lg-5 justify-content-center">
                <div class="col-lg-8">
                    <form action="{{route('update_auto')}}" method="post">
                        @csrf
                        <h3>Виды авто</h3>
                        <input type="hidden" name="obj_id" value="{{$obj_id}}">


                        @for($i = 0; $i < 5; $i++)
                            <label for="type_auto"><b>Тип авто {{$i + 1}}:</b></label><br>
                            <input type="text" class="form-control" name="type_auto[]" value="{{ $auto[$i] ?? null }}"
                            ><br>
                            <br>
                        @endfor
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
