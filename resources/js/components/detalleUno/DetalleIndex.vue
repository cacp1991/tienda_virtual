<template>

    <div class="card m-5" >
  <div class="card-header bg-warning  text-white ">
   Detalle del articulo
  </div>
  <div class="card-body">
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

			<img src="electrodomesticos.jpeg" class="card-img-top" alt="producto" v-else />

        </div>
	</section>

    <h2 class="card-title">{{ product.name }}</h2>
    <text class="card-text">{{ product.description }}</text>
    <h3 class="card-price">Precio: ${{ product.price }}</h3>
    <H5 class="card-stock"> {{ product.stock }} unidades disponibles</H5>
    <input type="number" id=""/>
    <hr>
    <a class="btn btn-primary" @click="add(product)">añadir a carrito</a><br>

  </div>
</div>

			<div class="card-body d-flex justify-content-center flex-wrap">
				<H5 class="card-name"></H5>
				<H5 class="card-description"></H5>



			</div>

</template>

<script>
 import {getData, saveData} from '../../localStorage'
	export default {
		props: ['product','user'],
        created(){
            console.log(this.product)
        },
		methods: {

            async add (product) {
                if  (!this.user){
                    await swal.fire({
						icon: 'error',
						title: 'Lo siento...',
						text: 'Inicia sesion para continuar con tu compra'
					})
                    window.location.replace("/login");

                } else{

                console.log(product);
                let data = getData (this.user.id)
                if (!data) data = []
                data = [...data,product]
                console.log(data);
                saveData (this.user.id, data)

                 swal.fire({
						icon: 'success',
						title: 'Felicidades',
						text: 'producto añadido al carrito de compras'
					})
                }
            }
        }
	}
</script>
