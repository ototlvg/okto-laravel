window.Vue = require('vue');

import App from './components/Questions'

const app = new Vue({
    el: '#app',
    components: { App },
    template: '<App/>'
})