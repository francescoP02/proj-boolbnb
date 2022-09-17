<template>
    <div>
        <form class="searchSection mb-3" action="">
            <div class="form-group">
                <div class="d-flex pt-1">
                    <input
                        type="text"
                        name="address"
                        placeholder="Where do you want to go?"
                        id="address"
                        v-model="addressSearched.address.freeformAddress"
                    />
                    <button
                        type="button"
                        class="btn ms-2"
                        id="filterButton"
                        @click="getFilter()"
                    >
                        Filter
                        <span id="angleDown"
                            ><i class="fas fa-angle-down"></i
                        ></span>
                    </button>
                    <button
                        type="button"
                        class="btn ms-2"
                        @click="searchAddress()"
                    >
                        Search
                    </button>
                </div>
                <div id="containerAddress" v-if="dropdownSearchFlag">
                    <select
                        name="addressOpt"
                        id="addressOpt"
                        class="form-select"
                        size="5"
                        v-model="addressSearched"
                        v-if="list"
                        @click="getApartments()"
                    >
                        <option
                            v-for="(addOp, index) in list"
                            :key="index"
                            :value="addOp"
                        >
                            {{ addOp.address.freeformAddress }}
                        </option>
                    </select>
                </div>
            </div>
        </form>

        <div class="mb-4 pb-2 px-3 d-none" id="filterSection">
            <div class="d-sm-flex justify-content-center">
                <div class="d-flex flex-column mx-sm-5">
                    <div class="mt-2">
                        <div class="fw-bold my-2">
                            <label for="roomsNumberSelector"
                                >Number of rooms</label
                            >
                        </div>
                        <select
                            name="roomsNumberSelector"
                            class="select-style"
                            id="roomsNumberSelector"
                            v-model="numberRooms"
                            @click="getApartments()"
                        >
                            <option v-for="i in 10" :key="i" :value="i">
                                {{ i }}
                            </option>
                        </select>
                    </div>

                    <div class="mt-2">
                        <div class="fw-bold my-2">
                            <label for="bedsNumberSelector"
                                >Number of beds</label
                            >
                        </div>
                        <select
                            name="bedsNumberSelector"
                            class="select-style"
                            id="bedsNumberSelector"
                            v-model="numberBeds"
                            @click="getApartments()"
                        >
                            <option v-for="i in 10" :key="i" :value="i">
                                {{ i }}
                            </option>
                        </select>
                    </div>
                </div>

                <div class="mx-sm-5 mt-sm-0 mt-3">
                    <div class="fw-bold my-2">Optionals</div>
                    <div
                        class="form-check"
                        v-for="optional in optionals"
                        :key="optional.id"
                    >
                        <input
                            class="form-check-input"
                            type="checkbox"
                            :value="optional.id"
                            :id="`check` + optional.name"
                            v-model="checkedOptionals"
                            @change="getApartments()"
                        />
                        <label
                            class="form-check-label"
                            :for="`check` + optional.name"
                        >
                            {{ optional.name }}
                        </label>
                    </div>
                </div>

                <div
                    class="rangeSelector align-self-center mx-sm-5 mt-sm-0 mt-3"
                    v-if="rangeSelectorFlag"
                >
                    <div>
                        <label for="distance" class="form-label fw-bold"
                            >Range distance:</label
                        >
                    </div>
                    <label for="distance" class="form-label"
                        >{{ distance }} km</label
                    >
                    <input
                        type="range"
                        class="form-range"
                        min="5"
                        max="35"
                        step="5"
                        id="distance"
                        v-model="distance"
                        @change="getApartments()"
                    />
                </div>
            </div>
        </div>

        <div class="position-relative mt-5" v-if="isSpNotEmpty()">
            <div class="sponsored-section-title">
                <span class="text-light fw-bold fs-5">Sponsored Apartment</span>
            </div>
            <div
                id="sponsoredSection"
                class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-xl-4 row-cols-xxl-5 pt-4 mb-4"
            >
                <div
                    v-for="apartment in apartmentsSp"
                    :key="apartment.id"
                    class="col"
                    v-if="apartment.visible"
                >
                    <router-link
                        v-if="logged"
                        :to="{
                            name: 'admin-single-apartment',
                            params: { slug: apartment.slug },
                        }"
                        class="card-link text-decoration-none"
                    >
                        <ApartmentCard :apartment="apartment" />
                    </router-link>

                    <router-link
                        v-else
                        :to="{
                            name: 'single-apartment',
                            params: { slug: apartment.slug },
                        }"
                        class="card-link text-decoration-none"
                    >
                        <ApartmentCard :apartment="apartment" />
                    </router-link>
                </div>
            </div>
        </div>

        <div
            class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-xl-4 row-cols-xxl-5"
        >
            <!-- Single apartemnt -->
            <div
                v-for="apartment in apartments"
                :key="apartment.id"
                class="col"
                v-if="apartment.visible"
            >
                <router-link
                    v-if="logged"
                    :to="{
                        name: 'admin-single-apartment',
                        params: { slug: apartment.slug },
                    }"
                    class="card-link text-decoration-none"
                >
                    <ApartmentCard :apartment="apartment" />
                </router-link>

                <router-link
                    v-else
                    :to="{
                        name: 'single-apartment',
                        params: { slug: apartment.slug },
                    }"
                    class="card-link text-decoration-none"
                >
                    <ApartmentCard :apartment="apartment" />
                </router-link>
            </div>
        </div>
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
    props: {
        logged: Boolean,
    },
    data() {
        return {
            apartments: null,
            apartmentsSp: null,
            optionals: [],
            numberRooms: 1,
            dropdownSearchFlag: false,
            rangeSelectorFlag: false,
            numberBeds: 1,
            checkedOptionals: [],
            latApt: 0,
            lonApt: 0,
            addressSearched: {
                address: {
                    freeformAddress: "",
                },
                position: {
                    lat: null,
                    lon: null,
                },
            },
            distance: 20,
            list: [],
        };
    },
    created() {
        this.getApartments();
        this.isSpNotEmpty();
    },

    methods: {
        isSpNotEmpty() {
            let flag = 0;
            if (this.apartmentsSp) {
                this.apartmentsSp.forEach((element) => {
                    if (element.visible) {
                        flag = 1;
                    }
                });
            }
            return flag;
        },
        getFilter() {
            const filterSection = document.getElementById("filterSection");
            const angleDown = document.getElementById("angleDown");
            filterSection.classList.toggle("d-none");
        },
        getApartments() {
            this.dropdownSearchFlag = false;
            Axios.get("/api/apartments", {
                params: {
                    rooms: this.numberRooms,
                    beds: this.numberBeds,
                    optionals: this.checkedOptionals,
                    lat: this.addressSearched.position.lat,
                    lon: this.addressSearched.position.lon,
                    dist: this.distance,
                },
            }).then((resp) => {
                console.log("normali", resp.data.results.apartments);
                console.log("premium", resp.data.results.sposoredApartments);
                this.apartments = resp.data.results.apartments;
                this.optionals = resp.data.results.optionals;
                this.apartmentsSp = resp.data.results.sposoredApartments;
                console.log(this.apartmentsSp);
            });
        },

        searchAddress() {
            if (this.addressSearched.address.freeformAddress.length >= 3) {
                this.dropdownSearchFlag = true;
                this.rangeSelectorFlag = true;
                const linkApi = `https://api.tomtom.com/search/2/geocode/${this.addressSearched.address.freeformAddress}.json?key=Rdcw2GVNiNQGXTWrgewGKq9cwtVYNPRw`;

                Axios.get(linkApi).then((resp) => {
                    const response = resp.data.results;
                    this.list = response;
                });
            } else {
                this.addressSearched.position.lat = null;
                this.addressSearched.position.lon = null;
                this.getApartments();
            }
        },
    },
};
</script>

<style scoped lang="scss">
.searchSection {
    #address {
        width: 100%;
        border: transparent;
        background-color: transparent;
        border-bottom: 2px solid lightgray;
        padding-left: 2%;
        &:focus-visible {
            border-bottom: 3px solid var(--primary-color);
            outline: transparent;
        }
    }
    #filterButton {
        width: 100px;
    }
    button {
        color: white;
        background-color: var(--secondary-color);
        transition: 0.2s;
        &:hover {
            background-color: rgba(255, 90, 95, 0.7);
            // background-color: rgba(7, 44, 97, 0.7);
        }
    }
}
#filterSection {
    color: var(--primary-color);
    border: 3px solid var(--primary-color);
    border-radius: 5px;

    select {
        border: 0.5px solid var(--primary-color);
        border-radius: 5px;

        .select-style {
            background-color: red;
        }
    }
}

#sponsoredSection {
    border: 3px solid var(--primary-color);
    border-radius: 10px;
}

.sponsored-section-title {
    background-color: var(--primary-color);
    position: absolute;
    top: -36px;
    padding: 5px 10px;
    border-radius: 10px 10px 0 0;
}
</style>
