<template>
    <div class="container">
        <backBtn></backBtn>
        <div class="card mb-5">
            <div class="card-header">
                <h5 class="mb-0">Add New Client</h5>
            </div>
            <div class="card-body">
                <form v-on:submit.prevent="saveClient">
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
                        <label for="avatar" class="col-sm-2 col-form-label">Avatar:</label>
                        <div class="col-sm-10">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="avatar" @change="previewFile" required>
                                <label class="custom-file-label" for="avatar">{{filename}}</label>
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
        name: "ClientsCreate",
        components: {},
        computed: {},
        data() {
            return {
                client: {
                    firstName: "",
                    lastName: "",
                    email: "",
                    avatar: "",
                },
                loading: false,
                filename: "Choose a file",
                fileSrc: "",

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

                    this.$swal({
                        title: "Please select a image file",
                        icon: "warning"
                    })
                    this.filename = "not a picture";
                    return;
                }

                this.filename = file.name;
                this.client.avatar = file;
            },

            saveClient() {
                let formData = new FormData();
                formData.append("firstName", this.client.firstName);
                formData.append("lastName", this.client.lastName);
                formData.append("email", this.client.email);
                formData.append("avatar", this.client.avatar);

                axios.post('/api/clients', formData).then(res => {
                    this.$swal({
                        title: "New client created",
                        icon: "success"
                    }).then(()=>{
                        this.client = {};
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


        },
        created() {
        }

    }
</script>

<style lang="scss">

</style>

