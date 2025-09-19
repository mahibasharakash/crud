<template>

    <div class="w-full bg-red-100 text-red-800 text-center p-3 mb-5 rounded-lg text-sm" v-if="invalidError">
        {{this.invalidError}}
    </div>

    <form @submit.prevent="loginApi()">
        <div class="mb-3 w-full block">
            <label for="email" class="mb-2 w-full block text-sm font-medium"> Email </label>
            <input id="email" type="email" name="email" v-model="formData.email" class="text-xs w-full border border-gray-100 bg-gray-100 block min-h-[45px] max-h-[45px] rounded-md outline-0 ring-0 focus-within:ring-3 ring-blue-400 duration-500 px-4 shadow-inner" autocomplete="off" />
            <div class="mt-2 w-full block text-red-500 text-xs font-medium" v-if="error?.email"> {{error?.email[0]}} </div>
        </div>
        <div class="mb-3 w-full block">
            <div class="w-full flex justify-between items-center">
                <label for="password" class="mb-2 w-full text-sm font-medium"> Password </label>
                <RouterLink :to="{name:'forgot'}" class="decoration-1 text-red-500 min-w-[120px] text-end text-xs"> Forgot Password? </RouterLink>
            </div>
            <input id="password" type="password" name="password" v-model="formData.password" class="text-xs w-full border border-gray-100 bg-gray-100 block min-h-[45px] max-h-[45px] rounded-md outline-0 ring-0 focus-within:ring-3 ring-blue-400 duration-500 px-4 shadow-inner" autocomplete="off" />
            <div class="mt-2 w-full block text-red-500 text-xs font-medium" v-if="error?.password"> {{error?.password[0]}} </div>
        </div>
        <div class="mb-5 w-full block">
            <button type="submit" class="min-w-[150px] text-sm font-medium bg-blue-400 duration-500 hover:bg-blue-700 text-white px-10 rounded-md min-h-[45px] max-h-[45px] cursor-pointer" v-if="!loading">
                Login
            </button>
            <button type="button" class="min-w-[150px] text-sm font-medium bg-blue-400 duration-500 hover:bg-blue-700 text-white px-10 rounded-md min-h-[45px] max-h-[45px] cursor-pointer" v-if="loading">
                <span class="inline-block rounded-full w-4 h-4 border-2 border-white border-t-transparent animate-spin"></span>
            </button>
        </div>
        <div class="text-center text-sm text-gray-700">
            No have an account?
            <RouterLink :to="{name:'registration'}" class="decoration-1 text-blue-400"> Registration </RouterLink>
        </div>
    </form>

</template>

<script>

import axios from "axios";

import apiRoutes from "@/app/apiController/apiRoutes.js";
import apiServices from "@/app/apiController/apiServices.js";
import cookieServices from "@/app/apiController/cookieServices.js";

export default {
    data() {
        return {
            error: null,
            invalidError: null,
            formData: {
                email: '',
                password: '',
            },
            loading: false,
        }
    },
    mounted() {

    },
    methods: {

        async loginApi() {
            try {
                this.error = null;
                this.invalidError = null;
                this.loading = true;
                const response = await axios.post(apiRoutes.login, this.formData, {headers: apiServices.headerContent});
                cookieServices.set('access_token', response?.data?.token);
                cookieServices.set('user', JSON.stringify(response?.data?.user));
                this.$router.push({name:'home'})
            } catch (e) {
                if(e.response.data.errors) {
                    this.error = e.response.data.errors;
                } else if (e.response.data.message) {
                    this.invalidError = e.response.data.message;
                }
            } finally {
                this.loading = false;
            }
        }

    }
}

</script>
