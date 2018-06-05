<template>
    <div>
        <p class="text-sm-center" v-show="loading">
            <i class="fa fa-spin fa-spinner"></i>
        </p>

        <div class="card" v-if="team">
            <div class="card-header">
                <h5 class="card-title my-1">
                    {{team.name}}
                </h5>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            loading: false,
            team: null
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
        }
    }
}
</script>