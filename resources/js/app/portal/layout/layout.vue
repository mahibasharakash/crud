<template>

    <!-- header -->
    <header class="bg-white w-full">
        <div class="mx-auto max-w-7xl w-full min-h-[80px] max-h-[80px] flex justify-between items-center">

            <!-- logo -->
            <RouterLink :to="{name:'home'}" class="decoration-0 text-black text-2xl">
                Laravel
            </RouterLink>
            <!-- / logo -->

            <!-- group links -->
            <div class="flex justify-end items-center gap-4">

                <!-- profile -->
                <RouterLink :to="{name:'profile'}" class="decoration-0 text-black text-sm">
                    Profile
                </RouterLink>
                <!-- / profile -->

                <!-- logout -->
                <a href="javascript:void(0)" class="decoration-0 text-black">
                    Logout
                </a>
                <!-- / logout -->

            </div>
            <!-- / group links -->

        </div>
    </header>
    <!-- / header -->

    <main class="w-full min-h-[calc(100vh-80px)] max-h-[calc(100vh-80px)] bg-gray-100">

    </main>

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

    }
}

</script>
