<template>
    <div>
        <div class="text-center" v-show="loading">
            <i class="fa fa-spin fa-spinner"></i>
        </div>

        <div v-if="profile">
            <h1>
                <img :src="profile.picture" alt="" class="rounded" height="75">
                {{profile.name || profile.email}}
            </h1>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            profile: null,
            loading: false
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
        }
    }
}
</script>