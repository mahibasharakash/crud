<template>

    <!-- header -->
    <header class="bg-white w-full">
        <div class="mx-auto max-w-7xl px-5 w-full min-h-[80px] max-h-[80px] flex justify-between items-center">

            <!-- logo -->
            <RouterLink :to="{name:'home'}" class="decoration-0 text-black text-2xl">
                Laravel
            </RouterLink>
            <!-- / logo -->

            <!-- group links -->
            <div class="flex justify-end items-center gap-8">

                <!-- profile -->
                <RouterLink :to="{name:'profile'}" class="decoration-0 text-sm" :class="{ 'text-blue-400' : $route.name === 'profile', 'text-black' : $route.name !== 'profile' }">
                    {{profileData?.name}}
                </RouterLink>
                <!-- / profile -->

                <!-- logout -->
                <a class="cursor-pointer decoration-0 text-sm" @click="logoutApi()">
                    Logout
                </a>
                <!-- / logout -->

            </div>
            <!-- / group links -->

        </div>
    </header>
    <!-- / header -->

    <!-- main -->
    <main class="w-full bg-gray-100 min-h-[calc(100vh-80px)] max-h-[calc(100vh-80px)] overflow-y-auto">
        <div class="mx-auto max-w-7xl px-5 pt-5 pb-16 w-full">
            <RouterView></RouterView>
        </div>
    </main>
    <!-- / main -->

</template>

<script>

import axios from "axios";

import apiRoutes from "@/app/apiController/apiRoutes.js";
import apiServices from "@/app/apiController/apiServices.js";
import cookieServices from "@/app/apiController/cookieServices.js";

export default {
    data() {
        return {
            // data properties
            logoutLoading: false,
            profileLoading: false,
            profileData: null,
        }
    },
    mounted() {
        // mounted properties
        this.profileData = JSON.parse(cookieServices.get('user'))
    },
    methods: {

        // logout api implementation
        async logoutApi() {
            try {
                this.logoutLoading = true;
                await axios.post(apiRoutes.logout, null, {headers: apiServices.headerContent});
                cookieServices.remove('access_token');
                this.$router.push({name:'login'});
            } catch (e) {

            } finally {
                this.logoutLoading = false;
            }
        }

    }
}

</script>
