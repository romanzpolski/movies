<template>
    <div style="position:relative">
        <div v-if="movie">
            <div id="image-bg">
                <img class="img-fluid" v-bind:src="getBackdropPath(movie.backdrop_path)" alt="Card image cap">
            </div>
            <div class="container">
                <br/>
                <br/>
                <br/>
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-9">
                                <h3 class="card-title">{{movie.title}} <small class="text-muted float-right">{{movie.release_date}}</small></h3>
                                <p class="lead">{{movie.tagline}}</p>
                                <p class="card-text">
                                    <small class="text-muted">original title: "{{movie.original_title}}"</small><br/>
                                    <small class="text-muted">language: "{{movie.original_language}}"</small><br/>
                                    <small class="text-muted">budget: "{{movie.budget}}"</small><br/>
                                    <small class="text-muted">revenue: "{{movie.revenue}}"</small><br/>
                                    <small v-if="movie.homepage" class="text-muted">website: <a target="_blank" v-bind:href="movie.homepage">link</a> </small>
                                </p>
                                <div class="row">
                                    <div class="col-3">

                                    </div>
                                    <div class="col-9">

                                    </div>
                                </div>
                                <p class="card-text">{{movie.overview}}}</p>
                                <br/>
                                <br/>
                                <h4>Production Companies</h4>
                                <br/>
                                <div class="row">
                                    <div v-for="comp in movie.production_companies" class="col-3">
                                        <div class="card">
                                            <div class="card-header">
                                                {{comp.name}}
                                            </div>
                                            <img v-if="comp.logo_path" class="img-fluid" v-bind:src="getLogoPath(comp.logo_path)" alt="Poster Image">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-3">
                                <img class="img-fluid" v-bind:src="getPosterPath(movie.poster_path)" alt="Poster Image">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div v-else class="text-center" style="font-size: 60px; padding: 60px 0px">
            <i class="fas fa-spinner fa-spin"></i>
        </div>
    </div>
</template>
<script>
    export default {
        data(){
            return {
                movie: null
            }
        },
        mounted() {
            this.getMovie()
        },
        methods: {
            getBackdropPath(img){
                return 'http://image.tmdb.org/t/p/w1280'+img
            },

            getPosterPath(img){
                return 'http://image.tmdb.org/t/p/w500'+img
            },

            getLogoPath(img){
                return 'http://image.tmdb.org/t/p/w300'+img
            },

            getMovie: function() {
                const url = 'movie/'+this.$route.params.id
                this.$http({
                    url: url,
                    method: 'GET'
                }).then((res) => {
                    this.movie = res.data.data
                }, () => {
                    this.has_error = true
                })
            }
        },
        computed: {

        }
    }
</script>
<style>
    #image-bg {
        position: absolute;
        width: 100%;
        left: 0;
        top: 0;
    }
</style>
