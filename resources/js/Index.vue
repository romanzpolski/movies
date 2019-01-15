<template>
    <div id="main">
        <link rel="stylesheet"
              href="https://use.fontawesome.com/releases/v5.2.0/css/all.css"
              integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ"
              crossorigin="anonymous">
        <header id="header">
            <navigationMenu></navigationMenu>
        </header>
        <div id="content">
            <router-view></router-view>
        </div>
    </div>
</template>
<script>
    import navigationMenu from './components/Menu.vue'
    export default {
        data() {
            return {
                //
            }
        },
        components: {
            navigationMenu
        }
    }
</script>
