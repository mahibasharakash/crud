<template>
    <!-- header -->
    <header class="w-full sticky top-0 start-0 end-0 duration-500 z-50 px-5" :class="{ 'bg-white pt-0': !isScrolled, 'bg-transparent pt-5': isScrolled }">
        <div class="mx-auto max-w-7xl px-6 w-full min-h-[80px] max-h-[80px] flex justify-between items-center duration-500" :class="{ 'rounded-0 bg-transparent shadow-none': !isScrolled, 'rounded-xl bg-white shadow-2xl': isScrolled }">

            <!-- logo -->
            <RouterLink :to="{ name: 'home' }" class="decoration-0 font-semibold text-black text-xl">
                Blog
            </RouterLink>
            <!-- / logo -->

            <div class="lg:hidden">
                <button type="button" class="min-w-[45px] max-w-[45px] min-h-[45px] max-h-[45px] inline-flex justify-center items-center outline-0 border-0 bg-transparent hover:bg-gray-200 duration-500 rounded-full cursor-pointer" @click.stop="isSidebarActive = true">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 6h9.75M10.5 6a1.5 1.5 0 1 1-3 0m3 0a1.5 1.5 0 1 0-3 0M3.75 6H7.5m3 12h9.75m-9.75 0a1.5 1.5 0 0 1-3 0m3 0a1.5 1.5 0 0 0-3 0m-3.75 0H7.5m9-6h3.75m-3.75 0a1.5 1.5 0 0 1-3 0m3 0a1.5 1.5 0 0 0-3 0m-9.75 0h9.75" />
                    </svg>
                </button>
            </div>

            <!-- group links -->
            <div class="fixed duration-500 shadow-2xl lg:shadow-none lg:static top-0 bottom-0 h-screen bg-white lg:bg-transparent lg:h-auto min-w-full sm:min-w-[290px] z-50 lg:w-auto flex justify-center lg:justify-end items-center flex-col lg:flex-row gap-8" @click.stop :class="{ 'end-0' : isSidebarActive, '-end-full sm:-end-[290px]' : !isSidebarActive }">

                <div class="lg:hidden">
                    <div class="absolute top-0 end-0 p-5">
                        <button type="button" class="min-w-[45px] max-w-[45px] min-h-[45px] max-h-[45px] inline-flex justify-center items-center outline-0 border-0 bg-transparent hover:bg-gray-200 duration-500 rounded-full cursor-pointer" @click.stop="isSidebarActive = false">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>
                </div>

                <!-- home -->
                <RouterLink :to="{ name: 'home' }" @click="this.isSidebarActive = false" class="decoration-0 text-sm duration-500 hover:text-blue-600" :class="{ 'text-blue-600': $route.name === 'home', 'text-black': $route.name !== 'home' }">
                    Home
                </RouterLink>
                <!-- / home -->

                <!-- login -->
                <RouterLink v-if="!profileData" :to="{ name: 'login' }" @click="this.isSidebarActive = false" class="decoration-0 text-sm duration-500 hover:text-blue-600" :class="{ 'text-blue-600': $route.name === 'login', 'text-black': $route.name !== 'login' }">
                    Login
                </RouterLink>
                <!-- / login -->

                <!-- registration -->
                <RouterLink v-if="!profileData" :to="{ name: 'registration' }" @click="this.isSidebarActive = false" class="decoration-0 text-sm duration-500 hover:text-blue-600" :class="{ 'text-blue-600': $route.name === 'registration', 'text-black': $route.name !== 'registration' }">
                    Registration
                </RouterLink>
                <!-- / registration -->

                <!-- dashboard -->
                <RouterLink v-if="profileData" :to="{ name: 'dashboard' }" @click="this.isSidebarActive = false" class="decoration-0 text-sm duration-500 hover:text-blue-600" :class="{ 'text-blue-600': $route.name === 'dashboard', 'text-black': $route.name !== 'dashboard' }">
                    Dashboard
                </RouterLink>
                <!-- / dashboard -->

                <!-- profile -->
                <RouterLink v-if="profileData" :to="{ name: 'profile' }" @click="this.isSidebarActive = false" class="decoration-0 text-sm duration-500 hover:text-blue-600" :class="{ 'text-blue-600': $route.name === 'profile', 'text-black': $route.name !== 'profile' }">
                    {{ profileData }}
                </RouterLink>
                <!-- / profile -->

                <!-- logout -->
                <a v-if="profileData" class="cursor-pointer decoration-0 text-sm duration-500 hover:text-blue-600" :class="{ 'text-blue-600': logoutLoading, 'text-black': !logoutLoading }" @click="logoutApi();this.isSidebarActive = false">
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
            isSidebarActive: false,
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
        window.addEventListener('click', (event) => this.outsideClickSidebar())
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

        // outside click sidebar
        outsideClickSidebar() {
            if(this.isSidebarActive) {
                this.isSidebarActive = false;
            }
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
