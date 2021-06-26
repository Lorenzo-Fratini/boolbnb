@extends('layouts.main-layout')

@section('content')

<div class="container-flat">

    <div class="flat-description margins">
        <h1> {{ $apartment -> title }} </h1>
        <h2> {{ $apartment -> address}} | {{ $apartment -> city}}</h2>
    </div>

    <div class="flat-block margins">

        <div class="flat-img">
            {{-- <span>Qui dentro ci va l'immagine principale</span> --}}
            <img src="{{ asset('/storage/images/' . $apartment -> cover_image) }}" alt="">
        </div>

        <div class="container-text">
            <div class="flat-text" id="flat-text-id">
                <h2>Descrizione</h2>
                <span> {{ $apartment -> description}} </span>
                {{-- <span>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Iusto molestiae distinctio modi, quasi maxime, at ex repellendus suscipit sed aut ad non, iste vitae cumque illo ea similique et inventore.</span> --}}

                <hr>
                
                <ul>
                    <li>
                        <span>Stanze:</span> {{ $apartment -> rooms_number }}
                    </li>
                    <li>
                        <span>Letti:</span> {{ $apartment -> beds_number }}
                    </li>
                    <li>
                        <span>Bagni:</span> {{ $apartment -> bathrooms_number }}
                    </li>
                    <li>
                        <span>mq:</span> {{ $apartment -> area }}
                    </li>
                </ul>

                <hr>

                <h2 class="servizi">Servizi:</h2>
                <ul class="flex-order">

                    <li>
                        @foreach ($apartment -> services as $service)

                        {{ $service -> name }}
                            
                        @endforeach
                    </li>

                </ul>
                

            </div>
        </div>
    </div>

   <div class="my-apartment">

        <div class="stats" id="stats">
            <div>

                <h1>Statistiche</h1>
                <canvas id="myChart" width="500px" height="200px"></canvas>

            </div>
        </div>

        <div class="messages">

            <h1>Messaggi ricevuti:</h1>

            <div class="received-msgs">

                {{-- foreach msg blabla --}}
                <div class="msg">

                    @foreach ($messages as $message)
                    <div class="msg-row">

                        <p>Hai un nuovo messaggio da: {{ $message -> email }} </p>
                        <p> {{ $message -> text }} </p>

                    </div>
                        
                    @endforeach
                    
                </div>
                
            </div>
        </div>
   </div>

</div>

<script>

    new Vue ({
        el: '#stats',
        data: {
            messages: {},
            statistics: {},
            months: '',
            years: '',
        },
        methods: {

            chartCreate: function (){

                let ctx = document.getElementById('myChart').getContext('2d');
                let myChart = new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: ['Gennaio', 'Febbraio', 'Marzo', 'Aprile', 'Maggio', 'Giugno', 'Luglio', 'Agosto', 'Settembre', 'Ottobre', 'Novembre', 'Dicembre'],
                        datasets: [{
                            label: '# of Visits',
                            data: this.statistics.year.month,
                            backgroundColor: [
                                'rgba(255, 99, 132, 0.2)',
                                'rgba(54, 162, 235, 0.2)',
                                'rgba(255, 206, 86, 0.2)',
                                'rgba(75, 192, 192, 0.2)',
                                'rgba(153, 102, 255, 0.2)',
                                'rgba(255, 159, 64, 0.2)'
                            ],
                            borderColor: [
                                'rgba(255, 99, 132, 1)',
                                'rgba(54, 162, 235, 1)',
                                'rgba(255, 206, 86, 1)',
                                'rgba(75, 192, 192, 1)',
                                'rgba(153, 102, 255, 1)',
                                'rgba(255, 159, 64, 1)'
                            ],
                            borderWidth: 1
                        }]
                    },
                    options: {
                        scales: {
                            y: {
                                beginAtZero: true
                            }
                        }
                    }
                });
            },

        },

        mounted(){

            axios.post('/api/getStatistics/' + {{$apartment -> id}})
            .then(res => {

                this.statistics = res.data;
                let statistics = [];

                if (!res.data.lenght) {

                    statistics = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, ]
                } else {

                    for (let x = 0; x < 12; x++) {

                        let month = (x + 1).toString();
                        
                        if (this.statistics['2021'][month]) {

                            statistics.push(this.statistics['2021'][month].length);
                        } else {

                            statistics.push(0);
                        }
                    }
                }

                this.statistics = statistics;
            });

            axios.post('/api/getMessages/' + {{$apartment -> id}})
            .then(res => {

                this.messages = res.data;
                let messages = [];

                if (!res.data.length) {

                    messages = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, ]
                } else {

                    for (let x = 0; x < 12; x++) {

                        let month = (x + 1).toString();
                        
                        if (this.messages['2021'][month]) {

                            messages.push(this.messages['2021'][month].length);
                        } else {

                            messages.push(0);
                        }
                    }
                }

                this.messages = messages;
            });
        }
    })

</script>
@endsection