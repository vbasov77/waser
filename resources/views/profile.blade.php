@extends('layouts.app')
@section('content')

    @if (!empty($error))
        <div style="background-color: red; color:#ffffff; padding: 5px;margin: 15px">
            <center> {{$error}}</center>
        </div>
    @endif
    @if (!empty($message))
        <div style="background-color: #43b143; color:#ffffff; padding: 5px;margin: 15px">
            <center> {{$message }}</center>
        </div>
    @endif

    <section class="about-section text-center" id="about">
        <div class="container px-4 px-lg-5">
            <div class="row gx-4 gx-lg-5 justify-content-center">
                <div class="col-lg-8">
                    <h1>Профиль</h1><br>
                    @if(empty($data))
                        <div style="color: red">
                            Заполните, пожалуйста, данные
                        </div>
                    @else
                    @endif
                    <form action="{{route('add_profile')}}" method="post">
                        @csrf
                        <label for="phone_user"><b>Телефон:</b></label><br>
                        <input name="phone_user" id="name" value="{{ $data['phone_user'] ?? '' }}"
                               required
                               class="form-control tel"><br>
                        <br>

                        <label for="date"><b>Номер авто:</b></label><br>
                        <div>
                            <input type="text" name="auto_user" method="post"
                                   required
                                   class="form-control"
                                   value="{{ $data['auto_user'] ?? '' }}"><br>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </section>
    @push('scripts')
        <script src="{{ asset('js/mask.js') }}" defer></script>
    @endpush
@endsection

