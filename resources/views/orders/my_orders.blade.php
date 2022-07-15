@extends('layouts.app')
@section('content')

    <section class="about-section text-center" id="about">
        <div class="container px-4 px-lg-5">
            <div class="row gx-4 gx-lg-5 justify-content-center">
                <div class="col-lg-8">
                    <h3>Забронированное время</h3>
                    @if(!empty($data))
                        @foreach($data as $dat)
                            <div class="card text-center">
                                <div class="card-header">
                                    Номер заказа: {{$dat['id']}}<br>
                                    {{$num}}
                                </div>
                                <div class="card-body">
                                    <h4>{{$dat ['time_wash']}}</h4>
                                    {{ $dat['date_book']}}
                                    <h5>{{$dat['total_cost']}} руб</h5> <br>
                                </div>

                                <div class="card-footer text-muted">
                                    Тип авто: {{$dat ['type_auto']}}<br>
                                    Тип мойки: {{$dat ['type_wash']}}<br>

                                    <a onClick="return confirm('Подтвердите удаление!')"
                                       href='/order/{{$dat['id']}}/delete' type='button'
                                       class='btn btn-outline-danger btn-sm'>Удалить</a>
                                </div>
                            </div>
                        @endforeach
                </div>
            </div>
            @else
                <br> Заказов не найдено
        @endif
    </section>


@endsection
