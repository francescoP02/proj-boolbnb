<template>
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
                <label class="form-label" for="mail">Email(*):</label>
                <input class="form-control" type="email" id="mail" name="mail" v-model="messageForm.mail" required>
            </div>
            <div class="col-md-12">
                <label class="form-label" for="message">Message(*):</label>
                <textarea class="form-control" name="message" id="message" cols="30" rows="10" v-model="messageForm.text" required></textarea>
            </div>
            <div class="col-12">
                <button class="btn btn-primary" type="submit">Submit form</button>
            </div>
        </form>
    </div>
</template>

<script>
import Axios from 'axios';


export default {
    name: "ContactPage",
    data() {
        return {
            apartmentInfo: Object,

            messageForm: {
                name: "",
                surname: "",
                mail: "",
                text: "",
                apartment_id : apartmentInfo.id,
            }
        }
    },
    methods: {
        sendMail() {
            Axios
            .post(
                `/api/messages`, {
                headers: { 
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': token.content,
                    'X-Requested-With': 'XMLHttpRequest',
                }
            }
            )
            .then()
        }
    }
}
</script>

<style>

</style>