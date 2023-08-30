<template>
  <v-carousel cycle interval="5000" hide-delimiters :show-arrows="false" style="max-height:65vh;" :style="{ maxHeight: height }" >
    <v-carousel-item
      v-for="(item, i) in items" 
      :key="i"
      :src="item.src"
      cover
    />
  </v-carousel>
</template>

<script lang="ts">
import { onMounted, computed } from 'vue'

import { ref } from 'vue';
import { useDisplay } from 'vuetify'

export default {
  
  setup() {

    const { name } = useDisplay()

    const items = ref([
      { src: "https://www.cooke.cl/wp-content/uploads/2020/09/cooke-43-scaled.jpg" },
      { src: "https://static.wixstatic.com/media/9da313_30c3645913e143c08da491e73d10d440~mv2.jpg/v1/fill/w_640,h_512,al_c,q_80,usm_0.66_1.00_0.01,enc_auto/9da313_30c3645913e143c08da491e73d10d440~mv2.jpg" },
      { src: "https://aguasalvaje.cl/wp-content/uploads/2021/12/mariscos-congelados-65233749.jpg" }
    ]);
    
    const height = computed(() => {
        // name is reactive and
        // must use .value
        switch (name.value) {
          case 'xs': return 220
          case 'sm': return 400
          case 'md': return 500
          case 'lg': return 600
          case 'xl': return 700
          case 'xxl': return 700
        }

        return 0
      })

    return { items, height };
  }
}
</script>
