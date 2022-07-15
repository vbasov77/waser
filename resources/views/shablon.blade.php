@extends('layouts.app')
@section('content')

    <?php if (!empty($error)): ?>
    <div style="background-color: red; color:#ffffff; padding: 5px;margin: 15px">
        <center> <?= $error ?></center>
    </div>
    <?php endif; ?>
    <?php if (!empty($message)): ?>
    <div style="background-color: #43b143; color:#ffffff; padding: 5px;margin: 15px">
        <center> <?= $message ?></center>
    </div>
    <?php endif; ?>





@endsection
