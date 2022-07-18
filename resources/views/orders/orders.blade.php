@extends('layouts.app')
@section('content')

    <section class="about-section text-center" id="about">
        <div class="container px-4 px-lg-5">
            <div class="gx-4 gx-lg-5 justify-content-center">
                <h1>{{$date}}</h1>
                @if(!empty($obj_id))
                    <div class="card-footer text-muted" style="margin: 5px">
                        <button class="btn btn-success" style="color: white; "
                                onclick="window.location.href = '/admin_book/obj_id{{$obj_id}}';">
                            Добавить заказ
                        </button>
                    </div>
                @endif
                <h3 style="margin-top: 40px">Забронированное время</h3><br>
                @if(!empty($data))
                    @for($i = 0; $i < count($data); $i++)
                        <?php
                        $phone = preg_replace("/[^0-9]/", '', $data [$i][0] ['phone_user']);
                        $auto = \Illuminate\Support\Facades\DB::table('profile')->where('phone_user', $data [$i][0] ['phone_user'])->value('auto_user');

                        ?>
                        <div class="card text-center" style="margin: 15px">
                            <div class="card-header">
                                Номер заказа: {{$data [$i][0] ['id'] }}<br>
                                {{$data[$i][0] ['date_book']}}
                                <h3>{{$data [$i][0] ['time_wash']}}</h3><br>
                            </div>
                            <div class="card-body">
                                <h5>{{$data [$i][0] ['total_cost']}} руб</h5><br>
                                Тип авто: <?= $data [$i][0] ['type_auto'] ?><br>
                                Тип мойки: <?= $data [$i][0] ['type_wash'] ?><br>
                                <a href='tel:+{{ $phone }}'> {{$data [$i][0]['phone_user'] }}</a>
                                {{$data [$i][0] ['name_user'] }}<br>
                                <b><?= $auto ?></b><br>


                                @if(!empty($data [$i][0]['more_book']))
                                    <b>Дополнительно:</b><br>
                                    <?php
                                    $more_book = explode(";", $data [$i][0]['more_book'])
                                    ?>
                                    @foreach($more_book as $book)
                                        <?php
                                        $more = explode(',', $book);
                                        ?>
                                        {{$more[2] . " " . $more [3] . " руб " . $more [4] . " мин"}}<br>
                                    @endforeach
                                @endif
                            </div>

                            <div class="card-footer text-muted">

                                <button class="btn btn-success btn-sm" style="color: white; "
                                        onclick="window.location.href = '#';">
                                    Редактировать
                                </button>

                                <a onClick="return confirm('Подтвердите удаление!')"
                                   class="btn btn-danger btn-sm" style="color: white; "
                                   href='/delete/<?= $data[$i][0]['id'] . ';' . $date . ';' . $data[$i][0]['obj_id'] ?>/order'>
                                    Удалить
                                </a>

                                <form action="/in_archive" method="post">
                                    @csrf
                                    <input type="hidden" name="id" value="{{$data[$i][0]['id']}}"/>
                                    <input type="hidden" name="obj_id" value="{{$data[$i][0]['obj_id']}}"/>
                                    <i>Отзыв администратора</i><br>
                                    <input type="text" name="comment_admin" id="otz" class="form-control"
                                           placeholder="Отзыв администратора"/>
                                    <br>
                                    <div>
                                        <input id="submit" class="btn btn-outline-dark btn-sm" type="submit"
                                               value="В архив"/>
                                    </div>
                                </form>

                            </div>
                        </div>
                    @endfor
                @else
                    <br>
                    Заказов не найдено
                @endif
            </div>
        </div>
    </section>
    @push('scripts')
        <script src="{{ asset('js/otz.js') }}" defer></script>
    @endpush
@endsection
