<template>
    <div>
        <div class="row row-cols-4">
            <div
                v-for="apartment in apartments"
                :key="apartment.id"
                class="col"
            >
                <ApartmentCard :apartment="apartment" />
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

        <div>
            <label for="roomsNumberSelector">Number of rooms</label>
            <select
                name="roomsNumberSelector"
                id="roomsNumberSelector"
                v-model="numberRooms"
                @click="getApartments()"
            >
                <option v-for="i in 10" :key="i" :value="i">{{ i }}</option>
            </select>
        </div>

        <div>
            <label for="bedsNumberSelector">Number of beds</label>
            <select
                name="bedsNumberSelector"
                id="bedsNumberSelector"
                v-model="numberBeds"
                @click="getApartments()"
            >
                <option v-for="i in 10" :key="i" :value="i">{{ i }}</option>
            </select>
        </div>

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
            <label class="form-check-label" :for="`check` + optional.name">
                {{ optional.name }}
            </label>
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
    data() {
        return {
            apartments: null,
            optionals: [],
            // currentPage: 1,
            // lastPage: 0,
            numberRooms: 1,
            numberBeds: 1,
            checkedOptionals: [],
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
    },
};
</script>

<style scoped lang="scss"></style>
