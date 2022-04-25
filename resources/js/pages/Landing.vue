<template> 
    <div class="landing"> 
        <h1>Landing page</h1> 
        <h4>Total Visitors Online: {{ total }}</h4>
        <button @click.prevent="redirect('register')" class="btn btn-primary">To Register page</button> 
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
            this.$store.dispatch('Visitor/createVisitor');
        }, 
    	methods: { 
            redirect(routeName){  
                this.$router.push({name: routeName});   
            }, 
        }, 
        computed: { 
            ...mapGetters('Visitor', [ 
                'total', 
            ]),
        }, 
        filters: { 
        } 
    } 
</script>