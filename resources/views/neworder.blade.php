@extends('layouts.app')

@section('title')
Создано новое исследование
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
    <div class="main-block main-block-neworder">
        <div class="logo">
            <img src="images/logo.svg" alt="Логотип fixtome.ru">
        </div>
        <div class="utp">
            <p>
                Опрос "{{ $data['title'] }}" создан!<br>
                Страница доступна по
                <a href="{{ URL('/') }}/research/{{ $data['token'] }}" target="blank">ссылке</a>
            </p>
            <p class="linktobufer">ссылка скопирована<br>в буфер обмена</p>
            <input type="text" id="sharelink" value="{{ URL('/') }}/research/{{ $data['token'] }}">
        </div>
        <div class="share-block">
            <button class="share-button" type="button" class="share" onclick="shareButton()">
                <img src="images/share.svg" alt="">
            </button>
        </div>
        <div class="button-block">
            <a class="button new-research-button" href="">Информация</a>
        </div>
    </div>

</div>
@endsection

<script>
    function shareButton(){
        let copyElem = document.getElementById('sharelink')
        copyElem.select()
        document.execCommand("copy");
        let linktobufer = document.querySelector('.linktobufer');
        linktobufer.style = 'font-size: 12px!important; transition: 1s;'
        setTimeout(()=>{
            linktobufer.style='font-size: 0px!important; transition: 0.5s;'
        }, 2500)
    }
</script>