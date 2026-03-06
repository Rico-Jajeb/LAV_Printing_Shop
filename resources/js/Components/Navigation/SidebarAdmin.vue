<template>
    <main>
        <div   :class="[
    {
      'bg-blue-300': colorDefault === 'blue',
      'bg-yellow-300': colorDefault === 'yellow',
      'bg-red-300': colorDefault === 'red',
      'bg-pink-300': colorDefault === 'pink',
      'bg-teal-300': colorDefault === 'teal',
      'bg-gray-300': colorDefault === 'black',
    },
    'hidden sm:flex h-full  flex-col pt-16 px-4 py-4'
  ]" >
            
            <nav class="hidden sm:flex sticky top-20 mb-4 z-40 flex-col">
                <NavLink
                    class="flex items-center mt-4 mb-4 hover:bg-teal-100"
                    :href="route('dashboard')"
                    :class="[
                        'px-3 py-2 rounded',
                        page.component.startsWith('Admin/Dashboard')
                            ? 'bg-teal-500 text-white hover:bg-teal-500 hover:text-white'
                            : 'text-gray-600',
                    ]"
                    prefetch
                    cache-for="30s"
                >
                    <svg
                        class="w-6 h-6 mr-2 text-gray-800 dark:text-white"
                        aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg"
                        width="24"
                        height="24"
                        fill="currentColor"
                        viewBox="0 0 24 24"
                    >
                        <path
                            fill-rule="evenodd"
                            d="M4.857 3A1.857 1.857 0 0 0 3 4.857v4.286C3 10.169 3.831 11 4.857 11h4.286A1.857 1.857 0 0 0 11 9.143V4.857A1.857 1.857 0 0 0 9.143 3H4.857Zm10 0A1.857 1.857 0 0 0 13 4.857v4.286c0 1.026.831 1.857 1.857 1.857h4.286A1.857 1.857 0 0 0 21 9.143V4.857A1.857 1.857 0 0 0 19.143 3h-4.286Zm-10 10A1.857 1.857 0 0 0 3 14.857v4.286C3 20.169 3.831 21 4.857 21h4.286A1.857 1.857 0 0 0 11 19.143v-4.286A1.857 1.857 0 0 0 9.143 13H4.857ZM18 14a1 1 0 1 0-2 0v2h-2a1 1 0 1 0 0 2h2v2a1 1 0 1 0 2 0v-2h2a1 1 0 1 0 0-2h-2v-2Z"
                            clip-rule="evenodd"
                        />
                    </svg>

                    <span v-if="isVisible"> Dashboard </span>
                </NavLink>
                <NavLink
                    class="flex items-center hover:bg-teal-100"
                    :href="route('products')"
                    :class="[
                        'px-3 py-2 rounded',
                        page.component.startsWith('Admin/Products')
                            ? 'bg-teal-500 text-white hover:bg-teal-500 hover:text-white'
                            : 'text-gray-600',
                    ]"
                    prefetch
                    cache-for="30s"
                >
                    <svg
                        class="w-6 h-6 mr-2 text-gray-800 dark:text-white"
                        aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg"
                        width="24"
                        height="24"
                        fill="currentColor"
                        viewBox="0 0 24 24"
                    >
                        <path
                            fill-rule="evenodd"
                            d="M14 7h-4v3a1 1 0 0 1-2 0V7H6a1 1 0 0 0-.997.923l-.917 11.924A2 2 0 0 0 6.08 22h11.84a2 2 0 0 0 1.994-2.153l-.917-11.924A1 1 0 0 0 18 7h-2v3a1 1 0 1 1-2 0V7Zm-2-3a2 2 0 0 0-2 2v1H8V6a4 4 0 0 1 8 0v1h-2V6a2 2 0 0 0-2-2Z"
                            clip-rule="evenodd"
                        />
                    </svg>

                    <span v-if="isVisible"> Products </span>
                </NavLink>
            </nav>

            <div class="hidden sm:block fixed bottom-0 mb-2 z-40">
                <button
                    @click="toggleDiv"
                    data-drawer-target="top-bar-sidebar"
                    data-drawer-toggle="top-bar-sidebar"
                    aria-controls="top-bar-sidebar"
                    type="button"
                    class="text-heading bg-transparent box-border border border-transparent hover:bg-neutral-secondary-medium focus:ring-1 focus:ring-teal-300 font-medium leading-5 rounded-base text-sm p-2 focus:outline-none"
                >
                    <span class="sr-only">Open sidebar</span>
                    <svg
                        class="w-6 h-6"
                        aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg"
                        width="24"
                        height="24"
                        fill="none"
                        viewBox="0 0 24 24"
                    >
                        <path
                            stroke="currentColor"
                            stroke-linecap="round"
                            stroke-width="2"
                            d="M5 7h14M5 12h14M5 17h10"
                        />
                    </svg>
                </button>
            </div>
        </div>
    </main>
</template>
<script setup>
import NavLink from "@/Components/NavLink.vue";
import { usePage } from "@inertiajs/vue3";
import { useButton } from "@/Composables/Toggle/buttonTogle";
import { useColor } from "@/Composables/useColor";

const {  themeColor1, themeColor2, themeColor3, themeColor4, themeColor5, themeColor6, colorDefault } = useColor()

const { isVisible, toggleDiv } = useButton();
const page = usePage();
</script>
