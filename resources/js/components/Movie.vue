<template>
    <div>
        <img class="card-img-top" v-bind:src="getImagePath(movie.poster_path)" alt="Card image cap">
        <div class="blockquote mb-0 card-body">
            <h5 class="card-title">{{movie.title}}</h5>
            <div class="row">
                <div class="col">
                    <p class="card-text">
                        <small class="text-muted"><i class="far fa-thumbs-up"></i> {{movie.vote_average }} </small><br/>
                        <small class="text-muted"><i class="far fa-user"></i> {{movie.vote_count }} </small>
                    </p>
                </div>
                <div class="col">
                    <p class="text-right">
                        <br/>
                        <button @click="onClick(movie.id)" class="btn btn-outline-dark">Read more</button>
                    </p>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
    export default {
        props: ['movie'],
        data(){
            return {

            }
        },
        mounted() {
            //
        },
        methods: {
            getImagePath(img){
                return 'https://image.tmdb.org/t/p/w500'+img
            },
            onClick(id){
                this.$router.push('/movie/'+id)
            }
        },
        computed: {

        }
    }
</script>
