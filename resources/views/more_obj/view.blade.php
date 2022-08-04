@extends('layouts.app')
@section('content')
    <?php
    //           var_dump($more_obj);
    //           return;
    //?>
    <section class="about-section text-center" id="about">
        <div class="container px-4 px-lg-5">
            <div class="row gx-4 gx-lg-5 justify-content-center">
                <div class="col-lg-8">
                    <h3>Дополнительно к "{{$name_obj}}"</h3>
                    <br>
                    <h2>Услуги</h2>
                    <div class="card-footer text-muted" style="margin: 5px">
                        <button class="btn btn-success" style="color: white; "
                                onclick="window.location.href = '{{route('add_more', ['id'=>(int) $obj_id])}}';">
                            Добавить услугу
                        </button>
                    </div>
                    @foreach($more_obj as $more)

                        <div class="card text-center">
                            <div class="card-header">
                                <h3>{{$more->name_more}}</h3>
                            </div>

                            <div class="card-body">
                                Порядковый номер: {{ $more->number_more}}<br>
                                Описание: {{ $more->descriptions_more}}<br>
                                Цена: {{ $more->cost_more}}<br>
                                Время: {{ $more->time_more}}<br>

                                @if(!empty($more->category))
                                    <i>{{$more->category}}</i>
                                @else
                                    <div style="color: red; font-size: small;">
                                        !!! не заданы категории
                                    </div>
                                @endif
                            </div>


                            <div class="card-footer text-muted">
                                <button class="btn btn-outline-primary btn-sm"
                                        onclick="window.location.href = '{{route('upload.more', ['id' => $more->id . "&" . (int) $obj_id])}}';">
                                    Редактировать
                                </button>

                                <a onClick="return confirm('Подтвердите удаление!')"
                                   href='{{route('upload_more', ['id' => $more->id . ";" . $more->obj_id])}}' type='button'
                                   class='btn btn-outline-danger btn-sm'>Удалить</a>
                            </div>
                        </div>
                    @endforeach

                </div>
            </div>
        </div>
    </section>

    <script src="{{ asset('js/mask.js') }}" defer></script>
@endsection
