<template>
    <div class="container">
        <div class="cart-page" v-if="cartProducts.data != ''">
            <!------------------------------Products Cart Table -------------------------------------->
            <div class="cart-table">
                <table>
                    <thead>
                        <tr>
                            <th>Image</th>
                            <th>Product</th>
                            <th>Color</th>
                            <th>Text</th>
                            <th>Quantity</th>
                            <th>Price</th>
                            <th>SUB-TOTAL</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="product, index in cartProducts.data" :key="index">
                            <td><img :src="'/storage/' + getImage(product.productId)" alt="product image"
                                    style="width:30px; height:30px"></td>
                            <td>{{ product.title }}</td>
                            <td>{{ product.color }}</td>
                            <td>{{ product.text }}</td>
                            <td><input type="number" :id="'quantity' + index" name="quantity" :value="product.quantity"
                                    @change="update(index)"></td>
                            <td>{{ product.strike_price }}</td>
                            <td>{{ calculatedValue(product) }} €</td>
                            <td><a href="" @click.prevent="remove(index)"><img src="/storage/images/Icons/delete-icon.png" alt="" width="20px"></a></td>
                        </tr>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td>Total :</td>
                            <td>{{ sessionTotal }} €</td>
                            <td></td>
                            <td></td>
                        </tr>
                    </tfoot>
                </table>
            </div>
            <!------------------------------ Final check before checkout -------------------------------------->
            <div class="cart-finish">
                <div class="pub">

                </div>
                <div class="finish-table">
                    <table>
                        <thead>
                            <tr>
                                <th>Finishing moves</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><b>Cupon Discount</b></td>
                                <td><input type="text"></td>
                            </tr>
                            <tr>
                                <td><b>Products total</b></td>
                                <td>
                                    <h6>{{ sessionTotal }} €</h6>
                                </td>
                            </tr>
                            <tr>
                                <td><b>Shipping</b></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td><b>Total</b></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td><button class="button-login">CHECK OUT</button></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!------------------------------ Info Page if the car is empty -------------------------------------->
        <div class="cart-empty text-red" v-else>
            <h1>Cart is empty</h1>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            cartProducts: { data: [] },
            cartTotal: '',
            totalProducts: '',
            quantity: '',
            discounts: { data: [] },
            totalPrice: '',
            images: { data: [] },
        }
    },
    methods: {
        forceRerender() {
            this.$store.state.componentKey += 1;
        },
        remove(i) {

            let url = this.$store.state.Url + 'cart'

            let formdata = new FormData()

            formdata.append('product_id', i)
            formdata.append('_method', 'delete')

            let config = {
                headers: {
                    'Content-Type': 'x-www-form-urlencoded',
                    'Accept': 'application/json'
                }
            }

            axios.post(url, formdata, config)
                .then(response => {
                    alert(response.data.msg)
                    this.getData()
                    this.forceRerender()
                })
                .catch(errors => {
                    console.log(errors)
                })
        },
        update(i) { //update the quantity
            const input = document.getElementById('quantity' + i)
            const inputValue = input.value

            let url = this.$store.state.Url + 'cart'

            let formdata = new FormData()

            formdata.append('product_id', i)
            formdata.append('quantity', inputValue)
            formdata.append('_method', 'patch')

            let config = {
                headers: {
                    'Content-Type': 'x-www-form-urlencoded',
                    'Accept': 'application/json'
                }
            }

            axios.post(url, formdata, config)
                .then(response => {
                    this.getData()
                    this.forceRerender()
                })
                .catch(errors => {
                    console.log(errors)
                })
        },

        calculatedValue(p) { //gets the product value with the discount, if exists
            let price = p.strike_price
            let discountValue = ''
            let quantity = p.quantity

            this.discounts.data.forEach(e => {
                if (e.id == p.discount_price && e.ativo == 1) {
                    discountValue = e.desconto
                }
            })

            let priceDiscounted = price - (discountValue * price)

            let total = (priceDiscounted * quantity).toFixed(2)

            return total
        },

        getImage(id) {
            let image = ''
            Object.values(this.images.data).forEach(v => {
                
                if (v.produto_id == id && v.posicao == 1) {
                    image = v.nome

                }
            })
            return image

        },
        getData() {
            let url = this.$store.state.Url + 'cart'
            let urlDiscount = this.$store.state.Url + 'api/desconto'
            let urlImages = this.$store.state.Url + 'api/imagens_produto'


            axios.get(urlDiscount)
                .then((response) => {
                    this.discounts.data = response.data
                })
                .catch(errors => {
                    console.log(errors.response.data.message)
                })

            axios.get(url)
                .then((response) => {
                    this.cartProducts.data = response.data.cart_products
                    this.cartTotal = response.data.cart_total
                    this.totalProducts = response.data.total_products_count
                })
                .catch(errors => {
                    console.log(errors.response.data.message)
                })

            axios.get(urlImages)
                .then((response) => {
                    this.images.data = response.data
                })
                .catch(errors => {
                    console.log(errors.response.data.message)
                })
        }
    },
    computed: {
        sessionTotal() { // gives the total to pay from all products
            let values = []
            let total = 0

            Object.values(this.cartProducts.data).forEach(v => {
                values.push(this.calculatedValue(v))
            })

            function sum(a) { //sum all the product final value and return the total with decimals 
                return (a.length && parseFloat(a[0]) + sum(a.slice(1))) || 0;
            }

            total = sum(values).toFixed(2)

            console.log(values)

            this.totalPrice = total

            return total

        },
    },
    mounted() {
        this.getData()
    }

}
</script>