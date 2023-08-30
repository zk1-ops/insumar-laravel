<template>
    <!-- Start wrapper-->
  <div id="wrapper">
   
    <!-- Sidebar -->
    <AdminSidebar/>
 <!--Start topbar header-->
 <header class="topbar-nav">
  <nav class="navbar navbar-expand fixed-top">
   <ul class="navbar-nav mr-auto align-items-center">
     <li class="nav-item">
       <a class="nav-link toggle-menu" href="javascript:void();">
        <i class="icon-menu menu-icon"></i>
      </a>
     </li>
   </ul>
      
   <ul class="navbar-nav align-items-center right-nav-link">    
     <li class="nav-item">
       <a class="nav-link dropdown-toggle dropdown-toggle-nocaret" data-toggle="dropdown" href="#">
         <span class="user-profile"><img src="https://via.placeholder.com/110x110" class="img-circle" alt="user avatar"></span>
       </a>
       <ul class="dropdown-menu dropdown-menu-right">
        <li class="dropdown-item user-details">
         <a href="javaScript:void();">
            <div class="media">
              <div class="avatar"><img class="align-self-start mr-3" src="https://via.placeholder.com/110x110" alt="user avatar"></div>
             <div class="media-body">
             <h6 class="mt-2 user-title">Sarajhon Mccoy</h6>
             <p class="user-subtitle">mccoy@example.com</p>
             </div>
            </div>
           </a>
         </li>
       </ul>
     </li>
   </ul>
 </nav>
 </header>
 <!--End topbar header-->
 
 <div class="clearfix"></div>
     
   <div class="content-wrapper">
     <div class="container-fluid">
        
        <router-view></router-view> 
       <!--End Content-->
       
     <!--start overlay-->
           <div class="overlay toggle-menu"></div>
         <!--end overlay-->
         
     </div>
     <!-- End container-fluid-->
     
     </div><!--End content-wrapper-->
    <!--Start Back To Top Button-->
     <a href="javaScript:void();" class="back-to-top"><i class="fa fa-angle-double-up"></i> </a>
     <!--End Back To Top Button-->
    
   </div><!--End wrapper-->
 </template>