<template> 
    <div class="dashboard container"> 
        <h1>Dashboard page</h1> 

        <button @click.prevent="logout()" type="submit" class="btn btn-primary">Logout</button>
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
            } 
        }, 
        created() { 
            this.onload();
        }, 
    	methods: { 
            redirect(routeName){  
                this.$router.push({name: routeName});   
            }, 
            onload(){
                var self = this;
                var data = {} 
                let config = { 
                    headers: { 
                        'Accept': 'application/json', 
                    } 
                } 
                axios.post('/check-login', data, config) 
                .then(function (response) { 
                    console.log(response.data); 
                    if(!response.data.status){
                        self.redirect('login');
                    }
                }) 
                .catch(function (error) { 
                    
                });
            },
            logout(){
                var self = this;
                var data = {} 
                let config = { 
                    headers: { 
                        'Accept': 'application/json', 
                    } 
                } 
                axios.post('/logout', data, config) 
                .then(function (response) { 
                    if(!response.data.status){
                        self.redirect('login');
                    }
                }) 
                .catch(function (error) { 
                    
                });
            }
        }, 
        computed: { 
        }, 
        filters: { 
        } 
    } 
</script>