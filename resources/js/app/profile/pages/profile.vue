<template>

    <!-- breadcrumb -->
    <div class="w-full flex justify-start items-center px-6 py-4 gap-3 bg-white rounded-md mb-3 shadow-md">

        <!-- breadcrumb link -->
        <RouterLink :to="{name:'dashboard'}" class="decoration-0 text-black text-sm font-medium">
            Dashboard
        </RouterLink>
        <!-- / breadcrumb link -->

        <span>
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.3" stroke="currentColor" class="w-4 h-4">
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

    <div class="w-full flex justify-center">

        <!-- upload photo -->
        <div class="mb-5 w-full flex justify-center">
            <div v-if="avatarLoading" class="border border-gray-200 bg-white overflow-hidden rounded-full max-w-[280px] min-w-[280px] max-h-[280px] min-h-[280px] flex justify-center items-center">
                <span class="inline-block rounded-full w-15 h-15 border-4 border-blue-500 border-t-transparent animate-spin"></span>
            </div>
            <div v-if="attach_preview && !avatarLoading" class="border border-gray-200 overflow-hidden rounded-full max-w-[280px] min-w-[280px] max-h-[280px] min-h-[280px] relative">
                <img :src="attach_preview" class="w-full object-cover bg-cover max-h-[280px] min-h-[280px]" alt="attached-file" />
                <div class="absolute inset-0 flex justify-center items-center">
                    <button type="button" class="min-w-[45px] max-w-[45px] min-h-[45px] max-h-[45px] inline-flex justify-center items-center bg-red-500 cursor-pointer text-white hover:bg-red-700 rounded-full" @click="removeFile()">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                        </svg>
                    </button>
                </div>
            </div>
            <label v-if="!attach_preview && !avatarLoading" for="upload-photo" class="border border-gray-200 bg-white duration-500 overflow-hidden cursor-pointer font-medium hover:bg-gray-300 rounded-full max-w-[280px] min-w-[280px] max-h-[280px] min-h-[280px] text-sm text-center flex justify-center items-center flex-col">
                <input type="file" name="image" id="upload-photo" hidden @change="attachFile($event)" />
                <span class="mb-3">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-7 h-7">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75V16.5m-13.5-9L12 3m0 0 4.5 4.5M12 3v13.5" />
                    </svg>
                </span>
                <span> Upload Photo <br/> ( max: 2048kb or 2MB ) </span>
            </label>
        </div>
        <!-- / upload photo -->

    </div>

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
            attach_preview: null,
            avatarLoading: false,
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
                if(response.data.user.image) {
                    this.attach_preview = `/storage/${response.data.user.image}`;
                }
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
        },

        // attach file
        async attachFile(e) {
            try {
                this.avatarLoading = true;
                this.attach_preview = URL.createObjectURL(e.target.files[0]);
                this.profileParam.image = e.target.files[0];
                let formData = new FormData();
                if (this.profileParam.image) {
                    formData.append("image", this.profileParam.image);
                }
                await axios.post(apiRoutes.uploadImage, formData, {
                    headers: {
                        'Content-Type': 'multipart/form-data',
                    }
                });
            } catch (e) {
                console.log(e);
            } finally {
                this.avatarLoading = false;
            }
        },

        // remove file
        async removeFile() {
            try {
                this.avatarLoading = true;
                this.attach_preview = null;
                this.profileParam.image = null;
                await axios.post(apiRoutes.removeImage, {
                    headers: {
                        'Content-Type': 'multipart/form-data',
                    }
                });
            } catch (e) {
                console.log(e)
            } finally {
                this.avatarLoading = false;
            }
        },

    }
}

</script>
