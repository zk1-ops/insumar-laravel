<template>
<!--Start sidebar-wrapper-->
<div id="sidebar-wrapper" data-simplebar="" data-simplebar-auto-hide="true">
     <div class="brand-logo">
      <a href="index.html">
       <img src="/assets/dashboard/images/logo-icon.png" class="logo-icon" alt="logo icon">
       <h5 class="logo-text">INSUMAR - PANEL</h5>
     </a>
   </div>
   <ul class="sidebar-menu do-nicescrol">
      <li class="sidebar-header">NAVEGACION PRINCIPAL</li>
      <li>
        <router-link :to="{ name: 'AdminDashboard' }">
          <a>
              <i class="zmdi zmdi-cloud"></i> <span>Dashboard</span>
          </a>
        </router-link>
      </li>

      <li>
        <router-link :to="{ name: 'AdminUsers' }">
        <a>
          <i class="zmdi zmdi-account"></i> <span>Empleados</span>
        </a>
      </router-link>
      </li>

      <li>
        <router-link :to="{ name: 'AdminUsers' }">
        <a>
          <i class="zmdi zmdi-accounts"></i> <span>Clientes</span>
        </a>
      </router-link>
      </li>

      <li>
        <router-link :to="{ name: 'AdminSuppliers' }">
        <a>
          <i class="zmdi zmdi-folder-person"></i> <span>Proveedores</span>
        </a>
      </router-link>
      </li>
      <li>
        <router-link :to="{ name: 'AdminUsers' }">
        <a>
          <i class="zmdi zmdi-archive"></i> <span>Ventas</span>
        </a>
      </router-link>
      </li>
      <li>
        <router-link :to="{ name: 'AdminProducts' }">
        <a>
          <i class="zmdi zmdi-grid"></i> <span>Productos</span>
        </a>
      </router-link>
      </li>

      <li class="sidebar-header">AUTHENTICATION</li>
      <li><a href="javaScript:void();" @click="logout"><i class="zmdi zmdi-close text-danger"></i> <span>Cerrar sesion</span></a></li>

    </ul>
   
   </div>
   <!--End sidebar-wrapper-->
</template>
<script setup lang="ts">
import axios from 'axios';

function logout() {
    axios.post('/logout').then(function(response){
        window.location.href = '/admin';
    })  

}

</script>