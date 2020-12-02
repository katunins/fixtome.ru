@extends('layouts.app')
@section('title')
fixtome - мобильные исследования
@endsection

@section('content')
<div class="container">
    <div class="background-eyes">
        <div class="background-eye-left">
            <img src="images/backeye.svg" alt="">
        </div>
        <div class="background-eye-right">
            <img src="images/backeye.svg" alt="">
        </div>
    </div>
    <div class="main-block main-block-welcome">
        <div class="logo">
            <img src="images/logo.svg" alt="Логотип fixtome.ru">
        </div>
        <div class="utp">
            <p>
                Сервис исследования групп с рейтингом мнений
            </p>
        </div>
        <div class="button-block">
            <a class="button new-research-button" href="newResearch">Создать опрос</a>
            <a href="about">Как это работает?</a>
        </div>
    </div>

</div>
@endsection