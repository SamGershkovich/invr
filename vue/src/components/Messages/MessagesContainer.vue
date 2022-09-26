<template>
  <div class="">
    <Messages class="lg:block hidden" />
    <MessagesPopOut class="lg:hidden block"/>
  </div>
</template>

<script>
import MessagesPopOut from "./MessagesPopOut.vue";
import Messages from "./Messages.vue";

export default {
  name: "MessagesContainer",
  components: { MessagesPopOut, Messages },
  props: {},
  data() {
    return {};
  },
  mounted() {},
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