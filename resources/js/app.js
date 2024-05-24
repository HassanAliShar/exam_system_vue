import './bootstrap';
import $ from 'jquery';
import { createApp } from 'vue';
import router from './routes';
import 'toastr/build/toastr.css';
import 'datatables.net-bs4/css/dataTables.bootstrap4.min.css';
import 'vue-draggable-resizable/style.css';
// import select2 library
import 'select2/dist/css/select2.css';
import 'select2';


import App from './components/layouts/App.vue';
import { library } from "@fortawesome/fontawesome-svg-core";
import { faRefresh } from "@fortawesome/free-solid-svg-icons";
import { FontAwesomeIcon } from "@fortawesome/vue-fontawesome";

library.add(faRefresh);



const app = createApp(App);
app.component("font-awesome-icon", FontAwesomeIcon);
app.use(router);
app.mount('#app');
