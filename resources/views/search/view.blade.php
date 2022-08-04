@extends('layouts.app')
@section('content')

    @if (!empty($error))
        <div style="background-color: red; color:#ffffff; padding: 5px;margin: 15px">
            <center>{{$error}}</center>
        </div>
    @endif

    @if (!empty($message))
        <div style="background-color: #43b143; color:#ffffff; padding: 5px;margin: 15px">
            <center> {{$message}}</center>
        </div>
    @endif

    <section class="about-section text-center">
        <div class="container px-4 px-lg-5">
            <form action="{{route('search.phone')}}" class="form js-form-validate" method="post">
                @csrf
                <div>
                    <label for="date"><b>Телефон:</b></label><br>
                    <input type="tel" placeholder="+7 (000) 000-0000" name="phone" method="post"
                           class="tel form-control" required><br>
                </div>
                <input class="btn btn-outline-primary btn-sm" type="submit" value="Продолжить">
            </form>
        </div>
    </section>
    @push('scripts')
        <script src="{{ asset('js/mask.js') }}" defer></script>
    @endpush

@endsection

