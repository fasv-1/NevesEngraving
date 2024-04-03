<template>
    <div class="container">
        <div class="cart-page" v-if="cartProducts.data != ''">
            <table>
                <thead>
                    <tr>
                        <th>Image</th>
                        <th>Product</th>
                        <th>Color</th>
                        <th>Text</th>
                        <th>Quantity</th>
                        <th>Total</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="product, index in cartProducts.data" :key="index">
                        <td><img :src="'/storage/' + getImage(index)" alt="product image" style="width:30px; height:30px"></td>
                        <td>{{ product.title }}</td>
                        <td>{{ product.color }}</td>
                        <td>{{ product.text }}</td>
                        <td><input type="number" :id="'quantity' + index" name="quantity" :value="product.quantity"
                                @change="update(index)"></td>
                        <td>{{ calculatedValue(product) }}</td>
                        <td><button @click="remove(index)">remover</button></td>
                    </tr>
                </tbody>
                <tfoot>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td>{{ sessionTotal }}</td>
                        <td></td>
                    </tr>
                </tfoot>
            </table>

        </div>
        <div class="cart-empty" v-else>
            <h1>Cart empty</h1>
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
                })
                .catch(errors => {
                    console.log(errors)
                })
        },
        update(i) {
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
                    console.log(response)
                    this.getData()
                })
                .catch(errors => {
                    console.log(errors)
                })
        },
        calculatedValue(p) {
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
        getImage(id){
            let image = ''
            Object.values(this.images.data).forEach(v => {
                if(v.produto_id == id && v.posicao == 1){
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
                    //   console.log(response.data)
                })
                .catch(errors => {
                    console.log(errors.response.data.message)
                })

            axios.get(url)
                .then((response) => {
                    this.cartProducts.data = response.data.cart_products
                    this.cartTotal = response.data.cart_total
                    this.totalProducts = response.data.total_products_count
                      console.log(response)
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
        sessionTotal() {
            let values = []
            let total = 0

            Object.values(this.cartProducts.data).forEach(v => {
                values.push(this.calculatedValue(v))
            })

            function sum(a) {
                return (a.length && parseFloat(a[0]) + sum(a.slice(1))) || 0;
            }

            total = sum(values).toFixed(2)

            this.totalPrice = total

            return total

        },
    },
    mounted() {
        this.getData()
    }

}
</script>