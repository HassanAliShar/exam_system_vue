<template>
    <!-- bootstrap 4 header start here -->
    <div class="header">
        <div class="navbar shadow box-shadow navbar-info navbar-expand-lg navbar-static-top">
            <div class="navbar-header">
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
            </div>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item">
                        <router-link to="/" class="nav-link">Categories</router-link>
                    </li>
                    <li class="nav-item">
                        <router-link to="/products" class="nav-link">Products</router-link>
                    </li>
                </ul>
            </div>
            <!-- navbar right side -->
            <div class="navbar-right">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="#">Logout</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "Header"
}
</script>
