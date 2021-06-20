@extends('layouts.main-layout')

    @section('content')

        <div class="container">
            <div class="row text-center">
                <div class="col-12">
                    <h1>Nuovo appartamento:</h1>
                </div>
            </div>
        </div>
        <form method="POST" action="{{ route('storeApartment')}}">

            @csrf
            @method('POST')

            <input type="hidden" name="user_id" value="{{Auth::user()->id}}">

            {{-- title --}}
            <div class="form-group row">
                <label for="title" class="col-md-4 col-form-label text-md-right">Title</label>
                <div class="col-md-6">
                    <input id="title" type="text" class="form-control" name="title">
                </div>
            </div>
            {{-- cover image --}}
            <div class="form-group row">
                <label for="cover_image" class="col-md-4 col-form-label text-md-right">Cover image</label>
                <div class="col-md-6">
                    <input id="cover_image" type="text" class="form-control" name="cover_image">
                </div>
            </div>
            {{-- description --}}
            <div class="form-group row">
                <label for="description" class="col-md-4 col-form-label text-md-right">Description</label>
                <div class="col-md-6">
                    <input id="description" type="text" class="form-control" name="description">
                </div>
            </div>
            {{-- rooms number --}}
            <div class="form-group row">
                <label for="rooms_number" class="col-md-4 col-form-label text-md-right">Rooms number</label>
                <div class="col-md-6">
                    <input id="rooms_number" type="number" class="form-control" name="rooms_number">
                </div>
            </div>
            {{-- beds number --}}
            <div class="form-group row">
                <label for="beds_number" class="col-md-4 col-form-label text-md-right">Beds number</label>
                <div class="col-md-6">
                    <input id="beds_number" type="number" class="form-control" name="beds_number">
                </div>
            </div>
            {{-- bathrooms number --}}
            <div class="form-group row">
                <label for="bathrooms_number" class="col-md-4 col-form-label text-md-right">Bathrooms number</label>
                <div class="col-md-6">
                    <input id="bathrooms_number" type="number" class="form-control" name="bathrooms_number">
                </div>
            </div>
            {{-- area --}}
            <div class="form-group row">
                <label for="area" class="col-md-4 col-form-label text-md-right">Area</label>
                <div class="col-md-6">
                    <input id="area" type="number" class="form-control" name="area">
                </div>
            </div>
            {{-- address --}}
            <div class="form-group row">
                <label for="address" class="col-md-4 col-form-label text-md-right">Address</label>
                <div class="col-md-6">
                    <input id="address" type="text" class="form-control" name="address">
                </div>
            </div>
            {{-- city --}}
            <div class="form-group row">
                <label for="city" class="col-md-4 col-form-label text-md-right">City</label>
                <div class="col-md-6">
                    <input id="city" type="text" class="form-control" name="city">
                </div>
            </div>
            {{-- country --}}
            <div class="form-group row">
                <label for="country" class="col-md-4 col-form-label text-md-right">Country</label>
                <div class="col-md-6">
                    <input id="country" type="text" class="form-control" name="country">
                </div>
            </div>
            {{-- postal_code --}}
            <div class="form-group row">
                <label for="postal_code" class="col-md-4 col-form-label text-md-right">Postal Code</label>
                <div class="col-md-6">
                    <input id="postal_code" type="text" class="form-control" name="postal_code">
                </div>
            </div>
            {{-- services --}}
            <div class="form-group row">
                <label for="service_id[]" class="col-md-4 col-form-label text-md-right">Services</label>
                <div class="col-md-6">
                    @foreach ($services as $service)
                        <input type="checkbox" id="service_id[]" name="service_id[]" value="{{ $service -> id}}">
                        <label for="service_id[]">{{ $service -> name}}</label>
                    @endforeach
                </div>
            </div>
          
            {{-- BUTTON --}}
            <div class="form-group row">
                <div class="col-12 text-center">
                    <button type="submit" class="btn btn-primary">
                        Nuovo Appartamento
                    </button>
                </div>
            </div>
        </form>

    @endsection
