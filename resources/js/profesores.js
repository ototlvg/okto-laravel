console.log('RE ZERO')

window.Vue = require('vue');

import App from './components/Profesores'

const app = new Vue({
    el: '#app',
    components: { App },
    template: '<App/>'
})