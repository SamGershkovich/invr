<!-- This example requires Tailwind CSS v2.0+ -->
<template>
  <div>
    <TransitionRoot as="template" :show="open">
      <Dialog as="div" class="relative z-10" @close="open = false">
        <TransitionChild as="template" enter="ease-in-out duration-500" enter-from="opacity-0" enter-to="opacity-100"
          leave="ease-in-out duration-500" leave-from="opacity-100" leave-to="opacity-0">
          <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" />
        </TransitionChild>

        <div class="fixed inset-0 overflow-hidden">
          <div class="absolute inset-0 overflow-hidden">
            <div class="
              pointer-events-none
              fixed
              inset-y-0
              right-0
              flex
              max-w-full
              pl-10
            ">
              <TransitionChild as="template" enter="transform transition ease-in-out duration-500"
                enter-from="translate-x-full" enter-to="translate-x-0"
                leave="transform transition ease-in-out duration-500" leave-from="translate-x-0"
                leave-to="translate-x-full">
                <DialogPanel class="pointer-events-auto relative w-screen max-w-md">
                  <TransitionChild as="template" enter="ease-in-out duration-500" enter-from="opacity-0"
                    enter-to="opacity-100" leave="ease-in-out duration-500" leave-from="opacity-100"
                    leave-to="opacity-0">
                    <div class="
                      absolute
                      top-0
                      left-0
                      -ml-8
                      flex
                      pt-4
                      pr-2
                      sm:-ml-10 sm:pr-4
                    ">
                      <button type="button" class="
                        rounded-md
                        text-gray-300
                        hover:text-white
                        focus:outline-none focus:ring-2 focus:ring-white
                      " @click="open = false">
                        <span class="sr-only">Close panel</span>
                        <XMarkIcon class="h-6 w-6" aria-hidden="true" />
                      </button>
                    </div>
                  </TransitionChild>
                  <div class="
                    flex
                    h-full
                    flex-col
                    overflow-y-scroll
                    bg-white
                    py-6
                    shadow-xl
                  ">
                    <div class="px-4 sm:px-6">
                      <DialogTitle class="text-lg font-medium text-gray-900">Messages</DialogTitle>
                    </div>
                    <div class="relative mt-6 flex-1 px-4 sm:px-6">
                      <!-- Replace with your content -->
                      <div class="absolute inset-0 px-4 sm:px-6">

                        <div
                          class="overflow-y-auto relative bg-gray-100 border rounded shadow h-full p-3 pb-0 flex flex-col gap-3">

                          <invrMessage v-for="(message, index) in messages" :key="index" :data="message" />

                          <div class="bg-gray-100 w-full bottom-0 sticky mt-5 py-3">
                            <textarea ref="message" class="w-full"></textarea>
                            <button @click="addMessage()"
                              class="block ml-auto bg-blue-500 hover:bg-blue-400 text-white rounded px-3 py-1">Send
                              Message</button>
                          </div>

                        </div>

                      </div>
                      <!-- /End replace -->
                    </div>
                  </div>
                </DialogPanel>
              </TransitionChild>
            </div>
          </div>
        </div>
      </Dialog>
    </TransitionRoot>
    <TransitionRoot as="template" :show="!open">
      <TransitionChild as="template" enter="transform transition ease-in-out duration-700" enter-from="translate-x-full"
        enter-to="translate-x-0" leave="transform transition ease-in-out duration-500" leave-from="translate-x-0"
        leave-to="translate-x-full">
        <div style="border-right: none;  border-top-right-radius: 0; border-bottom-right-radius: 0;"
          class="px-2 py-1 rounded absolute right-0 -top-20 border shadow bg-white cursor-pointer"
          @click="open = true;">
          ◄ Messages</div>
      </TransitionChild>
    </TransitionRoot>
  </div>
</template>

<script>
import {
  Dialog,
  DialogPanel,
  DialogTitle,
  TransitionChild,
  TransitionRoot,
} from "@headlessui/vue";
import { XMarkIcon } from "@heroicons/vue/24/outline";
import invrMessage from "./components/invrMessage.vue";
export default {
  components: {
    Dialog,
    DialogPanel,
    DialogTitle,
    TransitionChild,
    TransitionRoot,
    XMarkIcon,
    invrMessage,
  },
  data() {
    return {
      openPopout: false,
    }
  },
  methods: {
    addMessage() {
      this.$store.dispatch('addMessage', { content: this.$refs.message.value });
      this.$refs.message.value = "";
    },
  },
  computed: {
    messages() {
      return this.$store.getters.messages
    },
    open: {
      set(value) {
        this.openPopout = value;
      },
      get() {
        return this.openPopout;
      },
    }
  },
}
</script>