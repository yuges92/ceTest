<template>
    <div class="container">

        <backBtn></backBtn>
        <div class="mb-3">
            <router-link :to="{ name: 'clients.addTransaction' }" class="btn btn-primary"><i class="fa fa-plus"></i> Add Transaction
            </router-link>
        </div>

        <div class="card mb-5">
            <div class="card-header">
                <h5 class="mb-0">Edit Client</h5>
            </div>
            <div class="card-body">
                <form v-on:submit.prevent="UpdateClient">
                    <div class="form-group row">
                        <label for="firstName" class="col-sm-2 col-form-label">First name:</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="firstName" v-model="client.firstName" required
                                   placeholder="First name">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="lastName" class="col-sm-2 col-form-label">Last name:</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="lastName" v-model="client.lastName" required
                                   placeholder="Last name">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="email" class="col-sm-2 col-form-label">Email:</label>
                        <div class="col-sm-10">
                            <input type="email" class="form-control" id="email" v-model="client.email" required
                                   placeholder="Email">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label  class="col-sm-2 col-form-label">Preview:</label>
                        <div class="col-sm-10">

                        <div class="avatar-container">
                            <img :src="'/'+client.avatar" alt="" class="avatar">
                        </div>
                        </div>
                    </div>



                    <div class="form-group row">
                        <label for="avatar" class="col-sm-2 col-form-label">Avatar:</label>
                        <div class="col-sm-10">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="avatar" @change="previewFile">
                                <label class="custom-file-label" for="avatar">{{filename}}</label>
                            </div>
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
                client: {},
                loading: false,
                filename: "Choose a file",
                fileSrc: "",
                newAvatar:""

            }
        },
        methods: {
            previewFile(e) {
                const file = e.target.files[0];
                if (!file) {
                    this.filename = "Choose a file";
                    return;
                }
                if (!file.type.match("image.*")) {
                    alert("Please select a image file");
                    this.filename = "not a picture";
                    return;
                }

                this.filename = file.name;
                this.newAvatar = file;
            },

            UpdateClient() {
                let formData = new FormData();
                formData.append("firstName", this.client.firstName);
                formData.append("lastName", this.client.lastName);
                formData.append("email", this.client.email);
                if(this.newAvatar){
                formData.append("avatar", this.newAvatar);
                }
                formData.append("_method", "PUT");
                axios.post(`/api/clients/${this.$route.params.id}`, formData).then(res => {
                    this.$swal({
                        title: "Updated",
                        icon: "success"
                    }).then(()=>{
                        this.$router.push({ name: "clients" });
                    })
                }).catch(error => {
                    this.$swal({
                        title: "Failed to create",
                        icon: "Error"
                    })
                    console.error(error.errors)
                })
            },

            fetchClient(){
                axios.get(`/api/clients/${this.$route.params.id}`)
                    .then(res=>{
                        this.client = res.data;
                    })
                    .catch(error =>{
                    console.error(error);
                })
            }

        },
        mounted() {
            this.fetchClient();
        }

    }
</script>

<style lang="scss">

</style>

