<template> 
    <div class="landing"> 
        <h1>Author page</h1> 
        <h4>Total Authors Online: {{ total }}</h4>
    </div> 
</template> 
<script> 
    import { mapGetters } from 'vuex';

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
            console.log(this.total);
            this.$store.dispatch('Author/createAuthor');
        }, 
    	methods: { 
            redirect(routeName){  
                this.$router.push({name: routeName});   
            }, 
        }, 
        computed: { 
            ...mapGetters('Author', [ 
                'total', 
            ]),
        }, 
        filters: { 
        } 
    } 
</script>