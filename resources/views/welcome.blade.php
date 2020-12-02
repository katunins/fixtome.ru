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
    <div class="video hide" id="video">
    </div>

</div>
@endsection
<script>

    function howItWorks(){
        let videoElem = document.getElementById('video')
        videoElem.innerHTML = '<video loop muted playsinline id="background"><source src="video/howitwork.mp4" type="video/mp4"><source src="video/howitwork.webm" type="video/webm"><source src="video/howitwork.ogv" type="video/ogg"></video>'
        videoElem.className="video"
        window.scrollTo({top: 40000, behavior: 'smooth'})
        setTimeout(function(){
            document.querySelector('video').play()
        }, 400)
    }
</script>