<template> 
    <div class="register"> 
        <h1>Register page</h1> 
        <button @click.prevent="redirect('landing')" class="btn btn-primary">To Landing page</button> 
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
        }, 
    	methods: { 
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