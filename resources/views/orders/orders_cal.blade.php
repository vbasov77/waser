@extends('layouts.app')
@section('content')

    <section class="about-section text-center" id="about">
        <div class="container px-4 px-lg-5">
            <div class="row gx-4 gx-lg-5 justify-content-center">
                <div class="col-lg-8">
                    <h3>Выберете дату</h3>
                    <form action="{{route('get.date')}}" method="post">
                        @csrf
                        <input type="hidden" name="obj_id" value="{{$id}}">
                        <div>
                            <input type="text" id="timepicker" name="date" class="form-control" required
                                   autocomplete="off">
                        </div>
                        <div class="float-center">
                            <input class="btn btn-outline-primary" type="submit" value="Продолжить">
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </section>
    @push('scripts')
        <script>
            var datedis = @json('02.11.2022');
        </script>
        <script src="{{ asset('js/calendars/cal.js') }}" defer></script>
    @endpush
@endsection
