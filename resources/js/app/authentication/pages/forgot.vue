<template>

    <form @submit.prevent="forgotApi()">
        <div class="mb-3 w-full block">
            <label for="email" class="mb-2 w-full block text-sm font-medium"> Email </label>
            <input id="email" type="email" name="email" v-model="formData.email" class="w-full border border-gray-200 bg-gray-200 block min-h-[45px] max-h-[45px] rounded-md outline-0 ring-0 focus-within:ring-3 ring-blue-400 duration-500 px-4" autocomplete="off" />
            <div class="mt-2 w-full block text-red-500 text-xs" v-if="error.email"> {{error.email[0]}} </div>
        </div>
        <div class="mb-5 w-full block">
            <button type="submit" class="text-sm font-medium bg-blue-400 duration-500 hover:bg-blue-700 text-white px-10 rounded-md min-h-[45px] max-h-[45px] cursor-pointer" v-if="!loading">
                Send
            </button>
        </div>
        <div class="text-center text-sm text-gray-700">
            Remember Password?
            <RouterLink :to="{name:'login'}" class="decoration-1 text-blue-400"> Login </RouterLink>
        </div>
    </form>

</template>

<script>

export default {
    data() {
        return {
            error: {},
            formData: {
                email: '',
            },
            loading: false,
        }
    },
    mounted() {

    },
    methods: {

        forgotApi() {
            try {
                this.loading = true;
            } catch (e) {
                this.error = e.response.errors;
            } finally {
                this.loading = false;
            }
        }

    }
}

</script>
