let routes= [];
let routes_list= [];

import List from '../pages/events/List.vue'
import Form from '../pages/events/Form.vue'
import Item from '../pages/events/Item.vue'

routes_list = {

    path: '/events',
    name: 'events.index',
    component: List,
    props: true,
    children:[
        {
            path: 'form/:id?',
            name: 'events.form',
            component: Form,
            props: true,
        },
        {
            path: 'view/:id?',
            name: 'events.view',
            component: Item,
            props: true,
        },

    ]
};

routes.push(routes_list);

export default routes;

