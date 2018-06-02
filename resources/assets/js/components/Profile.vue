<template>
    <div>
        <h1>Profile!</h1>
        {{$route.params.sub}}
    </div>
</template>

<script>
export default {
    data() {
        return {
            profile: null
        }
    },
    async mounted() {
        let resp = await this.$http.get('/api/users/' + this.$route.params.sub);
        this.profile = await resp.json();
    }
}
</script>