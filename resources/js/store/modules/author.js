const state = { 
    total: 0, 
    author: {
        name: '',
        password: '1q2w3e4r',
        token: '',
    },


}; 
const getters = { 
    total: state => { 
        return state.total; 
    }, 
}; 
const actions = { 
    createAuthor: (context, payload) => { 
        context.dispatch('Author/checkNameExistOrCreate', {}, { root: true }); 
        context.dispatch('Author/checkTokenExistOrCreate', {}, { root: true }); 
    },

    checkNameExistOrCreate: (context, payload) => { 
        if(localStorage.getItem('author_name') !== null) {
            context.commit('setName', localStorage.getItem('author_name'));
        } else {
            var no_1 = Math.floor(Math.random() * 100000) + 1;
            var no_2 = Math.floor(Math.random() * 100000) + 1;
            var name = 'author_' + no_1 + '_' + no_2;
            context.commit('setName', name);

            // Store at Local Storage
            localStorage.setItem('author_name', context.state.author.name);
        }
    },
    checkTokenExistOrCreate: (context, payload) => { 
        if(localStorage.getItem('author_token') !== null) {
            var token = localStorage.getItem('author_token');
            context.dispatch('Author/checkTokenValiditiy', token, { root: true });

        } else {
            context.dispatch('Author/createToken', {}, { root: true });
        }
    },
    checkTokenValiditiy: (context, payload) => {
        var data = {}  
        let config = {  
            headers: {  
                'Accept': 'application/json',  
                'Authorization': 'Bearer ' + payload,  
            }  
        }  
        console.log(config)
        axios.post('/api/user', data, config)  
        .then((response) => {  
            //console.log(response.data);
            context.dispatch('Author/listenAuthorTotal', {}, { root: true });
        })  
        .catch((error) => {
            //console.log(error.response)  
            if(error.response.status === 401){
                context.dispatch('Author/createToken', {}, { root: true });
            }
        });
    },
    createToken: (context, payload) => { 
        
        var data = { 
            name: context.state.author.name, 
            password: context.state.author.password, 
        }  
        let config = {  
            headers: {  
                'Accept': 'application/json',  
            }  
        }  
        axios.post('/api/author/login', data, config)  
        .then((response) => {  
            console.log(response.data);
            var token = response.data.author_token;
            context.commit('setToken', token);

            // Store at Local Storage
            localStorage.setItem('author_token', token);

            // Start listening
            context.dispatch('Author/listenAuthorTotal', {}, { root: true }); 
        })  
        .catch(function (error) {  
        });
    },

    listenAuthorTotal: (context, payload) => { 
        window.Echo3
            .join('authors-counter')
            .here(users => context.state.total = users.length)
            .joining(user => context.state.total++)
            .leaving(user => context.state.total--);
    },

}; 
const mutations = { 
    setName: (state, payload) => { 
        state.author.name = payload; 
    },
    setToken: (state, payload) => { 
        state.author.token = payload; 
    },
    
}; 

export default { 
    namespaced: true, 
    state, 
    getters, 
    actions, 
    mutations, 
}