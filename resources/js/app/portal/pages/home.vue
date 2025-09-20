<template>

    <!-- main -->
    <main class="w-full">
        <div class="mx-auto max-w-7xl px-5 pt-5 pb-16 w-full">
            <div class="w-full flex flex-wrap">

                <!-- post card collection -->
                <div class="w-full order-2 lg:order-1 lg:w-2/3 lg:pe-5 pt-5">

                    <!-- title with duration -->
                    <div class="w-full gap-3 rounded-md mb-5">
                        <div class="w-full flex justify-between items-center">

                            <!-- title -->
                            <div class="w-full block text-xl font-semibold ps-0.5"> Post </div>
                            <!-- / title -->

                            <!-- select duration -->
                            <div class="max-w-[230px] w-full relative">
                                <select name="time" v-model="params.time" @input="searchData()" class="w-full font-semibold border-0 bg-white outline-0 ring-0 focus-within:ring-3 ring-blue-500 duration-500 cursor-pointer rounded-md min-h-[50px] max-h-[50px] text-sm px-5 appearance-none" required autocomplete="off">
                                    <option :value="null"> Select Duration </option>
                                    <option :value="'today'"> Today </option>
                                    <option :value="'week'"> Week </option>
                                    <option :value="'month'"> Month </option>
                                    <option :value="'year'"> Year </option>
                                </select>
                                <div class="absolute top-0 bottom-0 end-0 pe-3 flex items-center pointer-events-none text-black">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-5 h-5">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5" />
                                    </svg>
                                </div>
                            </div>
                            <!-- / select duration -->

                        </div>
                    </div>
                    <!-- / title with duration -->

                    <template v-if="listLoading">
                        <div class="w-full min-h-[calc(100vh-320px)] max-h-[calc(100vh-320px)] flex justify-center items-center bg-white shadow-md rounded-md" v-if="listLoading">
                            <div class="w-12 h-12 inline-block rounded-full border-4 border-blue-500 border-t-transparent animate-spin"></div>
                        </div>
                    </template>

                    <template v-if="tableData.length === 0">

                        <div class="w-full min-h-[calc(100vh-250px)] rounded-md mb-10 max-h-[calc(100vh-250px)] flex justify-center items-center bg-white flex-col">
                            <div class="mb-3">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-18 h-18">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m2.25 0H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" />
                                </svg>
                            </div>
                            <div class="font-medium text-md"> No Data Found </div>
                        </div>

                    </template>

                    <template v-if="tableData.length > 0 && !listLoading">

                        <!-- card grid -->
                        <div class="w-full grid grid-cols-1 sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-2 gap-5">

                            <template v-for="(each, index) in tableData" :key="index">

                                <!-- card -->
                                <div class="w-full bg-white rounded-md mb-5 shadow-lg group duration-500 hover:shadow-2xl shadow-gray-400 overflow-hidden">

                                    <div class="min-h-[250px] max-h-[250px] overflow-hidden relative">

                                        <!-- card image -->
                                        <img v-if="each.image" :src="`/storage/${each.image}`" class="w-full scale-100 duration-500 group-hover:scale-125 object-cover bg-cover min-h-[250px] max-h-[250px]" :alt="each.slug" />
                                        <div v-else class="w-full scale-100 duration-500 group-hover:scale-125 text-2xl font-semibold min-h-[250px] max-h-[250px] flex justify-center items-center">
                                            300x300
                                        </div>
                                        <!-- / card image -->

                                        <div class="absolute inset-0 w-full h-full bg-gradient-to-t from-blue-900 to-35% to-transparent opacity-50"></div>

                                        <!-- card views -->
                                        <div class="absolute top-0 end-0 p-3 pointer-events-none z-10">
                                            <div class="bg-white px-2.5 py-1.5 text-xs rounded-sm font-medium shadow-md shadow-gray-500"> 10 Views </div>
                                        </div>
                                        <!-- / card views -->

                                    </div>

                                    <div class="text-xs mt-3 px-7 font-medium flex justify-between gap-3 opacity-70">

                                        <!-- card date -->
                                        <div> {{each.human_created_at}} </div>
                                        <!-- / card date -->

                                        <div class="flex items-center justify-end gap-3">

                                            <!-- card comments -->
                                            <div class="inline-flex justify-end items-center gap-2">
                                                <div>
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-3 h-3">
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 20.25c4.97 0 9-3.694 9-8.25s-4.03-8.25-9-8.25S3 7.444 3 12c0 2.104.859 4.023 2.273 5.48.432.447.74 1.04.586 1.641a4.483 4.483 0 0 1-.923 1.785A5.969 5.969 0 0 0 6 21c1.282 0 2.47-.402 3.445-1.087.81.22 1.668.337 2.555.337Z" />
                                                    </svg>
                                                </div>
                                                <div> {{countNumber(2000)}} </div>
                                            </div>
                                            <!-- / card comments -->

                                            <!-- card share -->
                                            <div class="inline-flex justify-end items-center gap-2">
                                                <div>
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-3 h-3">
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M7.217 10.907a2.25 2.25 0 1 0 0 2.186m0-2.186c.18.324.283.696.283 1.093s-.103.77-.283 1.093m0-2.186 9.566-5.314m-9.566 7.5 9.566 5.314m0 0a2.25 2.25 0 1 0 3.935 2.186 2.25 2.25 0 0 0-3.935-2.186Zm0-12.814a2.25 2.25 0 1 0 3.933-2.185 2.25 2.25 0 0 0-3.933 2.185Z" />
                                                    </svg>
                                                </div>
                                                <div> {{countNumber(1200)}} </div>
                                            </div>
                                            <!-- / card share -->

                                        </div>
                                    </div>

                                    <!-- card title -->
                                    <div class="text-lg mt-3 block px-7 font-medium">
                                        <div class="text-truncate-line-2">
                                            {{each.title}}
                                        </div>
                                    </div>
                                    <!-- / card title -->

                                    <!-- card description -->
                                    <div class="text-sm block my-3 px-7 font-normal">
                                        <div class="text-truncate-line-3 text-gray-600">
                                            {{each.short_description}}
                                        </div>
                                    </div>
                                    <!-- / card share -->

                                    <div class="pb-5 w-full flex justify-between items-center px-7">

                                        <!-- card author name -->
                                        <div class="inline-flex justify-start items-center">
                                            <div class="min-w-[45px] uppercase bg-blue-500 text-white rounded-full min-h-[45px] max-w-[45px] max-h-[45px] inline-flex justify-center items-center text-sm">
                                                {{shortName(each?.user?.name)}}
                                            </div>
                                            <div class="ms-2 text-sm"> {{each?.user?.name}} </div>
                                        </div>
                                        <!-- / card author name -->

                                        <!-- link -->
                                        <RouterLink :to="{ name: 'blogDetails', params: { slug: each.slug }, state: { slug: each.slug} }" class="min-w-[45px] bg-gray-100 rounded-full min-h-[45px] max-w-[45px] max-h-[45px] inline-flex justify-center items-center hover:bg-blue-500 hover:text-white duration-500 cursor-pointer">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="m15 15 6-6m0 0-6-6m6 6H9a6 6 0 0 0 0 12h3" />
                                            </svg>
                                        </RouterLink>
                                        <!-- / link -->

                                    </div>
                                </div>
                                <!-- / card -->

                            </template>

                        </div>
                        <!-- / card grid -->

                    </template>

                    <div class="w-full flex justify-between items-center mt-3" v-if="tableData.length > 0 && !listLoading">

                        <!-- pagination buttons -->
                        <div class="flex justify-start items-center gap-1">

                            <!-- Previous button -->
                            <button type="button" :disabled="pagination.current_page <= 1" @click="goToPage(pagination.current_page - 1)" class="disabled:bg-blue-300 cursor-pointer rounded-full min-w-[35px] max-w-[35px] min-h-[35px] max-h-[35px] text-md inline-flex justify-center items-center bg-blue-400 duration-500 text-white hover:bg-blue-700 disabled:cursor-not-allowed">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="3" stroke="currentColor" class="w-4 h-4">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5 8.25 12l7.5-7.5" />
                                </svg>
                            </button>

                            <!-- Page buttons -->
                            <button v-for="page in getPageRange()" :key="page" type="button" @click="goToPage(page)" :class="[ 'cursor-pointer rounded-full min-w-[35px] max-w-[35px] min-h-[35px] max-h-[35px] text-md inline-flex justify-center items-center duration-500', page === pagination.current_page ? 'bg-blue-700 text-white' : 'bg-blue-400 text-white hover:bg-blue-700' ]">
                                {{ page }}
                            </button>

                            <!-- Next button -->
                            <button type="button" :disabled="pagination.current_page >= pagination.last_page" @click="goToPage(pagination.current_page + 1)" class="disabled:bg-blue-300 cursor-pointer rounded-full min-w-[35px] max-w-[35px] min-h-[35px] max-h-[35px] text-md inline-flex justify-center items-center bg-blue-400 duration-500 text-white hover:bg-blue-700 disabled:cursor-not-allowed">
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

                </div>
                <!-- / post card collection -->

                <!-- search and category -->
                <div class="w-full order-1 lg:order-2 lg:w-1/3">

                    <div class="sticky top-30 start-0 end-0 z-10">

                        <!-- title with search -->
                        <div class="w-full px-6 py-5 gap-3 bg-white rounded-md mb-5 shadow-md">

                            <!-- title -->
                            <div class="mb-3 w-full block text-xl font-semibold"> Search </div>
                            <!-- / title -->

                            <!-- search -->
                            <div class="w-full relative">
                                <div class="absolute top-0 bottom-0 start-0 ps-3 items-center flex">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-6 h-6">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                                    </svg>
                                </div>
                                <input type="text" name="search" v-model="params.search" @input="searchData()" class="w-full border-0 outline-0 block ring-0 focus-within:ring-3 ring-blue-500 duration-500 min-h-[50px] max-h-[50px] rounded-md bg-gray-100 ps-12 pe-5 text-sm font-medium placeholder-black" placeholder="Search Here" required autocomplete="off" />
                            </div>
                            <!-- / search -->

                        </div>
                        <!-- / title with search -->

                        <!-- title with category -->
                        <div class="w-full px-6 py-5 gap-3 bg-white rounded-md mb-5 shadow-md">

                            <!-- title -->
                            <div class="mb-3 w-full block text-xl font-semibold"> Category </div>
                            <!-- / title -->

                            <!-- category -->
                            <div class="w-full flex flex-wrap gap-2">
                                <template v-for="(each,index) in categoryData" :key="index">
                                    <button type="button" class="cursor-pointer capitalize ring-0 focus:ring-3 ring-blue-700/50 duration-500 text-sm px-4.5 py-1.5 rounded-md outline-0 border-0 bg-blue-500 hover:bg-blue-700 text-white" @click="selectCategory(each.title)">
                                        {{each.title}}
                                    </button>
                                </template>
                                <button type="button" class="cursor-pointer ring-0 focus:ring-3 ring-blue-700/50 duration-500 text-sm px-4.5 py-1.5 rounded-md outline-0 border-0 bg-blue-500 hover:bg-blue-700 text-white" @click="selectCategory('')">
                                    All
                                </button>
                            </div>
                            <!-- / category -->

                        </div>
                        <!-- / title with category -->

                    </div>

                </div>
                <!-- / search and category -->

            </div>
        </div>
    </main>
    <!-- / main -->

