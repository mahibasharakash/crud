<template>

    <!-- breadcrumb -->
    <div class="w-full flex justify-start items-center px-6 py-4 gap-3 bg-white rounded-md mb-3 shadow-md">

        <!-- breadcrumb link -->
        <RouterLink :to="{name:'dashboard'}" class="decoration-0 text-black text-sm font-medium">
            Dashboard
        </RouterLink>
        <!-- / breadcrumb link -->

    </div>
    <!-- / breadcrumb -->

    <!-- search and control modal -->
    <div class="flex justify-between items-center mb-3">

        <!-- search -->
        <div class="relative max-w-[420px] w-full">
            <div class="absolute top-0 bottom-0 start-0 ps-5 flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                </svg>
            </div>
            <input type="text" name="search" v-model="params.search" @input="searchData()" class="ps-16 w-full min-h-[50px] max-h-[50px] outline-0 bg-white border-0 shadow-md pe-5 placeholder-black text-sm rounded-md" placeholder="Search Here" required autocomplete="off" />
        </div>
        <!-- / search -->

        <!-- button -->
        <button type="button" class="text-sm min-w-[100px] min-h-[50px] max-h-[50px] inline-flex justify-center items-center rounded-md bg-blue-500 duration-500 hover:bg-blue-700 text-white cursor-pointer" @click="openManageModal(null)">
            New
        </button>
        <!-- / button -->

    </div>
    <!-- / search and control modal -->

    <!-- loading  -->
    <div class="w-full min-h-[calc(100vh-320px)] max-h-[calc(100vh-320px)] flex justify-center items-center bg-white shadow-md rounded-md" v-if="listLoading">
        <div class="w-12 h-12 inline-block rounded-full border-4 border-blue-500 border-t-transparent animate-spin"></div>
    </div>
    <!-- / loading  -->

    <!-- no data founded -->
    <div class="w-full min-h-[calc(100vh-320px)] max-h-[calc(100vh-320px)] flex justify-center items-center flex-col bg-white shadow-md rounded-md" v-if="tableData.length === 0 && !listLoading">
        <div class="mb-3">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-18 h-18">
                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m2.25 0H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" />
            </svg>
        </div>
        <div class="font-medium mb-2 text-md"> No Data Found </div>
        <div class="font-normal text-sm"> Click to "New" to add new data </div>
    </div>
    <!-- / no data founded -->

    <!-- crud -->
    <div class="w-full min-h-[calc(100vh-370px)] max-h-[calc(100vh-370px)] overflow-y-auto pe-3 py-3" v-if="tableData.length > 0 && !listLoading">
        <table class="table table-auto w-full">

            <!-- crud head -->
            <thead>
                <tr class="w-full block rounded-lg overflow-hidden duration-500 bg-white shadow-md">
                    <th class="mb-3 rounded-s-lg overflow-hidden max-w-[400px] min-w-[400px] text-xs font-medium text-start py-5 px-7">
                        Title
                    </th>
                    <th class="mb-3 max-w-[600px] min-w-[600px] text-xs font-medium text-start py-5 px-7">
                        Description
                    </th>
                    <th class="mb-3 rounded-e-lg overflow-hidden max-w-[150px] min-w-[150px] text-xs font-medium text-start py-5 px-7">
                        Action
                    </th>
                </tr>
            </thead>
            <!-- / crud head -->

            <!-- crud body -->
            <tbody>
                <tr v-for="(each, index) in tableData" :key="index" class="w-full mt-3 block rounded-lg shadow-md hover:shadow-lg overflow-hidden duration-500 bg-white  hover:bg-blue-50">
                    <td class="rounded-s-lg overflow-hidden max-w-[400px] min-w-[400px] text-xs font-normal text-start py-5 px-7">
                        <div class="truncate">
                            {{each.title}}
                        </div>
                    </td>
                    <td class="max-w-[600px] min-w-[600px] text-xs font-normal text-start py-5 px-7">
                        <div class="truncate">
                            {{each.description}}
                        </div>
                    </td>
                    <td class="rounded-e-lg overflow-hidden max-w-[150px] min-w-[150px] text-xs font-normal text-start py-5 px-7">
                        <div class="flex justify-start items-center gap-5">
                            <a class="decoration-0 text-gray-600 cursor-pointer" @click="openManageModal(each.id)">
                                Edit
                            </a>
                            <a class="decoration-0 text-red-600 cursor-pointer" @click="openDeleteModal(each.id)">
                                Delete
                            </a>
                        </div>
                    </td>
                </tr>
            </tbody>
            <!-- / crud body -->

        </table>
    </div>
    <!-- / crud -->

    <div class="w-full flex justify-between items-center mt-3" v-if="tableData.length > 0 && !listLoading">

        <!-- pagination buttons -->
        <div class="flex justify-start items-center gap-1">

            <!-- Previous button -->
            <button type="button" :disabled="pagination.current_page <= 1" @click="goToPage(pagination.current_page - 1)" class="disabled:bg-blue-300 cursor-pointer rounded-md min-w-[35px] max-w-[35px] min-h-[35px] max-h-[35px] text-md inline-flex justify-center items-center bg-blue-400 duration-500 text-white hover:bg-blue-700 disabled:cursor-not-allowed">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="3" stroke="currentColor" class="w-4 h-4">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5 8.25 12l7.5-7.5" />
                </svg>
            </button>

            <!-- Page buttons -->
            <button v-for="page in getPageRange()" :key="page" type="button" @click="goToPage(page)" :class="[ 'cursor-pointer rounded-md min-w-[35px] max-w-[35px] min-h-[35px] max-h-[35px] text-md inline-flex justify-center items-center duration-500', page === pagination.current_page ? 'bg-blue-700 text-white' : 'bg-blue-400 text-white hover:bg-blue-700' ]">
                {{ page }}
            </button>

            <!-- Next button -->
            <button type="button" :disabled="pagination.current_page >= pagination.last_page" @click="goToPage(pagination.current_page + 1)" class="disabled:bg-blue-300 cursor-pointer rounded-md min-w-[35px] max-w-[35px] min-h-[35px] max-h-[35px] text-md inline-flex justify-center items-center bg-blue-400 duration-500 text-white hover:bg-blue-700 disabled:cursor-not-allowed">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="3" stroke="currentColor" class="w-4 h-4">
                    <path stroke-linecap="round" stroke-linejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5" />
                </svg>
            </button>
        </div>

        <!-- count -->
        <div class="text-gray-600 text-sm font-medium">
            Showing {{ tableData.length }} of {{ pagination.total }} items
        </div>

    </div>

    <!-- manage crud modal -->
    <section class="fixed inset-0 size-full grid sm:justify-center items-center duration-500 z-50 p-5 overflow-y-auto" :class="{ 'invisible bg-black/35': !isActiveManageModal, 'visible bg-black/65': isActiveManageModal }" @click="isActiveManageModal = false">

        <!-- card -->
        <aside class="bg-white rounded-xl w-full sm:max-w-[450px] sm:min-w-[450px] px-8 py-5 duration-500 origin-top" :class="{ 'translate-y-0 opacity-100': isActiveManageModal, '-translate-y-1/2 opacity-0': !isActiveManageModal }" @click.stop>

            <!-- form -->
            <form @submit.prevent="manageApi()" class="w-full block">

                <!-- header -->
                <div class="w-full flex justify-between items-center mb-3">
                    <div class="text-xl font-semibold">
                        <template v-if="formData.id"> Edit </template>
                        <template v-else> Create </template>
                        Crud
                    </div>
                    <button type="button" class="min-w-[45px] max-w-[45px] min-h-[45px] max-h-[45px] bg-transparent duration-500 hover:bg-gray-200 rounded-full inline-flex justify-center items-center cursor-pointer" @click="closeManageModal()">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
                <!-- / header -->

                <!-- body -->
                <div class="w-full block">

                    <!-- upload photo -->
                    <div class="mb-3 w-full block">
                        <div v-if="attach_preview" class="border border-gray-200 rounded-lg overflow-hidden max-h-[200px] min-h-[200px] relative">
                            <img :src="attach_preview" class="w-full object-cover bg-cover max-h-[200px] min-h-[200px]" alt="attached-file" />
                            <div class="absolute inset-0 flex justify-center items-center">
                                <button type="button" class="min-w-[45px] max-w-[45px] min-h-[45px] max-h-[45px] inline-flex justify-center items-center bg-red-500 cursor-pointer text-white hover:bg-red-700 rounded-full" @click="removeFile()">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                    </svg>
                                </button>
                            </div>
                        </div>
                        <label v-else for="upload-photo" class="border border-gray-200 bg-gray-100 duration-500 overflow-hidden rounded-lg cursor-pointer font-medium hover:bg-gray-300 w-full min-h-[200px] max-h-[200px] text-sm text-center flex justify-center items-center flex-col">
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

                    <!-- title -->
                    <div class="mb-3 w-full block">
                        <label for="title" class="mb-2 w-full block text-sm"> Title </label>
                        <input id="title" type="text" name="title" v-model="formData.title" class="text-xs w-full border border-gray-100 bg-gray-100 block min-h-[45px] max-h-[45px] rounded-md outline-0 ring-0 focus-within:ring-3 ring-blue-400 duration-500 px-4 shadow-inner" autocomplete="off" />
                        <div class="mt-2 w-full block text-red-500 text-xs font-medium" v-if="error?.title"> {{error?.title[0]}} </div>
                    </div>
                    <!-- / title -->

                    <!-- description -->
                    <div class="mb-3 w-full block">
                        <label for="short_description" class="mb-2 w-full block text-sm"> Short Description </label>
                        <textarea name="short_description" id="short_description" v-model="formData.short_description" class="text-xs w-full border border-gray-100 bg-gray-100 block rounded-md outline-0 ring-0 focus-within:ring-3 ring-blue-400 duration-500 p-4 shadow-inner" cols="30" rows="3" autocomplete="off"></textarea>
                        <div class="mt-2 w-full block text-red-500 text-xs font-medium" v-if="error?.short_description"> {{error?.short_description[0]}} </div>
                    </div>
                    <!-- / description -->

                    <!-- description -->
                    <div class="mb-3 w-full block">
                        <label for="long_description" class="mb-2 w-full block text-sm"> Long Description </label>
                        <textarea name="long_description" id="long_description" v-model="formData.long_description" class="text-xs w-full border border-gray-100 bg-gray-100 block rounded-md outline-0 ring-0 focus-within:ring-3 ring-blue-400 duration-500 p-4 shadow-inner" cols="30" rows="5" autocomplete="off"></textarea>
                        <div class="mt-2 w-full block text-red-500 text-xs font-medium" v-if="error?.long_description"> {{error?.long_description[0]}} </div>
                    </div>
                    <!-- / description -->

                </div>
                <!-- / body -->

                <!-- footer -->
                <div class="w-full flex justify-end items-center gap-5">
                    <button type="button" class="min-w-[90px] max-w-[90px] font-medium cursor-pointer bg-gray-200 duration-500 hover:bg-gray-300 px-8 text-xs rounded-md min-h-[45px] max-h-[45px] inline-flex justify-center items-center" @click="closeManageModal()">
                        Cancel
                    </button>
                    <button type="submit" class="min-w-[90px] max-w-[90px] font-medium cursor-pointer bg-blue-500 duration-500 hover:bg-blue-700 text-white px-8 text-xs rounded-md min-h-[45px] max-h-[45px] inline-flex justify-center items-center" v-if="!manageLoading">
                        <template v-if="formData.id"> Update </template>
                        <template v-else> Create </template>
                    </button>
                    <button type="button" class="min-w-[90px] max-w-[90px] font-medium cursor-pointer bg-blue-500 duration-500 hover:bg-blue-700 text-white px-8 text-xs rounded-md min-h-[45px] max-h-[45px] inline-flex justify-center items-center" v-if="manageLoading">
                        <span class="inline-block rounded-full w-4 h-4 border-2 border-white border-t-transparent animate-spin"></span>
                    </button>
                </div>
                <!-- / footer -->

            </form>
            <!-- / form -->

        </aside>
        <!-- / card -->

    </section>
    <!-- / manage crud modal -->

    <!-- delete crud modal -->
    <section class="fixed inset-0 size-full grid sm:justify-center items-center duration-500 z-50 p-5 overflow-y-auto" :class="{ 'invisible bg-black/35': !isActiveDeleteModal, 'visible bg-black/65': isActiveDeleteModal }" @click="isActiveDeleteModal = false">

        <!-- card -->
        <aside class="bg-white rounded-xl w-full sm:max-w-[450px] sm:min-w-[450px] px-8 py-10 duration-500 origin-top" :class="{ 'translate-y-0 opacity-100': isActiveDeleteModal, '-translate-y-1/2 opacity-0': !isActiveDeleteModal }" @click.stop>

            <!-- form -->
            <form @submit.prevent="deleteApi()" class="w-full block">

                <!-- header -->
                <div class="mb-3 flex justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.3" stroke="currentColor" class="w-17 h-17 text-red-500">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                    </svg>
                </div>
                <!-- / header -->

                <!-- body -->
                <div class="mb-4 flex justify-center font-medium">
                    Are You Sure?
                </div>
                <!-- / body -->

                <!-- footer -->
                <div class="w-full flex justify-center items-center gap-5">
                    <button type="button" class="min-w-[110px] max-w-[110px] font-medium cursor-pointer bg-gray-200 duration-500 hover:bg-gray-300 px-8 text-xs rounded-md min-h-[45px] max-h-[45px] inline-flex justify-center items-center" @click="closeDeleteModal()">
                        Cancel
                    </button>
                    <button type="submit" class="min-w-[110px] max-w-[110px] font-medium cursor-pointer bg-red-500 duration-500 hover:bg-red-700 text-white px-8 text-xs rounded-md min-h-[45px] max-h-[45px] inline-flex justify-center items-center" v-if="!deleteLoading">
                        Confirm
                    </button>
                    <button type="button" class="min-w-[110px] max-w-[110px] font-medium cursor-pointer bg-red-500 duration-500 hover:bg-red-700 text-white px-8 text-xs rounded-md min-h-[45px] max-h-[45px] inline-flex justify-center items-center" v-if="deleteLoading">
                        <span class="inline-block rounded-full w-4 h-4 border-2 border-white border-t-transparent animate-spin"></span>
                    </button>
                </div>
                <!-- / footer -->

            </form>
            <!-- / form -->

        </aside>
        <!-- / card -->

    </section>
    <!-- / delete crud modal -->

