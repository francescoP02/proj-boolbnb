<template>
    <div>
        <h1>Questa è la home</h1>
        <Apartments />
    </div>
</template>

<script>
import Apartments from '../components/Apartments.vue';
export default {
    name: 'Home',
    components: {
        Apartments,
    }
}
</script>

<style>
</style>