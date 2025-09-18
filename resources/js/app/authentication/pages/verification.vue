<template>

    <form @submit.prevent="verificationApi()">
        <div class="mb-3 w-full block">
            <label for="verification_code" class="mb-2 w-full block text-sm font-medium"> Verification Code </label>
            <input id="verification_code" type="text" name="verification_code" v-model="formData.verification_code" class="w-full border border-gray-200 bg-gray-200 block min-h-[45px] max-h-[45px] rounded-md outline-0 ring-0 focus-within:ring-3 ring-blue-400 duration-500 px-4" autocomplete="off" />
            <div class="mt-2 w-full block text-red-500 text-xs" v-if="error.verification_code"> {{error.verification_code[0]}} </div>
        </div>
        <div class="mb-5 w-full block">
            <button type="submit" class="text-sm font-medium bg-blue-400 duration-500 hover:bg-blue-700 text-white px-10 rounded-md min-h-[45px] max-h-[45px] cursor-pointer" v-if="!loading">
                Send
            </button>
        </div>
        <div class="text-center text-sm text-gray-700">
            Already Verified?
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

        verificationApi() {
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
