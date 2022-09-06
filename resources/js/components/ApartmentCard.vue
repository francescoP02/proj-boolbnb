<template>
    <div>
        <div class="card mb-3">
            <div class="card-body">
                <!-- <div class="test">
                    <span class="d-block"
                    >Beds number: {{ apartment.beds_number }}</span
                    >
                    <span class="d-block"
                    >Rooms number: {{ apartment.rooms_number }}</span
                    >
                </div> -->
                <div class="img-wrap" v-if="apartment.image">
                    <img :src="apartment.image" alt="" />
                </div>
                <h5 class="card-title text-start mt-2">{{ apartment.title }}</h5>
                <p class="text-start">{{ apartment.address }}</p>
                <router-link :to="{ name: 'single-apartment', params: { slug: apartment.slug } }" class="card-link">View Details</router-link>
                <!-- <div>
                    Optional:
                    <span
                        v-for="optional in apartment.optionals"
                        :key="optional.id"
                    >
                        {{ optional.name }}</span\
                    >
                </div> -->
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "ApartmentCard",
    props: {
        apartment: Object,
    },
};
</script>

<style scoped lang="scss">
img {
    width: 100%;
    height: 200px;
}

.card {
        border: transparent;
        background-color: transparent;
        color: #072c61;

        h5 {
            font-weight: bold;
        }
        .img-wrap {
            width: 100%;
            border-radius: 5%;
            overflow: hidden;
            // height: 15vw;
            // background-image: url('https://a0.muscache.com/im/pictures/miso/Hosting-610511843622686196/original/253bfa1e-8c53-4dc0-a3af-0a75728c0708.jpeg?im_w=720');
            // background-size: cover;
            // background-position: center;


            span {
                color: white;
                margin-right: 15px;
                font-size: 2rem;
                text-shadow: 1px 1px 5px black;
                cursor: pointer;
            }
        }
    }
</style>
