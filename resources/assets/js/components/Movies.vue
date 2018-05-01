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
            <button @click="editMovie(movie)" class="btn btn-primary mb-2">Edit Movie</button>
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

        <!-- edit and update form -->
        <h2>Modify Movie:</h2>
        <form @submit.prevent="addMovie">
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="inputTitle">Movie Name:</label>
                <input type="text" class="form-control" id="inputTitle" placeholder="Title" v-model="movie.name">
            </div>
            <div class="form-group col-md-6">
                <label for="inputDate">Released Date:</label>
                <input type="date" class="form-control" id="inputDate" placeholder="Released Date" v-model="movie.release_date">
            </div>
        </div>
        <div class="form-group">
            <label for="inputDescription">Description</label>
            <input type="textarea" class="form-control" id="inputDescription" placeholder="Description" v-model="movie.description">
        </div>

        <div class="form-row">
            <div class="form-group col-md-3">
                <label for="inputDirector">Director Name:</label>
                <input type="text" class="form-control" id="inputDirector" v-model="movie.director">
            </div>
            
            <div class="form-group col-md-3">
                <label for="inputGenre">Genre:</label>
                <input type="text" class="form-control" id="inputGenre" v-model="movie.genre">
            </div>

            <div class="form-group col-md-3">
                <label for="inputRunningTime">Running Time:</label>
                <input type="text" class="form-control" placeholder="Movie Length (min)" v-model="movie.running_time">
            </div>
            
            <div class="form-group col-md-3">
                <label for="inputRating">Rating:</label>
                <input type="text" class="form-control" id="inputRating" v-model="movie.rating">
            </div>
        </div>

        <button type="submit" class="btn btn-primary btn-block">Save</button>
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
                            
                            'content-type': 'application/json'
                        }
                    })
                    // .then(console.log(this.movie))
                    .then(res => res.json())
                    .then(data => {
                        this.movie.name = '';
                        this.movie.description = '';
                        this.movie.genre = '';
                        this.movie.release_date = '';
                        this.movie.director = '';
                        this.movie.running_time = '';
                        this.movie.rating = '';
                        alert('Movie Added!')
                        this.fetchMovies()
                    })
                    .catch(error => console.log(error))
                } else {
                    fetch('api/v1/movies/' + this.movie.id, {
                        method: 'put',
                        body: JSON.stringify(this.movie),
                        headers: {
                            
                            'content-type': 'application/json'
                        }
                    })
                    // .then(console.log(this.movie))
                    .then(res => res.json())
                    .then(data => {
                        this.movie.name = '';
                        this.movie.description = '';
                        this.movie.genre = '';
                        this.movie.release_date = '';
                        this.movie.director = '';
                        this.movie.running_time = '';
                        this.movie.rating = '';
                        alert('Movie Changed!')
                        this.fetchMovies()
                    })
                }
            },

            editMovie (movie) {
                this.edit = true;
                this.movie.id = movie.id;
                this.movie.movie_id = movie.id;
                this.movie.name = movie.name;
                this.movie.description = movie.description;
                this.movie.genre = movie.genre;
                this.movie.release_date = movie.release_date;
                this.movie.director = movie.director;
                this.movie.running_time = movie.running_time;
                this.movie.rating = movie.rating
            }
            
        }        
    }
</script>
