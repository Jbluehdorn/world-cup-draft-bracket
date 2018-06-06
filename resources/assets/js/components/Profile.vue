<template>
    <div>
        <div class="text-center" v-show="loading">
            <i class="fa fa-spin fa-spinner"></i>
        </div>

        <div class="card" v-if="profile" v-show="!loading">
            <div class="card-header">
                <h5 class="mb-0">
                    {{profile.name}}
                </h5>
            </div>

            <div class="card-body py-1">
                <div class="row">
                    <div class="col-auto px-1">
                        <img alt="profile.name" :src="profile.picture" class="img-fluid img-thumbnail">
                    </div>
                    <div class="col">
                        <h3>{{profile.score}} points</h3>

                        <ul class="list-group">
                            <li class="list-group-item list-group-item-secondary">
                                <strong>Teams</strong>
                            </li>
                            <li 
                                v-for="(team, index) in sortedTeams"
                                :key="index"
                                class="list-group-item"
                                :class="team.eliminated ? 'list-group-item-dark' : ''"
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
import _ from 'lodash'

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

            this.$forceUpdate();

            this.loading = false;
        }
    },
    computed: {
        sortedTeams() {
            return _.orderBy(this.teams, ['score'], ['desc']);
        }
    }
}
</script>