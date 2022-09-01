<template>
    <div>
        <h1>Errore 404! Pagina non trovata</h1>
        <router-link :to="{name: 'home'}">Ritorna nella pagina Home</router-link>
    </div>
</template>

<script>
export default {
    name: 'NotFound',
}
</script>

<style>
</style>