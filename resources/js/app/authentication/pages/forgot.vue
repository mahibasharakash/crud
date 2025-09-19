<template>

    <form @submit.prevent="forgotApi()">
        <div class="mb-3 w-full block">
            <label for="email" class="mb-2 w-full block text-sm font-medium"> Email </label>
            <input id="email" type="email" name="email" v-model="formData.email" class="text-xs w-full border border-gray-100 bg-gray-100 block min-h-[45px] max-h-[45px] rounded-md outline-0 ring-0 focus-within:ring-3 ring-blue-400 duration-500 px-4 shadow-inner" autocomplete="off" />
            <div class="mt-2 w-full block text-red-500 text-xs" v-if="error?.email"> {{error?.email[0]}} </div>
        </div>
        <div class="mb-5 w-full block">
            <button type="submit" class="min-w-[150px] text-sm font-medium bg-blue-400 duration-500 hover:bg-blue-700 text-white px-10 rounded-md min-h-[45px] max-h-[45px] cursor-pointer" v-if="!loading">
                Send
            </button>
            <button type="button" class="min-w-[150px] text-sm font-medium bg-blue-400 duration-500 hover:bg-blue-700 text-white px-10 rounded-md min-h-[45px] max-h-[45px] cursor-pointer" v-if="loading">
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
            error: null,
            invalidError: null,
            formData: {
                email: '',
            },
            loading: false,
        }
    },
    mounted() {

    },
    methods: {

        async forgotApi() {
            try {
                this.error = null;
                this.loading = true;
                const response = await axios.post(apiRoutes.forgot, this.formData, {headers: apiServices.headerContent});
                if(response.data.type === 'verification') {
                    this.$router.push({name:'verification', state: {email: this.formData.email} });
                } else if(response.data.type === 'reset') {
                    this.$router.push({name:'reset', state: {email: this.formData.email} });
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