</template>

<script>

import axios from "axios";

import apiRoutes from "@/app/apiController/apiRoutes.js";
import apiServices from "@/app/apiController/apiServices.js";

export default {
    data() {
        return {
            // data properties
            tableData: [],
            categoryData: [],
            showLoading: false,
            listLoading: false,
            params: {
                category: '',
                page: 1,
                per_page: 10,
                search: '',
                time: null,
            },
            pagination: {
                current_page: 1,
                per_page: 10,
                total: 0,
                last_page: 0
            },
        }
    },
    mounted() {
        // mounted properties
        this.listApi();
        this.getCategory();
    },
    methods: {

        // count number
        countNumber(num) {
            if (num >= 1_000_000_000) {
                return (num / 1_000_000_000).toFixed(1).replace(/\.0$/, '') + 'b';
            } else if (num >= 1_000_000) {
                return (num / 1_000_000).toFixed(1).replace(/\.0$/, '') + 'm';
            } else if (num >= 1_000) {
                return (num / 1_000).toFixed(1).replace(/\.0$/, '') + 'k';
            } else {
                return num.toString();
            }
        },

        // list api implementation
        async listApi() {
            try {
                this.listLoading = true;
                const response = await axios.get(apiRoutes.allBlog, {params: this.params}, {headers: apiServices.headerContent});
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

        // short name
        shortName(name) {
            if (!name || typeof name !== 'string') return '';
            let parts = name.trim().split(' ');
            if (parts.length < 2) return parts[0][0] || '';
            return parts[0][0] + parts[1][0];
        },

        // category api implementation
        async getCategory() {
            try {
                this.showLoading = true;
                const response = await axios.get(apiRoutes.allCategory, null, {headers: apiServices.headerContent});
                this.categoryData = response?.data?.data
            } finally {
                this.showLoading = false;
            }
        },

        // select category filter list api implementation
        selectCategory(category) {
            clearTimeout(this.searchTimeout);
            this.searchTimeout = setTimeout(() => {
                this.params.category = category;
                this.listApi();
            }, 500);
        },

    }
}

</script>
