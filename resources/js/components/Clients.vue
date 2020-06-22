<template>
    <div class="container">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">Add New Client</h5>
            </div>
            <div class="card-body">
                <form>
                    <div class="form-group row">
                        <label for="firstName" class="col-sm-2 col-form-label">First name:</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="firstName" value="">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="lastName" class="col-sm-2 col-form-label">Last name:</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="lastName" value="">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="email" class="col-sm-2 col-form-label">Email:</label>
                        <div class="col-sm-10">
                            <input type="email" class="form-control" id="email" value="">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="avatar" class="col-sm-2 col-form-label">Avatar:</label>
                        <div class="col-sm-10">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="avatar">
                                <label class="custom-file-label" for="avatar">Choose file</label>
                            </div>
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

        name: "Clients",
        data() {
            return {
                clients:[],
            }
        },
        methods:{
            fetchClients:()=>{
                axios.get('/api/clients').then(res=>{
                    console.log(res)
                    this.clients=res.data;
                }).catch(err=>{

                }).finally({

                })
            }
        },
        created() {
            this.fetchClients();
        }

    }
</script>

<style scoped>

</style>

