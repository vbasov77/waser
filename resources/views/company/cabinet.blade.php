@extends('layouts.app')
@section('content')

    <section class="about-section text-center" id="about">
        <div class="container px-4 px-lg-5">
            <div class="row gx-4 gx-lg-5 justify-content-center">
                <div class="col-lg-8">
                    <h1>Кабинет</h1>
                    <br>
                    <h2>Объекты</h2>
                    <div class="card-footer text-muted" style="margin: 5px">
                        <button class="btn btn-success" style="color: white; "
                                onclick="window.location.href = '{{route('add_object')}}';">
                            Добавить объект
                        </button>
                    </div>
                    @foreach($objects as $item)

                        <div class="card text-center" style="margin-top: 25px">
                            <div class="card-header">
                                <h3>{{$item ['name_obj']}}</h3>
                            </div>

                            <div class="card-footer text-muted" style="margin: 5px">
                                <button class="btn btn-success" style="color: white; "
                                        onclick="window.location.href = '{{route('view_admin_book', ['id'=>$item->id])}}';">
                                    Добавить заказ
                                </button>
                            </div>

                            <div class="card-body">

                                Адрес: {{$item->address_obj}} <br>
                                Телефон: {{$item->phone_obj}} <br>
                                Координаты карты: {{$item->coordinates}} <br>
                                <b>Расписание</b><br>
                                Время работы: {{$item ->working_hours}} <br>
                                Нагрузка: {{$item->load_obj}} <br><br>

                                <b>Категории авто:</b><br>
                                @php
                                    $res = \Illuminate\Support\Facades\DB::table('type_auto')->where('obj_id', $item->id)->value('name_auto');
                                    $category = explode(',', $res);
                                @endphp
                                @if (!empty($category))
                                    @foreach($category as $value)
                                        {{$value}}<br>
                                    @endforeach
                                @endif
                                <button class="btn btn-outline-success btn-sm"
                                        onclick="window.location.href = '{{ route('view_category', ['id' => $item->id]) }}';">
                                    Изменить категории
                                </button>
                                <br>

                                <b>Виды мойки:</b><br>
                                @php
                                    $r = \Illuminate\Support\Facades\DB::table('type_wash')->where('obj_id', $item->id)->value('name_wash');
                                    $wash = explode(',', $r);
                                @endphp
                                @if (!empty($wash))
                                    @foreach($wash as $val)
                                        {{$val}}<br>
                                    @endforeach
                                @endif
                                <button class="btn btn-outline-success btn-sm"
                                        onclick="window.location.href = '{{route('view_wash', ['id'=> $item['id']])}}'">
                                    Изменить виды
                                </button>
                                <br>
                                <b>Дополнительно:</b><br>
                                <?php
                                $result = \Illuminate\Support\Facades\DB::table('more_obj')->where('obj_id', $item->id)->get();
                                $more = json_decode(json_encode($result), true);

                                ?>
                                @if (!empty(count($more)))
                                    @foreach($more as $obj)
                                        {{$obj['name_more'] . " " . $obj['cost_more'] . " руб +" . $obj['time_more'] . " мин"}}
                                        <br>
                                    @endforeach
                                @endif

                                <button class="btn btn-outline-success btn-sm"
                                        onclick="window.location.href = '{{route('view_more', ['id'=>$item->id])}}';">
                                    Изменить доп
                                </button>
                                <br>
                                <button class="btn btn-outline-primary btn-sm"
                                        onclick="window.location.href = '{{route('table_cost', ['id'=>$item->id])}}';">
                                    >>Таблица цен<<
                                </button>
                            </div>


                            <div class="card-footer text-muted">
                                <button class="btn btn-primary btn-sm" style="color: white; "
                                        onclick="window.location.href = '{{route('object', ['id' => $item->id])}}';">
                                    Перейти
                                </button>
                                <button class="btn btn-success btn-sm" style="color: white; "
                                        onclick="window.location.href = '{{route('object.update', ['id'=>$item->id])}}';">
                                    Редактировать
                                </button>
                                <a onClick="return confirm('Подтвердите удаление!')"
                                   href='{{route('object.delete', ['id'=>$item->id])}}' type='button'
                                   class='btn btn-outline-danger btn-sm'>Удалить</a>
                            </div>
                        </div>
                    @endforeach

                </div>
            </div>
        </div>
    </section>
    @push('scripts')
        <script src="{{ asset('js/mask.js') }}" defer></script>
    @endpush
@endsection
