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
    name: 'Inicio'
  },
  {
    path: '/productos',
    component: Productos,
    name: 'Productos'
  },
  // Admin .... // Admin .... // Admin ....
  {
    path: '/admin/dashboard',
    component: AdminDashboard,
    name: 'AdminDashboard'
  },
  {
    path: '/admin/users',
    component: AdminUsers,
    name: 'AdminUsers'
  },
  {
    path: '/admin/products',
    component: AdminProducts,
    name: 'AdminProducts'
  },
  {
    path: '/admin/suppliers',
    component: AdminSuppliers,
    name: 'AdminSuppliers'
  }
];

const router = createRouter({
  history: createWebHistory(),
  routes
});

export default router;
