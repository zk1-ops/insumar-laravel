<template>
    <v-col class="d-flex flex-column align-center my-0 text-center" cols="12">
        <v-sheet color="primary" width="10%" height="5px" class="my-4" />
        <h2 class="text-uppercase" v-text="title" />
        <div role="h4" class="section-separator-description" v-html="subtitle" />
    </v-col>
</template>

<script>
export default {
    props: ['title', 'subtitle']
}
</script>

<style>
.section-separator-description {
    /* Shift right, Shift down, Blur, color */
    text-shadow: 1px 7px 5px rgba(black,0.41);
}
</style>