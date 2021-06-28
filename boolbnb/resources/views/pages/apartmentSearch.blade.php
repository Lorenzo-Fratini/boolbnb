@extends('layouts.main-layout')

@section('content')
    <main>
        <div id="search">

            {{-- servizi --}}
            <div class="box-service">
                <div style="display:flex">
                    <div v-for="service in allServices" class="my-services">
                        <input v-on:change="filterApartments" type="checkbox" :name="service.name" :value="service.id" v-model="filterServices">
                        <label for="" style="margin-right:10px">@{{ service.name }}</label>
                    </div>
                </div>

                <div>
                    <label for="rooms">Rooms</label>
                    <input v-on:change="filterApartments" type="number" name="rooms" id="rooms" v-model="rooms">
                    
                    <label for="beds">Beds</label>
                    <input v-on:change="filterApartments" type="number" name="beds" id="beds" v-model="beds">
                </div>
            </div>

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

                allApartments: [],
                currentApartments: [],
                allServices: [],
                filterServices: [],
                filterData: [],
                testtomtomapi: [],
                coord: [],
                lat: 0,
                lon: 0,
                beds: '1',
                rooms: '1',
            },

            methods: {

                filterApartments: function() {

                const searchString = new URL(location.href).searchParams.get('searchString');
                let bedsRooms = [];
                bedsRooms.push(this.beds, this.rooms);
                

                if (this.filterServices.length > 0) {
                    
                    axios.post('/api/filterApartments/' + searchString + '/' + this.filterServices + '/' + bedsRooms) 
                    .then(res => {

                        this.currentApartments = res.data;
                        //console.log(res.data);
                        this.getMap(searchString)
                    });


                } else {

                    let filterServices = 'noServices';

                    axios.post('/api/filterApartments/' + searchString + '/' + filterServices + '/' + bedsRooms) 
                    .then(res => {

                        this.currentApartments = res.data;
                        //console.log(res.data);
                        this.getMap(searchString)
                    });

                }

                
                },

                getMap: function(searchString){

                console.log('hello');

                // TOM TOM 
                axios.get('https://api.tomtom.com/search/2/geocode/%20' + searchString + '%20it.JSON?key=e221oCcENGoXZRDyweSTg7PnYGiEXO82', {headers:''})
                .then(res => {

                    this.testtomtomapi = res.data.results[0];

                    this.lat = this.testtomtomapi.position.lat;
                    this.lon = this.testtomtomapi.position.lon;
                
                    
                    // Tom Tom Map

                    //console.log(this.lat, this.lon);

                    var APIKEY = "XPOiPra9khmu2grECjX15gw5Cdy98fSX"
                    var CITY = [this.lon, this.lat] // [longitudine, latitudine]
                    //var ROMA1 = [12.48536, 41.88697]
                
                
                    var map = tt.map({
                        key: APIKEY,
                        container: 'mymap',
                        center: CITY,
                        zoom: 11,
                        style: 'tomtom://vector/1/basic-main'
                    });


                    // Bandiere + popup Appartamenti su mappa
                    for(i=0; i<this.currentApartments.length; i++){

                        var appLatLon = [ this.currentApartments[i].longitude, this.currentApartments[i].latitude]
                        var appTitle = [this.currentApartments[i].title]
                        var appAddress = [this.currentApartments[i].address]

                        //console.log(this.allApartments);
                        console.log(this.currentApartments);

                        var marker1 = new tt.Marker().setLngLat(appLatLon).addTo(map);

                        var popup = new tt.Popup({offset: popupOffsets}).setHTML("<strong>" + this.currentApartments[i].title + "</strong>" + "<br>" + this.currentApartments[i].address);
                        marker1.setPopup(popup).togglePopup();

                    }

                    // bandiere su mappa
                    // var marker = new tt.Marker().setLngLat(CITY).addTo(map);
                

                    var popupOffsets = {
                        top: [0, 0],
                        bottom: [0, -70],
                        'bottom-right': [0, -70],
                        'bottom-left': [0, -70],
                        left: [25, -35],
                        right: [-25, -35]
                    }
                    
                    // popup nomi appartamenti
                    // var popup = new tt.Popup({offset: popupOffsets}).setHTML("CITY");
                    // marker.setPopup(popup).togglePopup();
                    


                    //controlli mappa    
                    map.addControl(new tt.NavigationControl());

                });

                }

            },

            mounted() {


            const searchString = new URL(location.href).searchParams.get('searchString');

            axios.get('/api/getApartments/' + searchString)
                .then(res => {

                    this.allApartments = res.data;
                    this.currentApartments = this.allApartments;
                    // console.log(this.currentApartments, this.allApartments);

                    this.getMap(searchString)

                });

            axios.get('/api/getServices/')
                .then(res => {

                    this.allServices = res.data;
            });



            }, // fine Mounted()

            /* computed: {

                gethref: function() {
                    return '/apartment/' + this.filterServices
                }
            }, */
            
        });

    </script>

@endsection
