<template>
    <div>
        <div class="row row-cols-4">
            <!-- Single apartemnt -->
            <div v-for="apartment in apartments" :key="apartment.id" class="col">
                <ApartmentCard :apartment="apartment" />
            </div>
        </div>


        <nav aria-label="...">
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
        </nav>


    </div>
</template>

<script>
import Axios from 'axios';
import ApartmentCard from './ApartmentCard.vue';

export default {
    name: "ApartmentsContainer",
    components: {
        ApartmentCard,
    },
    data() {
        return {
            apartments: [],
            currentPage: 1,
            lastPage: 0,
            // totalApartments: 0,
        }
    },
    created() {
        this.getApartments(1);
    },
    methods: {
        getApartments(nPage) {
            Axios.get("/api/apartments", {
                params: {
                    page: nPage,
                }
            })
            .then(resp => {
                this.apartments = resp.data.results.data;
                this.currentPage = resp.data.results.current_page;
                this.lastPage = resp.data.results.last_page;
                // this.totalApartments = resp.data.results.total;
            })
        }
    },
}
</script>

<style scoped lang="scss">
</style>