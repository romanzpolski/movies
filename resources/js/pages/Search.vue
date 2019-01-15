<template>
    <div class="container">
        <div class="card card-default">
            <div class="card-header text-center">Search Movies</div>
            <div class="card-body">
                <div class="row">
                    <div class="col">
                        <div class="input-group">
                            <input v-model="title" type="text" class="form-control" placeholder="Search movies by title">
                            <div class="input-group-append">
                                <button @click="searchByString" class="btn btn-outline-dark">Go</button>
                            </div>
                        </div>
                        <br/>
                    </div>
                    <div class="col">
                        <div class="row">
                            <div class="col">

                            </div>
                            <div class="col">
                                <div v-if="genres" class="form-group">
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <label class="input-group-text" for="genreSelect">Genre</label>
                                        </div>
                                        <select @change="onSelectChange" v-model="genre" class="custom-select" id="genreSelect">
                                            <option v-bind:key="0" v-bind:value="0" selected>Select Genre</option>
                                            <option v-bind:value="g.id" v-for="g in genres" v-bind:key="g.id">{{g.name}}</option>
                                        </select>
                                    </div>
                                </div>
                                <div v-else class="form-group text-center">
                                    <i class="fas fa-spinner fa-w-16 fa-spin fa-2x" style="margin-top:8px"></i>
                                </div>
                                <br/>
                            </div>
                        </div>

                    </div>
                </div>
                <br/>
                <div v-if="movies">
                    <div class="card-columns">
                        <div class="card" v-for="movie in movies" v-bind:key="movie.id">
                            <movie :movie="movie"></movie>
                        </div>
                    </div>
                    <div v-if="totalPages > 1">
                        <div class="col text-center">
                            <br/>
                            <br/>
                            <button @click="paginationClick" v-bind:data-page="n" v-for="n in totalPages" v-bind:class="n === page ? 'btn-success' : 'btn-outline-dark'" class="btn">{{n}}</button>
                            <br/>
                            <br/>
                        </div>
                    </div>
                </div>
                <div v-else class="text-center" style="font-size: 60px; padding: 60px 0px">
                    <i class="fas fa-spinner fa-spin"></i>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
    import Movie from '../components/Movie.vue'
    export default {
        data(){
            return {
                genres: false,
                genre: 0,
                title: '',
                movies: false,
                totalPages: 0,
                page: 1,
                mode: 0
            }
        },
        mounted() {
            this.getSelectGenres()
            this.parseUrlForDeepLinking(this.$route.params.query)
        },
        components: {
            Movie
        },
        // WATCH ROUTE CHANGES
        watch: {
            '$route' (to, from) {
                if(to.params.query !== from.params.query){
                    this.parseUrlForDeepLinking(to.params.query)
                }
            }
        },
        methods: {

            paginationClick: function(e){
                this.page= e.target.dataset.page
                this.changeRouteForDeepLinking()
            },

            changeRouteForDeepLinking: function() {
                const params = {
                    "mode" : this.mode,
                    "genre" : this.genre,
                    "title" : this.title,
                    "page" : this.page
                }

                const encodedParams = btoa(JSON.stringify(params))
                this.$router.push('/search/'+encodedParams)
            },

            parseUrlForDeepLinking: function(query) {
               if(query){
                   const queryObject = JSON.parse(atob(query))
                   this.page = queryObject.page
                   this.genre = queryObject.genre
                   this.title = queryObject.title
                   this.mode = queryObject.mode
               }

                this.searchMovies()
            },

            getSelectGenres: function() {
                this.$http({
                    url: `genres`,
                    method: 'GET'
                }).then((res) => {
                    console.log(res)
                        this.genres = res.data.data
                    }, () => {
                        this.has_error = true
                    })
            },

            onSelectChange: function(event) {
                event.preventDefault()
                const value = event.target.value;
                if(value){
                    this.genre = value
                    this.mode = 2
                    this.page = 1
                    this.changeRouteForDeepLinking();
                    //this.searchMovies()
                }
            },

            searchByString: function() {
                this.mode = 1
                this.page = 1
                this.changeRouteForDeepLinking();
            },

            /**
             *
             * @param mode = 0 : return default best rated over 100 votes
             *        mode = 1 : search by string,
             *        mode = 2 : search by genre
             * @param genre
             * @param title
             * @param page
             */

            searchMovies: function() {
                this.movies = false
                const params = {
                    "mode" : this.mode,
                    "genre" : this.genre,
                    "title" : this.title,
                    "page" : this.page
                }

                const encodedParams = btoa(JSON.stringify(params))
                const url = 'search/'+encodedParams

                this.$http({
                    url: url,
                    method: 'GET'
                }).then((res) => {
                    console.log(res)
                    this.movies = res.data.data.results
                    this.totalPages = res.data.data.total_pages
                    this.page = res.data.data.page
                }, () => {
                    this.has_error = true
                })
            }
        }
    }
</script>
