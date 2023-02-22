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
					<th>image</th>
					<th>name</th>
					<th>description</th>
					<th>price</th>
					<th>stock</th>
				</tr>
			</thead>
			<tbody>
				<tr v-for="(product, index) in products" :key="index">
					<section class="d-flex justify-content-center flex-wrap">
						<div class="card m-5" style="width: 14rem">
							<img
								:src="`/storage/images/${product.image}`"
								alt=""
								class="card-img-top"
								width="100"
								height="160"
								v-if="product.image"
							/>
						</div>
					</section>

					<td>{{ product.name }}</td>
					<td>{{ product.description }}</td>
					<td ><strong>$ {{ product.price }}</strong></td>
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
		<strong>Total $</strong><p >{{ total }}</p>

	</section>
</template>

<script>
	import { getData, saveData } from '../../localStorage'
	export default {
		props: ['user'],
		data() {
			return {
                suma:{},
				products: [],
                cesta: '',
				total: 0
			}
		},
		created() {
			this.index()

		},
		//  para la cesta del carrito
		// computed: {
		// 	cestaTotal: function () {
        //         this.total = 0
				// let suma = 0
				// for (key in this.cesta) {
				// 	suma = suma + this.cesta[key].product.price * this.cesta[key].product.stock
				// }
				// return suma
			// }
		// },

		methods: {
			index() {
				this.products = this.getProduct()
                this.cestaTotal()
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
			},
            cestaTotal()
            {
                this.total = 0
                console.log(this.products)
                this.products.map(e =>{
                    this.total += e.stock * e.price

                })
                console.log(this.total)

                // this.cesta = 0
                // console.log(this.products)
                // this.products.map(e =>{
                //     this.cesta += e.stock * e.price

                // })
                // console.log(this.cesta)


            }
		}
	}
</script>
