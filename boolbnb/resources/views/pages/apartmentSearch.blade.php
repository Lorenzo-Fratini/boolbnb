@extends('layouts.main-layout')

@section('content')
    <main>
        <div id="search">

            {{-- servizi --}}
            <div class="box-service">
                <form action="#">
                    <div v-for="service in allServices" class="my-services">
                        <input v-on:change="sendServices" type="checkbox" :name="service.name" :value="service.id" v-model="filterServices">
                        <label for="" style="margin-right:10px">@{{ service.name }}</label>
                    </div>
                </form>
            </div>

            <div class="box-app-map">
                {{-- appartamenti --}}
                <div class="my-apartments">
                    <p v-for="apartment in apartments">
                                   @{{ apartment.title }}   <br>
                        Indirizzo: @{{ apartment.address }} <br>
                        Città:     @{{ apartment.city }}
                    </p>
                </div>
                    {{-- tom tom map --}}
                <div id="map" class="box-map">
                    <div id="mymap">
                        Tom Tom Map
                    </div>
                </div>
    
            </div>        
        </div>
            
        
    </main>

    <script>

    
            new Vue({

                el: '#search',

                data: {

                    apartments: [],
                    allServices: [],
                    filterServices: []
                    
                },

                methods: {

                    sendServices: function(){
                        axios.get('/api/filterApartments/' + filterServices)
                        .then(res => {

                            this.apartments = res.data;
                            // console.log(res.data);
                        });
                    }
                
                },

                mounted() {

                    let searchString = new URL(location.href).searchParams.get('searchString');

                    console.log(searchString);

                    axios.get('/api/getApartments/' + searchString)
                        .then(res => {

                            this.apartments = res.data;  // inserisco appartamenti in array x portarmeli in pagina
                            // console.log(res.data);
                        });

                    axios.get('/api/getServices/')
                        .then(res => {

                            this.allServices = res.data;   // inserisco servizi in array x portarmeli in pagina
                            // console.log(res.data);
                        });
                }
            });

            // Tom Tom Map

            var APIKEY = "XPOiPra9khmu2grECjX15gw5Cdy98fSX"
            //var MADRID = [-3.703790,40.416775]
            //var LISBONA = [-3.703790,40.416775]
            var ROMA = [12.62456,41.86756]

            var map = tt.map({
                key: APIKEY,
                container: 'mymap',
                //center: MADRID,
                center: ROMA,
                zoom: 10,
            style: 'tomtom://vector/1/basic-main'
    });

    var search = function(){

    }
        
    </script>

@endsection