</template>

<script>

import axios from "axios";

import apiRoutes from "@/app/apiController/apiRoutes.js";
import apiServices from "@/app/apiController/apiServices.js";

export default {
    data() {
        return {
            // data properties
            isActiveManageModal: false,
            isActiveDeleteModal: false,
            manageLoading: false,
            listLoading: false,
            deleteLoading: false,
            showLoading: false,
            searchTimeout: null,
            attach_preview: null,
            tableData: [],
            params: {
                page: 1,
                per_page: 10,
                search: ''
            },
            pagination: {
                current_page: 1,
                per_page: 10,
                total: 0,
                last_page: 0
            },
            formData: {
                id: null,
                image: null,
                title: '',
                short_description: '',
                long_description: '',
            },
            error: {},
        }
    },
    mounted() {
        // mounted properties
        this.listApi();
    },
    methods: {

        // open manage modal
        openManageModal(data) {
            this.error = {};
            if(data) {
                this.showApi(data);
            } else {
                this.attach_preview = null;
                this.formData = {
                    id: null,
                    image: null,
                    title: '',
                    short_description: '',
                    long_description: '',
                }
            }
            this.isActiveManageModal = true;
        },

        // close manage modal
        closeManageModal() {
            this.isActiveManageModal = false;
        },

        // open delete modal
        openDeleteModal(data) {
            this.formData.id = data;
            this.isActiveDeleteModal = true;
        },

        // close delete modal
        closeDeleteModal() {
            this.isActiveDeleteModal = false;
        },

        // attach file
        attachFile(e) {
            this.attach_preview = URL.createObjectURL(e.target.files[0]);
            this.formData.image = e.target.files[0];
        },

        // remove file
        removeFile() {
            this.attach_preview = null;
            this.formData.image = null;
        },

        // manage api implementation
        async manageApi() {
            if(this.formData.id) {
                await this.updateApi();
            } else {
                await this.createApi();
            }
        },

        // create api implementation
        async createApi() {
            try {
                this.error = null;
                this.manageLoading = true;
                let formData = new FormData();
                formData.append("title", this.formData.title);
                formData.append("short_description", this.formData.short_description);
                formData.append("long_description", this.formData.long_description);
                formData.append("image", this.formData.image);
                await axios.post(apiRoutes.createCrud,formData,{headers:{'Content-Type':'multipart/form-data'}});
                this.closeManageModal();
                await this.listApi();
            } catch(e) {
                console.log(e);
            } finally {
                this.manageLoading = false;
            }
        },

        // update api implementation
        async updateApi() {
            try {
                this.manageLoading = true;
                const formData = new FormData();
                formData.append('title', this.formData.title);
                formData.append('short_description', this.formData.short_description);
                formData.append('long_description', this.formData.long_description);
                formData.append("image", this.formData.image);
                await axios.post(apiRoutes.updateCrud+`/${this.formData.id}?_method=PUT`,formData,{headers:{'Content-Type': 'multipart/form-data'}});
                this.closeManageModal();
                await this.listApi();
            } catch(e) {
                console.log(e);
            } finally {
                this.manageLoading = false;
            }
        },

        // list api implementation
        async listApi() {
            try {
                this.listLoading = true;
                const response = await axios.get(apiRoutes.listCrud, {params: this.params}, {headers: apiServices.headerContent});
                this.tableData = response?.data?.data;
                this.pagination = response?.data?.pagination;
            } finally {
                this.listLoading = false;
            }
        },

        // search data
        searchData() {
            clearTimeout(this.searchTimeout);
            this.searchTimeout = setTimeout(() => {
                this.params.page = 1;
                this.listApi();
            }, 500);
        },

        // page change
        goToPage(page) {
            if (page >= 1 && page <= this.pagination.last_page) {
                this.params.page = page;
                this.listApi();
            }
        },

        // Generate max 5-page buttons
        getPageRange() {
            const total = this.pagination.last_page || 1;
            let start = this.pagination.current_page - 2;
            let end = this.pagination.current_page + 2;
            if (start < 1) { start = 1; end = Math.min(5, total); }
            if (end > total) { end = total; start = Math.max(total - 4, 1); }
            const range = [];
            for (let i = start; i <= end; i++) { range.push(i); }
            return range;
        },

        // show api implementation
        async showApi(data) {
            try {
                this.showLoading = true;
                const response = await axios.get(apiRoutes.showCrud+`/${data}`, {headers: apiServices.headerContent});
                this.formData = response.data.data
            } finally {
                this.showLoading = false;
            }
        },

        // delete api implementation
        async deleteApi() {
            try {
                this.deleteLoading = true;
                await axios.delete(apiRoutes.deleteCrud+`/${this.formData.id}`, {headers: apiServices.headerContent});
                this.closeDeleteModal();
                await this.listApi();
            } finally {
                this.deleteLoading = false;
            }
        },

    }
}

</script>
