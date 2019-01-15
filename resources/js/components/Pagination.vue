<template>
    <div class="col text-center">
        <button v-for="n in total" v-bind:class="n === page ? 'btn-outline-secondary' : 'btn-outline-dark'" class="btn btn-outline-dark">{{n}}</button>
        <br/>
        <br/>
    </div>
</template>
<script>
    export default {
        props: ['total','page'],
        data(){
            return {

            }
        },
        mounted() {
            //
        },
        methods: {

        },
        computed: {

        }
    }
</script>
