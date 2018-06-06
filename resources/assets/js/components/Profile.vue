<template>
    <div>
        <div class="text-center" v-show="loading">
            <i class="fa fa-spin fa-spinner"></i>
        </div>

        <div class="card" v-if="profile" v-show="!loading">
            <div class="card-body">
                <div class="row">
                    <div class="col-2">
                        <img alt="profile.name" :src="profile.picture" class="img-fluid img-thumbnail">
                    </div>
                    <div class="col-10">
                        <h5>{{profile.name || profile.email}}</h5>
                        <h3>{{profile.score}} points</h3>
                    </div>
                </div>

                <br>

                <div class="row">
                    <div class="col-12">
                        <strong>Teams:</strong>
                        <ul class="list-group">
                            <li 
                                v-for="(team, index) in teams"
                                :key="index"
                                class="list-group-item"
                            >
                                {{index + 1}}. {{team.name}}
                                <strong class="pull-right">{{team.score}}</strong>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            profile: null,
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

            let resp = await this.$http.get('/api/users/' + this.$route.params.sub);
            this.profile = await resp.json();

            this.loading = false;

            this.loadScore();
            this.loadTeams();
        },
        async loadTeams() {
            this.loading = true;

            let resp = await this.$http.get(`/api/users/${this.$route.params.sub}/teams`);
            this.teams = await resp.json();

            this.loading = false;
        },
        async loadScore() {
            this.loading = true;

            let resp = await this.$http.get(`/api/users/${this.$route.params.sub}/score`);
            this.profile.score = await resp.json();

            this.loading = false;
        }
    }
}
</script>