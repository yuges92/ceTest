<template>
    <div class="container">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">Add New Transaction</h5>
            </div>
            <div class="card-body">
                <form>
                    <div class="form-group row">
                        <label for="firstName" class="col-sm-2 col-form-label">Client:</label>
                        <div class="col-sm-10">
                            <input type="text"  class="form-control" id="firstName" value="" >
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="lastName" class="col-sm-2 col-form-label">Transaction Date:</label>
                        <div class="col-sm-10">
                            <input type="date"  class="form-control" id="lastName" value="" >
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="email" class="col-sm-2 col-form-label">Amount:</label>
                        <div class="col-sm-10">
                            <input type="number" step="0.01"  class="form-control" id="email" value="" >
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
        name: "Transactions"
    }
</script>

<style scoped>

</style>
