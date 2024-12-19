import Dashboard from './components/Dashboard.vue';
import StudySets from './components/StudySets.vue';
import Users from './components/Users.vue';
import Account from './components/Account.vue';
import ViewDeck from './components/ViewDeck.vue';




export default [
    {
        path: '/dashboard',
        name: 'dashboard',
        component: Dashboard,
    }, 

    {
        path: '/studysets',
        name: 'studysets',
        component: StudySets,
    }, 
    {
        path: '/studysets/:id',
        name: 'viewDeck',
        component: ViewDeck,
        props: true, // Pass route params as props
    },

    {
        path: '/users',
        name: 'users',
        component: Users,
    }, 

    {
        path: '/account',
        name: 'account',
        component: Account,
    }

]