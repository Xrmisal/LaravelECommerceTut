<script setup>
import { useRoute } from 'vue-router';
import GuestLayout from '../components/GuestLayout.vue';

const route = useRoute();

function RequestPasswordReset() {
    console.log('RequestPasswordReset');
}

function ChangePassword() {
    console.log('ChangePassword');
}
</script>

<template>
    <GuestLayout :title="route.params.token ? 'Reset password' : 'Request password reset'">
        <div class="mt-10 mx-auto w-full max-w-sm">
            <form @submit.prevent="RequestPasswordReset" method="POST" v-if="!route.params.token" class="space-y-6">
                <div>
                    <label for="email" class="block text-sm/6 font-medium text-gray-100">Email address</label>
                    <div class="mt-2">
                        <input type="email" name="email" id="email" autocomplete="email" required="" class="block w-full rounded-md bg-white/5 px-3 py-1.5 text-base text-white outline-1 -outline-offset-1 outline-white/10 placeholder:text-gray-500 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-500 sm:text-sm/6" />
                    </div>
                </div>
                <div class="mt-4">
                    <router-link to="/login" class="font-semibold text-indigo-400 hover:text-indigo-300">Remember Password?</router-link>
                </div>
                <div>
                    <button type="submit" class="mt-4 flex w-full justify-center rounded-md bg-indigo-500 px-3 py-1.5 text-sm/6 font-semibold text-white hover:bg-indigo-400 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-500">Submit</button>
                </div>
            </form>
            <form @submit.prevent="ChangePassword" method="POST" v-else class="space-y-6">
                <div>
                    <label for="password" class="block text-sm/6 font-medium text-gray-100">Password</label>
                    <div class="mt-2">
                        <input type="password" name="password" id="password" autocomplete="current-password" required="" class="block w-full rounded-md bg-white/5 px-3 py-1.5 text-base text-white outline-1 -outline-offset-1 outline-white/10 placeholder:text-gray-500 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-500 sm:text-sm/6" />
                    </div>
                </div>
                <div>
                    <label for="repeat-password" class="block text-sm/6 font-medium text-gray-100">Repeat Password</label>
                    <div class="mt-2">
                        <input type="password" name="repeat-password" id="repeat-password" autocomplete="repeat-password" required="" class="block w-full rounded-md bg-white/5 px-3 py-1.5 text-base text-white outline-1 -outline-offset-1 outline-white/10 placeholder:text-gray-500 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-500 sm:text-sm/6" />
                    </div>
                </div> 
                <div class="mt-4">
                    <router-link to="/login" class="font-semibold text-indigo-400 hover:text-indigo-300">Remember Password?</router-link>
                </div>
                <div>
                    <button type="submit" class="mt-4 flex w-full justify-center rounded-md bg-indigo-500 px-3 py-1.5 text-sm/6 font-semibold text-white hover:bg-indigo-400 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-500">Submit</button>
                </div>
            </form>
        </div>
    </GuestLayout>
</template>