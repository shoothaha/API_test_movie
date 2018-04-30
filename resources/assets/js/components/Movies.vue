<template>
    <div>
        <!-- Movie Contents: -->
        <h2>Movies</h2>
        
        <hr>
        <div class="card card-body mb-2" v-for="movie in movies" v-bind:key="movie.id">
            
            <div class="row">
                <div class="col-8">
                    <h2>{{ movie.name }}</h2>
                </div>

                <div class="col-4">
                    <p class="font-weight-bold">Released on: {{movie.release_date}}</p>
                </div>
            </div>

            <p>{{ movie.description }}</p>

            <div class="row">
                <div class="col-sm">
                    <p class="font-weight-bold"> By: {{ movie.director }}</p>
                </div>

                <div class="col-sm">
                    <p class="font-weight-bold">Movie length: {{ movie.running_time }} Minutes</p>
                </div>

                <div class="col-sm">
                    <p class="font-weight-bold">Rating: {{ movie.rating }} points </p>
                </div>
            </div>
            <hr>
            <!-- delete & edit buttons: -->
            <button @click="deleteMovie(movie.id)" class="btn btn-danger">Delete Movie</button>
        </div>

        <!-- Pagination: -->
        <nav aria-label="Page navigation">
            <ul class="pagination justify-content-center">
                <li v-bind:class="[{disabled: !pagination.prev_page_url}]" class="page-item">
                    <a class="page-link" @click="fetchMovies(pagination.prev_page_url)" tabindex="-1">Previous</a>
                </li>

                <li class="page-item disabled">
                    <a class="page-link">Page: {{ pagination.current_page }} / {{ pagination.last_page }} </a>
                </li>

                <li class="page-item">
                    <a class="page-link" @click="fetchMovies(pagination.next_page_url)">Next</a>
                </li>
            </ul>
        </nav>
        <hr>
        <form @submit.prevent="addMovie" class="mb-2">
            <div class="form-group">
                <input type="text" class="form-control" placeholder="Movie Title" v-model="movie.name">
            </div>

            <div class="form-group">
                <input type="textarea" class="form-control" placeholder="Movie Description" v-model="movie.description">
            </div>
            <button type="submit" class="btn btn-submit">Save</button>
        </form>
    </div>
    
</template>
 


<script>
    export default {
        // get data:
        data() {
            return {
                movies: [],
                movie: {
                    id: '',
                    name: '',
                    description: '',
                    genre: '',
                    release_date: '',
                    director: '',
                    running_time: '',
                    rating: 0
                },
                movie_id: '',
                pagination: {},
                edit: false
            }
        },
        // call the fetchMovies method
        created() {
            this.fetchMovies();
        },

        methods: {
            fetchMovies(page_url) {

                page_url = page_url || '/api/v1/movies'
                fetch(page_url)
                    // Return json format
                    .then(res => res.json())
                    // Return readable format:
                    //Call the makePagination method to create pagination:
                    .then(res => {
                        this.movies = res.data;
                        this.makePagination(res.meta, res.links);
                    })
                    // throw error message incase their is one:
                    .catch(err => console.log(err));
            },

            makePagination(meta, links){
                let pagination = {
                    //URLs from the showed Json file:
                    // smgtest.test/api/v1/movies
                    current_page: meta.current_page,
                    last_page: meta.last_page,
                    next_page_url: links.next,
                    prev_page_url: links.prev
                };

                this.pagination = pagination;
            },
            // Delete method:
            deleteMovie(id) {
                //if confirm to delete ? :
                if (confirm('Confirm Delete')){
                    //find the movie by $ID, then delete:
                    fetch(`/api/v1/movies/${id}`, {
                        method: 'delete'
                    })
                        .then(res => res.json())
                        .then(data => {
                            alert('Deleted!');
                            this.fetchMovies();
                        })
                        .catch(err => console.log(err));
                }
            },

            addMovie(){
                if (this.edit === false){
                    fetch('api/v1/movies', {
                        method: 'post',
                        body: JSON.stringify(this.movie),
                        headers: {
                            'accept': 'application/json',
                            'content-type': 'application/x-www-form-urlencoded'
                        }
                    })
                    .then(res => res.json())
                    .then(data => {
                        this.movie.name = '';
                        this.movie.description = '';
                    })
                } else {
                    a
                }
            }
        }        
    }
</script>
