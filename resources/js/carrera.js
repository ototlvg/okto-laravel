window.Vue = require('vue');

import App from './components/Carrera'

const app = new Vue({
    el: '#app',
    components: { App },
    template: '<App/>'
})