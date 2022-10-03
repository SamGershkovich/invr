<template>
  <div>
    <Comments />
    <CommentsPopOut />
  </div>
</template>

<script>
import CommentsPopOut from "./CommentsPopOut.vue";
import Comments from "./Comments.vue";

export default {
  name: "CommentsContainer",
  components: { CommentsPopOut, Comments },
  props: {},
  data() {
    return {};
  },
  mounted() { 
  },
  computed: {
    //1024px
    popOutMode() {
      return this.popOut;
    },
  },
  methods: {},
};
</script>

<style>

</style>