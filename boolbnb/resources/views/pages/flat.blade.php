@extends('layouts.main-layout')

@section('content')

<div class="container-flat">

    <div class="flat-description margins">
        <h1>Nome hotel/appartamento</h1>
        <h2>Posizione hotel/appartamento</h2>
    </div>

    <div class="flat-block margins">

        <div class="flat-img">
            {{-- <span>Qui dentro ci va l'immagine principale</span> --}}
            <img src="http://lorempixel.com/output/nature-q-g-1920-1080-10.jpg" alt="">
        </div>

        <div class="container-text">
            <div class="flat-text">
                <h2>Descrizione</h2>
                <span>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Iusto molestiae distinctio modi, quasi maxime, at ex repellendus suscipit sed aut ad non, iste vitae cumque illo ea similique et inventore.</span>
                <h4>Stanze:</h4>
                <h4>Letti:</h4>
                <h4>Bagni:</h4>
                <h4>Metratura:</h4>
            </div>
            <div class="flat-form">
                <h3>Desideri maggiori informazioni? <br> Contatta {nome posto}</h3>
                <form action="">

                    <input type="email" placeholder="La tua email">
                    <br>
                    <textarea class="textarea" type="textarea" placeholder="Inserisci la tua richiesta"></textarea>
                    <br>
                    <button>
                        Invia richiesta
                    </button>

                </form>
            </div>
        </div>
    </div>

</div>
