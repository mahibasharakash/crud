<template>
    <!-- header -->
    <header class="w-full sticky top-0 start-0 end-0 duration-500 z-50" :class="{ 'bg-white pt-0': !isScrolled, 'bg-transparent pt-5': isScrolled }">
        <div class="mx-auto max-w-7xl px-6 w-full min-h-[80px] max-h-[80px] flex justify-between items-center duration-500" :class="{ 'rounded-0 bg-transparent shadow-none': !isScrolled, 'rounded-xl bg-white shadow-2xl': isScrolled }">

            <!-- logo -->
            <RouterLink :to="{ name: 'home' }" class="decoration-0 font-semibold text-black text-xl">
                Blog
            </RouterLink>
            <!-- / logo -->

            <!-- group links -->
            <div class="flex justify-end items-center gap-8">

                <!-- home -->
                <RouterLink :to="{ name: 'home' }" class="decoration-0 text-sm duration-500 hover:text-blue-600" :class="{ 'text-blue-600': $route.name === 'home', 'text-black': $route.name !== 'home' }">
                    Home
                </RouterLink>
                <!-- / home -->

                <!-- login -->
                <RouterLink v-if="!profileData" :to="{ name: 'login' }" class="decoration-0 text-sm duration-500 hover:text-blue-600" :class="{ 'text-blue-600': $route.name === 'login', 'text-black': $route.name !== 'login' }">
                    Login
                </RouterLink>
                <!-- / login -->

                <!-- registration -->
                <RouterLink v-if="!profileData" :to="{ name: 'registration' }" class="decoration-0 text-sm duration-500 hover:text-blue-600" :class="{ 'text-blue-600': $route.name === 'registration', 'text-black': $route.name !== 'registration' }">
                    Registration
                </RouterLink>
                <!-- / registration -->

                <!-- dashboard -->
                <RouterLink v-if="profileData" :to="{ name: 'dashboard' }" class="decoration-0 text-sm duration-500 hover:text-blue-600" :class="{ 'text-blue-600': $route.name === 'dashboard', 'text-black': $route.name !== 'dashboard' }">
                    Dashboard
                </RouterLink>
                <!-- / dashboard -->

                <!-- profile -->
                <RouterLink v-if="profileData" :to="{ name: 'profile' }" class="decoration-0 text-sm duration-500 hover:text-blue-600" :class="{ 'text-blue-600': $route.name === 'profile', 'text-black': $route.name !== 'profile' }">
                    {{ profileData }}
                </RouterLink>
                <!-- / profile -->

                <!-- logout -->
                <a v-if="profileData" class="cursor-pointer decoration-0 text-sm duration-500 hover:text-blue-600" :class="{ 'text-blue-600': logoutLoading, 'text-black': !logoutLoading }" @click="logoutApi">
                    Logout
                </a>
                <!-- / logout -->

            </div>
            <!-- / group links -->

        </div>
    </header>
    <!-- / header -->

    <RouterView />

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
            profileData: JSON.parse(cookieServices.get('user')) || null,
            isScrolled: false,
            cookieUser: cookieServices.get('user') || null,
        };
    },
    watch: {
        // watch properties
        cookieUser(newVal) {
            this.profileData = newVal ? JSON.parse(newVal) : null;
        }
    },
    mounted() {
        // mounted properties
        this.cookieInterval = setInterval(() => {
            const currentCookie = cookieServices.get('user');
            if (currentCookie !== this.cookieUser) {
                this.cookieUser = currentCookie;
            }
        }, 500);
        window.addEventListener("scroll", this.handleScroll);
    },
    beforeUnmount() {
        window.removeEventListener("scroll", this.handleScroll);
        clearInterval(this.cookieInterval);
    },
    methods: {
        // methods properties

        // handle scroll
        handleScroll() {
            this.isScrolled = window.scrollY > 20;
        },

        // logout api implementation
        async logoutApi() {
            try {
                this.logoutLoading = true;
                await axios.post(apiRoutes.logout, null, { headers: apiServices.headerContent });
                cookieServices.remove("access_token");
                cookieServices.remove("user");
                this.profileData = null;
                this.$router.push({ name: "login" });
            } catch (e) {
                console.error(e);
            } finally {
                this.logoutLoading = false;
            }
        },

    },
};

</script>
