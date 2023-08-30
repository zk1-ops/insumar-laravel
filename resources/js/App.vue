<template>
    <v-app style="background: rgba(0, 58, 123, 0.9); color: white;">
        <AppBar />
        <v-main id="inicio">
            <HomeCarousel /> 
            <v-container>
                <router-view></router-view>
            </v-container>
        </v-main>
        <Footer />
        
    </v-app>
  </template>