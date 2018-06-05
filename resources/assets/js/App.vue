<template>
    <div>
        <nav class="navbar navbar-expand-sm navbar-dark bg-dark">
            <router-link class="navbar-brand" to="/">
                <img src="images/logo.png" alt="Home" height="30" />
                &nbsp;WC Draft Bracket
            </router-link>

            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#mainNav" >
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="mainNav">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <router-link to="/" class="nav-link">Home</router-link>
                    </li>
                    <li class="nav-item" v-if="user.role.includes('admin')">
                        <router-link to="/teams" class="nav-link">Teams</router-link>
                    </li>
                    <li class="nav-item">
                        <router-link to="/profile" class="nav-link">
                            {{user.name || user.email}}
                            <img class="rounded" height="25" :src="user.picture">
                        </router-link>
                    </li>
                </ul>
            </div>
            
        </nav>

        <div class="container-fluid pt-1">
            <div class="card">
                <div class="card-body">
                    <router-view></router-view>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            user: window.user
        }
    }
}
</script>