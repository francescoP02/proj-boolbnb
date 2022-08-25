<template>
    <div>
        <nav class="navbar navbar-expand-lg bg-light">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">BoolBnB</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav">

                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="#">Home</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="login">Login</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="/register">Register</a>
                        </li>

                    </ul>
                </div>
            </div>
        </nav>
        <WorkInProgress />
    </div>
</template>

<script>
import WorkInProgress from '../components/WorkInProgress.vue';
export default {
    name: 'App',
    components: {
        WorkInProgress,
    }
}
</script>

<style>
</style>