@extends('layouts.app')
@section('content')
    <section class="about-section text-center" id="about">
        <div class="container px-4 px-lg-5">
            <div class="gx-4 gx-lg-5 justify-content-center">

                <h3 style="margin-top: 40px">Объекты</h3><br>
                @if(!empty($objects))
                    @for($i = 0; $i < count($objects); $i++)
                        <div class="card text-center" style="margin: 15px">
                            <div class="card-header">
                                {{$objects[$i]['name_obj']}}
                            </div>
                            <div class="card-body">
                                <button class="btn btn-success btn-sm" style="color: white; "
                                        onclick="window.location.href = 'object/{{$objects[$i]['id'] }}/today';">
                                    Сегодня
                                </button>
                                <button class="btn btn-primary btn-sm" style="color: white; "
                                        onclick="window.location.href = 'object/{{$objects[$i]['id'] }}/cal';">
                                    Календарь
                                </button>
                            </div>
                        </div>
                    @endfor
                @else
                    <br>
                    Объектов не найдено
                @endif
            </div>
        </div>
    </section>


@endsection
