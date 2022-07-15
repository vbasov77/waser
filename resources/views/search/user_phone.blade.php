@extends('layouts.app')
@section('content')
    <section class="about-section text-center" id="about">
        <div class="container px-4 px-lg-5">
            <div class="gx-4 gx-lg-5 justify-content-center">
                @if(!empty($profile && $user))
                    <form action="/user_phone" class="form js-form-validate" method="post">
                        @csrf
                        <div>
                            <label for="id"><b>ID:</b></label><br>
                            <input type="text" name="id"
                                   value="{{ $user ['id'] ?? ''}}"
                                   class="form-control" required readonly><br>
                        </div>
                        <div>
                            <label for="name"><b>Имя:</b></label><br>
                            <input type="text" name="name"
                                   value="{{ $user ['name'] ?? '' }}"
                                   class="form-control" required><br>
                        </div>
                        <div>
                            <label for="email"><b>Email:</b></label><br>
                            <input type="email" name="email"
                                   value="{{$user ['email'] ?? ''}}"
                                   class="form-control" required readonly><br>
                        </div>


                        <input type="hidden" name="profile_id" value="{{$profile ['id'] ?? '' }}">
                        <div>
                            <label for="date"><b>Телефон:</b></label><br>
                            <input type="tel" placeholder="+7 (000) 000-0000" name="phone"
                                   value="{{ $profile ['phone_user'] ?? '' }}"
                                   class="tel form-control" required><br>
                        </div>
                        <div>
                            <label for="auto_user"><b>Имя:</b></label><br>
                            <input type="text" name="auto_user"
                                   id="gosnomer"
                                   placeholder="А777AA"
                                   style="text-transform:uppercase"
                                   value="{{ $profile ['auto_user'] ?? '' }}"
                                   class="form-control" required><br>
                        </div>
                        <input class="btn btn-outline-primary btn-sm" type="submit" value="Сохранить">
                    </form>
                @else
                    Пользователь по телефону не найден
                @endif
            </div>
        </div>
    </section>
    @push('scripts')
        <script src="{{ asset('js/masks/mask_auto.js') }}" defer></script>
        <script src="{{ asset('js/mask.js') }}" defer></script>
    @endpush

@endsection

