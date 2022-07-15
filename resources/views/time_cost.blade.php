@extends('layouts.app')
@section('content')
    <div class="container mt-5 mb-5" style="width: 680px">
        <form action="/time_cost" method="post">
            @csrf
            <div>
                <div>
                    <?php $d = 0; for ($i = 0; $i < 4; $i++): ?>

                    <h4><?= $class_auto[$i]; ?></h4>
                    <?php for ($ii = 0; $ii < 4; $ii++): ?>
                        <b> {{ $name_wash[$ii] }}</b> <i>({{$class_auto[$i]}}. Минуты/рубли - через слеш "/")</i>

                        <div>
                            <?= $i . " "  .  $ii ?>
                            <input type="text" id="date" name="time_cost[{{ $i }}][]" method="post" class="form-control"
                                    value="{{$time_cost[$d]['time_cost'] ?? '' }}" placeholder="мин/руб" autocomplete="off" onkeyup="this.value = this.value.replace(/[^0-9/]/, '');"><br>

                        </div>
                        <? $d = $d + 1 ?>
                    <?php endfor; ?>
                    <?php endfor; ?>
                </div>
            </div>
            <br>
            <input class="btn btn-outline-primary" type="submit" value="Продолжить">
        </form>
    </div>
@endsection
