<template>
    <form class="row" @submit.prevent="purchaseStore">
        <div class="mb-3 col-md-4">
            <label class="form-label" for="date">Date<span class="text-danger">*</span></label>
            <input type="date" class="form-control" id="date" name="date" disabled v-model="purchase.date">
            <span v-if="allErrors.has('date')" class="error text-danger text-bold ms-2 mt-2"
                  v-text="allErrors.get('date')"></span>
        </div>
        <div class="mb-3 col-md-4">
            <label class="form-label" for="invoice">Invoice<span class="text-danger">*</span></label>
            <input type="text" class="form-control" id="invoice" name="invoice" disabled v-model="purchase.invoice">
            <span v-if="allErrors.has('Invoice')" class="error text-danger text-bold ms-2 mt-2"
                  v-text="allErrors.get('Invoice')"></span>
        </div>
        <div class="mb-3 col-md-4">
            <label class="form-label" for="user">User<span class="text-danger">*</span></label>
            <input type="text" class="form-control" id="user" name="user" disabled v-model="user.name">
        </div>
        <div class="mb-3 col-md-4"></div>
        <div class="mb-3 col-md-4">
            <label class="form-label" for="barcode">Barcode<span class="text-danger">*</span></label>
            <input type="text" class="form-control" id="barcode" name="barcode" v-model="barcode">
            <span class="text-danger" v-if="allErrors.has('barcode')" v-text="allErrors.get('barcode')"></span>
        </div>
        <div class="mb-3 col-md-4"></div>
        <div class="mb-3 col-md-4"></div>
        <div class="mb-3 col-md-4 text-center">
            <div v-if="spinner" class="spinner-border text-success" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
        </div>
        <div class="mb-3 col-md-4"></div>

        <div style="overflow-x: auto" class="mb-3">
            <table class="table table-bordered" v-if="purchaseProducts.length > 0">
                <tbody>
                <tr>
                    <th>Barcode</th>
                    <th>Product</th>
                    <th>SKU</th>
                    <th>Buy Price</th>
                    <th class="text-center" style="width: 15%;">Quantity</th>
                    <th class="text-center">Total Price</th>
                    <th class="text-center">Action</th>
                </tr>
                <tr v-for="(product, index) in purchaseProducts">
                    <td>{{ product.product_barcode }}</td>
                    <td>{{ product.product_name }}</td>
                    <td>{{ product.variation_sku }}</td>
                    <td class="text-center">{{ product.product_buy_price }}</td>
                    <td class="text-center">
                        <div class="input-group">
                            <input @input="quantityInput(index, product)" type="number" min="1" step="1"
                                   v-model.number="product.quantity" class="form-control text-center">
                        </div>
                    </td>
                    <td class="text-center">{{ product.total_price }}</td>
                    <td class="text-center" @click="purchaseProducts.splice(index, 1)">
                        <i class='bx bxs-trash cursor-pointer text-danger'></i>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
        <div v-if="purchaseProducts.length > 0" class="mb-3 col-md-12 text-center">
            Profit: BDT {{ totalCalculation.profit }}/- &nbsp;&nbsp;&nbsp;&nbsp;Total Quantity:
            {{ totalCalculation.totalQuantity }}
            &nbsp;&nbsp;&nbsp;&nbsp;Total Purchase Amount: BDT {{ totalCalculation.totalPurchase }} /-
        </div>
        <div class="text-center">
            <h4 class="text-danger text-bold" v-if="allErrors.has('purchase_products')"
                v-text="allErrors.get('purchase_products')"></h4>
        </div>
        <div class="mb-3 col-md-12 text-center">
            <button type="submit" v-if="isLoading" class="btn btn-success">Purchasing....</button>
            <button type="submit" v-else class="btn btn-success">Purchase</button>
        </div>
    </form>

</template>
<script>

import collect from 'collect.js';
import Errors from "../../errors/errors";
import _ from "lodash";

export default {
    props: ['user', 'invoice', 'date'],
    data() {
        return {
            purchase: {
                date: this.date,
                invoice: this.invoice,
            },
            purchaseProducts: [],
            barcode: "",
            allErrors: new Errors(),
            spinner: false,
            isLoading: false,
        }
    },
    watch: {
        'barcode'() {
            if (this.barcode.length < 1) {
                return true;
            }
            this.spinner = true;
            this.getSkuProduct();
        },
    },
    methods: {
        purchaseStore() {
            this.isLoading = true;
            this.loader(true);
            const form = {
                ...this.purchase,
                purchase_products: this.purchaseProducts,
                ...this.totalCalculation
            }
            axios
                .post(route('purchase.store'), form)
                .then((response) => {
                    if (response.data.status === 201) {
                        toastr.success("Purchase add successfully")
                        // const url = route('purchases.show', response.data.result.id);
                        // this.newTab(url);
                        this.reload(0);
                        this.Loader();
                    }

                })
                .catch(error => {
                    this.allErrors.record(error.response.data.errors);
                    this.playSound();
                    this.isLoading = false;
                    this.loader();
                })
        },
        getSkuProduct: _.debounce(function () {
            axios
                .post(route('barcode-wise-product'), {barcode: this.barcode})
                .then((response) => {
                    this.allErrors.clear('purchase_products')
                    if (response.data.result) {
                        let oldProduct = collect(this.purchaseProducts).pluck('product_barcode').toArray();
                        let newProduct = collect(response.data.result).whereNotIn('product_barcode', oldProduct).toArray();
                        for (const key in this.purchaseProducts) {
                            if (this.purchaseProducts[key].product_barcode === this.barcode) {
                                console.log('here')
                                this.purchaseProducts[key].quantity += 1;
                                this.quantityInput(key, this.purchaseProducts[key]);
                            }
                        }
                        if (newProduct) {
                            console.log('new product')
                            for (const newProductKey in newProduct) {
                                this.purchaseProducts.push(newProduct[newProductKey]);
                            }
                            toastr.success("Product add successfully")
                        }
                    }
                    this.barcode = "";
                    this.spinner = false;
                })
                .catch(error => {
                    this.allErrors.record(error.response.data.errors);
                    this.playSound();
                    this.spinner = false;
                })
        }, 500),
        quantityInput(index, current_product) {
            if (current_product.quantity < 1) {
                this.purchaseProducts[index].quantity = 1;
                this.purchaseProducts[index].total_price = (parseInt(this.purchaseProducts[index].quantity) * current_product.product_buy_price);
                return;
            }
            this.purchaseProducts[index].total_price = (parseInt(current_product.quantity) * current_product.product_buy_price);

        }
    },
    computed: {
        totalCalculation() {
            const totalPurchase = this.purchaseProducts.reduce((total, current) => total + current.total_price, 0);
            const totalQuantity = this.purchaseProducts.reduce((total, current) => total + current.quantity, 0);
            const totalSellPrice = this.purchaseProducts.reduce((total, current) => total + (current.product_sell_price * current.quantity), 0);
            const profit = parseFloat(totalSellPrice) - parseFloat(totalPurchase)
            return {
                'totalPurchase': totalPurchase,
                'subtotal': totalPurchase,
                'total': totalPurchase,
                'profit': profit,
                'total_quantity': totalQuantity,
            };

        },
    }
}
</script>
<style scoped>

</style>
