<template>
    <div class="text-start">
        <h1>{{apartment.title}}</h1>
        <p class="">{{ apartment.address }}</p>

        <div class="d-flex">
            <div class="img-wrap-single-apt" v-if="apartment.image">
                <img :src=" `storage/` + apartment.image " alt="" />
            </div>
            <div id="info-box" class="ms-3">
                <p>Number of rooms: <span class="fw-bold">{{ apartment.rooms_number }} </span><i class="fas fa-door-open"></i></p>
                <p>Number of beds: <span class="fw-bold">{{ apartment.beds_number }} </span><i class="fas fa-bed"></i></p>
                <p>Number of bathroom: <span class="fw-bold">{{ apartment.bathroom_number }} </span><i class="fas fa-bath"></i></p>
                <p>Square metres: <span class="fw-bold">{{ apartment.square_metres }} m²</span></p>
                <p>inserito da: <span class="fw-bold">{{ apartment.square_metres }} m²</span></p>
                <button id="_book_button" class="btn text-white" type="button">Book</button>
            </div>
        </div>



        <div class="my-4">
            <h4>You will find</h4>
            <span v-for="optional in apartment.optionals" :key="optional.id" class="me-2 d-inline-block rounded-pill text-dark mr-3 p-1 fs-4">
                <span v-if="optional.id == 1"><i class="fas fa-wifi"></i></span>
                <span v-if="optional.id == 2"><i class="fas fa-swimmer"></i></span>
                <span v-if="optional.id == 3"><i class="fas fa-spa"></i></span>
                <span v-if="optional.id == 4"><i class="fas fa-water"></i></span>
                <span v-if="optional.id == 5"><i class="fas fa-dog"></i></span>
                <span>{{ optional.name }} | </span>
            </span>
        </div>

        <hr class="my-4">

        <div class="img-container">
            <h4>Where you will be</h4>
            <span class="span-img"><i class="fa-solid fa-location-dot fs-1"></i></span>
            <img :src="`https://api.tomtom.com/map/1/staticimage?key=Rdcw2GVNiNQGXTWrgewGKq9cwtVYNPRw&zoom=14&center=${apartment.longitude},${apartment.latitude}&format=jpg&layer=basic&style=main&width=1200&height=400`" alt="">
        </div>

        <hr class="my-4">

        <!-- <router-link :to="{ name: 'contact-single-apartment', params: { slug: apartment.slug } }" class="btn btn-primary">Contact</router-link> -->

        <div>
        <form class="row g-3">
            <div class="col-md-6">
                <label class="form-label" for="name">Name(*):</label>
                <input class="form-control" type="text" id="name" name="name" v-model="messageForm.name" required>
            </div>
            <div class="col-md-6">
                <label class="form-label" for="surname">Surname(*):</label>
                <input class="form-control" type="text" id="surname" name="surname" v-model="messageForm.surname" required>
            </div>
            <div class="col-md-12">
                <label class="form-label" for="email">Email(*):</label>
                <input class="form-control" type="email" id="email" name="email" v-model="messageForm.email" required>
            </div>
            <div class="col-md-12">
                <label class="form-label" for="message">Message(*):</label>
                <textarea class="form-control" name="message" id="message" cols="30" rows="10" v-model="messageForm.text" required></textarea>
            </div>
            <div class="col-12">
                <button @click="sendMail()" class="btn btn-primary" type="button">Submit form</button>
            </div>
        </form>
    </div>

        <!-- <a href="{{route('messages.create')}}">Contact</a> -->

    </div>
</template>

<script>
import Axios from 'axios';
// import ContactPage from './ContactPage.vue';

export default {
    name: 'SingleApartment',
    // components: {
    //     ContactPage,
    // },
    data() {
        return {
            apartment: Object, 

            messageForm: {
                name: "",
                surname: "",
                email: "",
                text: "",
            }
        };
    },
    // props: {
    //     apartmentInfo: apartment,
    // },
    created() {
        this.getApartmentDetails();
    },
    computed: {
        optionalName() {
            return this.apartment.optional ? this.apartment.optional.name : "nessuna";
        },
        apartment_id() { 
            return this.apartment.id;
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

            sendMail() {
                Axios
                .post(
                    // `/api/messages?apartment_id=${this.apartment.id}&name=${this.messageForm.name}&surname=${this.messageForm.surname}&email=${this.messageForm.email}&text=${this.messageForm.text}`
                    'api/messages', { form:this.messageForm, ap_id: this.apartment_id }
                    // ,
                    // this.messageForm
                    // ,
                    // {
                    //     headers: { 
                    //         'Content-Type': 'application/json',
                    //         'X-CSRF-TOKEN': token.content,
                    //         'X-Requested-With': 'XMLHttpRequest',
                    //     }
                    // }
                )
                .then(function (response) {
                    console.log(response);
                })
                .catch(function (error) {
                    console.log(error);
                });
            }
        }
}
</script>

<style scoped lang="scss">

    #info-box {
        padding: 2rem;
        width: 30%;
        height: fit-content;
        border: 2px solid var(--secondary-color);
        border-radius: 4%;
        box-shadow: 1px 1px 15px rgba(128, 128, 128, .6);
    }
    .img-wrap-single-apt {
        width: 70%;
        
        img {
            width: 100%;
        }
    }
    .img-container {
        position: relative;
        width: 100%;
        img {
            width: 100%;
        }

        .span-img {
            color: red;
            text-shadow: 1px 1px 10px rgba(0, 0, 0, .3);
            position:absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%,-50%);
        }
    }
</style>