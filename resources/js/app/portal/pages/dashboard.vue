<template>

    <!-- breadcrumb -->
    <div class="w-full flex justify-start items-center p-6 gap-3 bg-white rounded-md mb-5 shadow-md">

        <!-- breadcrumb link -->
        <RouterLink :to="{name:'dashboard'}" class="decoration-0 text-black text-sm font-medium">
            Dashboard
        </RouterLink>
        <!-- / breadcrumb link -->

    </div>
    <!-- / breadcrumb -->

    <!-- header -->
    <div class="flex justify-between items-center mb-4">
        <input type="text" name="search" class="w-full max-w-[420px] min-h-[50px] max-h-[50px] outline-0 bg-white border-0 shadow-md px-5 placeholder-black text-sm rounded-md" placeholder="Search Here" required autocomplete="off" />
        <button type="button" class="text-sm min-w-[100px] min-h-[50px] max-h-[50px] inline-flex justify-center items-center rounded-md bg-blue-500 duration-500 hover:bg-blue-700 text-white cursor-pointer" @click="openManageModal()">
            New
        </button>
    </div>
    <!-- / header -->

    <!-- crud -->
    <div class="w-full min-h-[calc(100vh-370px)] max-h-[calc(100vh-370px)] overflow-y-auto pe-3 py-3">
        <table class="table table-auto w-full">

            <!-- crud head -->
            <thead>
                <tr class="w-full block rounded-lg overflow-hidden duration-500 bg-white shadow-md">
                    <th class="mb-3 rounded-s-lg overflow-hidden max-w-[200px] min-w-[200px] text-xs font-medium text-start py-5 px-7">
                        Name
                    </th>
                    <th class="mb-3 max-w-[260px] min-w-[260px] text-xs font-medium text-start py-5 px-7">
                        Email
                    </th>
                    <th class="mb-3 max-w-[180px] min-w-[180px] text-xs font-medium text-start py-5 px-7">
                        Phone
                    </th>
                    <th class="mb-3 max-w-[400px] min-w-[400px] text-xs font-medium text-start py-5 px-7">
                        Present Address
                    </th>
                    <th class="mb-3 rounded-e-lg overflow-hidden max-w-[150px] min-w-[150px] text-xs font-medium text-start py-5 px-7">
                        Action
                    </th>
                </tr>
            </thead>
            <!-- / crud head -->

            <!-- crud body -->
            <tbody>
                <tr v-for="(each, index) in 20" :key="index" class="w-full mt-3 block rounded-lg shadow-md hover:shadow-lg overflow-hidden duration-500 bg-white  hover:bg-blue-50">
                    <td class="rounded-s-lg overflow-hidden max-w-[200px] min-w-[200px] text-xs font-normal text-start py-5 px-7">
                        <div class="truncate">
                            Mahi Bashar Akash
                        </div>
                    </td>
                    <td class="max-w-[260px] min-w-[260px] text-xs font-normal text-start py-5 px-7">
                        <div class="truncate">
                            mahibashar2000002@gmail.com
                        </div>
                    </td>
                    <td class="max-w-[180px] min-w-[180px] text-xs font-normal text-start py-5 px-7">
                        <div class="truncate">
                            01400125289
                        </div>
                    </td>
                    <td class="max-w-[400px] min-w-[400px] text-xs font-normal text-start py-5 px-7">
                        <div class="truncate">
                            Dhanmondi, Dhaka - 1216, Bangladesh
                        </div>
                    </td>
                    <td class="rounded-e-lg overflow-hidden max-w-[150px] min-w-[150px] text-xs font-normal text-start py-5 px-7">
                        <div class="flex justify-start items-center gap-5">
                            <a href="javascript:void(0)" class="decoration-0 text-gray-600" @click="openManageModal()">
                                Edit
                            </a>
                            <a href="javascript:void(0)" class="decoration-0 text-red-600" @click="openDeleteModal()">
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

    <div class="w-full flex justify-between items-center mt-3">

        <!-- pagination -->
        <div class="flex justify-start items-center gap-1">
            <button type="button" class="cursor-pointer rounded-md min-w-[35px] max-w-[35px] min-h-[35px] max-h-[35px] text-md inline-flex justify-center items-center bg-blue-400 duration-500 text-white hover:bg-blue-700">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="3" stroke="currentColor" class="w-4 h-4">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5 8.25 12l7.5-7.5" />
                </svg>
            </button>
            <button type="button" class="cursor-pointer rounded-md min-w-[35px] max-w-[35px] min-h-[35px] max-h-[35px] text-md inline-flex justify-center items-center bg-blue-400 duration-500 text-white hover:bg-blue-700">
                1
            </button>
            <button type="button" class="cursor-pointer rounded-md min-w-[35px] max-w-[35px] min-h-[35px] max-h-[35px] text-md inline-flex justify-center items-center bg-blue-400 duration-500 text-white hover:bg-blue-700">
                2
            </button>
            <button type="button" class="cursor-pointer rounded-md min-w-[35px] max-w-[35px] min-h-[35px] max-h-[35px] text-md inline-flex justify-center items-center bg-blue-400 duration-500 text-white hover:bg-blue-700">
                3
            </button>
            <button type="button" class="cursor-pointer rounded-md min-w-[35px] max-w-[35px] min-h-[35px] max-h-[35px] text-md inline-flex justify-center items-center bg-blue-400 duration-500 text-white hover:bg-blue-700">
                4
            </button>
            <button type="button" class="cursor-pointer rounded-md min-w-[35px] max-w-[35px] min-h-[35px] max-h-[35px] text-md inline-flex justify-center items-center bg-blue-400 duration-500 text-white hover:bg-blue-700">
                5
            </button>
            <button type="button" class="cursor-pointer rounded-md min-w-[35px] max-w-[35px] min-h-[35px] max-h-[35px] text-md inline-flex justify-center items-center bg-blue-400 duration-500 text-white hover:bg-blue-700">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="3" stroke="currentColor" class="w-4 h-4">
                    <path stroke-linecap="round" stroke-linejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5" />
                </svg>
            </button>
        </div>
        <!-- / pagination -->

        <!-- count -->
        <div class="text-gray-600 text-sm font-medium">
            10 of 30 from 300
        </div>
        <!-- / count -->

    </div>

    <!-- manage crud modal -->
    <section class="fixed inset-0 size-full grid sm:justify-center items-center duration-500 z-50 p-5 overflow-y-auto" :class="{ 'invisible bg-black/35': !isActiveManageModal, 'visible bg-black/65': isActiveManageModal }" @click="isActiveManageModal = false">

        <!-- card -->
        <aside class="bg-white rounded-xl w-full sm:max-w-[450px] sm:min-w-[450px] px-8 py-5 duration-500 origin-top" :class="{ 'translate-y-0 opacity-100': isActiveManageModal, '-translate-y-1/2 opacity-0': !isActiveManageModal }" @click.stop>

            <!-- form -->
            <form class="w-full block">

                <!-- header -->
                <div class="w-full flex justify-between items-center mb-3">
                    <div class="text-xl font-semibold"> Create Crud </div>
                    <button type="button" class="min-w-[45px] max-w-[45px] min-h-[45px] max-h-[45px] bg-transparent duration-500 hover:bg-gray-200 rounded-full inline-flex justify-center items-center cursor-pointer" @click="closeManageModal()">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
                <!-- / header -->

                <!-- body -->
                <div class="w-full block">

                    <!-- name -->
                    <div class="mb-3 w-full block">
                        <label for="name" class="mb-2 w-full block text-sm"> Name </label>
                        <input id="name" type="text" name="name" class="text-xs w-full border border-gray-100 bg-gray-100 block min-h-[45px] max-h-[45px] rounded-md outline-0 ring-0 focus-within:ring-3 ring-blue-400 duration-500 px-4 shadow-inner" autocomplete="off" />
                    </div>
                    <!-- / name -->

                    <!-- email -->
                    <div class="mb-3 w-full block">
                        <label for="email" class="mb-2 w-full block text-sm"> Email </label>
                        <input id="email" type="email" name="email" class="text-xs w-full border border-gray-100 bg-gray-100 block min-h-[45px] max-h-[45px] rounded-md outline-0 ring-0 focus-within:ring-3 ring-blue-400 duration-500 px-4 shadow-inner" autocomplete="off" />
                    </div>
                    <!-- / email -->

                    <!-- phone -->
                    <div class="mb-3 w-full block">
                        <label for="phone" class="mb-2 w-full block text-sm"> Phone Number </label>
                        <input id="phone" type="text" name="phone" class="text-xs w-full border border-gray-100 bg-gray-100 block min-h-[45px] max-h-[45px] rounded-md outline-0 ring-0 focus-within:ring-3 ring-blue-400 duration-500 px-4 shadow-inner" autocomplete="off" />
                    </div>
                    <!-- / phone -->

                    <!-- address -->
                    <div class="mb-3 w-full block">
                        <label for="address" class="mb-2 w-full block text-sm"> Address </label>
                        <input id="address" type="text" name="address" class="text-xs w-full border border-gray-100 bg-gray-100 block min-h-[45px] max-h-[45px] rounded-md outline-0 ring-0 focus-within:ring-3 ring-blue-400 duration-500 px-4 shadow-inner" autocomplete="off" />
                    </div>
                    <!-- / address -->

                </div>
                <!-- / body -->

                <!-- footer -->
                <div class="w-full flex justify-end items-center gap-5">
                    <button type="button" class="font-medium cursor-pointer bg-gray-200 duration-500 hover:bg-gray-300 px-8 text-xs rounded-md min-h-[45px] max-h-[45px] inline-flex justify-center items-center" @click="closeManageModal()">
                        Cancel
                    </button>
                    <button type="button" class="font-medium cursor-pointer bg-blue-500 duration-500 hover:bg-blue-700 text-white px-8 text-xs rounded-md min-h-[45px] max-h-[45px] inline-flex justify-center items-center">
                        Create
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
            <form class="w-full block">

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
                    <button type="button" class="font-medium cursor-pointer bg-gray-200 duration-500 hover:bg-gray-300 px-8 text-xs rounded-md min-h-[45px] max-h-[45px] inline-flex justify-center items-center" @click="closeDeleteModal()">
                        Cancel
                    </button>
                    <button type="button" class="font-medium cursor-pointer bg-red-500 duration-500 hover:bg-red-700 text-white px-8 text-xs rounded-md min-h-[45px] max-h-[45px] inline-flex justify-center items-center">
                        Confirm
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

export default {
    data() {
        return {
            // data properties
            isActiveManageModal: false,
            isActiveDeleteModal: false,
        }
    },
    mounted() {
        // mounted properties
    },
    methods: {

        // open manage modal
        openManageModal() {
            this.isActiveManageModal = true;
        },

        // close manage modal
        closeManageModal() {
            this.isActiveManageModal = false;
        },

        // open delete modal
        openDeleteModal() {
            this.isActiveDeleteModal = true;
        },

        // close delete modal
        closeDeleteModal() {
            this.isActiveDeleteModal = false;
        }

    }
}

</script>
