<template>
  <div class="border rounded shadow p-3">
    <div class="grid grid-cols-4">
      <button
        style="width: fit-content"
        class="
          bg-white
          hover:bg-gray-100
          text-gray-800
          font-semibold
          py-2
          px-3
          border border-gray-400
          rounded
          shadow
        "
      >
        Filters
      </button>
      <div class="relative mx-auto text-gray-600 col-span-2">
        <input
          class="
            border-2 border-gray-300
            bg-white
            h-full
            px-5
            rounded-lg
            text-sm
            focus:outline-none
          "
          type="search"
          name="search"
          placeholder="Search products"
        />
      </div>
      <button
        style="width: fit-content"
        class="
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
        "
      >
        Search
      </button>
    </div>
  </div>
</template>

<script>
export default {
  name: "Inventory",
  components: {},
  props: {},
  data() {
    return {};
  },
  computed: {},
  methods: {},
};
</script>

<style>
</style>