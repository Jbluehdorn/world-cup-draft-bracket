<template>
    <div class="card">
        <div class="card-header">
            <h5 class="card-title my-1">
                New Team
            </h5>
        </div>

        <div class="card-body">
            <div class="alert alert-danger" v-show="error">
                <strong>Error:</strong> {{error}}

                <button class="close" @click="clearError()">
                    <i class="fa fa-times"></i>
                </button>
            </div>

            <div class="form-group">
                <label>Name:</label>
                <input type="text" class="form-control" placeholder="ex. Paraguay" v-model="name">
            </div>

            <button class="btn btn-primary pull-right" @click="save()" :disabled="saving">
                <span v-show="!saving">Save</span>
                <i class="fa fa-spinner fa-spin" v-show="saving"></i>
            </button>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            name: null,
            saving: false,
            error: null
        }
    },
    methods: {
        async save() {
            this.saving = true;

            if(!this.name || !this.name.length) {
                this.error = "Name required";
                this.saving = false;
                return;
            } else {
                this.clearError();
            }

            let resp = await this.$http.post('/api/teams', {name: this.name});
            let json = resp.json();

            this.saving = false;
        },
        clearError() {
            this.error = null;
        }
    }
}
</script>