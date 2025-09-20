<template>

    <!-- main -->
    <main class="w-full">
        <div class="mx-auto max-w-7xl px-5 pt-5 pb-16 w-full">
            <div class="w-full flex flex-wrap">

                <!-- post card collection -->
                <div class="w-full lg:w-2/3 pe-5 pt-5">

                    <!-- title with duration -->
                    <div class="w-full px-6 py-5 gap-3 bg-white rounded-md mb-5 shadow-md">
                        <div class="w-full flex justify-between items-center">

                            <!-- title -->
                            <div class="w-full block text-xl font-semibold"> Post </div>
                            <!-- / title -->

                            <!-- select duration -->
                            <div class="max-w-[250px] w-full relative">
                                <select name="time" class="w-full font-semibold border-0 bg-gray-100 outline-0 ring-0 focus-within:ring-3 ring-blue-500 duration-500 cursor-pointer rounded-md min-h-[50px] max-h-[50px] text-sm px-5 appearance-none" required autocomplete="off">
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

                    <!-- card grid -->
                    <div class="w-full grid grid-cols-1 sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-2 gap-5">

                        <template v-for="(each, index) in 2" :key="index">

                            <!-- card -->
                            <div class="w-full bg-white rounded-md mb-5 shadow-lg group duration-500 hover:shadow-2xl shadow-gray-400 overflow-hidden">

                                <div class="min-h-[250px] max-h-[250px] overflow-hidden relative">

                                    <!-- card image -->
                                    <img :src="'/collection/food.jpeg'" class="w-full scale-100 duration-500 group-hover:scale-125 object-cover bg-cover min-h-[250px] max-h-[250px]" alt="food" />
                                    <!-- / card image -->

                                    <!-- card views -->
                                    <div class="absolute bottom-0 start-0 p-3 pointer-events-none">
                                        <div class="bg-white px-2.5 py-1.5 text-xs rounded-sm font-medium shadow-md shadow-gray-500"> 10 Views </div>
                                    </div>
                                    <!-- / card views -->

                                </div>

                                <div class="text-xs mt-3 px-7 font-medium flex justify-between gap-3 opacity-70">

                                    <!-- card date -->
                                    <div> 25 Sep 2025 </div>
                                    <!-- / card date -->

                                    <div class="flex items-center justify-end gap-3">

                                        <!-- card comments -->
                                        <div class="inline-flex justify-end items-center gap-2">
                                            <div>
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 20.25c4.97 0 9-3.694 9-8.25s-4.03-8.25-9-8.25S3 7.444 3 12c0 2.104.859 4.023 2.273 5.48.432.447.74 1.04.586 1.641a4.483 4.483 0 0 1-.923 1.785A5.969 5.969 0 0 0 6 21c1.282 0 2.47-.402 3.445-1.087.81.22 1.668.337 2.555.337Z" />
                                                </svg>
                                            </div>
                                            <div> {{countNumber(2000)}} </div>
                                        </div>
                                        <!-- / card comments -->

                                        <!-- card share -->
                                        <div class="inline-flex justify-end items-center gap-2">
                                            <div>
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4">
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
                                        Decadent Caramel Pancake Stack with Fresh Berries
                                    </div>
                                </div>
                                <!-- / card title -->

                                <!-- card description -->
                                <div class="text-sm block my-3 px-7 font-normal">
                                    <div class="text-truncate-line-3">
                                        Indulge in a sumptuous breakfast experience with this towering stack of fluffy pancakes, generously drizzled with rich, golden caramel sauce. Each layer is perfectly cooked to a soft, airy texture, creating a delightful contrast with the slightly crisp edges. The pancakes are topped with a medley of fresh strawberries and nuts, adding bursts of flavor and a satisfying crunch in every bite.
                                    </div>
                                </div>
                                <!-- / card share -->

                                <div class="pb-5 w-full flex justify-between items-center px-7">

                                    <!-- card author name -->
                                    <div class="inline-flex justify-start items-center">
                                        <div class="min-w-[45px] bg-blue-500 text-white rounded-full min-h-[45px] max-w-[45px] max-h-[45px] inline-flex justify-center items-center text-sm">
                                            MB
                                        </div>
                                        <div class="ms-2 text-sm"> Mahi Bashar Akash </div>
                                    </div>
                                    <!-- / card author name -->

                                    <!-- link -->
                                    <a href="javascript:void(0)" class="min-w-[45px] bg-gray-100 rounded-full min-h-[45px] max-w-[45px] max-h-[45px] inline-flex justify-center items-center hover:bg-blue-500 hover:text-white duration-500 cursor-pointer">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="m15 15 6-6m0 0-6-6m6 6H9a6 6 0 0 0 0 12h3" />
                                        </svg>
                                    </a>
                                    <!-- / link -->

                                </div>
                            </div>
                            <!-- / card -->

                        </template>

                    </div>
                    <!-- / card grid -->

                    <div class="w-full mt-5 flex justify-between items-center">

                        <!-- pagination -->
                        <div class="flex justify-start items-center gap-1">
                            <button type="button" class="cursor-pointer font-medium text-sm rounded-full bg-blue-200 text-blue-600 hover:bg-blue-500 hover:text-white duration-500 outline-0 border-0 min-w-[35px] max-w-[35px] min-h-[35px] max-h-[35px] inline-flex justify-center items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-3.5 h-3.5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5 8.25 12l7.5-7.5" />
                                </svg>
                            </button>
                            <button type="button" class="cursor-pointer font-medium text-sm rounded-full bg-blue-200 text-blue-600 hover:bg-blue-500 hover:text-white duration-500 outline-0 border-0 min-w-[35px] max-w-[35px] min-h-[35px] max-h-[35px] inline-flex justify-center items-center">
                                1
                            </button>
                            <button type="button" class="cursor-pointer font-medium text-sm rounded-full bg-blue-200 text-blue-600 hover:bg-blue-500 hover:text-white duration-500 outline-0 border-0 min-w-[35px] max-w-[35px] min-h-[35px] max-h-[35px] inline-flex justify-center items-center">
                                2
                            </button>
                            <button type="button" class="cursor-pointer font-medium text-sm rounded-full bg-blue-200 text-blue-600 hover:bg-blue-500 hover:text-white duration-500 outline-0 border-0 min-w-[35px] max-w-[35px] min-h-[35px] max-h-[35px] inline-flex justify-center items-center">
                                3
                            </button>
                            <button type="button" class="cursor-pointer font-medium text-sm rounded-full bg-blue-200 text-blue-600 hover:bg-blue-500 hover:text-white duration-500 outline-0 border-0 min-w-[35px] max-w-[35px] min-h-[35px] max-h-[35px] inline-flex justify-center items-center">
                                4
                            </button>
                            <button type="button" class="cursor-pointer font-medium text-sm rounded-full bg-blue-200 text-blue-600 hover:bg-blue-500 hover:text-white duration-500 outline-0 border-0 min-w-[35px] max-w-[35px] min-h-[35px] max-h-[35px] inline-flex justify-center items-center">
                                5
                            </button>
                            <button type="button" class="cursor-pointer font-medium text-sm rounded-full bg-blue-200 text-blue-600 hover:bg-blue-500 hover:text-white duration-500 outline-0 border-0 min-w-[35px] max-w-[35px] min-h-[35px] max-h-[35px] inline-flex justify-center items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-3.5 h-3.5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5" />
                                </svg>
                            </button>
                        </div>
                        <!-- / pagination -->

                        <!-- count page with quantity -->
                        <div class="text-gray-800 text-xs font-medium">10 of 30 out of 300</div>
                        <!-- / count page with quantity -->

                    </div>

                </div>
                <!-- / post card collection -->

                <!-- search and category -->
                <div class="w-full lg:w-1/3">

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
                                <input type="text" name="search" class="w-full border-0 outline-0 block ring-0 focus-within:ring-3 ring-blue-500 duration-500 min-h-[50px] max-h-[50px] rounded-md bg-gray-100 ps-12 pe-5 text-sm font-medium placeholder-black" placeholder="Search Here" required autocomplete="off" />
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
                                <button type="button" class="cursor-pointer ring-0 focus:ring-3 ring-blue-700/50 duration-500 text-sm px-4.5 py-1.5 rounded-md outline-0 border-0 bg-blue-500 hover:bg-blue-700 text-white">
                                    Food
                                </button>
                                <button type="button" class="cursor-pointer ring-0 focus:ring-3 ring-blue-700/50 duration-500 text-sm px-4.5 py-1.5 rounded-md outline-0 border-0 bg-blue-500 hover:bg-blue-700 text-white">
                                    Dress
                                </button>
                                <button type="button" class="cursor-pointer ring-0 focus:ring-3 ring-blue-700/50 duration-500 text-sm px-4.5 py-1.5 rounded-md outline-0 border-0 bg-blue-500 hover:bg-blue-700 text-white">
                                    Shelter
                                </button>
                                <button type="button" class="cursor-pointer ring-0 focus:ring-3 ring-blue-700/50 duration-500 text-sm px-4.5 py-1.5 rounded-md outline-0 border-0 bg-blue-500 hover:bg-blue-700 text-white">
                                    Education
                                </button>
                                <button type="button" class="cursor-pointer ring-0 focus:ring-3 ring-blue-700/50 duration-500 text-sm px-4.5 py-1.5 rounded-md outline-0 border-0 bg-blue-500 hover:bg-blue-700 text-white">
                                    Treatment
                                </button>
                                <button type="button" class="cursor-pointer ring-0 focus:ring-3 ring-blue-700/50 duration-500 text-sm px-4.5 py-1.5 rounded-md outline-0 border-0 bg-blue-500 hover:bg-blue-700 text-white">
                                    Technology
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

export default {
    data() {
        return {

        }
    },
    mounted() {

    },
    methods: {

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
        }

    }
}

</script>
