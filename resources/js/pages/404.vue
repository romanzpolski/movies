<template>
    <div class="" id="particles">
        <div class="particles">
            <vue-particles
                color="#fff"
                :particleOpacity="0.3"
                :particlesNumber="100"
                shapeType="circle"
                :particleSize="2"
                linesColor="#fff"
                :linesWidth="1"
                :lineLinked="true"
                :lineOpacity="0.3"
                :linesDistance="150"
                :moveSpeed="0.2"
                :hoverEffect="false"
                hoverMode="bubble"
                :clickEffect="false"
                clickMode="bubble"
            ></vue-particles>
        </div>
        <div class="inner text-center">
            <h1>404</h1>
            <h2>Whoops, something went wrong !!</h2>
            <router-link class="btn btn-outline-primary"   :to="{ name : 'home' }" :key="'sdf'">
                Go home
            </router-link>
        </div>
    </div>
</template>
<script>
    export default {
        mounted() {
            //
        }
    }
</script>
<style>
    #particles {
        position:relative;
        background-color: black;
        background-size: cover;
    }

    .particles {
        background: black url("/images/sky.jpg") no-repeat center center;
        background-size: cover;
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        min-height: 100px;
    }

    .inner {
        text-shadow: 0px 0px 40px #000;
        text-align: center;
        position: absolute;
        color: white;
        z-index: 1;
        top: 0;
        left: 0;
        width:100%;
    }
    .inner h1 {
        font-size: 60px;
        font-weight: bolder;
        margin: 150px 0px 0px;
        letter-spacing: 20px;
    }
    .inner h2 {
        font-size: 20px;
        font-weight: lighter;
        margin: 0px 0px 20px;
    }
</style>
