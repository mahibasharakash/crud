<template>

    <form @submit.prevent="resetApi()">
        <div class="mb-3 w-full block">
            <label for="email" class="mb-2 w-full block text-sm font-medium"> Email </label>
            <input id="email" type="email" name="email" v-model="formData.email" class="text-xs w-full border border-gray-100 bg-gray-100 block min-h-[45px] max-h-[45px] rounded-md outline-0 ring-0 focus-within:ring-3 ring-blue-400 duration-500 px-4 shadow-inner" autocomplete="off" />
            <div class="mt-2 w-full block text-red-500 text-xs" v-if="error?.email"> {{error?.email[0]}} </div>
        </div>
        <div class="mb-3 w-full block">
            <label for="reset_code" class="mb-2 w-full block text-sm font-medium"> Reset Code </label>
            <input id="reset_code" type="text" name="reset_code" v-model="formData.reset_code" class="text-xs w-full border border-gray-100 bg-gray-100 block min-h-[45px] max-h-[45px] rounded-md outline-0 ring-0 focus-within:ring-3 ring-blue-400 duration-500 px-4 shadow-inner" autocomplete="off" />
            <div class="mt-2 w-full block text-red-500 text-xs" v-if="error?.reset_code"> {{error?.reset_code[0]}} </div>
        </div>
        <div class="mb-3 w-full block">
            <label for="password" class="mb-2 w-full block text-sm font-medium"> Password </label>
            <input id="password" type="password" name="password" v-model="formData.password" class="text-xs w-full border border-gray-100 bg-gray-100 block min-h-[45px] max-h-[45px] rounded-md outline-0 ring-0 focus-within:ring-3 ring-blue-400 duration-500 px-4 shadow-inner" autocomplete="off" />
            <div class="mt-2 w-full block text-red-500 text-xs" v-if="error?.password"> {{error?.password[0]}} </div>
        </div>
        <div class="mb-3 w-full block">
            <label for="password_confirmation" class="mb-2 w-full block text-sm font-medium"> Password Confirmation </label>
            <input id="password_confirmation" type="password" name="password_confirmation" v-model="formData.password_confirmation" class="text-xs w-full border border-gray-100 bg-gray-100 block min-h-[45px] max-h-[45px] rounded-md outline-0 ring-0 focus-within:ring-3 ring-blue-400 duration-500 px-4 shadow-inner" autocomplete="off" />
            <div class="mt-2 w-full block text-red-500 text-xs" v-if="error?.password_confirmation"> {{error?.password_confirmation[0]}} </div>
        </div>
        <div class="mb-5 w-full block">
            <button type="submit" class="min-w-[120px] text-sm font-medium bg-blue-400 duration-500 hover:bg-blue-700 text-white px-10 rounded-md min-h-[45px] max-h-[45px] cursor-pointer" v-if="!loading">
                Reset
            </button>
            <button type="button" class="min-w-[120px] text-sm font-medium bg-blue-400 duration-500 hover:bg-blue-700 text-white px-10 rounded-md min-h-[45px] max-h-[45px] cursor-pointer" v-if="loading">
                <span class="inline-block rounded-full w-4 h-4 border-2 border-white border-t-transparent animate-spin"></span>
            </button>
        </div>
        <div class="text-center text-sm text-gray-700">
            Remember Password?
            <RouterLink :to="{name:'login'}" class="decoration-1 text-blue-400"> Login </RouterLink>
        </div>
    </form>

</template>

<script>

import axios from "axios";

import apiRoutes from "@/app/apiController/apiRoutes.js";
import apiServices from "@/app/apiController/apiServices.js";

export default {
    data() {
        return {
            error: {},
            formData: {
                email: window.history.state.email,
                reset_code: '',
                password: '',
                password_confirmation: '',
            },
            loading: false,
        }
    },
    mounted() {
        if(!window.history.state.email) {
            this.$router.push({name:'login'});
        }
    },
    methods: {

        async resetApi() {
            try {
                this.error = null;
                this.loading = true;
                const response = await axios.post(apiRoutes.reset, this.formData, {headers: apiServices.headerContent});
                if(response.data.message) {
                    this.$router.push({name:'login'})
                }
            } catch (e) {
                this.error = e.response.data.errors;
            } finally {
                this.loading = false;
            }
        }

    }
}

</script>
