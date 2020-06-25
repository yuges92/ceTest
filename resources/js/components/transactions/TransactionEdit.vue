<template>
    <div class="container">

        <backBtn></backBtn>

        <div class="card mb-5">
            <div class="card-header">
                <h5 class="mb-0">Edit Client</h5>
            </div>
            <div class="card-body">
                <form v-on:submit.prevent="UpdateClient">
                    <div class="form-group row">
                        <label for="transactionID" class="col-sm-2 col-form-label">Transaction ID:</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="transactionID" v-model="transaction.id" readonly
                                   placeholder="First name">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="client_id" class="col-sm-2 col-form-label">Client ID:</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="client_id" v-model="transaction.client_id" readonly
                                   >
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="fullname" class="col-sm-2 col-form-label">Client Name:</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="fullname" v-model="transaction.clientName" readonly
                                   >
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="transactionDate" class="col-sm-2 col-form-label">Transaction Date:</label>
                        <div class="col-sm-10">
                            <input type="date" class="form-control" id="transactionDate" v-model="transaction.transactionDate" required>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="amount" class="col-sm-2 col-form-label">Amount:</label>
                        <div class="col-sm-10">
                            <input type="number" step="0.01"  class="form-control" id="amount" value="" v-model="transaction.amount" required>
                        </div>
                    </div>



                    <div class="d-flex justify-content-end mt-4">
                        <button class="btn btn-primary px-5" type="submit">Update</button>
                    </div>

                </form>
            </div>
        </div>

    </div>
</template>

<script>

    export default {
        name: "ClientsCreate",
        components: {},
        computed: {},
        data() {
            return {
                transaction: {},
                loading: false,
            }
        },
        methods: {


            UpdateClient() {
                axios.put(`/api/transactions/${this.$route.params.id}`, this.transaction).then(res => {
                        this.$swal({
                            title: "Transaction updated",
                            icon: "success"
                        }).then(()=>{
                            this.client = {};
                            this.$router.push({ name: "transactions" });
                        })
                    }).catch(error => {
                        this.$swal({
                            title: "Failed to create",
                            type: "Error"
                        })
                        console.error(error.errors)
                    })
            },

            fetchTransaction(){
                axios.get(`/api/transactions/${this.$route.params.id}`)
                    .then(res=>{
                        console.log(res)
                        this.transaction = res.data;
                    })
                    .catch(error =>{
                        console.error(error);
                    })
            }

        },
        mounted() {
            this.fetchTransaction();
        }

    }
</script>

<style lang="scss">

</style>

