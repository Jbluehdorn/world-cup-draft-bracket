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
                        <li class="list-group-item p-1">
                            <input type="text" class="form-control" v-model="searchTerm" placeholder="Search...">
                        </li>
                        <router-link
                            v-for="team in filteredTeams"
                            :key="team.id"
                            :to="`/teams/${team.id}`"
                            class="list-group-item clickable"
                            tag="li"
                        >
                            {{team.name}}
                            <span class="pull-right">{{team.score}}</span>
                        </router-link>
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
import _ from 'lodash'

export default {
    data() {
        return {
            loading: false,
            teams: null,
            searchTerm: ''
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
    },
    computed: {
        filteredTeams() {
            return _.filter(this.teams, team => {
                return team.name.toLowerCase().indexOf(this.searchTerm.toLowerCase()) > -1;
            });
        }
    }
}
</script>
