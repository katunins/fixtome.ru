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
                    Online исследование<br>общего мнения пользователей<br>через голосование
                </p>
            </div>
            <div class="button-block">
                <a class="button new-research-button pulse-button" href="newResearch">Создать опрос</a>
                <button class="how-it-works" onclick="howItWorks(true)">Как это работает?</button>
            </div>
        </div>


    </div>
    <div class="video hide" id="video">
        <div class="close-video-block">
            <button class="close-video" onclick="howItWorks(false)">x</button>
        </div>

        <video loop muted playsinline id="background">
            <source src="video/howitwork.mp4" type="video/mp4">
            <source src="video/howitwork.webm" type="video/webm">
            <source src="video/howitwork.ogv" type="video/ogg">
        </video>
    </div>
@endsection
<script>
    function howItWorks(status) {
        let howItWorks = document.querySelector('.how-it-works')
        let videoElem = document.getElementById('video')

        if (status) {
            howItWorks.classList.add('hide')
            videoElem.classList.remove('hide')
            window.scrollTo({
                top: 40000,
                behavior: 'smooth'
            })
            videoElem.querySelector('video').play()
        } else {
            howItWorks.classList.remove('hide')
            videoElem.classList.add('hide')
        }
    }

</script>
