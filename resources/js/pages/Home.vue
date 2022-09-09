<template>
    <div>
        <ApartmentsContainer :logged="isLogged"/>
        <!-- <div>
            <button>Filtra</button>
            <div>
                <label for="min-rooms">Min rooms:</label>
                <input id="min-rooms" type="number">
                <label for="min-beds">Min beds:</label>
                <input id="min-beds" type="number">

                <input type="text">
                <select name="" id="">
                    <option value=""></option>
                </select>

                <div>Distance: 20 km</div>

                <div>
                    optional:
                    wifi
                </div>
            </div>
        </div> -->
    </div>
</template>

<script>
import ApartmentsContainer from '../components/ApartmentsContainer.vue';
export default {
    name: 'Home',
    components: {
        ApartmentsContainer,
    },
    props: { isLogged: Boolean },
}
</script>

<style>
</style>