<template>
    <div class="text-center d-flex justify-content-between m-4">
        <div>
            <a href="/" class="btn btn-danger">Back To Store</a>
        </div>
    </div>

    <section class="container m-lg-auto text-center m-2">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>image</th>
                    <th>name</th>
                    <th>Description</th>
                    <th>Price</th>
                    <th>stock</th>
                    <th>actions</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="(product, index) in this.products" :key="index">
                    <td>
                        <img :src="null" alt="product-image" width="50" height="50">
                    </td>

                    <td >{{ product.name }}</td>
                    <td>{{ product.description }}</td>
                    <td>{{ product.price }}</td>
                    <td>{{ product.stock}}</td>



                    <td>
                        <button class="btn btn-danger btn-sm" @click="deleteItem(product)">Delete</button>
                    </td>

                </tr>

            </tbody>
            <tfoot>
                <tr>
                    <td>{{}}</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td>$</td>
                    <td></td>
                </tr>
            </tfoot>
        </table>
    </section>
    </template>

    <script>
    export default {
        props: [],

        data() {
            return {
                cart: [],
                // url: 'https://picsum.photos/300/300',
            }
        },

        created() {
            this.index()
            this.cart = JSON.parse(localStorage.getItem('CarritoCompras'))
            // console.log(this.cart)
            if (this.cart == null) {
                return swal.fire({
                    icon: 'warning',
                    title: 'Your cart is empty!',
                    text: 'Please add products to your cart!'
                })
            }
        },

        methods: {

            async index() {},

            async deleteItem(item) {
                try {
                    const result = await swal.fire({
                        title: 'Do you want delete the item?',
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Delete'
                    })

                    if (!result.isConfirmed) return

                    localStorage.removeItem('CarritoCompras')
                    this.cart = []
                    // this.cart = JSON.parse(localStorage.getItem('cart'))

                    swal.fire({
                        icon: 'success',
                        title: 'Congrats!',
                        text: 'Item Deleted!'
                    })
                } catch (error) {
                    console.error(error);
                }
            },
        },
    }
    </script>

