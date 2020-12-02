@extends('layouts.app')
@section('title')
Опрос - {{ $dataArr->title }}
@endsection
@section('content')
<div class="container">
    <div class="background-eyes" style="opacity: 0.3">
        <div class="background-eye-left">
            <img src="/images/backeye.svg" alt="">
        </div>
        <div class="background-eye-right">
            <img src="/images/backeye.svg" alt="">
        </div>
    </div>
    @php
    $marginTopMainBlock = 160;
    $marginTopMainBlock -= 35*$likesArr->count();
    if ($marginTopMainBlock < 40) $marginTopMainBlock=40; @endphp <div class="main-block"
        style="margin-top: {{ $marginTopMainBlock }}px">
        <form class="form" action="newTweet" method="post">

            @csrf
            <input type="hidden" name="orderToken" value="{{ $dataArr->token }}">
            @if ($dataArr->image)
            <div class="loaded-image" style="background-image: url({{ $dataArr->image }});">
            </div>
            @endif


            <div class="header-block">
                <div class="order-title-block">
                    <h2>
                        {{ $dataArr->title }}
                    </h2>
                    @if ($dataArr->description !='')
                    <p>
                        {{ $dataArr->description }}

                    </p>
                    @endif
                </div>
            </div>

            <div class="input-block input-block-research">
                @error('title')
                <div class="input-error">{{ $message }}</div>
                @enderror
                <input class="title" type="text" name="title" id="" placeholder="Ваше мнение" autocomplete="off"
                    value="{{ old('title') }}" oninput="titleInputEvent()">
                <button type="button" class="erase-input hide-effect-off" onclick="eraseInput()"></button>
                <input class="description hide-effect-off" type="text" name="description" id=""
                    placeholder="Добавьте подробности" autocomplete="off" value="{{ old('description') }}">

                @error('count')
                <div class="input-error">{{ $message }}</div>
                @enderror
            </div>
            <div class="button-block button-block-research hide-effect-off">
                <input class="button" type="submit" value="Сохранить">
            </div>
        </form>
</div>
<div class="likes-list">
    @foreach ($likesArr as $item)
    <div class="like-block">
        <button class="like @if($item->likes==0) empty-like @endif" onclick="setLike({{ $item->id }})">
            <span>
                @if ($item->likes>1){{ $item->likes }}@endif
            </span>
        </button>
        <div class="like-text-block">
            <h3>{{ $item->tweet }}</h3>
            @if ($item->description !='')
            <p>{{ $item->description }}</p>
            @endif
        </div>
    </div>
    @endforeach
</div>

</div>
@endsection
<script>
    function eraseInput() {
        [
                document.querySelector('.description'),
                document.querySelector('.title')
            ].forEach(el=>{
                el.value = ''
            })
            turnInput()
    }
    function turnInput(status) {
        
            [
                document.querySelector('.description'), 
                document.querySelector('.button-block'),
                document.querySelector('.erase-input')
            ].forEach(el=>{
                if (status) {
                    if (el.classList.contains('hide-effect-off')) {
                        el.classList.remove('hide-effect-off')
                        el.classList.add('hide-effect-on')
                    }
                } else {
                    if (el.classList.contains('hide-effect-on')) {
                        el.classList.remove('hide-effect-on')
                        el.classList.add('hide-effect-off')
                    }
                }
            })
    }
    function titleInputEvent(){
        let value = event.target.value
        if (value != '') {
            turnInput(true)
        } else {
            turnInput(false)
        }
        
        likeFilter(value)
    }
    function likeFilter(value) {
        let likeBlocks = document.querySelectorAll('.like-text-block')
        if (likeBlocks.length > 0){
            likeBlocks.forEach(el=>{
                
                let likeBlock = el.parentNode
                let text=''
                text+=el.querySelector('h3').innerHTML
                if (el.querySelector('p')) text+=el.querySelector('p').innerHTML;
                if (value=='') {
                    if (likeBlock.classList.contains('hide'))likeBlock.classList.remove('hide')
                } else {
                    if (text.indexOf(value) <0) {
                        likeBlock.classList.add('hide')
                    } else {
                        if (likeBlock.classList.contains('hide'))likeBlock.classList.remove('hide')
                    }
                }
            })
        }
    }

    function ajax (
        url,
        data,
        callBack = null
        ) {
        fetch (url, {
            headers: {
            'Content-Type': 'application/json',
            Accept: 'application/json, text-plain, */*',
            'X-Requested-With': 'XMLHttpRequest',
            'X-CSRF-TOKEN': document
                .querySelector ('meta[name="csrf-token"]')
                .getAttribute ('content'),
            },
            method: 'post',
            credentials: 'same-origin',
            body: JSON.stringify (data),
        })
            .then (response => response.json ())
            .then (response => {
            if (callBack) callBack (response);
            // console.log (callBack);
            })
            .catch (function (error) {
            console.log (error);
            });
    };

    function setLike(id) {
        let likeElem = event.target
        ajax('/setLike', {id:id}, function (result){
            if (result) {
                if (result == 1) likeElem.className = 'like';
                if (result>1) likeElem.querySelector('span').innerHTML = result;
            }
        })
    }
</script>