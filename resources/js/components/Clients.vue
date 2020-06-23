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
                        <router-link :to="{ name: 'clients.edit',params:{id:props.row.id} }" class="fa fa-edit"></router-link>
                        <a class="fas fa-trash-alt" href=""></a>
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

