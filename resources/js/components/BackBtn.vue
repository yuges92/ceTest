<template>
    <div class="mb-3">
        <button class="btn btn-secondary" type="button" @click="$router.go(-1)">
            <i class="fas fa-chevron-circle-left"></i>
            Back
        </button>
    </div>

</template>

<script>
    export default {
        name: "BackBtn.vue"
    }
</script>

<style scoped>

</style>
