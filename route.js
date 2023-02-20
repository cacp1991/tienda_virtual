import { createWebHistory, createRouter } from 'vue-route'
import HomeIndex from './resources/js/components/principal/HomeIndex.vue'
import electrodomesticos from './resources/js/components/Categories/ListaProductos.vue'

const routes = [	
	{
		path: '/',
		name: HomeIndex,
		component: home
	},

    {
		path: '/electro',
		name: electro,
		component: electrodomesticos
	}
];

const route = createRouter({
    history: createWebHistory(process.env.BASE_URL),
    routes
});

export default route

