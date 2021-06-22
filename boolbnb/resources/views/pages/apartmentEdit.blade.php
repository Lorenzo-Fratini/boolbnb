@extends('layouts.main-layout')

    @section('content')
    <div class="edit-container">
        <div class="container">
            <div class="row text-center">
                <div class="col-12">
                    <h1>Modifica appartamento:</h1>
                </div>
            </div>
        </div>
    <form method="POST" action="{{ route('updateApartment', $apartment -> id)}}" enctype="multipart/form-data">

            @csrf
            @method('POST')

    <input type="hidden" name="user_id" value="{{ $user -> id}}">

            {{-- title --}}
            <div class="line">
                <div>
                    <label for="title">Title</label>
                    <div>
                        <input id="title" type="text" name="title" value="{{ $apartment -> title }}">
                    </div>
                </div>
                {{-- description --}}
                <div>
                    <label for="description">Description</label>
                    <div>
                        <input id="description" type="text" name="description" value="{{ $apartment -> description }}">
                    </div>
                </div>
            </div>    
                {{-- rooms number --}}
            <div class="line"> 
                <div>
                    <label for="rooms_number">Rooms number</label>
                    <div>
                        <input id="rooms_number" type="number" name="rooms_number" value="{{ $apartment -> rooms_number }}">
                    </div>
                </div>
                {{-- beds number --}}
                <div>
                    <label for="beds_number">Beds number</label>
                    <div>
                        <input id="beds_number" type="number" name="beds_number" value="{{ $apartment -> beds_number }}">
                    </div>
                </div>
            </div>    
                {{-- bathrooms number --}}
            <div class="line">
                <div>
                    <label for="bathrooms_number">Bathrooms number</label>
                    <div>
                        <input id="bathrooms_number" type="number" name="bathrooms_number" value="{{ $apartment -> bathrooms_number }}">
                    </div>
                </div>
                {{-- area --}}
                <div>
                    <label for="area">Area</label>
                    <div>
                        <input id="area" type="number" name="area" value="{{ $apartment -> area }}">
                    </div>
                </div>
            </div>    
                {{-- address --}}
            <div class="line">   
                <div>
                    <label for="address">Address</label>
                    <div>
                        <input id="address" type="text" name="address" value="{{ $apartment -> address }}">
                    </div>
                </div>
                {{-- city --}}
                <div>
                    <label for="city">City</label>
                    <div>
                        <input id="city" type="text" name="city" value="{{ $apartment -> city }}">
                    </div>
                </div>
            </div>    
                {{-- country --}}
            <div class="line">  
                <div>
                    <label for="country">Country</label>
                    <div>
                        <input id="country" type="text" name="country" value="{{ $apartment -> country }}">
                    </div>
                </div>
                {{-- postal_code --}}
                <div>
                    <label for="postal_code">Postal Code</label>
                    <div>
                        <input id="postal_code" type="text" name="postal_code" value="{{ $apartment -> postal_code }}">
                    </div>
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
            <h2 class="servizih2">Servizi</h2>
            <div class="services">
                
                <div>
                    @foreach ($services as $service)
                    <div class="service">
                        <input type="checkbox" id="service_id[]" name="service_id[]" value="{{ $service -> id }}"
                        @foreach ($apartment -> services as $apartmentService)
                            @if ($apartmentService -> id == $service -> id)
                                checked
                            @endif
                        @endforeach
                        >
                        <br>
                        <label for="service_id[]">{{ $service -> name}}</label>
                    </div>    
                    @endforeach
                </div>
            </div>
          
            {{-- BUTTON --}}
            <div>
                <div>
                    <button type="submit">
                        UPDATE
                    </button>
                </div>
            </div>
        </form>
    </div>    
    @endsection