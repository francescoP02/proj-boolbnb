<template>
    <div>
        <h1>{{apartment.title}}</h1>

        <div class="img-wrap" v-if="apartment.image">
            <img :src=" `storage/` + apartment.image " alt="" />
        </div>

        <p class="">{{ apartment.address }}</p>


        <div class="mb-4">
            <h5>Optionals:</h5>
            <span v-for="optional in apartment.optionals" :key="optional.id" class="badge rounded-pill bg-warning text-dark mr-3 p-1">{{ optional.name }}</span>
        </div>

        <div class="img-container">
            <span class="span-img"><i class="fa-solid fa-location-dot"></i></span>
            <img :src="`https://api.tomtom.com/map/1/staticimage?key=Rdcw2GVNiNQGXTWrgewGKq9cwtVYNPRw&zoom=15&center=${apartment.longitude},${apartment.latitude}&format=jpg&layer=basic&style=main&width=400&height=300`" alt="">
        </div>

    </div>
</template>

<script>
import Axios from 'axios';

export default {
    name: 'SingleApartment',
    data() {
        return {
            apartment: Object, 
        };
    },
    created() {
        this.getApartmentDetails();
    },
    computed: {
        optionalName() {
            return this.apartment.optional ? this.apartment.optional.name : "nessuna";
        }
    },
    methods: {
            getApartmentDetails() {
                const slug = this.$route.params.slug;
                
                Axios.get(`/api/apartments/${slug}`).then((resp) => {
                    if (resp.data.success) {
                        this.apartment = resp.data.results;
                    } else {
                        this.$router.push({ name: "not-found" });
                    }
                });
            },
        }
}
</script>

<style scoped lang="scss">

    .img-container {
        position: relative;

        .span-img {
            color: #ff5e64;
            position:absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%,-50%);
        }
    }
</style>