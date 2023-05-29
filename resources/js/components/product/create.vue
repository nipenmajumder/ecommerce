<template>
    <div class="card mb-4">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Add Product</h5>
        </div>
        <div class="card-body">
            <form class="row" @submit.prevent="submit">
                <div class="mb-3 col-md-4">
                    <label class="form-label" for="name">Name<span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="name" placeholder="Name" name="name"
                           v-model="product.name">
                    <span v-if="this.allErrors.has('name')"
                          class="error text-danger text-bold ms-2 mt-2"
                          v-text="this.allErrors.get('name')">
                    </span>
                </div>
                <div class="mb-3 col-md-4">
                    <label class="form-label" for="slug">Slug<span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="slug" placeholder="Slug" name="slug"
                           disabled v-model="product.slug">
                    <span v-if="this.allErrors.has('slug')"
                          class="error text-danger text-bold ms-2 mt-2"
                          v-text="this.allErrors.get('slug')">
                    </span>
                </div>
                <div class="mb-3 col-md-4">
                    <label class="form-label" for="sku">Sku<span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="sku" placeholder="Sku" name="sku" v-model="product.sku"
                           disabled>
                    <span v-if="this.allErrors.has('sku')"
                          class="error text-danger text-bold ms-2 mt-2"
                          v-text="this.allErrors.get('sku')">
                    </span>
                </div>
                <div class="mb-3 col-md-4">
                    <label class="form-label" for="barcode">Barcode<span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="barcode" placeholder="Barcode" name="barcode"
                           disabled v-model="product.barcode">
                    <span v-if="this.allErrors.has('barcode')"
                          class="error text-danger text-bold ms-2 mt-2"
                          v-text="this.allErrors.get('barcode')">
                    </span>
                </div>
                <div class="mb-3 col-md-4">
                    <label class="form-label" for="author">Author<span class="text-danger">*</span></label>
                    <v-select :options="authors"
                              :label="'name'"
                              name="author_id"
                              :placeholder="'Select Author'"
                              :reduce="author => author.id"
                              v-model="product.author_id"
                    >
                    </v-select>
                    <span v-if="this.allErrors.has('author_id')"
                          class="error text-danger text-bold ms-2 mt-2"
                          v-text="this.allErrors.get('author_id')">
                    </span>
                </div>
                <div class="mb-3 col-md-4">
                    <label class="form-label" for="publication">Publication<span class="text-danger">*</span></label>
                    <v-select :options="publications"
                              :label="'name'"
                              name="publication_id"
                              :placeholder="'Select Publication'"
                              :reduce="publication => publication.id"
                              v-model="product.publication_id"
                    >
                    </v-select>
                    <span v-if="this.allErrors.has('publication_id')"
                          class="error text-danger text-bold ms-2 mt-2"
                          v-text="this.allErrors.get('publication_id')">
                    </span>
                </div>
                <div class="mb-3 col-md-4">
                    <label class="form-label" for="buy_price">Buy Price<span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="buy_price" placeholder="Buy Price" name="buy_price"
                           v-model.number="product.buy_price">
                    <span v-if="this.allErrors.has('buy_price')"
                          class="error text-danger text-bold ms-2 mt-2"
                          v-text="this.allErrors.get('buy_price')">
                    </span>
                </div>
                <div class="mb-3 col-md-4">
                    <label class="form-label" for="sell_price">Sell Price<span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="sell_price" placeholder="Sell Price" name="sell_price"
                           v-model.number="product.sell_price">
                    <span v-if="this.allErrors.has('sell_price')"
                          class="error text-danger text-bold ms-2 mt-2"
                          v-text="this.allErrors.get('sell_price')">
                    </span>
                </div>
                <div class="mb-3 col-md-4">
                    <label class="form-label" for="status">Status<span class="text-danger">*</span></label>
                    <v-select
                        :options="statuses"
                        :label="'name'"
                        name="status"
                        :placeholder="'Select Status'"
                        :reduce="status => status.value"
                        v-model="product.status"
                    >
                    </v-select>
                    <span v-if="this.allErrors.has('status')"
                          class="error text-danger text-bold ms-2 mt-2"
                          v-text="this.allErrors.get('status')">
                    </span>
                </div>
                <div class="mb-3 col-md-12">
                    <label class="form-label" for="image">Image</label>
                    <input type="file" class="form-control" id="image" name="image">
                    <span v-if="this.allErrors.has('image')"
                          class="error text-danger text-bold ms-2 mt-2"
                          v-text="this.allErrors.get('image')">
                    </span>
                </div>
                <div class="mb-3 col-12">
                    <label class="form-label" for="description">Description<span class="text-danger">*</span></label>
                    <textarea class="form-control" id="description" placeholder="Description"
                              name="description" v-model="product.description"></textarea>
                    <span v-if="this.allErrors.has('description')"
                          class="error text-danger text-bold ms-2 mt-2"
                          v-text="this.allErrors.get('description')">
                    </span>
                </div>
                <div class="mb-3 col-12 text-center">
                    <button type="submit" class="btn btn-success">Store</button>
                </div>
            </form>
        </div>
    </div>
</template>

<script>
import Errors from "../../errors/errors";

export default {
    name: "CreateProduct",
    data() {
        return {
            allErrors: new Errors(),
            authors: [],
            publications: [],
            statuses: [
                {name: 'Active', value: 1},
                {name: 'Inactive', value: 2},
            ],
            product: {
                name: '',
                slug: '',
                sku: '',
                barcode: '',
                author_id: '',
                publication_id: '',
                buy_price: 0,
                sell_price: 0,
                image: '',
                description: '',
                status: '',
            }
        }
    },
    watch: {
        'product.name': function (val) {
            this.product.slug = this.slugify(val);
        }
    },
    methods: {
        getAuthors() {
            axios.get(route('get-authors'))
                .then(response => {
                    this.authors = response.data.result;
                })
                .catch(error => {
                    console.log(error);
                })
        },
        getPublications() {
            axios.get(route('get-publications'))
                .then(response => {
                    this.publications = response.data.result;
                })
                .catch(error => {
                    console.log(error);
                })
        },
        getSkuBarcode() {
            axios.get(route('get-sku-barcode'))
                .then(response => {
                    this.product.sku = response.data.result.sku;
                    this.product.barcode = response.data.result.barcode;
                })
                .catch(error => {
                    console.log(error);
                })
        },
        submit() {
            this.loader(true);
            axios.post(route('product.store'), {
                ...this.product
            })
                .then(response => {
                    if (response.status === 201) {
                        this.loader(false);
                        toastr.success(response.data.message);
                        location.reload();
                    }
                })
                .catch(error => {
                    console.log(error.response.data);
                    if (error.response.status !== 422) {
                        toastr.error(error.message);
                    }
                    if (error && error.response.status === 422) {
                        this.allErrors.record(error.response.data.errors);
                    }
                    this.playSound();
                    this.loader();
                })
        }
    },
    created() {
        this.getAuthors();
        this.getPublications();
        this.getSkuBarcode();
    }
}
</script>
<style scoped>

</style>
