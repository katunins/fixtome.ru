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
                Online опрос ваших пользователей с сортировкой и голосованием
            </p>
        </div>
        <div class="button-block">
            <a class="button new-research-button" href="newResearch">Создать опрос</a>
            <button class="how-it-works" onclick="howItWorks()">Как это работает?</button>
        </div>
    </div>
    <div class="video">
        <video controls width="400" height="300" muted>
            {{-- <source src="video.mp4" type="video/mp4"><!-- MP4 для Safari, IE9, iPhone, iPad, Android, и Windows Phone 7 --> --}}
            <source src="viseo/howitworks.webm" type="video/webm"><!-- WebM/VP8 для Firefox4, Opera, и Chrome -->
            {{-- <source src="video.ogv" type="video/ogg"><!-- Ogg/Vorbis для старых версий браузеров Firefox и Opera --> --}}
            {{-- <object data="video.swf" type="application/x-shockwave-flash"><!-- добавляем видеоконтент для устаревших браузеров, в которых нет поддержки элемента video --> --}}
            {{-- <param name="movie" value="video.swf"> --}}
            </object>
        </video>
    </div>

</div>
@endsection