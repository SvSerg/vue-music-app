import Vue from 'vue';
import Router from 'vue-router';

Vue.use(Router);

export default new Router({
  routes: [
    { path: '*', name: 'NotFoundPage', component: require('./pages/NotFoundPage') },
    { path: '/', name: 'HomePage', component: require('./pages/HomePage') },
    { path: '/search/:search', name: 'FoundItemsPage', component: require('./pages/FoundItemsPage') },
    // { path: '/register', name: 'RegisterPage', component: require('./pages/RegisterPage') },
    // { path: '/login', name: 'LoginPage', component: require('./pages/LoginPage') },
    // { path: '/logout', name: 'LogoutPage', component: require('./pages/LogoutPage') },
    // { path: '/user', name: 'UserPage', component: require('./pages/UserPage') },
  ],
});