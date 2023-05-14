import './bootstrap';

import { createApp } from 'vue'
import {ZiggyVue} from '../../vendor/tightenco/ziggy/dist/vue.m';
import mixin from "./mixins/mixin";
const app = createApp({});
app.use(ZiggyVue, Ziggy);
app.mixin(mixin);
app.mount("#app");
