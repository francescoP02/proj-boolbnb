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
                        <div class="test">
                            <span class="d-block">Beds number: {{apartment.beds_number}}</span>
                            <span class="d-block">Rooms number: {{apartment.rooms_number}}</span>
                        </div>
                        <div v-if="apartment.image">
                            <img :src="apartment.image" alt="" />
                        </div>
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

<style scoped lang="scss">

    img {
        width: 100%;
    }

</style>