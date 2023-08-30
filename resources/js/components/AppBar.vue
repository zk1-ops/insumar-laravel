<template>
  <v-app-bar
    :elevation="0"
    :color="appBarColor"
    app
    scroll-target="#app"
    :class="{ scrolling: isScrolling }"
  >
  <v-app-bar-title><v-img src="http://127.0.0.1:8000/assets/img/sinfondo.png"/></v-app-bar-title>
    <v-tabs
      v-model="tab"
      align-tabs="center"
      style="flex-grow: 1"
    >
      <v-tab
        v-for="(item, i) in tabs"
        :key="i"
        :href="`#${item.to}`"
        append
        exact-active-class="white--text primary"
        exact
        class="white-text text-sm-h6"
        @click.prevent="scrollToTab(item)"

      >
         {{ item.title  }}
      </v-tab>
    </v-tabs>
    <v-spacer></v-spacer>
    <v-btn icon class="instagram" target="_blank" href="https://www.instagram.com/insumar.spa/">
      <v-icon size="35" rounded icon="mdi-instagram"></v-icon>
    </v-btn>
  </v-app-bar>
</template>

<script setup lang="ts">
import { ref, computed, onMounted, onBeforeUnmount } from 'vue';
import { useRouter } from 'vue-router';

const router = useRouter();
const tabs = ref([
  {
    title: "Inicio",
    to: "inicio",
  },
  {
    title: "Productos",
    to: "/productos",
  },
  {
    title: "Información",
    to: "informacion",
  },
  {
    title: "Contacto",
    to: "contacto",
  }
])

const tab = ref('inicio');
const isScrolling = ref(false)

const appBarColor = computed(() => isScrolling.value ? "rgba(0, 58, 123, 0.7)" : "rgba(0, 58, 123, 0.9)")

function handleScroll()  {
  const scrollTop = window.pageYOffset ||
    document.documentElement.scrollTop ||
    document.body.scrollTop || 0 
  isScrolling.value = scrollTop > 0
}

function scrollToTab(item) {
  if (item.to === '/productos') {
    router.push(item.to);
  } else {
    const elem = document.getElementById(item.to);
    router.push('/');
    if (elem) {
      const top = elem.getBoundingClientRect().top + window.pageYOffset;
      window.scrollTo({ top, behavior: 'smooth' });
    }
  }
}



onMounted(() => {
  window.addEventListener("scroll", handleScroll);
  window.addEventListener("resize", handleScroll);
})

onBeforeUnmount(() => {
  window.removeEventListener("scroll", handleScroll);
  window.removeEventListener("resize", handleScroll);
})
</script>

<style>
.scrolling {
  transition: background-color 0.2s ease-in-out;
}
.white-text {
  color: #08EECB;
}

.mdi-instagram {
  color: transparent;
  background: radial-gradient(circle at 30% 107%, #fdf497 0%, #fdf497 5%, #fd5949 45%, #d6249f 60%, #285AEB 90%);
  background: -webkit-radial-gradient(circle at 30% 107%, #fdf497 0%, #fdf497 5%, #fd5949 45%, #d6249f 60%, #285AEB 90%);
  background-clip: text;
  -webkit-background-clip: text;
}

</style>
