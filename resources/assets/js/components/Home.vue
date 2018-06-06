<template>
    <div>
        <div class="text-center" v-show="loading">
            <i class="fa fa-spin fa-spinner"></i>
        </div>

        <div class="card" v-if="user">
            <div class="card-header">
                <h3 class="mb-0">CU World Cup Draft Bracket</h3>
            </div>

            <div class="card-body py-1">
                <div class="row">
                    <div class="col-auto px-0">
                        <img alt="user.name" :src="user.picture" class="img-fluid img-thumbnail">
                    </div>
                    <div class="col pl-1">
                        <h5>{{user.name || user.email}}</h5>
                        <h3>{{user.score}} points</h3>
                    </div>
                </div>
            </div>
        </div>

        <br>

        <div class="row">
            <div class="col-sm-12 col-md-6">
                <div class="card" v-if="users">
                    <div class="card-header">
                        <h5 class="mb-0">Standings</h5>
                    </div>

                    <div class="card-body py-0 px-3">
                        <div class="row">
                            <div class="col-12 p-0">
                                <ul class="list-group list-group-flush">
                                    <router-link
                                        :to="`/profile/${user.sub}`"
                                        tag="li"
                                        v-for="(user, index) in filteredUsers"
                                        :key="index"
                                        class="list-group-item clickable"
                                    >
                                        {{index + 1}}. {{user.name || user.email}}
                                        <strong class="pull-right">{{user.score}}</strong>
                                    </router-link>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-sm-12 col-md-6">
                <div class="card" v-if="topTeams">
                    <div class="card-header">
                        <h5 class="mb-0">Top Teams</h5>
                    </div>

                    <div class="card-body py-0 px-3">
                        <div class="row">
                            <div class="col-12 p-0">
                                <ul class="list-group list-group-flush">
                                    <li 
                                        v-for="(team, index) in topTeams"
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
        </div>

        <br>

        <div class="row">
            <div class="col-12">
                <div class="card" v-if="!loading">
                    <div class="card-header">
                        <h5 class="mb-0">Scoring</h5>
                    </div>

                    <div class="card-body py-1 px-2">
                        <div class="row">
                            <div class="col">
                                <p class="body-1">
                                    <strong>Base Score:</strong>
                                    <br>
                                    Win <span class="pull-right">+3</span>
                                    <br>
                                    Draw <span class="pull-right">+1</span>
                                    <br>
                                    Loss <span class="pull-right">+0</span>
                                </p>
                            </div>
                            <div class="col">
                                <p class="body-1">
                                    <strong>Rank Booster (round down):</strong>
                                    <br>
                                    Win <span class="pull-right">+(rank1 - rank2) / 3</span>
                                    <br>
                                    Draw <span class="pull-right">+(rank1 - rank2) / 4</span>
                                    <br>
                                    Loss <span class="pull-right">+0</span>
                                </p>
                            </div>
                            <div class="col">
                                <p class="body-1">
                                    <strong>Group Result Bonus:</strong>
                                    <br>
                                    1st in group <span class="pull-right">+2</span>
                                    <br>
                                    2nd in group <span class="pull-right">+1</span>
                                </p>
                            </div>
                            <div class="col">
                                <p class="body-1">
                                    <strong>Round Bonus:</strong>
                                    <br>
                                    Round of 16 <span class="pull-right">+1</span>
                                    <br>
                                    Quarter-finals <span class="pull-right">+2</span>
                                    <br>
                                    Semi-finals <span class="pull-right">+3</span>
                                    <br>
                                    Finals <span class="pull-right">+5</span>
                                </p>
                            </div>
                            <div class="col">
                                <strong>Knockout Result Bonus</strong>
                                <br>
                                Win in Full Time <span class="pull-right">+1</span>
                                <br>
                                Win on PKs <span class="pull-right">-1</span>
                            </div>
                        </div>
                        
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
            loading: false,
            users: null,
            topTeams: null
        }
    },
    mounted() {
        this.load();
    },
    methods: {
        async load() {
            this.loading = true;

            let resp = await this.$http.get('/api/users');
            this.users = await resp.json();

            this.loading = false;

            this.loadTopTeams();
        },
        async loadTopTeams() {
            this.loading = true;

            let resp = await this.$http.get('/api/teams/top');
            this.topTeams = await resp.json();

            this.loading = false;
        }
    },
    computed: {
        filteredUsers() {
            return _
                        .chain(this.users)
                        .sortBy('score')
                        .reverse()
                        .value();
        },
        user() {
            return _.find(this.users, user => {
                return user.sub == window.user.sub;
            });
        }
    }
}
</script>