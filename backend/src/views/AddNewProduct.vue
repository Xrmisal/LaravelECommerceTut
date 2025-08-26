<script setup>
import { computed, ref } from 'vue';
import {Dialog, DialogPanel, DialogTitle, TransitionChild, TransitionRoot} from '@headlessui/vue'
import { ExclamationIcon } from '@heroicons/vue/outline';
import CustomInput from '../components/core/CustomInput.vue';
import store from '../store';

const product = ref({
    title: null,
    image: null,
    description: null,
    price: null,
})

const props = defineProps({
    modelValue: Boolean,
})

const emit = defineEmits(['update:modelValue'])

const show = computed({
    get: () => props.modelValue,
    set: (value) => emit('update:modelValue', value)
})

function closeModel() {
    show.value = false
}

function onSubmit() {
    store.dispatch('createProduct', product.value)
        .then(response => {
            if(response.status === 201) {
                store.dispatch('getProducts')
                closeModel()
            }
        })
}
</script>

<template>
    <TransitionRoot as="template" :show="show">
        <Dialog as="div" class="relative z-50" @close="show = false">
            <TransitionChild as="template" enter="ease-out duration-300" enter-from="opacity-0" enter-to="opacity-100" leave="ease-in duration-200" leave-from="opacity-100" leave-to="opacity-0">
                <div class="fixed inset-0 bg-black bg-opacity-70 transition-opacity"/>
            </TransitionChild>

            <div class="fixed inset-0 overflow-y-auto">
                <div class="flex min-h-screen justify-center items-center p-4 text-center">
                    <TransitionChild as="template" enter="ease-out duration-300" enter-from="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" enter-to="opacity-100 translate-y-0 sm:scale-100" leave="ease-in-duration-200" leave-from="opacity-100 translate-y-0 sm:scale-100" leave-to="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95">
                        <DialogPanel
                            class="w-full max-w-md sm:max-w-lg md:max-w-xl lg:max-w-2xl rounded-xl bg-white p-4 text-left shadow-2xl"
                        >
                            <header
                                class="py-2 px-4 flex justify-between items-center"
                            >
                                <DialogTitle
                                    as="h3"
                                    class="text-lg leading-6 font-medium text-gray-900"
                                >
                                    Create new Product
                                </DialogTitle>
                                <button
                                    @click="closeModel()"
                                    class="w-8 h-8 flex items-center justify-center rounded-full transition-colors cursor-pointer hover:bg-[rgba(0, 0, 0, 0.2)]"
                                >
                                    <!-- SVG Here -->
                                </button>
                            </header>
                            <form @submit.prevent="onSubmit">
                                <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                                    <CustomInput class="mb-2" v-model="product.title" label="Product Title" />
                                    <CustomInput type="textarea" class="mb-2" v-model="product.description" label="Description" />
                                    <CustomInput type="number" class="mb-2" v-model="product.price" label="Price"/>
                                </div>
                                <footer class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                                    <button
                                        type="submit"
                                        class="py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:w-auto w-full sm:ml-3"
                                    >
                                        Submit
                                    </button>
                                    <button
                                        type="button"
                                        class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm"
                                        @click="show = false"
                                        ref="cancelButtonRef"
                                    >
                                        Cancel
                                    </button>
                                </footer>
                            </form>
                        </DialogPanel>
                    </TransitionChild>
                </div>
            </div>
        </Dialog>
    </TransitionRoot>
</template>