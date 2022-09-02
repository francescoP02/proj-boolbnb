<template>
    <div>
        <div class="card mb-3" style="width: 18rem;">
            <div class="card-body">
                <h5 class="card-title">{{apartment.title}}</h5>
                <p>{{apartment.address}}</p>
                <div class="test">
                    <span class="d-block">Beds number: {{apartment.beds_number}}</span>
                    <span class="d-block">Rooms number: {{apartment.rooms_number}}</span>
                </div>
                <div v-if="apartment.image">
                    <img :src="apartment.image" alt="" />
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
    }
}
</script>

<style scoped lang="scss">

    img {
        width: 100%;
    }

</style>