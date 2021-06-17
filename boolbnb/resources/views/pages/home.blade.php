@extends('layouts.main-layout')

@section('content')

            {{-- JT --}}
  <div class="container-content">
    <div class="margin-content">
      <div class="text-content">
        <h1>Esplora BoolBnB</h1>
      </div>
    </div>
  </div>


            {{-- PREMIUM APARTMENTS --}}


  {{-- debug --}}
  {{-- <div class="container-evidenza">
    <h1>Appartamenti in evidenza</h1>
    <div class="cities-evidenza">

      <div class="cities-box">

        <div class="box-img">
          <p>Immagine principale dell'appartamento</p>
        </div>
        <div class="box-text">Descrizione appartamento</div>
      </div>

      <div class="cities-box">

        <div class="box-img">
          <p>Immagine principale dell'appartamento</p>
        </div>
        <div class="box-text">Descrizione appartamento</div>
      </div>

      <div class="cities-box">

        <div class="box-img">
          <p>Immagine principale dell'appartamento</p>

        </div>
        <div class="box-text">Descrizione appartamento</div>
      </div>

      <div class="cities-box">

        <div class="box-img">
          <p>Immagine principale dell'appartamento</p>

        </div>
        <div class="box-text">Descrizione appartamento</div>
      </div>
    </div>
  </div> --}}

  <div class="container-ap">


    <div class="row">
      
      <h3>IN EVIDENZA</h3>

    </div>

    <div class="row">
      
      @foreach ($apartments as $apartment)

      <div class="ap-lyt">


        <p>{{ $apartment -> title }}</p>

        <p>{{ $apartment -> rooms_number }}</p>

        <p>{{ $apartment -> beds_number }}</p>

        <p>{{ $apartment -> bathrooms_number }}</p>

        <p>{{ $apartment -> area }}</p>

        <p>{{ $apartment -> address }}</p>
        
        <p>{{ $apartment -> city }}</p>

        <p>{{ $apartment -> country }}</p>


      </div>
          
      @endforeach

    </div>


  </div>

@endsection
