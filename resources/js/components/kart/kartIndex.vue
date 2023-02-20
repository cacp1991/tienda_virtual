<template>
	<section class="d-flex justify-content-center flex-wrap m-5">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">Inicio</a></li>
            </ol>
        </nav>
		<table class="table" id="">
			<thead>
				<tr>
					<th>name</th>
					<th>description</th>

					<th>price</th>
					<th>stock</th>
				</tr>
			</thead>
			<tbody>
				<tr v-for="(product, index) in products" :key="index">
					<td>{{ product.name }}</td>
					<td>{{ product.description }}</td>
					<td>{{ product.price }}</td>
					<td><input v-model="product.stock" /></td>
					<td>
						<button
							type="button"
							class="btn btn-danger"
							aria-label="Close"
							@click="remove(product)"
						>
							Eliminar
						</button>
					</td>
				</tr>
			</tbody>
		</table>
	</section>

</template>

<script>
	import { getData, saveData } from '../../localStorage'
	export default {
		props: ['user'],
		data() {
			return {
				products: [],
				total: 0
			}
		},
		created() {
			this.index()
		},

        //  para la cesta del carrito
        computed: {
            cestaTotal: function(){
                let suma = 0;
                for (key in this.cesta){
                    suma = suma+(this.cesta[key].product.price *
                    this.cesta[key].cant);
                }
                return suma
            }
        },

		methods: {
			index() {
				this.products = this.getProduct()
			},
			getProduct() {
				return getData(this.user.id) ?? []
			},
			remove(product) {
				const products = this.products.filter(element => {
					if (element.id != product.id) return element
				})
				console.log(products)
				saveData(this.user.id, products)
				this.index()
				this.$forceUpdate() //forzar
			}
		}
	}
</script>
