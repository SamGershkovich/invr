<template>
  <div class="overflow-hidden bg-gray-100 lg:block hidden border rounded shadow h-full p-3 pb-0 relative">
    <div>
      <h2>Comments</h2>
      <div v-if="products.length> 0 "><b>{{products[productIndex].name}}</b></div>
    </div>

    <div style="max-height: 500px;" class="overflow-y-auto relative bg-gray-100 h-full p-3 pb-0 flex flex-col gap-3">

      <Comment v-for="(comment, index) in comments" :key="index" :data="comment" />

      <div class="bg-gray-100 w-full bottom-0 sticky mt-5 py-3">
        <textarea ref="comment" class="w-full"></textarea>
        <button @click="addComment()"
          class="block ml-auto bg-blue-500 hover:bg-blue-400 text-white rounded px-3 py-1">Add
          Comment</button>
      </div>

    </div>
  </div>
</template>

<script>

import Comment from "./components/Comment.vue";
export default {
  name: "Comments",
  components: { Comment },
  props: {},
  data() {
    return {};
  },
  mounted() { },
  computed: {
    products() {
      return this.$store.getters.products;
    },
    productIndex() {
      return this.$store.getters.productIndex;
    },
    comments() {
      return this.$store.getters.comments
    }
  },
  methods: {
    addComment() {
      this.$store.dispatch('addComment', { content: this.$refs.comment.value });
      this.$refs.comment.value = "";
    },
  },
};
</script>

<style>

</style>