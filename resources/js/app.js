require('jquery');
require('./bootstrap');
require('./AdminLTE');
window.toastr = require('toastr/toastr');
require('bootstrap');
window.Chart = require('chart.js');
window.Vue = require('vue/dist/vue');
import {VueAutosuggest} from "vue-autosuggest";
const { Dropzone } = require("dropzone");
window.Dropzone = Dropzone;
Vue.component('vue-autosuggest', VueAutosuggest);
Vue.use(VueAutosuggest);
Vue.config.ignoredElements = [/^ion-/];
window.VueAutosuggest = VueAutosuggest;
window.s4 = () => {
    return Math.floor((1 + Math.random()) * 0x10000)
        .toString(16)
        .substring(1);
}
