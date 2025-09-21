<template>

    <!-- verification -->
    <form @submit.prevent="verificationApi()">

        <!-- verification code -->
        <div class="mb-3 w-full block">
            <label for="verification_code" class="mb-2 w-full block text-sm font-medium"> Verification Code </label>
            <input id="verification_code" type="text" name="verification_code" v-model="formData.verification_code" class="text-xs font-medium w-full border border-gray-100 bg-gray-100 block min-h-[45px] max-h-[45px] rounded-md outline-0 ring-0 focus-within:ring-3 ring-blue-400 duration-500 px-4 shadow-inner" autocomplete="off" />
            <div class="mt-2 w-full block text-red-500 text-xs" v-if="error?.verification_code"> {{error?.verification_code[0]}} </div>
        </div>
        <!-- / verification code -->

        <!-- button -->
        <div class="mb-5 w-full block">
            <button type="submit" class="min-w-[150px] text-sm font-medium bg-blue-400 duration-500 hover:bg-blue-700 text-white px-10 rounded-md min-h-[45px] max-h-[45px] cursor-pointer inline-flex justify-center items-center" v-if="!loading">
                Send
            </button>
            <button type="button" class="min-w-[150px] text-sm font-medium bg-blue-400 duration-500 hover:bg-blue-700 text-white px-10 rounded-md min-h-[45px] max-h-[45px] cursor-pointer inline-flex justify-center items-center" v-if="loading">
                <span class="inline-block rounded-full w-4 h-4 border-2 border-white border-t-transparent animate-spin"></span>
            </button>
        </div>
        <!-- / button -->

        <div class="text-center text-sm text-gray-700">
            Already Verified?
            <br/>

            <!-- link -->
            <RouterLink :to="{name:'login'}" class="decoration-1 text-blue-400"> Login </RouterLink>
            <!-- / link -->

        </div>
    </form>
    <!-- / verification -->

</template>

<script>

import axios from "axios";

import apiRoutes from "@/app/apiController/apiRoutes.js";
import apiServices from "@/app/apiController/apiServices.js";

export default {
    data() {
        return {
            // data properties
            error: {},
            formData: {
                email: window.history.state.email,
                verification_code: '',
            },
            loading: false,
        }
    },
    mounted() {
        // mounted properties
        if(!window.history.state.email) {
            this.$router.push({name:'login'});
        }
    },
    methods: {

        // verification api implementation
        async verificationApi() {
            try {
                this.error = null;
                this.loading = true;
                const response = await axios.post(apiRoutes.verification, this.formData, {headers: apiServices.headerContent});
                if(response.data.message) {
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
