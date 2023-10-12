import { createApp } from "vue";
import App from "./App.vue";
import AdminMain from "./pages/Admin/Main.vue"
import router from './router'; // Importa el enrutador

//add this
import { aliases, mdi } from 'vuetify/iconsets/mdi'
//

// Vuetify
import "vuetify/styles";
import { createVuetify } from "vuetify";
import * as components from "vuetify/components";
import * as directives from "vuetify/directives";

import '@mdi/font/css/materialdesignicons.css';




// Componentes
import AppBar from './components/AppBar.vue'
import Footer from './components/Footer.vue'
import SectionSeparator from './components/SectionSeparator.vue'
// Home Componentes
import HomeCarousel from './components/Home/Carousel.vue'
import HomeInfo from './components/Home/Info.vue'
import HomeList from './components/Home/List.vue'

import HomeAboutUS from './components/Home/AboutUS.vue'
import HomeContact from './components/Home/Contact.vue'
// Productos
import ProductosCard from './components/Productos/Card.vue'


import colors from 'vuetify/lib/util/colors'

// Admin Components
import AdminSidebar from './components/Admin/Sidebar.vue'
import AdminDialogAddProductos from './components/Admin/AgregarProducto.vue'
import AdminDialogAddProveedores from './components/Admin/AgregarProveedores.vue'
import AdminDialogAddSales from './components/Admin/AgregarVentas.vue'

const vuetify = createVuetify({
    components: {
        HomeCarousel,
        AppBar,
        Footer,
        SectionSeparator,
        HomeInfo,
        HomeList,
        ProductosCard,
        HomeAboutUS,
        HomeContact,
        AdminSidebar,
        AdminDialogAddProductos,
        AdminDialogAddProveedores,
        AdminDialogAddSales
    },
    directives,

    //and this
    icons: {
        defaultSet: 'mdi',
        aliases,
        sets: {
        mdi,
        },
    },
    theme: {
        themes: {
          light: {
            dark: false,
            colors: {
              primary: colors.cyan.darken1, // #E53935
              secondary: colors.red.lighten4, // #FFCDD2
            }
          },
        },
      },
    
//

});

const app = createApp(App);
app.use(vuetify);
app.use(router);
app.mount('#app');

// Crea otra instancia de Vue para el otro punto de entrada
const anotherApp = createApp(AdminMain);
anotherApp.use(vuetify);
anotherApp.use(router);
anotherApp.mount('#app2');