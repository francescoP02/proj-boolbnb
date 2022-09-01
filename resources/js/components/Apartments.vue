<template>
    <div>
        <div class="row row-cols-4">
            <!-- Single apartemnt -->
            <div v-for="apartment in apartments" :key="apartment.id" class="col">
                <div class="card mb-3" style="width: 18rem;">
                        <!-- <img src="..." class="card-img-top" alt="..."> -->
                    <div class="card-body">
                        <h5 class="card-title">{{apartment.title}}</h5>
                        <p>{{apartment.address}}</p>
                    </div>
                </div>
            </div>

        </div>
    </div>
</template>

<script>
import Axios from 'axios';

export default {
    name: "Apartments",
    data() {
        return {
            apartments: [],
        }
    },
    created() {
        this.getApartments();
    },
    methods: {
        getApartments() {
            Axios.get("/api/apartments")
            .then(resp => {
                this.apartments = resp.data.results;
            })
        }
    },
}
</script>

<style>

</style>