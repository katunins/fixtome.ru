@extends('layouts.app')

@section('title')
    Новое исследование "{{ $data['title'] }}"
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
            <div class="new-order-text">
                Ваш опрос создан!<br>
                Он доступен по <a href="{{ URL('/') }}/research/{{ $data['token'] }}" target="blank">ссылке</a>
                {{-- <p class="linktobufer">ссылка скопирована<br>в буфер обмена</p>
                --}}
                <input type="text" id="sharelink" value="{{ URL('/') }}/research/{{ $data['token'] }}"></p>
            </div>
            <div class="share-block">
                <button class="share-button" type="button" class="share" onclick="copypaste()">
                    <img src="images/copypaste.svg" alt="">
                </button>
                <p class="copypaste-info">Скопируйте ссылку,<br>или поделитесь опросом в соцсетях</p>
            </div>

            <script src="https://yastatic.net/share2/share.js" async></script>
            <div class="ya-share2" data-curtain data-size="l" data-shape="round" data-color-scheme="normal"
                data-services="vkontakte,facebook,odnoklassniki,telegram,whatsapp"
                data-title='Поделитесь мнением: "{{ $data['title'] }}"' 
                data-url="{{ URL('/') }}/research/{{ $data['token'] }}">
            </div>

            <div class="button-block">
                <button class="button" onclick="openInfo()">О разработчике</button>
                {{-- <a class="button new-research-button" href="about">О разработчике</a>
                --}}
            </div>
        </div>
        <div class="info-block hide">
            <div class="portrait-image">
            </div>
            <h3>Павел Катунин</h3>
            <p>Fullstack разработка продающих сервисов и конструкторов. Создание медиа контента</p>
            <a href="http://ikatunin.ru">ikatunin.ru</a>
            <div class="whatsapp">
                <a href="https://api.whatsapp.com/send?phone=79290090383">
                    <svg width="30" height="30" viewBox="0 0 513 513" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" clip-rule="evenodd"
                            d="M415.48 97.6001C394.771 76.8807 370.168 60.4622 343.087 49.2896C316.007 38.117 286.984 32.411 257.69 32.5001C134.75 32.5001 34.67 132.08 34.62 254.5C34.5656 293.481 44.841 331.781 64.4 365.5L32.75 480.5L151 449.63C183.732 467.362 220.373 476.643 257.6 476.63H257.69C380.62 476.63 480.69 377.04 480.75 254.63C480.824 225.436 475.092 196.518 463.887 169.559C452.681 142.601 436.227 118.14 415.48 97.6001V97.6001ZM257.69 439.16H257.61C224.424 439.17 191.841 430.289 163.25 413.44L156.48 409.44L86.31 427.76L105.04 359.67L100.63 352.67C82.0739 323.292 72.2425 289.248 72.28 254.5C72.28 152.77 155.49 70 257.76 70C306.82 69.9124 353.906 89.3154 388.661 123.941C423.416 158.567 442.995 205.58 443.09 254.64C443.05 356.38 359.88 439.16 257.69 439.16V439.16ZM359.38 300.97C353.81 298.19 326.38 284.77 321.3 282.92C316.22 281.07 312.47 280.14 308.76 285.7C305.05 291.26 294.36 303.7 291.11 307.45C287.86 311.2 284.61 311.61 279.04 308.83C273.47 306.05 255.5 300.2 234.21 281.3C217.64 266.59 206.46 248.43 203.21 242.88C199.96 237.33 202.86 234.32 205.65 231.56C208.16 229.07 211.22 225.08 214.01 221.84C216.8 218.6 217.73 216.28 219.58 212.58C221.43 208.88 220.51 205.64 219.12 202.87C217.73 200.1 206.58 172.79 201.94 161.68C197.41 150.86 192.82 152.33 189.4 152.16C186.15 152 182.4 151.96 178.71 151.96C175.889 152.033 173.114 152.688 170.557 153.882C168 155.076 165.717 156.784 163.85 158.9C158.74 164.46 144.34 177.9 144.34 205.18C144.34 232.46 164.34 258.86 167.1 262.56C169.86 266.26 206.4 322.29 262.31 346.32C272.692 350.766 283.3 354.665 294.09 358C307.44 362.22 319.59 361.63 329.19 360.2C339.9 358.61 362.19 346.78 366.82 333.82C371.45 320.86 371.46 309.76 370.07 307.45C368.68 305.14 364.96 303.74 359.38 300.97V300.97Z"
                            fill="green" />
                    </svg>

                </a>
            </div>
        </div>

    </div>
@endsection

<script>
    function copypaste() {
        // if(window.clipboardData) {
        //     window.clipboardData.clearData();
        //     window.clipboardData.setData("Text", document.getElementById('sharelink').innerHTML);
        // } 

        let copyElem = document.getElementById('sharelink')
        console.log(copyElem)
        copyElem.select()
        document.execCommand("copy");
        let linktobufer = document.querySelector('.copypaste-info');
        linktobufer.innerHTML = 'Ссылка скопирована в буфер обмена'
        // linktobufer.style = 'font-size: 12px!important; transition: 1s;'
        // setTimeout(() => {
        //     linktobufer.style = 'font-size: 0px!important; transition: 0.5s;'
        // }, 2500)
    }

    function openInfo() {
        document.querySelector('.button-block').classList.add('hide')
        document.querySelector('.info-block').className = 'info-block'
        window.scrollTo(0, 10000000)
    }

</script>
