<template>
    <div class="containerr">
        <Menu/>
        <div class="main">
            <div class="topbar">
                <div class="toogle">
                    <i class="fa fa-align-justify" aria-hidden="true"></i>
                </div>
                <div class="search" id="recherche">
                    <label>
                        <input type="text" placeholder="Search Here">
                        <i class="fa fa-search"></i>
                    </label>
                </div>
                <div class="nom mb-2">
                    <h6>{{ user.name }}</h6>
                </div>
                <div v-if="user.photo" class="user">
                    <img :src="'/storage/'+user.photo" alt="">
                </div>
                <div v-else class="user">
                    <img src="~admin-lte/dist/img/user8-128x128.jpg" alt="">
                </div>
            </div>
            <div class="corps">
                
                    <slot/>
                  
            </div>


        </div>
        
    </div>
</template>
    <script setup>
      import Menu from "./Partials/Menu.vue";
      import Footer from "./Partials/Footer.vue";
      import { computed } from 'vue';
      import { usePage } from '@inertiajs/inertia-vue3';

      const user = computed(()=> {
        return usePage().props.value.auth.user
    })
    </script>