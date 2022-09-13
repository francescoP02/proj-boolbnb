<template>
    <div class="_min_width">
        <div class="container text-center mt-4">
            <Header />
            <router-view></router-view>
        </div>
    </div>
</template>

<script>
import Header from "../components/Header.vue";
export default {
    name: "App",
    components: {
        Header,
    },
};
</script>

<style></style>
