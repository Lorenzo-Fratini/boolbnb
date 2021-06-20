@extends('layouts.main-layout')

    @section('content')

        <div class="container">
            <div class="row text-center">
                <div class="col-12">
                    <h1>Nuovo appartamento:</h1>
                </div>
            </div>
        </div>
        <form method="POST" action="{{ route('storeApartment')}}" enctype="multipart/form-data">

            @csrf
            @method('POST')

            <input type="hidden" name="user_id" value="{{Auth::user()->id}}">

            {{-- title --}}
            <div>
                <label for="title">Titolo</label>
                <div>
                    <input id="title" type="text" name="title">
                </div>
            </div>
            {{-- description --}}
            <div>
                <label for="description">Descrizione</label>
                <div>
                    <input id="description" type="text" name="description">
                </div>
            </div>
            {{-- rooms number --}}
            <div>
                <label for="rooms_number">Stanze</label>
                <div>
                    <input id="rooms_number" type="number" name="rooms_number">
                </div>
            </div>
            {{-- beds number --}}
            <div>
                <label for="beds_number">Letti</label>
                <div>
                    <input id="beds_number" type="number" name="beds_number">
                </div>
            </div>
            {{-- bathrooms number --}}
            <div>
                <label for="bathrooms_number">Bagni</label>
                <div>
                    <input id="bathrooms_number" type="number" name="bathrooms_number">
                </div>
            </div>
            {{-- area --}}
            <div>
                <label for="area">m²</label>
                <div>
                    <input id="area" type="number" name="area">
                </div>
            </div>
            {{-- address --}}
            <div>
                <label for="address">Indirizzo</label>
                <div>
                    <input id="address" type="text" name="address">
                </div>
            </div>
            {{-- city --}}
            <div>
                <label for="city">Città</label>
                <div>
                    <input id="city" type="text" name="city">
                </div>
            </div>
            {{-- country --}}
            <div class="form-group row">
                <label for="country">Nazione</label>
                <div>
                    <input id="country" type="text" name="country">
                </div>
            </div>
            {{-- postal_code --}}
            <div>
                <label for="postal_code">CAP</label>
                <div>
                    <input id="postal_code" type="text" name="postal_code">
                </div>
            </div>
            {{-- cover image --}}
            <div>
                <label for="cover_image">Immagine di copertina</label>
                <div>
                    <input id="cover_image" type="file" name="cover_image">
                </div>
            </div>
            {{-- services --}}
            <div>
                <label for="service_id[]">Servizi</label>
                <div>
                    @foreach ($services as $service)
                        <input type="checkbox" id="service_id[]" name="service_id[]" value="{{ $service -> id}}">
                        <label for="service_id[]">{{ $service -> name}}</label>
                    @endforeach
                </div>
            </div>
          
            {{-- BUTTON --}}
            <div>
                <div>
                    <button type="submit">
                        Crea
                    </button>
                </div>
            </div>
        </form>

    @endsection