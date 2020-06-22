<template>
    <div class="not-found-component">
        <h1 class="display-1">Oops!</h1>
        <h2 class="display-3">404 Not Found</h2>
        <p class="message">
            Sorry, Requested page not found!
        </p>
        <div class="">
            <a href="/home" class="btn btn-primary">Take Me Home </a>
        </div>
    </div>
</template>

<script>
    export default {
        name: "NotFoundComponent"
    }
</script>

<style scoped lang="scss">
    .not-found-component {
        width: 100%;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;

    }

</style>
