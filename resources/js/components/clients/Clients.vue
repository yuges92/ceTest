<template>
    <div class="container">
        <div class="mb-3">
            <router-link :to="{ name: 'clients.create' }" class="btn btn-primary"><i class="fa fa-plus"></i> Add Client
            </router-link>
        </div>
        <div class="card">
            <div class="card-body">
                <v-server-table :columns="columns" :options="options" ref="table" url="/api/clients">
                    <div class="avatar-container" slot="avatar" slot-scope="props">
                        <img :src="'/'+props.row.avatar" alt="" class="avatar">
                    </div>
                    <div class="action-btns" slot="action" slot-scope="props">
                        <router-link :to="{ name: 'clients.edit',params:{id:props.row.id} }" class="btn btn-primary"><i class="fa fa-edit"></i></router-link>
                        <button class=" btn btn-danger" @click="deleteClient(props.row.id)"> <i class="fas fa-trash-alt"></i> </button>
                    </div>
                </v-server-table>
            </div>

        </div>

    </div>
</template>

<script>

    export default {
        components: {},
        computed: {},
        name: "Clients",
        data() {
            return {
                clients: [],
                columns: ['id', 'firstName', 'lastName', 'email', 'avatar', 'action'],
                options: {
                    perPage: 10,
                    perPageValues: [10],
                    filterable: false,
                    responseAdapter({data}) {
                        return {
                            data: data.data,
                            count: data.meta.total
                        }
                    },

                }
            }
        },
        methods: {
            fetchClients: () => {
                axios.get('/api/clients').then(res => {
                    // console.log(res)
                    this.clients = res.data;
                }).catch(err => {

                }).finally({})
            },


            refreshTable() {
                this.$refs.table.refresh();
            },

            deleteClient(id) {
                this.$swal.fire
                    ({
                        title: "Are you sure?",
                        icon: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#3085d6",
                        cancelButtonColor: "#d33",
                        confirmButtonText: "Yes, delete it!"
                    })
                    .then(result => {
                        if (result.value) {
                            axios
                                .delete("/api/clients/" + id)
                                .then(res => {
                                    this.refreshTable();
                                    this.$swal({
                                        title: "Deleted",
                                        icon: "success"
                                    })
                                })
                                .catch(err => {
                                    console.error(err);
                                    this.$swal({
                                        title: "Error",
                                        text: 'Failed to Delete!',
                                        icon: "error"
                                    })

                                })
                                .finally(() => {
                                    this.loading = false;
                                });
                        }
                    });
            }


        },
        created() {
            // this.fetchClients();

        }

    }
</script>

<style lang="scss">
    .action-btns {
        display: flex;
        justify-content: space-around;
    }

    .avatar-container {
        width: 100px;

        .avatar {
            width: 100%;
        }
    }
</style>

