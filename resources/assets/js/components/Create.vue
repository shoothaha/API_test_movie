<template>
    
</template>

<script>
    export default {
        
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
            
            fetchMovies() {

               
                fetch('api/v1/movies')
                    // Return json format
                    .then(res => res.json())
                    // Return readable format:
                    .then(res => {
                        this.movies = res.data;
                    })
                    // throw error message incase their is one:
                    .catch(error => console.log(error));
            },

            
        }
    }
</script>
