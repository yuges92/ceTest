<template>
    <div class="container">
        <backBtn></backBtn>

        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">Add New Transaction</h5>
            </div>
            <div class="card-body">
                <form v-on:submit.prevent="saveTransaction">

                    <div class="form-group row">
                        <label for="transactionDate" class="col-sm-2 col-form-label">Transaction Date:</label>
                        <div class="col-sm-10">
                            <input type="date"  class="form-control" id="transactionDate" value="" v-model="transaction.transactionDate" required>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="amount" class="col-sm-2 col-form-label">Amount:</label>
                        <div class="col-sm-10">
                            <input type="number" step="0.01"  class="form-control" id="amount" value="" v-model="transaction.amount" required>
                        </div>
                    </div>


                    <div class="d-flex justify-content-end mt-4">
                        <button class="btn btn-primary px-5" type="submit">Save</button>
                    </div>

                </form>
            </div>
        </div>

    </div>
</template>

<script>
    export default {
        name: "TransactionAdd",
        data() {
            return {
                transaction:{
                    client_id:this.$route.params.id,
                    transactionDate:"",
                    amount:"",
                },
            }
        },
        methods: {

            saveTransaction() {
                console.log(this.transaction);
                axios.post('/api/transactions', this.transaction).then(res => {
                    this.$swal({
                        title: "Transaction created",
                        icon: "success"
                    }).then(()=>{
                        this.client = {};
                        this.$router.push({ name: "transactions" });
                    })
                }).catch(error => {
                    this.$swal({
                        title: "Failed to create",
                        icon: "Error"
                    })
                    console.error(error.errors)
                })
            },
        },
        mounted() {
        }
    }
</script>

<style scoped>

</style>
<style src="vue-multiselect/dist/vue-multiselect.min.css"></style>
