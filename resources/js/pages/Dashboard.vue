<template> 
    <div class="dashboard container"> 
        <h1>Dashboard page</h1> 
        <h4 v-if="user.length !== 0">Welcome, {{ user.name }}</h4>
        <h4>Total Users Online: {{ count }}</h4>
        <br>

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
                user: [], 
                count: 0,
            } 
        }, 
        created() { 
            this.onload();
            this.listen();
        }, 
    	methods: { 
            redirect(routeName){  
                this.$router.push({name: routeName});   
            }, 
            onload(){
                var data = {} 
                let config = { 
                    headers: { 
                        'Accept': 'application/json', 
                    } 
                } 
                axios.post('/check-login', data, config) 
                .then((response) => { 
                    console.log(response.data); 
                    if(!response.data.status){
                        this.redirect('login');
                    } else {
                        this.user = response.data.user;
                    }
                })
                .catch(function (error) { 
                    
                });
            },
            listen() {
                window.Echo
                    .join('users-counter')
                    .here(users => this.count = users.length)
                    .joining(user => this.count++)
                    .leaving(user => this.count--);
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