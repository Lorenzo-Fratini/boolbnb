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
            
  <div class="container-ap">


    <div class="row">
      
      <h3>IN EVIDENZA</h3>

    </div>

    <div class="row">

      
      @foreach ($apartments as $apartment)

      <div class="ap-lyt" style="background-image: url(storage/images/es{{$apartment -> id}}.jpg)">


        <h2>{{ $apartment -> title }}</h2>

        <div>

          <span>Numero di stanze:</span>
          <span>{{ $apartment -> rooms_number }}</span>

        </div>
        
        <div class="details">

          <i class="fas fa-bed"></i>
          <span>{{ $apartment -> beds_number }}</span>
  
          <i class="fas fa-toilet"></i>
          <span>{{ $apartment -> bathrooms_number }}</span>

        </div>

        {{-- <p>{{ $apartment -> area }}</p>

        <p>{{ $apartment -> address }}</p>
        
        <p>{{ $apartment -> city }}</p>

        <p>{{ $apartment -> country }}</p> --}}


      </div>
          
      @endforeach


    </div>


  </div>

@endsection
