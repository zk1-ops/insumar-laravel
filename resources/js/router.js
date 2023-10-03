// router.js
import { createRouter, createWebHistory } from 'vue-router';
import Home from './components/Home/Main.vue'; // Importa tus componentes de vista
import Productos from './components/Productos/ShowProducts.vue'; // Importa tus componentes de vista


// Dashboard Rutas
import AdminUsers from './components/Admin/User.vue'
import AdminProducts from './components/Admin/Products.vue'
import AdminDashboard from './components/Admin/Dashboard.vue'
import AdminSuppliers from './components/Admin/Suppliers.vue'


const routes = [
  {
    path: '/',
    component: Home,
    name: 'Inicio',
    meta: {
      title: 'INSUMAR - Inicio'
   }
  },
  {
    path: '/productos',
    component: Productos,
    name: 'Productos',
    meta: {
      title: 'INSUMAR - Productos'
   }
  },
  // Admin .... // Admin .... // Admin ....
  {
    path: '/admin/dashboard',
    component: AdminDashboard,
    name: 'AdminDashboard',
    meta: {
      title: 'INSUMAR - Dashboard'
   }
  },
  {
    path: '/admin/users',
    component: AdminUsers,
    name: 'AdminUsers',
    meta: {
      title: 'INSUMAR - Empleados'
   }
  },
  {
    path: '/admin/products',
    component: AdminProducts,
    name: 'AdminProducts',
    meta: {
      title: 'INSUMAR - Productos'
   }
  },
  {
    path: '/admin/suppliers',
    component: AdminSuppliers,
    name: 'AdminSuppliers',
    meta: {
       title: 'INSUMAR - Proveedores'
    }
  }
];

const router = createRouter({
  history: createWebHistory(),
  routes
});

// Configura la actualización del título al cambiar de ruta
router.afterEach((to) => {
  document.title = to.meta.title;
});

export default router;
