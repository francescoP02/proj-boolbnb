<template>
    <div>
        <div class="_wrap_mess_sent text-center text-white">
            <p class="p-2">Message sent!</p>
        </div>

        <router-link v-if="isLogged" :to="{ name: 'admin-home' }"
            >Return to home page</router-link
        >
        <router-link v-else :to="{ name: 'home' }"
            >Return to home page</router-link
        >
    </div>
</template>

<script>
export default {
    name: "MessageResult",
    props: { isLogged: Boolean },
};
</script>

<style>
._wrap_mess_sent {
    background-color: rgb(60, 155, 60);
}
</style>
