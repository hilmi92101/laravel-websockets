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

            <div v-for="comment in post.comments" class="media mb-4" style="margin-top:20px;">
                <div class="media-left">
                    <a href="#">
                    <img class="media-object" src="http://placeimg.com/80/80" alt="...">
                    </a>
                </div>
                <div class="media-body">
                    <h4 class="media-heading">{{ comment.user.name }} said...</h4>
                    <p> {{ comment.body }} </p>
                    <span style="color: #aaa;">on Dec 15, 2017</span>
                </div>
            </div>
            <div v-if="post.comments.length == 0">
                <h2>No comment yet...</h2>
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
            listen(){ 
                window.Echo 
                .channel('post.' + this.post.id) 
                .listen('NewComment', (comment) => { 
                    this.post.comments.unshift(comment);
                }); 
            },
            createComment(){

                if(!this.isLoggedIn){
                    alert('You need to login first');
                    return false;
                }
                
                var data = {
                    postId: this.post.id,
                    comment: this.comment,
                } 
                let config = { 
                    headers: { 
                        'Accept': 'application/json', 
                    } 
                } 
                axios.post('/comment/store', data, config) 
                .then((response) => { 
                    //console.log(response.data); 
                    this.comment = '';
                    //this.post.comments.unshift(response.data);
                }) 
                .catch(function (error) { 
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
                    this.listen();

                }) 
                .catch(function (error) { 
                    if(!error.response.data.status){
                        //self.redirect('login');
                    }
                });
            },
            redirect(routeName){  
                this.$router.push({name: routeName});   
            }, 
            
        }, 
        computed: { 
        }, 
        filters: { 
        } 
    } 
</script>