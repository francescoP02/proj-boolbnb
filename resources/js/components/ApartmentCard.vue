<template>
    <div>
        <div class="card mb-3">
            <router-link :to="{ name: 'single-apartment', params: { slug: apartment.slug } }" class="card-link text-decoration-none">
                <div class="card-body">
                    <!-- image -->
                    <div class="img-wrap" v-if="apartment.image">
                        <img :src="apartment.image" alt="" />
                    </div>
    
                    <!-- text -->
                    <div class="_text">
                        <h5 class="_primary_color card-title text-start mt-3">{{ apartment.title }}</h5>
                        <p class="_primary_color text-start">{{ apartment.address }}</p>
                        <!-- <router-link :to="{ name: 'single-apartment', params: { slug: apartment.slug } }" class="card-link">View Details</router-link> -->
                    </div>
                </div>
            
            </router-link>

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

    ._text {
        
        h5 {
            font-weight: bold;
        }
    }

    .img-wrap {
        width: 100%;
        // overflow: hidden;
        height: fit-content;

        img {
            border-radius: 5%;
            height: 12vw;
        }


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
