<template> 
    <div class="post container mt-5"> 

        <div v-if="!loading" class="content">
            <h1>{{ post.title }}</h1>

            <span v-if="post.published" class="label label-success" style="margin-left:15px;">Published</span>
            <span v-else class="label label-default" style="margin-left:15px;">Draft</span>

            <hr />

            <p class="lead">
                {{ post.content }}
            </p>


            <h3>Comments:</h3>
            <div style="margin-bottom:50px;">
                <textarea v-model="comment" class="form-control" rows="3" name="body" placeholder="Leave a comment"></textarea>
                <button @click.prevent="createComment()" class="btn btn-success" style="margin-top:10px">Save Comment</button>
            </div>

            <div class="media" style="margin-top:20px;">
                <div class="media-left">
                    <a href="#">
                    <img class="media-object" src="http://placeimg.com/80/80" alt="...">
                    </a>
                </div>
                <div class="media-body">
                    <h4 class="media-heading">John Doe said...</h4>
                    <p>
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                    </p>
                    <span style="color: #aaa;">on Dec 15, 2017</span>
                </div>
            </div>

        </div>


        
    </div> 
</template> 
<script> 
    export default { 
        components: { 
        }, 
        props: { 
        }, 
    	data() { 
            return { 
                isLoggedIn: false,
                loading: true,
                post: null,
                comment: '',
            } 
        }, 
        created() { 
            this.onload();
        }, 
    	methods: { 
            redirect(routeName){  
                this.$router.push({name: routeName});   
            }, 
            createComment(){

                if(!this.isLoggedIn){
                    alert('You need to login first');
                    return false;
                }
                
                var data = {
                    comment: this.comment,
                } 
                let config = { 
                    headers: { 
                        'Accept': 'application/json', 
                    } 
                } 
                axios.post('/post/data', data, config) 
                .then((response) => { 
                    console.log(response.data); 
                    this.isLoggedIn = response.data.post;
                    this.post = response.data.post;
                    this.loading = false;

                }) 
                .catch(function (error) { 
                    if(!error.response.data.status){
                        //self.redirect('login');
                    }
                });
            },
            onload(){
                this.loading = true;
                var data = {
                    id: this.$route.params.id,
                } 
                let config = { 
                    headers: { 
                        'Accept': 'application/json', 
                    } 
                } 
                axios.post('/post/data', data, config) 
                .then((response) => { 
                    console.log(response.data); 
                    this.isLoggedIn = response.data.is_logged_in;
                    this.post = response.data.post;
                    this.loading = false;

                }) 
                .catch(function (error) { 
                    if(!error.response.data.status){
                        //self.redirect('login');
                    }
                });
            },
        }, 
        computed: { 
        }, 
        filters: { 
        } 
    } 
</script>