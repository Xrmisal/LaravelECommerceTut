<script setup>
import GuestLayout from '../components/GuestLayout.vue';

</script>

<template>
    <GuestLayout title="Sign in to your account">
            <div class="mt-10 mx-auto w-full max-w-sm space-y-6">
                <form action="#" method="POST" class="space-y-6">
                    <div>
                        <label for="email" class="block text-sm/6 font-medium text-gray-100">Email address</label>
                        <div class="mt-2">
                            <input type="email" name="email" id="email" autocomplete="email" required="" class="block w-full rounded-md bg-white/5 px-3 py-1.5 text-base text-white outline-1 -outline-offset-1 outline-white/10 placeholder:text-gray-500 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-500 sm:text-sm/6" />
                        </div>
                    </div>
                    
                    <div>
                        <div class="flex items-center justify-between">
                            <label for="password" class="block text-sm/6 font-medium text-gray-100">Password</label>
                            <div class="text-sm">
                                <router-link to="/request-password" class="font-semibold text-indigo-400 hover:text-indigo-300">Forgot password?</router-link>
                            </div>
                        </div>
                        <div class="mt-2">
                            <input type="password" name="password" id="password" autocomplete="current-password" required="" class="block w-full rounded-md bg-white/5 px-3 py-1.5 text-base text-white outline-1 -outline-offset-1 outline-white/10 placeholder:text-gray-500 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-500 sm:text-sm/6" />
                        </div>
                    </div>
                    
                    <div>
                        <button type="submit" class="flex w-full justify-center rounded-md bg-indigo-500 px-3 py-1.5 text-sm/6 font-semibold text-white hover:bg-indigo-400 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-500">Sign in</button>
                    </div>
                <p class="mt-10 text-center text-sm/6 text-gray-400">
                    Not a member?
                    {{ ' ' }}
                    <a href="#" class="font-semibold text-indigo-400 hover:text-indigo-300">Start a 14 day free trial</a>
                </p>
            </form>
            </div>
    </GuestLayout>
</template>