@extends('layouts.main-layout')

@section('content')
    <main>
        <div id="search">

            {{-- servizi --}}
            <div class="box-service">
                <div style="display:flex">
                    <div v-for="service in allServices" class="my-services">
                        <input v-on:change="sendServices" type="checkbox" :name="service.name" :value="service.id" v-model="filterServices">
                        <label for="" style="margin-right:10px">@{{ service.name }}</label>
                    </div>
                </div>

                <div>
                    <label for="beds">Beds</label>
                    <input v-on:change="sendBedsRooms" type="number" name="beds" id="beds" v-model="beds">

                    <label for="rooms">Rooms</label>
                    <input v-on:change="sendBedsRooms" type="number" name="rooms" id="rooms" v-model="rooms">
                </div>
            </div>

{{--             <a :href="gethref">aaaaaaa</a>
 --}}
            {{-- appartamenti --}}
            <div class="box-app-map">
                <div class="my-apartments">
                    <p v-for="apartment in currentApartments" style="margin: 20px 0 0 0">
                        @{{ apartment.title }} - [@{{ apartment.id }}]
                        <br>
                        @{{ apartment.address}}
                    </p>
                </div>
                {{-- tom tom --}}
                {{-- <div id="map" class="box-map">
                    <div id="mymap">
                        Tom Tom Map
                    </div>
                </div> --}}
            </div>
        </div>

        
            
    </main>

    <script>
        new Vue({

            el: '#search',

            data: {

                allApartments: [],
                currentApartments: [],
                allServices: [],
                filterServices: [],
                filterData: [],
                beds: '1',
                rooms: '1',
            },

            methods: {

                sendServices: function() {
                console.log(this.filterServices);

                    const searchString = new URL(location.href).searchParams.get('searchString');

                    // console.log(this.filterData);
                    if (this.filterServices.length > 0) {

                        axios.post('/api/filterApartments/' + searchString + '/' + this.filterServices) 
                        .then(res => {
    
                            this.currentApartments = res.data;
                        });
                    } else {

                        this.currentApartments = this.allApartments;
                        console.log(this.currentApartments);
                    }
                },

                sendBedsRooms: function() {

                    console.log(this.beds, this.rooms);
                    const searchString = new URL(location.href).searchParams.get('searchString');
                    let bedsRooms = [];
                    bedsRooms.push(this.beds, this.rooms);

                    axios.post('/api/filterBedsRooms/' + searchString + '/' + bedsRooms)
                    .then(res => {
                        
                        // console.log(res.data);
                        this.currentApartments = res.data;

                    })
                }
            },

            mounted() {

                const searchString = new URL(location.href).searchParams.get('searchString');

                axios.get('/api/getApartments/' + searchString)
                    .then(res => {

                        this.allApartments = res.data;
                        this.currentApartments = this.allApartments;
                        // console.log(this.currentApartments, this.allApartments);
                    });

                axios.get('/api/getServices/')
                    .then(res => {

                        this.allServices = res.data;
                });

                axios.get('https://api.tomtom.com/search/2/geocode/via%20roma%20codognè%2031013%20it.JSON?key=e221oCcENGoXZRDyweSTg7PnYGiEXO82', {headers: ''})
                    .then(res => {

                        // console.log(res);
                });
            },

            /* computed: {

                gethref: function() {
                    return '/apartment/' + this.filterServices
                }
            }, */
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
    </script>

@endsection
