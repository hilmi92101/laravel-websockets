import Vuex from 'vuex'; 
import Visitor from './modules/visitor';
import Author from './modules/author';

export default new Vuex.Store({ 
    modules: { 
        Visitor, 
        Author, 
    } 
});