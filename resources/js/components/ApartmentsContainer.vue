<template>
     <div>
        <form class="mb-3" action="">
            <div class="form-group">
                <input type="text" class="form-control" name="address" placeholder="Dove vuoi andare?" id="address" v-model="addressSearched">
                <button type="button" @click="searchAddress()">Cerca</button>
                <div class="d-none" id="containerAddress">
                    <select name="addressOpt" id="addressOpt" class="form-select">
                    </select>
                </div>
                <div class="">
                    <input type="text" id="latApart">
                    <input type="text" id="lonApart" v-bind="lonApt" />
                </div>
            </div>
        </form>

        <div class="d-flex filter-section text-start mb-4 pb-2 ps-3">
            <div>
                <div class="fw-bold my-2">
                    <label for="roomsNumberSelector">Number of rooms</label>
                </div>
                <select name="roomsNumberSelector" class="select-style" id="roomsNumberSelector" v-model="numberRooms" @click="getApartments()">
                    <option v-for="i in 10" :key="i" :value="i">{{i}}</option>
                </select>

                <div class="fw-bold my-2">
                    <label for="bedsNumberSelector">Number of beds</label>
                </div>
                <select name="bedsNumberSelector" class="select-style" id="bedsNumberSelector" v-model="numberBeds" @click="getApartments()">
                    <option v-for="i in 10" :key="i" :value="i">{{i}}</option>
                </select>
            </div>
        
            <div class="ms-4">
                <div class="fw-bold my-2">Optionals</div>
                <div class="form-check" v-for="optional in optionals" :key="optional.id">
                    <input class="form-check-input" type="checkbox" :value="optional.id" :id="`check` + optional.name" v-model="checkedOptionals" @change="getApartments()">
                    <label class="form-check-label" :for="`check` + optional.name">
                        {{optional.name}}
                    </label>
                </div>
            </div>
              
        </div>
        
        <div class="row row-cols-4">
            <!-- Single apartemnt -->
            <div v-for="apartment in apartments" :key="apartment.id" class="col">
                <ApartmentCard :apartment="apartment" />
                <p>{{apartment.distance}}</p>
            </div>
        </div>

        <!-- <nav aria-label="...">
            <ul class="pagination">
                <li class="page-item" :class="{ disabled: currentPage === 1 }">
                    <a
                        @click="getApartments(currentPage - 1)"
                        class="page-link"
                        href="#"
                        tabindex="-1"
                        >Previous</a
                    >
                </li>
                <li
                    v-for="n in lastPage"
                    :key="n"
                    class="page-item"
                    :class="{ active: currentPage === n }"
                >
                    <a @click="getApartments(n)" class="page-link" href="#">{{
                        n
                    }}</a>
                </li>
                <li
                    class="page-item"
                    :class="{ disabled: currentPage === lastPage }"
                >
                    <a
                        @click="getApartments(currentPage + 1)"
                        class="page-link"
                        href="#"
                        >Next</a
                    >
                </li>
            </ul>
        </nav> -->

    </div>
</template>

<script>
import Axios from "axios";
import ApartmentCard from "./ApartmentCard.vue";

export default {
    name: "ApartmentsContainer",
    components: {
        ApartmentCard,
    },
    data() {
        return {
            apartments: null,
            optionals: [],
            // currentPage: 1,
            // lastPage: 0,
            numberRooms: 1,
            numberBeds: 1,
            checkedOptionals: [],
            addressSearched: "",
            latApt: "",
            lonApt: "",
            distance: 20,
            // totalApartments: 0,
        };
    },
    created() {
        this.getApartments();
    },
    methods: {
        getApartments() {
            Axios.get("/api/apartments", {
                params: {
                    // page: nPage,
                    rooms: this.numberRooms,
                    beds: this.numberBeds,
                    optionals: this.checkedOptionals,
                    lat: this.latApt,
                    lon: this.lonApt,
                    dist: this.distance,
                },
            }).then((resp) => {
                console.log(resp.data.results.apartments);
                this.apartments = resp.data.results.apartments;
                // this.currentPage = resp.data.results.apartments.current_page;
                // this.lastPage = resp.data.results.apartments.last_page;
                this.optionals = resp.data.results.optionals;

                // this.totalApartments = resp.data.results.total;
            });
        },

        searchAddress() {            
            let divContainer = document.getElementById('containerAddress');    
            if (this.addressSearched.length >= 3) {            
                divContainer.classList.remove('d-none');

                const linkApi = `https://api.tomtom.com/search/2/geocode/${this.addressSearched}.json?key=Rdcw2GVNiNQGXTWrgewGKq9cwtVYNPRw`;

                Axios.get(linkApi).then(resp => {
                    const response = resp.data.results;

                    // console.log("response");

                    document.getElementById('address').innerHTML = "";

                    if (response.length == 0) {
                    
                        const nullElement = document.createElement('option');
                        nullElement.innerHTML = "No location found";
                        // nullElement.value = "";
                        nullElement.setAttribute("disabled","");
                        document.getElementById('address').setAttribute("size","2");
                        document.getElementById('address').append(nullElement);
                    
                    
                    } else {

                        response.forEach(element => {
                            
                            const addressElement = document.createElement('option');
                            document.getElementById('addressOpt').append(addressElement);
                            document.getElementById('addressOpt').setAttribute("size","5");
                            addressElement.classList.add('address-result');
                            addressElement.innerHTML = element.address.freeformAddress;
                            addressElement.value = element.address.freeformAddress;
            
                            addressElement.addEventListener('click', function () {
                                divContainer.classList.add('d-none');
                                document.getElementById('latApart').value = element.position.lon;
                                document.getElementById('lonApart').value = element.position.lat;      
                                document.getElementById('address').value = element.address.freeformAddress;
                            })
                            
                        })

                    }
                })
            } else {
                divContainer.classList.add('d-none');
            }
            
        }
    }
}
</script>

<style scoped lang="scss">
    .filter-section {
        color: #072c61;
        border: 2px solid #072c61;
        border-radius: 5px;

        select {
            border: .5px solid #072c61;
            border-radius: 5px;

            .select-style {
                background-color: red;
            }
        }
    }
</style>
