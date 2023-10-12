<template>
    <div>
         <!--Start Dashboard Content-->
        <div class="card mt-3">
            <div class="card-content">
                <div class="row row-group m-0">
                    <div class="col-12 col-lg-6 col-xl-3 border-light">
                        <div class="card-body">
                        <h5 class="text-white mb-0">9526 <span class="float-right"><i class="fa fa-shopping-cart"></i></span></h5>
                            <div class="progress my-3" style="height:3px;">
                            <div class="progress-bar" style="width:55%"></div>
                            </div>
                        <p class="mb-0 text-white small-font">Total Ventas <span class="float-right">+4.2% <i class="zmdi zmdi-long-arrow-up"></i></span></p>
                        </div>
                    </div>
                    <div class="col-12 col-lg-6 col-xl-3 border-light">
                        <div class="card-body">
                        <h5 class="text-white mb-0">{{ countProduct }} <span class="float-right"><i class="fa fa-usd"></i></span></h5>
                            <div class="progress my-3" style="height:3px;">
                            <div class="progress-bar" :style="`width: ${countProduct}%`"></div>
                            </div>
                        <p class="mb-0 text-white small-font">Total Productos</p>
                        </div>
                    </div>
                    <div class="col-12 col-lg-6 col-xl-3 border-light">
                        <div class="card-body">
                        <h5 class="text-white mb-0">6200 <span class="float-right"><i class="fa fa-eye"></i></span></h5>
                            <div class="progress my-3" style="height:3px;">
                            <div class="progress-bar" style="width:55%"></div>
                            </div>
                        <p class="mb-0 text-white small-font">Total de proveedores <span class="float-right">+5.2% <i class="zmdi zmdi-long-arrow-up"></i></span></p>
                        </div>
                    </div>
                    <div class="col-12 col-lg-6 col-xl-3 border-light">
                        <div class="card-body">
                        <h5 class="text-white mb-0">5630 <span class="float-right"><i class="fa fa-envira"></i></span></h5>
                            <div class="progress my-3" style="height:3px;">
                            <div class="progress-bar" style="width:55%"></div>
                            </div>
                        <p class="mb-0 text-white small-font">Total de clientes <span class="float-right">+2.2% <i class="zmdi zmdi-long-arrow-up"></i></span></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>  
    </div>
</template>
<script setup lang="ts">
import { onMounted, ref } from 'vue';
import axios from 'axios';

const countProduct = ref(null)

onMounted(async () => {
    await axios.get('/admin/countProduct').then(function (response) {
        countProduct.value = response.data
    })
})

</script>