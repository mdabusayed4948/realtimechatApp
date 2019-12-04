<template>
    <div>
        <toolbar></toolbar>
        <router-view></router-view>
        <AppFooter></AppFooter>
    </div>

</template>

<script>
    import Toolbar from "./Toolbar";
    import AppFooter from "./AppFooter";
    import Login from "./login/Login";
    export default {
        name: "AppHome",
        components: {Login, AppFooter, Toolbar}
    }
</script>

<style scoped>

</style>
