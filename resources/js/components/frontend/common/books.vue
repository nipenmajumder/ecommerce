<template>
    <div class="row mt-3">
        <div class="col-md-3">
            <div class="mb-2">
                <h6 class="bg-warning p-3">লেখক</h6>
                <div class="form-check" v-for="(author,index) in authors" :key="author.id">
                    <input class="form-check-input" type="checkbox" v-model="selectedAuthors" :value="author.id"
                           :id="'author'+ author.id">
                    <label class="form-check-label" :for="'author'+ author.id">
                        {{ author.name }} ({{ author.book_count }})
                    </label>
                </div>
            </div>
            <div>
                <h6 class="bg-warning p-3">প্রকাশক</h6>
                <div class="form-check" v-for="(publication,index) in publications" :key="publication.id">
                    <input class="form-check-input" type="checkbox" v-model="selectedPublications"
                           :value="publication.id" :id="'publication'+ publication.id">
                    <label class="form-check-label" :for="'publication'+ publication.id">
                        {{ publication.name }} ({{ publication.book_count }})
                    </label>
                </div>
            </div>
            <div>
                <h6 class="bg-warning p-3">বিষয়</h6>
                <div class="form-check" v-for="(category,index) in categories" :key="category.id">
                    <input class="form-check-input" type="checkbox" v-model="selectedCategories" :value="category.id"
                           :id="'category'+ category.id">
                    <label class="form-check-label" :for="'category'+ category.id">
                        {{ category.name }} ({{ category.book_count }})
                    </label>
                </div>
            </div>
        </div>
        <div class="col-md-9">
            <div class="row my-2">
                <div class="col-md-6">
                    <h6 class="card-text">
                        <small class="text-muted font-weight-bold" v-if="products && products.meta">
                            {{ products.meta.from || 0 }} থেকে {{ products.meta.to || 0 }} দেখাচ্ছে।
                            মোট {{ products.meta.total || 0 }} টি আইটেম পাওয়া গিয়েছে
                        </small>
                    </h6>

                </div>
                <div class="col-md-6">
                    <div class="row mb-3">
                        <label for="colFormLabelSm" class="col-sm-3 col-form-label col-form-label-sm">সর্ট করুন</label>
                        <div class="col-sm-9">
                            <div class="select-wrapper">
                                <select id="inputState" class="form-select">
                                    <option selected>Choose...</option>
                                    <option>...</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row row-cols-1 row-cols-md-3 g-4 mb-3">
                <div class="col-md-3" v-for="(product, index) in products.data" :key="product.id">
                    <div class="card h-100">
<!--                        <img :src="`/${product.image}`" class="card-img-top" alt="...">-->
<!--                        <span class="position-absolute top-0 start-25 translate-middle badge bg-danger p-2 mt-2">30% ছাড়</span>-->
                        <img :src="`/${product.image}`" class="card-img-top" alt="..."><span
                        class="position-absolute top-0 start-25 translate-middle badge border border-light rounded-circle bg-danger p-2 mt-2">30%
                                <br>
                                ছাড়</span>
                        <div class="card-body">
                            <h5 class="card-title fs-6">{{ product.name }}</h5>
                            <p class="card-text text-muted fs-6">আবদুল্লাহ আল মাসউদ</p>
                            <p class="card-text">
<!--                                <span class="text-decoration-line-through">-->
<!--                                    {{ product.sell_price }} ৳-->
<!--                                </span> -->
                                <span class="text-danger">{{ product.sell_price }} ৳</span>
                            </p>
                        </div>
                    </div>
                </div>

            </div>
            <pagination :data="products" :limit="10" :align="'center'"
                        @pagination-change-page="getPaginatedProducts($event)"/>
        </div>
    </div>
</template>
<script>
import {defineComponent} from 'vue'

export default defineComponent({
    name: "books",
    data() {
        return {
            categories: [],
            authors: [],
            publications: [],
            products: {},
            selectedAuthors: [],
            selectedCategories: [],
            selectedPublications: [],
        }
    },
    methods: {
        getCategories() {
            axios.get(route('get-categories-data'))
                .then((response) => {
                    this.categories = response.data.result.data;
                })
                .catch((error) => {
                    // toastr.error(error);
                    console.log(error)
                })
        },
        getAuthors() {
            axios.get(route('get-authors-data'))
                .then((response) => {
                    this.authors = response.data.result.data;
                })
                .catch((error) => {
                    // toastr.error(error);
                    console.log(error)
                })
        },
        getPublications() {
            axios.get(route('get-publications-data'))
                .then((response) => {
                    this.publications = response.data.result.data;
                })
                .catch((error) => {
                    // toastr.error(error);
                    console.log(error)
                })
        },
        getProducts({page = 1,}) {
            this.loader(true);
            axios.get(route('get-books-data'), {
                params: {
                    page,
                }
            })
                .then((response) => {
                    this.loader(false);
                    this.products = response.data.result;
                })
                .catch((error) => {
                    this.loader(false);
                    toastr.error(error);
                    console.log(error)
                })
        },
        getPaginatedProducts(page) {
            this.getProducts({page: page});
            this.scrollToTop();
        },
    },
    created() {
        this.getCategories();
        this.getAuthors();
        this.getPublications();
        this.getProducts({page: 1});
    }
})
</script>
<style scoped>

</style>
