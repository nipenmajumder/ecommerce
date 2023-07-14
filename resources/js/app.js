
import './bootstrap';
import {createApp} from 'vue'
import {ZiggyVue} from '../../vendor/tightenco/ziggy/dist/vue.m';
import mixin from "./mixins/mixin";
import "vue-select/dist/vue-select.css";
import {Bootstrap5Pagination} from 'laravel-vue-pagination';
import vSelect from "vue-select";
import Create from "./components/product/create.vue";
import Edit from "./components/product/edit.vue";
import Index from "./components/product/index.vue";
import CreatePurchase from "./components/purchase/Purchase.vue";
import Books from "./components/frontend/common/books.vue";

const app = createApp({});
app.use(ZiggyVue, Ziggy);
app.component("pagination", Bootstrap5Pagination);
app.component("v-select", vSelect);


app.component('create-product', Create);
app.component('edit-product', Edit);
app.component('product-list', Index);
app.component('create-purchase', CreatePurchase)
app.component('books-list', Books);
app.mixin(mixin);
app.mount("#app");
