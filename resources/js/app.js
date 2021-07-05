// require('./bootstrap');
// require('alpinejs');

import { createApp } from 'vue';
import HeaderNavAuth from './components/HeaderNavAuth.vue'
import HeaderNavGuest from './components/HeaderNavGuest.vue'

createApp({
  components: {
    HeaderNavAuth,
    HeaderNavGuest,
  }
}).mount('#app')

require('./withSignupEvent.js')