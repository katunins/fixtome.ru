@extends('layouts.app')
@section('title')
    Новое исследование
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
        <div class="main-block main-block-newsearch">
            <form class="form" action="newResearch" method="post" enctype="multipart/form-data">
                @csrf
                @error('image')
                    <div class="input-error">{{ $message }}</div>
                @enderror
                <input class="hide" type="file" name="image" id="inputFile" onChange="fileSelected()" accept="image/*">
                <label class="load-image" for="inputFile">
                    <div class="loaded-image"
                        style="background-image: url(images/imageicon.svg);background-size: 30px;     background-position-y: 18px;">
                        <p>Загрузите картинку</p>
                    </div>

                </label>

                <div class="input-block">
                    @error('title')
                        <div class="input-error">{{ $message }}</div>
                    @enderror
                    <div class="erase-button-block">
                        <button type="button" class="erase-input" onclick="eraseInput()"></button>
                    </div>
                    <input class="title" type="text" name="title" id="" placeholder="Напишите ваш вопрос" autocomplete="off"
                        value="{{ old('title') }}">

                    <input class="description" type="text" name="description" id="" placeholder="Добавьте описание"
                        autocomplete="off" value="{{ old('description') }}">

                    @error('count')
                        <div class="input-error">{{ $message }}</div>
                    @enderror
                </div>
                <div class="button-block">
                    <input class="button" type="submit" value="Сохранить">
                    {{-- <button type="button" class="how-it-works"
                        onclick="howItWorks(true)">В начало</button> --}}
                </div>
            </form>
        </div>

    </div>
@endsection
<script>
    function fileSelected() {

        var input = event.target
        if (input.files && input.files[0]) {
            var newFile = new File([input.files[0]], "Bank - Document.docx", {
                type: input.files[0].type,
            });


            var data = new FormData();
            data.set("image", newFile);
            data.set("title", 'newFile');
            fetch("newResearch", {
                    headers: {
                        'Content-Type': 'multipart/form-data',
                        // Accept: 'application/json, text-plain, */*',
                        'X-Requested-With': 'XMLHttpRequest',
                        'X-CSRF-TOKEN': document
                            .querySelector('meta[name="csrf-token"]')
                            .getAttribute('content'),
                    },
                    method: "POST",
                    body: data
                })
                .then(response => {
                    if (!response.ok) {
                        throw new Error("HTTP error " + response.status);
                    }
                    return response.text(); // or response.json() or whatever
                })
                .then(response => {
                    // Do something with the response
                })
                .catch(error => {
                    // Do something with the error
                });



            console.log(newFile)
            if (input.files[0].size > 1024 * 1024 * 5) return
            var reader = new FileReader()
            reader.onload = function(e) {
                document.querySelector('.load-image').querySelector('p').classList.add('hide')
                let imageElem = document.querySelector('.loaded-image')
                imageElem.style = ''
                imageElem.style.backgroundImage = 'url(' + e.target.result + ')'

            }
            reader.readAsDataURL(input.files[0]);
        }
    }

    function eraseInput() {
        [
            document.querySelector('#inputFile'),
            document.querySelector('.description'),
            document.querySelector('.title')
        ].forEach(el => {
            el.value = ''
        })
        document.querySelector('.loaded-image').style =
            'background-image: url(images/imageicon.svg);background-size: 30px;     background-position-y: 18px;'
    }

</script>
