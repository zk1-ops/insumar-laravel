// router.js
import { createRouter, createWebHistory } from 'vue-router';
import Home from './components/Home/Main.vue'; // Importa tus componentes de vista
import Productos from './components/Productos/ShowProducts.vue'; // Importa tus componentes de vista


// Dashboard Rutas
import AdminUsers from './pages/Admin/User.vue'
import AdminProducts from './pages/Admin/Products.vue'
import AdminDashboard from './pages/Admin/Dashboard.vue'
import AdminSuppliers from './pages/Admin/Suppliers.vue'
import AdminSales from './pages/Admin/Sales.vue'
import AdminEmployees from './pages/Admin/Employees.vue'

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
  },
  {
    path: '/admin/sales',
    component: AdminSales,
    name: 'AdminSales',
    meta: {
       title: 'INSUMAR - Ventas'
    }
  },
  {
    path: '/admin/employees/',
    component: AdminEmployees,
    name: 'AdminEmployee',
    meta: {
        title: 'INSUMAR - Empleados'
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
