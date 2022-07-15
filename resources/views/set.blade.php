@extends('layouts.app')
@section('content')
    <style>
        .col-1-2 {
            width: 50%;
            text-align: -webkit-center;
        }

        .floatleft {
            width: 100%;
            margin-top: 50px;
            float: left;
            text-align: left;
            font-size: 20px;
        }

        .float-center {
            margin-top: 30px;
            margin-bottom: 60px;
            text-align: center;
        }

        .xdsoft_timepicker.active {
            display: block;
            width: 350px;
        }

        .air-datepicker.-inline- {
            width: 100%;
        }

        input#el {

            margin-bottom: 15px;
        }

        .text-calendar {
            font-size: 20px;
        }

        .border_none {
            display: none;
        }
    </style>
    <script>
        var datedis = @json($datedis);
    </script>
    <section class="about-section text-center" id="about">
        <div class="container px-4 px-lg-5">
            <div class="row gx-4 gx-lg-5 justify-content-center">
                <div class="col-lg-8">
                    @if (!empty($message))
                        <div style="background-color: red; color:#ffffff; padding: 5px;margin: 15px">
                            <center> {{ $message }}</center>
                        </div>
                    @endif
                    <form action="/get_time" method="post">
                        @csrf
                        <input type="hidden" name="obj_id" value="{{$obj_id ?? ''}}">
                        <div class="text-calendar">
                            <b>Тип авто:</b> {{ $car}}<br><br>
                        </div>

                        <h3> Выберете дату и тип мойки </h3><br>
                        <div>
                            <input type="text" id="el" name="el" class="form-control" required autocomplete="off">
                        </div>

                        <div class="card" style="margin-top: 40px">
                            <div class="card-body">
                                <div class="floatleft">
                                    <h3>Выберете тип мойки</h3>
                                    @php $i = 0
                                    @endphp
                                    @foreach($wash as $val)
                                        <?php
                                        foreach ($costWashArr as $item) {
                                            $costArr = explode('&', $item);
                                            $typeWash = $car . ":" . $val;
                                            if ($typeWash === $costArr [0]) {
                                                $result = explode('/', $costArr[1]);
                                                $cost = $result[0];
                                                $timeWash = $result[1];
                                                break;
                                            }
                                        }
                                        ?>
                                        <div class="custom-control custom-radio">
                                            <input type="radio" name="class_wash" class="custom-control-input"
                                                   id="ini{{$i}}"
                                                   value="{{$val}}" required/>
                                            <label for="ini{{$i}}"
                                                   class="custom-control-label"> {{$val . ': ' . $cost . 'руб ' }}
                                                <small>{{$timeWash . 'мин'}}</small></label><br>
                                        </div>
                                        @php $i++
                                        @endphp
                                    @endforeach

                                </div>
                            </div>
                        </div>
                        @if(!empty($more_obj))
                            <div class="card">
                                <div class="card-body">
                                    <div class="floatleft">
                                        <h3>Выберете дополнительную услугу</h3>
                                        @foreach($more_obj as $obj)
                                            <input type="checkbox"
                                                   name="more_obj[]"
                                                   value="{{$obj['id'] . "," . $obj['obj_id'] . "," . $obj['name_more'] . "," . $obj['cost_more'] . "," . $obj['time_more']}}">
                                            <label for="more_obj[]">{{$obj['name_more'] . " " . $obj['cost_more'] . "руб " }}
                                                <small>{{" +" . $obj['time_more'] . "мин"}}</small></label>


                                            <br>
                                        @endforeach
                                    </div>
                                </div>
                            </div>

                        @endif
                        <div class="border_none">
                            <label for="class_auto"><b>Тип авто:</b></label>
                            <input value="<?= $_POST['class_auto'] ?>" readonly="readonly" type="text"
                                   name="class_auto"
                                   method="post"><br>
                        </div>
                        <div class="float-center">
                            <input class="btn btn-outline-primary" type="submit" value="Продолжить">
                        </div>


                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
