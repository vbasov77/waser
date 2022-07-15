@extends('layouts.app')
@section('content')

    <section class="about-section text-center" id="about">
        <div class="container px-4 px-lg-5">
            <div class="row gx-4 gx-lg-5 justify-content-center">
                <div class="col-lg-8">
                    <form action="/upload_more" method="post">
                        @csrf
                        <input type="hidden" name="id" value="{{$more_obj['id']}}">
                        <input type="hidden" name="obj_id" value="{{$more_obj['obj_id']}}">
                        <h3>Редактировать услугу</h3>
                        <label for="name_more"><b>Название</b></label><br>
                        <input type="text" class="form-control" name="name_more"
                               value="{{ $more_obj['name_more'] ?? '' }}"
                               required><br>
                        <br>

                        <label for="descriptions_more"><b>Описание</b></label><br>
                        <div>
                            <input type="text" name="descriptions_more" class="form-control"
                                   value="{{ $more_obj['descriptions_more'] ?? ''}}" required><br>
                        </div>

                        <br>
                        <label for="cost_more"><b>Цена</b></label><br>
                        <div>
                            <input type="number" name="cost_more" class="form-control"
                                   value="{{ $more_obj['cost_more'] ?? '' }}" required><br>
                        </div>
                        <br>

                        <label for="time_more"><b>Время</b></label><br>
                        <div>
                            <input type="number" name="time_more" class="form-control"
                                   autocomplete="off"
                                   value="{{ $more_obj['time_more'] ?? '' }}" required><br>
                        </div>
                        <br>
                        <div>
                            <label for="number_more"><b>Номер в списке</b></label><br>
                            <input type="number" name="number_more" class="form-control"
                                   autocomplete="off"
                                   value="{{ $more_obj['number_more'] ?? '' }}" required><br>
                        </div>

                        <div>
                            <label for="category"><b>Категория</b></label><br>
                            @foreach($type_auto as $type)
                                <?php
                                if (!empty(in_array($type, $category))) {
                                    $checked = 'checked';
                                } else {
                                    $checked = null;
                                }
                                ?>

                                <label> <input type="checkbox" name="category[]" class=""
                                               {{$checked}}  value="{{$type}}"> {{$type}}</label>

                            @endforeach
                        </div>

                        <br>
                        <input class="btn btn-outline-primary" type="submit" value="Продолжить">
                    </form>

                </div>
            </div>
        </div>
    </section>
    @push('scripts')
        <script src="{{ asset('js/time_setting.js') }}" defer></script>
        <script src="{{ asset('js/time_closed.js') }}" defer></script>
        <script src="{{ asset('js/mask.js') }}" defer></script>
        <script src="{{ asset('js/masks/working.js') }}" defer></script>
    @endpush
@endsection
