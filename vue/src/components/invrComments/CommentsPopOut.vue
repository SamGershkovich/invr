<!-- This example requires Tailwind CSS v2.0+ -->
<template>
  <div class="lg:hidden block">
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
                left-0
                flex
                max-w-full
                pr-10
              ">
              <TransitionChild as="template" enter="transform transition ease-in-out duration-500"
                enter-from="-translate-x-full" enter-to="translate-x-0"
                leave="transform transition ease-in-out duration-500" leave-from="translate-x-0"
                leave-to="-translate-x-full">
                <DialogPanel class="pointer-events-auto relative w-screen max-w-md">
                  <TransitionChild as="template" enter="ease-in-out duration-500" enter-from="opacity-0"
                    enter-to="opacity-100" leave="ease-in-out duration-500" leave-from="opacity-100"
                    leave-to="opacity-0">
                    <div class="
                        absolute
                        top-0
                        right-0
                        -mr-8
                        flex
                        pt-4
                        pl-2
                        sm:-mr-10 sm:pl-4
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
                      <DialogTitle class="text-lg font-medium text-gray-900">Comments</DialogTitle>
                      <div v-if="products.length > 0">{{products[productIndex].name}}</div>
                    </div>
                    <div class="relative mt-6 flex-1 px-4 sm:px-6">
                      <!-- Replace with your content -->
                      <div class="absolute inset-0 px-4 sm:px-6">

                        <div
                          class="overflow-y-auto relative bg-gray-100 border rounded shadow h-full p-3 pb-0 flex flex-col gap-3">

                          <Comment v-for="(comment, index) in comments" :key="index" :data="comment" />

                          <div class="bg-gray-100 w-full bottom-0 sticky mt-5 py-3">
                            <textarea ref="comment" class="w-full"></textarea>
                            <button @click="addComment()"
                              class="block ml-auto bg-blue-500 hover:bg-blue-400 text-white rounded px-3 py-1">Add
                              Comment</button>
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
      <TransitionChild as="template" enter="transform transition ease-in-out duration-700"
        enter-from="-translate-x-full" enter-to="translate-x-0" leave="transform transition ease-in-out duration-500 "
        leave-from="translate-x-0" leave-to="-translate-x-full">
        <div style="border-left: none; border-top-left-radius: 0; border-bottom-left-radius: 0;"
          class="px-2 py-1 rounded absolute left-0 -top-20 border shadow bg-white cursor-pointer" @click="open = true;">
          Comments ►</div>
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

import Comment from "./components/invrComment.vue";

export default {
  components: {
    Dialog,
    DialogPanel,
    DialogTitle,
    TransitionChild,
    TransitionRoot,
    XMarkIcon,
    Comment
  },
  data() {
    return {
      openPopout: false,
    }
  },
  methods: {
    addComment() {
      this.$store.dispatch('addComment', { content: this.$refs.comment.value });
      this.$refs.comment.value = "";
    },
  },
  computed: {
    products() {
      return this.$store.getters.products;
    },
    productIndex() {
      return this.$store.getters.productIndex;
    },
    comments() {
      return this.$store.getters.comments
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