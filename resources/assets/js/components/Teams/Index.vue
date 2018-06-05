<template>
    <div class="row">
        <div class="col-sm-4">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">
                        Teams

                        <router-link tag="button" to="/teams/new" class="btn btn-primary btn-sm pull-right">
                            <i class="fa fa-plus"></i>
                        </router-link>
                    </h5>
                </div>

                <div class="card-body p-0">
                    <div class="text-sm-center" v-show="loading">
                        <i class="fa fa-spin fa-spinner"></i>
                    </div>

                    <ul class="list-group list-group-flush" v-if="teams">
                        <router-link
                            v-for="team in teams"
                            :key="team.id"
                            :to="`/teams/${team.id}`"
                            class="list-group-item clickable"
                            v-text="team.name"
                            tag="li"
                        ></router-link>
                    </ul>
                </div>
            </div>
        </div>

        <div class="col-sm-8">
            <router-view @update="load"></router-view>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            loading: false,
            teams: null
        }
    },
    mounted() {
        this.load();
    },
    methods: {
        async load() {
            this.loading = true;

            let resp = await this.$http.get('/api/teams');
            this.teams = await resp.json();

            this.loading = false;
        }
    }
}
</script>
