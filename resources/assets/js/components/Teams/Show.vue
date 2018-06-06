<template>
    <div>
        <p class="text-center" v-show="loading">
            <i class="fa fa-spin fa-spinner"></i>
        </p>

        <div class="card" v-if="team && !loading">
            <div class="card-header">
                <h5 class="card-title my-1">
                    {{team.name}}
                </h5>
            </div>

            <div class="card-body">
                <div class="row">
                    <div class="col-4">
                        <div class="card">
                            <div class="card-header">
                                Score
                            </div>

                            <div class="card-body">
                                <div class="jumbotron mb-1">
                                    <h1 class="text-center">
                                        {{team.score}}
                                    </h1>
                                </div>

                                <div class="row">
                                    <div class="col-3 text-left">
                                        <button class="btn btn-light" @click="decrementScore" :disabled="saving">
                                            <i class="fa fa-minus"></i>
                                        </button>
                                    </div>
                                    <div class="col-6 text-center">
                                        <input type="number" class="form-control text-center" v-model="increment">
                                    </div>
                                    <div class="col-3 text-right">
                                        <button class="btn btn-light" @click="incrementScore" :disabled="saving">
                                            <i class="fa fa-plus"></i>
                                        </button>
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                    </div>

                    <div class="col-8">
                        <div class="card">
                            <div class="card-header">
                                Owner <span v-if="owner"> - {{owner.name}}</span>
                            </div>

                            <div class="card-body">
                                <div class="row" v-if="owner">
                                    <div class="col-2">
                                        <img alt="owner.name" :src="owner.picture" class="img-fluid img-thumbnail">
                                    </div>
                                    <div class="col-10">
                                        <h5>{{owner.name || owner.email}}</h5>
                                        <h3>{{owner.score}} points</h3>
                                    </div>
                                </div>
                                
                                <div class="row" v-else>
                                    <div class="col-12">
                                        <h5>Unowned</h5>
                                    </div>
                                </div>

                                <hr>

                                <div class="row">
                                    <div class="col-12">
                                        <label>Change Owner:</label>

                                        <ul class="list-group mb-1">
                                            <li
                                                v-for="owner in owners"
                                                :key="owner.sub"
                                                :class="owner.sub == newOwnerSub ? 'list-group-item-primary': ''"
                                                class="list-group-item clickable py-1 px-2"
                                                @click="setOwner(owner)"
                                                v-text="owner.name || owner.email"
                                            ></li>
                                        </ul>

                                        <button class="btn btn-primary pull-right" @click="saveOwner">
                                            <span v-show="!saving">Save</span>
                                            <i class="fa fa-spin fa-spinner" v-show="saving"></i>
                                        </button>
                                    </div>
                                </div>
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
            saving: false,
            team: null,
            increment: 1,
            owner: null,
            owners: null,
            newOwnerSub: null
        }
    },
    mounted() {
        this.load();
    },
    methods: {
        async load() {
            this.loading = true;

            let resp = await this.$http.get(`/api/teams/${this.$route.params.id}`);
            this.team = await resp.json();

            this.loading = false;

            this.loadOwners();
        },
        async incrementScore() {
            if(this.saving)
                return;

            this.saving = true;

            await this.$http.patch(`/api/teams/${this.$route.params.id}`, {
                score: parseInt(this.team.score) + parseInt(this.increment)
            });
            
            this.load();

            this.saving = false;
        },
        async decrementScore() {
            if(this.saving)
                return;

            this.saving = true;

            await this.$http.patch(`/api/teams/${this.$route.params.id}`, {
                score: parseInt(this.team.score) - parseInt(this.increment)
            });

            this.load();

            this.saving = false;
        },
        async loadOwners() {
            this.loading = true;

            let resp = await this.$http.get(`/api/users`);
            this.owners = await resp.json();

            this.loading = false;

            this.findOwner();
            this.loadOwnerScore();
        },
        findOwner() {
            this.owner = _.find(this.owners, ['sub', this.team.user_id]);

            if(this.owner)
                this.setOwner(this.owner);
        },
        setOwner(owner) {
            this.newOwnerSub = owner.sub;
        },
        async loadOwnerScore() {
            if(!this.owner)
                return;

            this.loading = true;

            let resp = await this.$http.get(`/api/users/${this.owner.sub}/score`);
            this.owner.score = await resp.json();

            this.loading = false;
        },
        async saveOwner() {
            if(this.saving)
                return;

            this.saving = true;

            await this.$http.patch(`/api/teams/${this.$route.params.id}`, {
                user_id: this.newOwnerSub
            });

            this.load();

            this.saving = false;
        }
    },
    watch: {
        '$route.params.id': function() {
            this.load();
        }
    }
}
</script>