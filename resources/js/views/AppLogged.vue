<template>
    <div>
        <div class="container text-center mt-4">
            <router-view :isLogged="true"></router-view>
        </div>
    </div>
</template>

<script>
export default {
    name: "AppLogged",
};
</script>

<style></style>
