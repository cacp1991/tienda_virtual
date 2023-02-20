import './bootstrap'
import { createApp } from 'vue'
import vSelect from 'vue-select'


/* Components */

import CategoryIndex from './components/crudcategorias/CategoryIndex.vue'
import UserHome from './components/crudusers/UserHome.vue'
import ProductList from './components/items/Product.vue'
import HomeIndex from './components/principal/HomeIndex.vue'

// lista de productos por categoria y detalle
import CategoriElectro from './components/CategoriaUno/CategoriElectro.vue'
import DetalleIndex from './components/detalleUno/DetalleIndex.vue'

// kart
import KartIndex from './components/kart/kartIndex.vue'
import carritoCompras from './components/kart/carritoCompras.vue'

const app = createApp({
	components: {
		HomeIndex,
		UserHome,
		ProductList,
		CategoryIndex,

		CategoriElectro,
		DetalleIndex,

		KartIndex,
        carritoCompras
	}
})


app.component('v-select', vSelect)
app.mount('#app')
