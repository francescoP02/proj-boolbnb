<template>
    <div>
        <div class="card mb-3">
            <div class="card">
                <!-- image -->
                <div class="_img_wrap" v-if="apartment.image">
                    <img :src="apartment.image" alt="" />
                </div>

                <!-- text -->
                <div class="_text">
                    <h5 class="_primary_color card-title text-start mt-3">
                        {{ apartment.title }}
                    </h5>
                    <p class="_primary_color text-start">
                        {{ apartment.address }}
                    </p>
                </div>
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

    // ._img_wrap {
    //     width: 100%;
    //     // overflow: hidden;
    //     height: fit-content;

    //     img {
    //         border-radius: 5%;
    //         border-radius: 5%;
    //         height: 180px;
    //         object-fit: cover;
    //     }

    //     span {
    //         color: white;
    //         margin-right: 15px;
    //         font-size: 2rem;
    //         text-shadow: 1px 1px 5px black;
    //         cursor: pointer;
    //     }
    // }
}

// Responsive
// @media screen and (max-width: 768px) {
//     ._img_wrap {
//         img {
//             height: 25vw;
//         }
//     }
// }
</style>
