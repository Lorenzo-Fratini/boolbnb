@extends('layouts.main-layout')

@section('content')

    <div class="container-flat">

        <div class="flat-description margins">
            <h1> {{ $apartment->title }} </h1>
            <h2> {{ $apartment->address }} | {{ $apartment->city }}</h2>
        </div>

        <div class="flat-block margins">

            <div class="flat-img">
                {{-- <span>Qui dentro ci va l'immagine principale</span> --}}
                <img src="{{ asset('/storage/images/' . $apartment->cover_image) }}" alt="">
            </div>

            <div class="container-text">
                <div class="flat-text" id="flat-text-id">
                    <h2>Descrizione</h2>
                    <span> {{ $apartment->description }} </span>
                    {{-- <span>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Iusto molestiae distinctio modi, quasi maxime, at ex repellendus suscipit sed aut ad non, iste vitae cumque illo ea similique et inventore.</span> --}}

                    <hr>

                    <ul>
                        <li>
                            <span>Stanze:</span> {{ $apartment->rooms_number }}
                        </li>
                        <li>
                            <span>Letti:</span> {{ $apartment->beds_number }}
                        </li>
                        <li>
                            <span>Bagni:</span> {{ $apartment->bathrooms_number }}
                        </li>
                        <li>
                            <span>mq:</span> {{ $apartment->area }}
                        </li>
                    </ul>

                    <hr>

                    <h2 class="servizi">Servizi:</h2>
                    <ul class="flex-order">

                        <li>
                            @foreach ($apartment->services as $service)

                                {{ $service->name }}

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

                    <select name="" id="" v-on:change="updateChart" v-model="selectedYear">
                        <option v-for="year in totalYears" v-bind:value="year">
                            @{{ year }}

                        </option>
                    </select>

                    <canvas id="statisticsChart" width="500px" height="200px"></canvas>
                    <canvas id="messagesChart" width="500px" height="200px"></canvas>
                </div>
            </div>

            <div class="messages">

                <h1>Messaggi ricevuti:</h1>

                <div class="received-msgs">

                    {{-- foreach msg blabla --}}
                    <div class="msg">

                        @foreach ($messages as $message)
                            <div class="msg-row">

                                <p>Hai un nuovo messaggio da: {{ $message->email }} </p>
                                <p> {{ $message->text }} </p>

                            </div>

                        @endforeach

                    </div>

                </div>
            </div>
        </div>

    </div>

    <script>
        new Vue({
            el: '#stats',
            data: {

                statisticsChart: [],
                messagesChart: [],

                totalYears: [
                    '2019',
                    '2020',
                    '2021',
                ],

                selectedYear: new Date().getFullYear(),
            },
            methods: {

                getChartData: function() {

                    const year = this.selectedYear.toString();

                    axios.post('/api/getChartData/' + '{{ $apartment->id }}' + '/' + year)
                        .then(res => {


                            this.createChart(res.data['statistics'], 'statisticsChart', 'Statistiche', 0);
                            this.createChart(res.data['messages'], 'messagesChart', 'Messaggi', 1);
                        });
                },

                updateChart: function() {

                    const year = this.selectedYear.toString();

                    axios.post('/api/getChartData/' + '{{ $apartment->id }}' + '/' + year)
                        .then(res => {

                            this.statisticsChart.data.datasets[0].data = res.data['statistics'];
                            this.statisticsChart.update();

                            this.messagesChart.data.datasets[0].data = res.data['messages'];
                            this.messagesChart.update();
                        });
                },

                createChart: function(chartData, divId, chartLabel, param) {

                    let ctx = document.getElementById(divId).getContext('2d');
                    let myChart = new Chart(ctx, {
                        type: 'bar',
                        data: {
                            labels: ['Gennaio', 'Febbraio', 'Marzo', 'Aprile', 'Maggio', 'Giugno',
                                'Luglio', 'Agosto', 'Settembre', 'Ottobre', 'Novembre', 'Dicembre'
                            ],
                            datasets: [{
                                label: chartLabel,
                                data: chartData,
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
                                    suggestedMin: 0,
                                    max: 10,
                                    suggestedMax: 50,
                                }
                            }
                        }
                    });


                    if (param == 0) {

                        this.statisticsChart = myChart;
                    } else {

                        this.messagesChart = myChart;
                    }
                },

            },

            mounted() {

                this.getChartData();
            }
        })
    </script>
@endsection
