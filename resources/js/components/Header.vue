<template>
    <div>
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container-fluid p-0">
                <a class="navbar-brand" href="/#">
                  <img src="images/logoboolbnb.png" alt="" style="width:150px">
                  <!-- boolbnb -->
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse right" id="navbarNav">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link" href="/login">Login</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/register">Register</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </div>
</template>

<script>
export default {
    name: 'Header',
}
</script>

<style lang="scss">

    .right {
        justify-content: flex-end;
    }

    #_user_btn {
        border: 1px solid transparent;
        border-radius: 50%;
        transition: .3s;

        a {
            color: var(--secondary-color);
            font-size: 1rem;

            &:hover {
                color: var(--primary-color);
            }
        }

    }
</style>