@extends('layouts.app')
@section('content')
    <section class="about-section text-center" id="about">
        <div class="container px-4 px-lg-5">
            <div class="row gx-4 gx-lg-5 justify-content-center">
                <div class="col-lg-8">
                    <form action="/admin_book" method="post">
                        @csrf
                        <input style="float: left" name="obj_id" type="hidden" value="{{$obj_id}}">
                        <br>
                        <h3>Запись на мойку (админ)</h3><br>
                        <div>
                            <label for="timepicker[]">C<b style="color: red">*</b></label>
                            <input type="text" id="date_timepicker_start" autocomplete="off" name="timepicker[]"
                                  placeholder="Выберете время" class="form-control" required><br>
                        </div>

                        <div>
                            <label for="timepicker[]">До<b style="color: red">*</b></label>
                            <input type="text" id="date_timepicker_end" autocomplete="off" name="timepicker[]"
                                   placeholder="Выберете время"  class="form-control" required>
                        </div>
                        <br>


                                <div class="floatleft">
                                    @php $i = 0
                                    @endphp
                                    <h5>Тип авто</h5>
                                    @foreach($auto as $item)
                                        <div class="custom-control custom-radio">
                                            <input type="radio" class="custom-control-input" id="initial{{$i}}"
                                                   name="class_auto"
                                                   value="{{$item}}"/>
                                            <label for="initial{{$i}}" class="custom-control-label">{{$item}}</label><br>
                                        </div>
                                        @php $i++
                                        @endphp
                                    @endforeach
                                    <br>
                                    @php $l = 0
                                    @endphp
                                    <h5>Тип мойки</h5>
                                    @foreach($wash as $val)
                                        <div class="custom-control custom-radio">
                                            <input type="radio" name="class_wash" class="custom-control-input"
                                                   id="ini{{$l}}"
                                                   value="{{$val}}"/>
                                            <label for="ini{{$l}}"
                                                   class="custom-control-label"> {{$val}}</label><br>
                                        </div>
                                        @php $l++
                                        @endphp
                                    @endforeach
                                </div>

                        <div>
                            <label for="name_user">ФИО</label>
                            <input type="text" autocomplete="off" name="name_user"
                                   placeholder="ФИО"  class="form-control" value="{{ $_POST ['name_user'] ?? "" }}">
                        </div>
                        <br>
                        <div>
                            <label for="user_email">Email</label>
                            <input type="email" autocomplete="off" name="user_email"
                                   placeholder="Email"  class="form-control" value="{{ $_POST ['user_email'] ?? "" }}">
                        </div>
                        <br>
                        <div>
                            <label for="phone_user">Телефон</label>
                            <input  autocomplete="off" name="phone_user"
                                   placeholder="Телефон"  class="form-control tel" value="{{ $_POST ['phone_user'] ?? "" }}">
                        </div>
                        <br>

                        <div>
                            <label for="total_cost">Сумма</label>
                            <input type="number" autocomplete="off" name="total_cost"
                                   placeholder="Сумма"  class="form-control" value="{{ $_POST ['total_cost'] ?? "" }}" >
                        </div>
                        <br>
                        <b style="color: red">* - <small>обязательно для заполнения</small></b>
                        <br>
                        <input class="btn btn-outline-primary" type="submit" value="Продолжить">
                    </form>
                </div>
            </div>
        </div>
    </section>
    @push('scripts')
        <script>
            var array = @json($work_time);
        </script>
        <script src="{{ asset('js/calendars/time_admin.js') }}" defer></script>
        <script src="{{ asset('js/mask.js') }}" defer></script>
    @endpush
@endsection
