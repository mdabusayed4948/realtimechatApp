<template>
    <div>
        <toolbar></toolbar>
        <AppFooter></AppFooter>
    </div>

</template>

<script>
    import Toolbar from "./Toolbar";
    import AppFooter from "./AppFooter";
    export default {
        name: "AppHome",
        components: {AppFooter, Toolbar}
    }
</script>

<style scoped>

</style>
