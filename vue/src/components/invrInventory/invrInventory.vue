<template>
  <div class="border rounded shadow p-3 grid grid-rows-7 pb-20">
    <div class="grid grid-cols-4">
      <button @click="$store.commit('setShowFilterModal', true)" style="width: fit-content" class="
          bg-white
          hover:bg-gray-100
          text-gray-800
          font-semibold
          py-2
          px-3
          border border-gray-400
          rounded
          shadow
        ">
        Filters
      </button>
      <div class="relative mx-auto text-gray-600 col-span-2">
        <input class="w-full
            border-2 border-gray-300
            bg-white
            h-full
            px-5
            rounded-lg
            text-sm
            focus:outline-none
          " type="search" name="search" ref="search" placeholder="Search products" />
      </div>
      <button @click="search()" style="width: fit-content" class="
          bg-white
          hover:bg-gray-100
          text-gray-800
          font-semibold
          py-2
          px-3
          border border-gray-400
          rounded
          shadow
          w-auto
        ">
        Search
      </button>
    </div>
    <div>
      <div class="my-3" v-if="products.length > 0">{{productIndex + 1 + "/" + products.length}}</div>
      <div v-else>No Products Found</div>
    </div>
    <div v-if="products.length > 0" style="justify-items: center;" class="row-span-5 grid grid-cols-7">
      <div class="cursor-pointer contents" @click="prevProduct()">
        <ArrowLeftCircleIcon class="w-10" />
      </div>
      <div class="col-span-5">

        <div> <span class="inline-block text-xl font-bold">{{products[productIndex].name}}</span>
          <span
            class="ml-3 rounded-full border border-black text-black w-5 h-5 inline-grid content-center cursor-pointer font-bold">i</span>
        </div>

        <div class="text-sm mb-7">{{products[productIndex].category_name}} &rarr;
          {{products[productIndex].sub_category_name}}</div>

        <div class="grid grid-flow-col grid-cols-2">
          <span>Front qty: </span>
          <span class="text-xl font-bold">{{products[productIndex].front_perpetual ? 'P' :
          (products[productIndex].front_quantity ?
          products[productIndex].front_quantity : '-')}}
          </span>
        </div>

        <div class="mt-2 grid grid-flow-col grid-cols-2">
          <span>Back qty: </span>
          <span class="text-xl font-bold">{{products[productIndex].back_perpetual ? 'P' :
          (products[productIndex].back_quantity ?
          products[productIndex].back_quantity : '-' )}}</span>
        </div>


        <button @click="$store.commit('setShowCountModal', true)" style="width: fit-content" class="
          mt-10
          bg-white
          hover:bg-gray-100
          text-gray-800
          font-semibold
          py-2
          px-3
          border border-gray-400
          rounded
          shadow
        ">
          Count
        </button>
        <button @click="$store.commit('setShowShrinkModal', true)" style="width: fit-content" class="
          mt-10
          bg-white
          hover:bg-gray-100
          text-gray-800
          font-semibold
          py-2
          px-3
          border border-gray-400
          rounded
          shadow
          ml-5
        ">
          Shrink
        </button>
      </div>
      <div class="cursor-pointer contents" @click="nextProduct()">
        <ArrowRightCircleIcon class="w-10" />
      </div>
    </div>
    <FilterModal />
    <CountModal />
    <ShrinkModal />
  </div>
</template>

<script>

import {
  ArrowLeftCircleIcon, ArrowRightCircleIcon
} from "@heroicons/vue/24/outline";

import FilterModal from "./FilterModal.vue";
import CountModal from "./CountModal.vue";
import ShrinkModal from "./ShrinkModal.vue";
export default {
  name: "invrInventory",
  components: { ArrowLeftCircleIcon, ArrowRightCircleIcon, FilterModal, CountModal, ShrinkModal },
  props: {},
  data() {
    return {
      productIndex: 0,
    };
  },
  async mounted() {
    await this.$store.dispatch('loadData');
    await this.$store.dispatch('searchProducts', { query: '' });
  },
  computed: {
    products() {
      return this.$store.getters.products ? this.$store.getters.products : [];
    }
  },
  methods: {
    nextProduct() {
      this.productIndex++;
      if (this.productIndex > this.products.length - 1) {
        this.productIndex = 0;
      }
      this.setProductIndex(this.productIndex);
    },
    prevProduct() {
      this.productIndex--;
      if (this.productIndex < 0) {
        this.productIndex = this.products.length - 1;
      }
      this.setProductIndex(this.productIndex);
    },
    setProductIndex(index) {
      this.$store.commit("setProductIndex", index);
      this.$store.dispatch("getComments");
    },
    search() {
      this.productIndex = 0;
      this.setProductIndex(0);
      this.$store.dispatch('searchProducts', { query: this.$refs.search.value });
    },
  },

};
</script>

<style>

</style>