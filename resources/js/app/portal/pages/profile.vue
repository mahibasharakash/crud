<template>

    <!-- breadcrumb -->
    <div class="w-full flex justify-start items-center p-6 gap-3 bg-white rounded-md mb-5 shadow-md">

        <!-- breadcrumb link -->
        <RouterLink :to="{name:'dashboard'}" class="decoration-0 text-black text-sm font-medium">
            Dashboard
        </RouterLink>
        <!-- / breadcrumb link -->

        <span>
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor" class="w-4 h-4">
                    <path stroke-linecap="round" stroke-linejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5" />
                </svg>
            </span>

        <!-- breadcrumb link -->
        <RouterLink :to="{name:'profile'}" class="decoration-0 text-black text-sm font-medium">
            Profile
        </RouterLink>
        <!-- / breadcrumb link -->

    </div>
    <!-- / breadcrumb -->

    <!-- update changes -->
    <div class="w-full bg-white rounded-lg p-6 block mb-5 shadow-md">

        <!-- title -->
        <div class="mb-1 block w-full font-semibold text-md"> Profile Information </div>
        <!-- / title -->

        <!-- description -->
        <div class="mb-6 block w-full font-normal text-xs max-w-[700px]"> Update your account's profile information and email address. </div>
        <!-- / description -->

        <!-- form -->
        <form @submit.prevent="changeDetails" class="w-full block max-w-[500px]">

            <!-- name -->
            <div class="mb-3 w-full block">
                <label for="name" class="block mb-2 w-full text-sm"> Name </label>
                <input id="name" type="text" name="name" v-model="profileParam.name" class="text-xs w-full block min-h-[45px] max-h-[45px] border-0 bg-gray-100 outline-0 ring-0 focus-within:ring-3 ring-blue-600 duration-500 px-4 rounded-md" />
                <div class="mt-2 w-full block text-red-500 text-xs font-medium" v-if="profileError?.name"> {{profileError?.name[0]}} </div>
            </div>
            <!-- / name -->

            <!-- email -->
            <div class="mb-3 w-full block">
                <label for="email" class="block mb-2 w-full text-sm"> Email </label>
                <input id="email" type="email" name="email" v-model="profileParam.email" class="text-xs w-full block min-h-[45px] max-h-[45px] border-0 bg-gray-100 outline-0 ring-0 focus-within:ring-3 ring-blue-600 duration-500 px-4 rounded-md" />
                <div class="mt-2 w-full block text-red-500 text-xs font-medium" v-if="profileError?.email"> {{profileError?.email[0]}} </div>
            </div>
            <!-- / email -->

            <!-- button -->
            <div class="w-full block">
                <button type="submit" class="cursor-pointer bg-blue-500 duration-500 hover:bg-blue-700 rounded-md text-sm text-white min-w-[130px] min-h-[45px] max-h-[45px] inline-flex justify-center items-center" v-if="!profileLoading">
                    Update
                </button>
                <button type="button" class="cursor-pointer bg-blue-500 duration-500 hover:bg-blue-700 rounded-md text-sm text-white min-w-[130px] min-h-[45px] max-h-[45px] inline-flex justify-center items-center" v-if="profileLoading">
                    <span class="inline-block rounded-full w-4 h-4 border-2 border-white border-t-transparent animate-spin"></span>
                </button>
            </div>
            <!-- / button -->

        </form>
        <!-- / form -->

    </div>
    <!-- / update changes -->

    <!-- update password -->
    <div class="w-full bg-white rounded-lg p-7 block mb-5 shadow-md">

        <!-- title -->
        <div class="mb-1 block w-full font-semibold text-md"> Update Password </div>
        <!-- / title -->

        <!-- description -->
        <div class="mb-6 block w-full font-normal text-xs max-w-[700px]"> Ensure your account is using a long, random password to stay secure. </div>
        <!-- / description -->

        <!-- not match error -->
        <div class="mb-3 text-red-600 bg-red-100 text-sm font-medium p-4 max-w-[500px] rounded-md" v-if="notMatch">
            {{notMatch}}
        </div>
        <!-- / not match error -->

        <!-- form -->

        <form @submit.prevent="changePassword" class="w-full block max-w-[500px]">

            <!-- current password -->
            <div class="mb-3 w-full block">
                <label for="current_password" class="block mb-2 w-full text-sm"> Current Password </label>
                <input id="current_password" type="password" name="current_password" v-model="passwordParam.current_password" class="text-xs w-full block min-h-[45px] max-h-[45px] border-0 bg-gray-100 outline-0 ring-0 focus-within:ring-3 ring-blue-600 duration-500 px-4 rounded-md" autocomplete="off" />
                <div class="mt-2 w-full block text-red-500 text-xs font-medium" v-if="passwordError?.current_password"> {{passwordError?.current_password[0]}} </div>
            </div>
            <!-- / current password -->

            <!-- password -->
            <div class="mb-3 w-full block">
                <label for="password" class="block mb-2 w-full text-sm"> Password </label>
                <input id="password" type="password" name="password" v-model="passwordParam.password" class="text-xs w-full block min-h-[45px] max-h-[45px] border-0 bg-gray-100 outline-0 ring-0 focus-within:ring-3 ring-blue-600 duration-500 px-4 rounded-md" autocomplete="off" />
                <div class="mt-2 w-full block text-red-500 text-xs font-medium" v-if="passwordError?.password"> {{passwordError?.password[0]}} </div>
            </div>
            <!-- / password -->

            <!-- password confirmation -->
            <div class="mb-3 w-full block">
                <label for="password_confirmation" class="block mb-2 w-full text-sm"> Password Confirmation </label>
                <input id="password_confirmation" type="password" name="password_confirmation" v-model="passwordParam.password_confirmation" class="text-xs w-full block min-h-[45px] max-h-[45px] border-0 bg-gray-100 outline-0 ring-0 focus-within:ring-3 ring-blue-600 duration-500 px-4 rounded-md" autocomplete="off" />
                <div class="mt-2 w-full block text-red-500 text-xs font-medium" v-if="passwordError?.password_confirmation"> {{passwordError?.password_confirmation[0]}} </div>
            </div>
            <!-- / password confirmation -->

            <!-- button -->
            <div class="w-full block">
                <button type="submit" class="cursor-pointer bg-blue-500 duration-500 hover:bg-blue-700 rounded-md text-sm text-white min-w-[130px] min-h-[45px] max-h-[45px] inline-flex justify-center items-center" v-if="!passwordLoading">
                    Update
                </button>
                <button type="button" class="cursor-pointer bg-blue-500 duration-500 hover:bg-blue-700 rounded-md text-sm text-white min-w-[130px] min-h-[45px] max-h-[45px] inline-flex justify-center items-center" v-if="passwordLoading">
                    <span class="inline-block rounded-full w-4 h-4 border-2 border-white border-t-transparent animate-spin"></span>
                </button>
            </div>
            <!-- / button  -->

        </form>
        <!-- form -->

    </div>
    <!-- / update password -->

    <!-- account delete -->
    <div class="w-full bg-white rounded-lg p-7 block shadow-md">

        <!-- title -->
        <div class="mb-1 block w-full font-semibold text-md"> Delete Account </div>
        <!-- / title -->

        <!-- description -->
        <div class="mb-6 block w-full font-normal text-xs max-w-[700px]"> Once your account is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain. </div>
        <!-- / description -->

        <!-- form -->

        <form @submit.prevent="deleteAccount" class="w-full block max-w-[500px]">

            <!-- button -->
            <div class="w-full block">
                <button type="submit" class="cursor-pointer bg-red-500 duration-500 hover:bg-red-700 rounded-md text-sm text-white min-w-[190px] min-h-[45px] max-h-[45px] inline-flex justify-center items-center" v-if="!accountDeleteLoading">
                    Delete Account
                </button>
                <button type="button" class="cursor-pointer bg-red-500 duration-500 hover:bg-red-700 rounded-md text-sm text-white min-w-[190px] min-h-[45px] max-h-[45px] inline-flex justify-center items-center" v-if="accountDeleteLoading">
                    <span class="inline-block rounded-full w-4 h-4 border-2 border-white border-t-transparent animate-spin"></span>
                </button>
            </div>
            <!-- / button  -->

        </form>
        <!-- form -->

    </div>
    <!-- / account delete -->

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
            profileDataLoading: false,
            profileLoading: false,
            passwordLoading: false,
            profileData: null,
            profileError: null,
            passwordError: null,
            notMatch: null,
            accountDeleteLoading: false,
            profileParam: {
                name: '',
                email: '',
            },
            passwordParam: {
                current_password: '',
                password: '',
                password_confirmation: '',
            },
        }
    },
    mounted() {
        // mounted properties
        this.getDetails();
    },
    methods: {

        // get details api implementation
        async getDetails() {
            try {
                this.profileDataLoading = true;
                const response = await axios.get(apiRoutes.user, null, {headers: apiServices.headerContent});
                this.profileData = response.data.user;
                this.profileParam = response.data.user;
            } finally {
                this.profileDataLoading = false;
            }
        },

        // change details api implementation
        async changeDetails() {
            try {
                this.profileError = null;
                this.profileLoading = true;
                await axios.post(apiRoutes.changeDetails, this.profileParam, {headers: apiServices.headerContent});
            } catch (e) {
                this.profileError = e.response.data.errors
            } finally {
                this.profileLoading = false;
            }
        },

        // change password api implementation
        async changePassword() {
            try {
                this.notMatch = null;
                this.passwordError = null;
                this.passwordLoading = true;
                await axios.post(apiRoutes.changePassword, this.passwordParam, {headers: apiServices.headerContent});
            } catch (e) {
                if(e.response.data.message) {
                    this.notMatch = e.response.data.message;
                } else {
                    this.passwordError = e.response.data.errors
                }
            } finally {
                this.passwordLoading = false;
            }
        },

        // change password api implementation
        async deleteAccount() {
            try {
                this.accountDeleteLoading = true;
                await axios.post(apiRoutes.deleteAccount, null, {headers: apiServices.headerContent});
                cookieServices.remove('access_token');
                this.$router.push({name:'login'});
            } catch (e) {  } finally {
                this.accountDeleteLoading = false;
            }
        }

    }
}

</script>
