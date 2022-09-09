<template>
    <div class="text-start pb-3">
        <div class="_wrap_mess_sent text-center text-white">
            <p class="p-2">Messaggio inviato!</p>
        </div>
        <h1>{{apartment.title}}</h1>
        <p class="">{{ apartment.address }}</p>

        <div id="_img_info_section" class="">
            <div class="img-wrap-single-apt" v-if="apartment.image">
                <img :src=" `storage/` + apartment.image " alt="" />
            </div>
            <div class="img-wrap-single-apt" v-else>
                <img :src="`https://help.iubenda.com/wp-content/plugins/accelerated-mobile-pages/images/SD-default-image.png`" alt="" />
            </div>
            <div id="_info_box" class="ms-lg-3">
                    <p>Number of rooms: <span class="fw-bold">{{ apartment.rooms_number }} </span><i class="fas fa-door-open"></i></p>
                    <p>Number of beds: <span class="fw-bold">{{ apartment.beds_number }} </span><i class="fas fa-bed"></i></p>
                    <p>Number of bathroom: <span class="fw-bold">{{ apartment.bathroom_number }} </span><i class="fas fa-bath"></i></p>      
                    <p>Square metres: <span class="fw-bold">{{ apartment.square_metres }} m²</span></p>
                    <p v-if="user && user.name && user.surname">inserito da: 
                        <span class="fw-bold">{{user.name}} {{user.surname}}</span>
                    </p>
                <div class="ms-sm-3 ms-md-0">
                    <a id="_contact_us_button" class="btn" href="#_contact_us_section" @click="showMeContactSection()">Contact us</a>
                </div>
            </div>
        </div>



        <div class="my-4">
            <h4>You will find</h4>
            <span v-for="(optional,index) in apartment.optionals" :key="optional.id" class="me-2 d-inline-block rounded-pill text-dark mr-3 p-1 fs-4">
                <span v-if="optional.id == 1"><i class="fas fa-wifi"></i></span>
                <span v-if="optional.id == 2"><i class="fas fa-swimmer"></i></span>
                <span v-if="optional.id == 3"><i class="fas fa-spa"></i></span>
                <span v-if="optional.id == 4"><i class="fas fa-water"></i></span>
                <span v-if="optional.id == 5"><i class="fas fa-dog"></i></span>
                <span>{{ optional.name }} <span v-if="index != (apartment.optionals).length - 1"> | </span></span>
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

        <div id="_contact_us_section" class="d-none">
        <form class="row g-3">
            <div class="col-md-6">
                <label class="form-label" for="name">Name(*):</label>
                <input class="form-control" @keyup="controlDataForm()" type="text" id="name" name="name" v-model="messageForm.name" required>
            </div>
            <div class="col-md-6">
                <label class="form-label" for="surname">Surname(*):</label>
                <input class="form-control" @keyup="controlDataForm()" type="text" id="surname" name="surname" v-model="messageForm.surname" required>
            </div>
            <div class="col-md-12">
                <label class="form-label" for="email">Email(*):</label>
                <input class="form-control" @keyup="controlDataForm()" type="email" id="email" name="email" v-model="messageForm.email" required>
            </div>
            <div class="col-md-12">
                <label class="form-label" for="message">Message(*):</label>
                <textarea class="form-control" @keyup="controlDataForm()" name="message" id="message" cols="30" rows="10" v-model="messageForm.text" required></textarea>
            </div>
            <div class="col-12">
                <router-link :to="{ name: 'message-result'}"><button id="messageButton" @click="sendMail()" class="btn btn-primary" disabled type="submit">Send</button></router-link>
            </div>
        </form>
    </div>

        <!-- <a href="{{route('messages.create')}}">Contact</a> -->

    </div>
</template>

<script>
import Axios from 'axios';


export default {
    name: 'SingleApartment',
    data() {
        return {
            apartment: Object, 

            messageForm: {
                name: "",
                surname: "",
                email: "",
                text: "",
                apartment_id: null,
            },

            
            nameFlag: false,
            surnameFlag: false,
            emailFlag: false,
            textFlag: false,

            user: null,
            logged_user: null,

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
        apartment_number() { 
            return this.apartment.id;
        }
    },
    methods: {
            showMeContactSection() {
                const ContactSection = document.getElementById('_contact_us_section');
                ContactSection.classList.remove('d-none');
            },
            getApartmentDetails() {
                const slug = this.$route.params.slug;
                
                Axios.get(`/api/admin/apartments/${slug}`).then((resp) => {
                    console.log(resp);
                    if (resp.data.success) {
                        this.apartment = resp.data.results.apartment;
                        // this.user = resp.data.results.user;
                        // this.logged_user = resp.data.result.logged_user;
                    }
                    else {
                        this.$router.push({ name: "admin-not-found" });
                    }
                }).catch((error) => {
                    this.$router.push({ name: "admin-not-found" });
                });
            },

        sendMail() {
            this.messageForm.apartment_id = this.apartment_number;
                Axios
                .post(
                    // `/api/messages?apartment_id=${this.apartment.id}&name=${this.messageForm.name}&surname=${this.messageForm.surname}&email=${this.messageForm.email}&text=${this.messageForm.text}`
                    '/api/messages', this.messageForm
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
            },

            controlDataForm() {

                if (this.messageForm.name !== "") {
                    this.nameFlag = true;
                } else {
                    this.nameFlag = false;
                }
                if (this.messageForm.surname !== "") {
                    this.surnameFlag = true;
                } else {
                    this.surnameFlag = false;
                }
                if (this.messageForm.email !== "" && this.messageForm.email.match(/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/)) {
                    this.emailFlag = true;
                } else {
                    this.emailFlag = false;
                }
                if (this.messageForm.text !== "") {
                    this.textFlag = true;
                } else {
                    this.textFlag = false;
                }

                if (this.nameFlag && this.surnameFlag && this.emailFlag && this.textFlag) {
                    document.getElementById('messageButton').disabled = false;
                } else {
                    document.getElementById('messageButton').disabled = true;
                }
            }
        }
}
</script>

<style scoped lang="scss">
    ._wrap_mess_sent {
        background-color: rgb(81, 170, 81);
    }
</style>