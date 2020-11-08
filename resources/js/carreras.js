console.log('Avatar')

window.Vue = require('vue');

import App from './components/Carreras'

const app = new Vue({
    el: '#app',
    components: { App },
    template: '<App/>'
})