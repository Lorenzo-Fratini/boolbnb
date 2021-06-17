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

  <div class="container">


    <div class="row">
      
      <h3>IN EVIDENZA</h3>

    </div>

    <div class="row">
      
      @foreach ($apartments as $apartment)

      <div class="app-lyt">
        <p>{{ $apartment -> title }}</p>
      </div>
          
      @endforeach

    </div>


  </div>

@endsection
