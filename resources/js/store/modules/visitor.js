const state = { 
    total: 0, 
    visitor: {
        name: '',
        password: '1q2w3e4r',
    },
    visitorLSKey: 'visitor_name', // Local Storage key


}; 
const getters = { 
    total: state => { 
        return state.total; 
    }, 
}; 
const actions = { 
    createVisitor: (context, payload) => { 
        context.dispatch('Visitor/checkExist', {}, { root: true }); 
        context.dispatch('Visitor/createName', {}, { root: true }); 
        context.dispatch('Visitor/saveVisitorToLS', {}, { root: true }); 
        context.dispatch('Visitor/dbCall', {}, { root: true }); 
    },
    checkExist: (context, payload) => { 
        if(localStorage.getItem(context.state.visitorLSKey) !== null) {
            context.commit('setName', localStorage.getItem(context.state.visitorLSKey));
        }
    },
    createName: (context, payload) => { 

        if(context.state.visitor.name === ''){
            var no_1 = Math.floor(Math.random() * 100000) + 1;
            var no_2 = Math.floor(Math.random() * 100000) + 1;
            var name = 'visitor_' + no_1 + '_' + no_2;

            context.commit('setName', name);
        }
        
    },
    saveVisitorToLS: (context, payload) => { 
        if(context.state.visitor.name !== ''){
            localStorage.setItem(context.state.visitorLSKey, context.state.visitor.name);
        }
        
    },
    dbCall: (context, payload) => { 

        var data = { 
            visitor: context.state.visitor, 
        }  
        let config = {  
            headers: {  
                'Accept': 'application/json',  
            }  
        }  
        axios.post('/visitor/onload', data, config)  
        .then((response) => {  
            console.log(response.data);  
        })  
        .catch(function (error) {  
        });
    },
}; 
const mutations = { 
    setName: (state, payload) => { 
        state.visitor.name = payload; 
    },
    

    
}; 

export default { 
    namespaced: true, 
    state, 
    getters, 
    actions, 
    mutations, 
}