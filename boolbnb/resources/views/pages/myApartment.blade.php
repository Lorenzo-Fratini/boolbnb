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
                <canvas id="statisticsChart" width="500px" height="200px"></canvas>
                <canvas id="messagesChart" width="500px" height="200px"></canvas>

                <select name="" id=""
                    v-on:change="selectYear">
                    <option
                        v-for="year in statisticsYears"
                        v-bind:value="year">@{{ year }}
                    </option>
                </select>

                </div>
            </div>

            <div class="messages">

                <h1>Messaggi ricevuti:</h1>

                <div class="received-msgs">

                    {{-- foreach msg blabla --}}
                    <div class="msg">


                        <p>Hai un nuovo messaggio da: {{ $message -> email }} </p>
                        <p> {{ $message -> text }} </p>

                        @foreach ($messages as $message)

                            <div class="msg-row">
                                <p class="new-msg-from">Hai un nuovo messaggio da: {{ $message->email }} </p>
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
                messages: {},
                statistics: {},
                months: '',
                years: '',
            },
            methods: {

    new Vue ({
        el: '#stats',
        data: {
            resStatistics: {},
            statisticsYears: [],
            resMessages: {},
            messagesYears: [],
            statisticsChart: '',
            messagesChart: '',
        },
        methods: {

            selectYear: function(event) {

                let year = event.target.value;

                let statistics = [];
                let parsedStatistics = JSON.parse(JSON.stringify(this.resStatistics));

                if (!this.resStatistics) {

                    statistics = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0]
                } else {

                    for (let x = 0; x < 12; x++) {

                        let month = (x + 1).toString();
                        
                        if (parsedStatistics[year][month]) {

                            statistics.push(parsedStatistics[year][month].length);
                        } else {

                            statistics.push(0);
                        }
                    }
                }

                // update dei grafici con l'anno selezionato dall'utente
                this.statisticsChart.data.datasets[0].data = statistics;
                this.statisticsChart.update();

                
                let messages = [];
                let parsedMessages = JSON.parse(JSON.stringify(this.resMessages));

                if (!this.resStatistics || !parsedMessages[year]) {

                    messages = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0]
                } else {

                    for (let x = 0; x < 12; x++) {

                        let month = (x + 1).toString();
                        
                        if (parsedMessages[year][month]) {

                            messages.push(parsedMessages[year][month].length);
                        } else {

                            messages.push(0);
                        }
                    }
                }

                // update dei grafici con l'anno selezionato dall'utente
                this.messagesChart.data.datasets[0].data = messages;
                this.messagesChart.update();
            },
        },

        mounted(){

            // GET STATISTICS ///////////////////////////////

            axios.post('/api/getStatistics/' + {{ $apartment -> id }})
            .then(res => {

                this.resStatistics = res.data;
                let parsedStatistics = JSON.parse(JSON.stringify(this.resStatistics));
                let currentYear = new Date().getFullYear();
                

                // prendiamo tutti gli anni delle statistiche
                let statisticsYears = []

                Object.keys(this.resStatistics).forEach(year => {

                    statisticsYears.push(year);
                });

                this.statisticsYears = statisticsYears.reverse();


                // preparazione dati per grafico
                let statistics = [];

                if (!this.resStatistics) {

                    statistics = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0]
                } else {

                    for (let x = 0; x < 12; x++) {

                        let month = (x + 1).toString();
                        
                        if (parsedStatistics[currentYear][month]) {

                            statistics.push(parsedStatistics[currentYear][month].length);
                        } else {

                            statistics.push(0);
                        }
                    }
                }


                // creazione del grafico
                let ctx = document.getElementById('statisticsChart').getContext('2d');
                this.statisticsChart = new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: ['Gennaio', 'Febbraio', 'Marzo', 'Aprile', 'Maggio', 'Giugno', 'Luglio', 'Agosto', 'Settembre', 'Ottobre', 'Novembre', 'Dicembre'],
                        datasets: [{
                            label: 'Visite',
                            data: statistics,
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
                                max: 5,
                                suggestedMax: 50,
                            }
                        }
                    }
                });
            });


            // GET MESSAGES ///////////////////////////////
            axios.post('/api/getMessages/' + {{ $apartment -> id }})
            .then(res => {

                this.resMessages = res.data;
                let parsedMessages = JSON.parse(JSON.stringify(this.resMessages));
                let currentYear = new Date().getFullYear();


                // prendiamo tutti gli anni dei messaggi
                let messagesYears = []

                Object.keys(this.resStatistics).forEach(year => {

                    messagesYears.push(year);
                });

                this.messagesYears = messagesYears.reverse();


                // preparazione dati per grafico
                let messages = [];

                if (!this.resMessages) {
                    
                    messages = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0]
                } else {

                                let month = (x + 1).toString();

                        let month = (x + 1).toString();

                        if (parsedMessages[currentYear][month]) {

                            messages.push(parsedMessages[currentYear][month].length);
                        } else {

                            messages.push(0);
                        }


                // creazione del grafico
                let ctx = document.getElementById('messagesChart').getContext('2d');
                this.messagesChart = new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: ['Gennaio', 'Febbraio', 'Marzo', 'Aprile', 'Maggio', 'Giugno', 'Luglio', 'Agosto', 'Settembre', 'Ottobre', 'Novembre', 'Dicembre'],
                        datasets: [{
                            label: 'Visite',
                            data: messages,
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
                                max: 5,
                                suggestedMax: 50,
                            }
                        }
                    }
                }); // chiudono chart
            }); // chiudono then
            
        }
    })

</script>
@endsection

{{-- creazione unico array per anni --}}
