const state = { 
    total: 0, 
    visitor: {
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
    createVisitor: (context, payload) => { 
        context.dispatch('Visitor/checkNameExistOrCreate', {}, { root: true }); 
        context.dispatch('Visitor/checkTokenExistOrCreate', {}, { root: true }); 
    },

    checkNameExistOrCreate: (context, payload) => { 
        if(localStorage.getItem('visitor_name') !== null) {
            context.commit('setName', localStorage.getItem('visitor_name'));
        } else {
            var no_1 = Math.floor(Math.random() * 100000) + 1;
            var no_2 = Math.floor(Math.random() * 100000) + 1;
            var name = 'visitor_' + no_1 + '_' + no_2;
            context.commit('setName', name);

            // Store at Local Storage
            localStorage.setItem('visitor_name', context.state.visitor.name);
        }
    },
    checkTokenExistOrCreate: (context, payload) => { 
        if(localStorage.getItem('visitor_token') !== null) {
            var token = localStorage.getItem('visitor_token');
            context.dispatch('Visitor/checkTokenValiditiy', token, { root: true });

        } else {
            context.dispatch('Visitor/createToken', {}, { root: true });
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
            context.dispatch('Visitor/listenVisitorTotal', {}, { root: true });
        })  
        .catch((error) => {
            //console.log(error.response)  
            if(error.response.status === 401){
                context.dispatch('Visitor/createToken', {}, { root: true });
            }
        });
    },
    createToken: (context, payload) => { 
        
        var data = { 
            name: context.state.visitor.name, 
            password: context.state.visitor.password, 
        }  
        let config = {  
            headers: {  
                'Accept': 'application/json',  
            }  
        }  
        axios.post('/api/visitor/login', data, config)  
        .then((response) => {  
            console.log(response.data);
            var token = response.data.visitor_token;
            context.commit('setToken', token);

            // Store at Local Storage
            localStorage.setItem('visitor_token', token);

            // Start listening
            context.dispatch('Visitor/listenVisitorTotal', {}, { root: true }); 
        })  
        .catch(function (error) {  
        });
    },

    listenVisitorTotal: (context, payload) => { 
        window.Echo2
            .join('visitors-counter')
            .here(users => context.state.total = users.length)
            .joining(user => context.state.total++)
            .leaving(user => context.state.total--);
    },

}; 
const mutations = { 
    setName: (state, payload) => { 
        state.visitor.name = payload; 
    },
    setToken: (state, payload) => { 
        state.visitor.token = payload; 
    },
    
}; 

export default { 
    namespaced: true, 
    state, 
    getters, 
    actions, 
    mutations, 
}