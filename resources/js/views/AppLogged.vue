<template>
    <div>
        <div class="container text-center mt-4">
            <router-view :isLogged="true" :user="user"></router-view>
        </div>
    </div>
</template>

<script>
export default {
    name: "AppLogged",
    data() {
        return {
            user: window.user,
        };
    },
};
</script>

<style></style>
