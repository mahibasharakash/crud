<template>

    <main class="w-full">
        <div class="mx-auto max-w-7xl px-5 pt-5 pb-16 w-full">

            <template v-if="singleData && !singleLoading">

                <!-- card image -->
                <div class="pt-5 w-full">
                    <img v-if="singleData?.image" :src="`/storage/${singleData?.image}`" class="w-full object-contain bg-contain min-h-[450px] max-h-[450px] rounded-md" alt="food" />
                    <div v-else class="w-full scale-100 duration-500 group-hover:scale-125 text-2xl font-semibold min-h-[250px] max-h-[250px] flex justify-center items-center">
                        300x300
                    </div>
                </div>
                <!-- / card image -->

                <div class="text-xs mt-3 font-medium flex justify-end gap-3 opacity-70">

                    <!-- card comments -->
                    <div class="inline-flex justify-end items-center gap-2">
                        <div>
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-3 h-3">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                            </svg>
                        </div>
                        <div> {{countNumber(singleData?.views)}} </div>
                    </div>
                    <!-- / card comments -->

                    <!-- card date -->
                    <div> {{singleData?.human_created_at}} </div>
                    <!-- / card date -->

                </div>

                <!-- card title -->
                <div class="text-lg mt-3 block font-medium">
                    {{singleData?.title}}
                </div>
                <!-- / card title -->

                <!-- card description -->
                <div class="text-sm block my-3 font-normal">
                    {{singleData?.short_description}}
                </div>

                <!-- card inner image -->
                <div class="max-w-[650px] my-10 w-full mx-auto">
                    <img v-if="singleData?.image" :src="`/storage/${singleData?.image}`" class="w-full object-contain bg-contain min-h-[350px] max-h-[350px] rounded-md" alt="food" />
                    <div v-else class="w-full scale-100 duration-500 group-hover:scale-125 text-2xl font-semibold min-h-[350px] max-h-[350px] flex justify-center items-center">
                        300x300
                    </div>
                </div>
                <!-- / card inner image -->

                <div class="text-sm block my-3 font-normal whitespace-break-spaces">
                    {{singleData?.long_description}}
                </div>

                <!-- card author name -->
                <div class="inline-flex justify-start items-center mt-5">
                    <div class="min-w-[55px] uppercase bg-blue-500 text-white rounded-full min-h-[55px] max-w-[55px] max-h-[55px] inline-flex justify-center items-center text-md">
                        {{shortName(singleData?.get_information?.name)}}
                    </div>
                    <div class="ms-2 text-sm">
                        {{singleData?.get_information?.name}} <br/>
                        <span class="text-sm text-gray-500"> {{singleData?.get_information?.email}} </span>
                    </div>
                </div>
                <!-- / card author name -->

            </template>

            <template v-if="!singleData && !singleLoading">

                <div class="w-full min-h-[calc(100vh-250px)] rounded-md mb-10 max-h-[calc(100vh-250px)] flex justify-center items-center bg-white flex-col">
                    <div class="mb-3">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-18 h-18">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m2.25 0H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" />
                        </svg>
                    </div>
                    <div class="font-medium text-md"> No Data Found </div>
                </div>

            </template>

            <template v-if="singleLoading">

                <div class="w-full min-h-[calc(100vh-320px)] max-h-[calc(100vh-320px)] flex justify-center items-center bg-white shadow-md rounded-md">
                    <div class="w-12 h-12 inline-block rounded-full border-4 border-blue-500 border-t-transparent animate-spin"></div>
                </div>

            </template>

        </div>
    </main>

</template>

<script>

import axios from "axios";

import apiRoutes from "@/app/apiController/apiRoutes.js";
import apiServices from "@/app/apiController/apiServices.js";

export default {
    data() {
        return {
            singleLoading: false,
            singleData: null,
        }
    },
    mounted() {
        if(window.history.state.slug) {
            this.singleApi(window.history.state.slug);
        }
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

        // single api implementation
        async singleApi(data) {
            try {
                this.singleLoading = true;
                const response = await axios.get(apiRoutes.singleBlog+`/${data}`, {headers: apiServices.headerContent});
                this.singleData = response?.data?.data
            } finally {
                this.singleLoading = false;
            }
        },

        // short name
        shortName(name) {
            if (!name || typeof name !== 'string') return '';
            let parts = name.trim().split(' ');
            if (parts.length < 2) return parts[0][0] || '';
            return parts[0][0] + parts[1][0];
        }

    }
}

</script>
