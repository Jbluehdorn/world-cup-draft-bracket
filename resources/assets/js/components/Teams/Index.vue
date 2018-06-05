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
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">Thing</li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="col-sm-8">
            <router-view></router-view>
        </div>
    </div>
</template>
