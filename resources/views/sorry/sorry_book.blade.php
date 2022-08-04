@extends('layouts.app')
@section('content')
    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <section class="about-section text-center" id="about">
        <div class="container px-4 px-lg-5">
            <div class="row gx-4 gx-lg-5 justify-content-center">
                <div class="col-lg-8">
                    <font color='red'><i class="fas fa-cat fa-5x"></i></font>
                    <br>
                    {{$message}}
                    <br>
                    <br>
                    <form action="{{route('get_time')}}" method="post">
                        @csrf
                        <input type="hidden" name="obj_id" value="{{$obj_id ?? ''}}">
                        <input type="hidden" name="car" value="{{$car ?? ''}}">
                        <input type="hidden" name="costWashArr" value="{{$costWashArr ?? ''}}">
                        <input type="hidden" name="more_obj" value="{{$more_obj ?? ''}}">
                        <div class="float-center">
                            <input class="btn btn-outline-primary" type="submit" value="Продолжить">
                        </div>
                    </form>
                    <button class="btn btn-info btn-sm" style="color: white; "
                            onclick="window.location.href = '/';">
                        На главную
                    </button>
                </div>
            </div>
        </div>
    </section>
@endsection
