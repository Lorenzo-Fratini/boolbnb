@extends('layouts.main-layout')

@section('content')
    <div class="create-container">
        <div class="container">
            <div class="row text-center">
                <div class="col-12">
                    <h1>Nuovo appartamento:</h1>
                </div>
            </div>
        </div>
        <form method="POST" action="{{ route('storeApartment') }}" enctype="multipart/form-data">

            @csrf
            @method('POST')

            <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">

            {{-- title --}}
            <div class="line">
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
            </div>
            <div class="line">
                {{-- rooms number --}}
                <div>
                    <label for="rooms_number">Stanze</label>
                    <div>
                        <input id="rooms_number" type="number" name="rooms_number" onkeydown="return false" min="1">
                    </div>
                </div>
                {{-- beds number --}}
                <div>
                    <label for="beds_number">Letti</label>
                    <div>
                        <input id="beds_number" type="number" name="beds_number" onkeydown="return false" min="1">
                    </div>
                </div>
            </div>
            {{-- bathrooms number --}}
            <div class="line">
                <div>
                    <label for="bathrooms_number">Bagni</label>
                    <div>
                        <input id="bathrooms_number" type="number" name="bathrooms_number" onkeydown="return false" min="1">
                    </div>
                </div>
                {{-- area --}}
                <div>
                    <label for="area">m²</label>
                    <div>
                        <input id="area" type="number" name="area" onkeydown="return false" min="1">
                    </div>
                </div>
            </div>
            {{-- address --}}
            <div class="line">
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
            </div>
            {{-- country --}}
            <div class="line">
                <div class="form-group row mix">
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
            </div>
            {{-- cover image --}}
            <div class="cover-img">
                <label for="cover_image">
                    <h3>Immagine di copertina</h3>
                </label>
                <div>
                    <input id="cover_image" type="file" name="cover_image">
                </div>
            </div>
            {{-- services --}}
            <h2 class="servizih2">Servizi</h2>
            <div class="services">
                <div>
                    @foreach ($services as $service)
                        <div class="service">
                            <input type="checkbox" id="service_id[]" name="service_id[]" value="{{ $service->id }}">
                            <br>
                            <span for="service_id">{{ $service->name }}</span>
                        </div>
                    @endforeach
                </div>
            </div>

            {{-- BUTTON --}}
            <div>
                <button type="submit">
                    CREA
                </button>
            </div>
        </form>
    </div>
@endsection
