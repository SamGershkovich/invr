<template>
  <div class="overflow-hidden bg-gray-100 lg:block hidden border rounded shadow h-full p-3 pb-0 relative">
    <div>
      <h2>Messages</h2>
    </div>

    <div style="max-height: 500px;" class="overflow-y-auto relative bg-gray-100 h-full p-3 pb-0 flex flex-col gap-3">

      <Message v-for="(message, index) in messages" :key="index" :data="message" />

      <div class="bg-gray-100 w-full bottom-0 sticky mt-5 py-3">
        <textarea ref="message" class="w-full"></textarea>
        <button @click="addMessage()"
          class="block ml-auto bg-blue-500 hover:bg-blue-400 text-white rounded px-3 py-1">Send
          Message</button>
      </div>

    </div>
  </div>
</template>

<script>

import Message from "./components/Message.vue";
export default {
  name: "Messages",
  components: { Message },
  props: {},
  data() {
    return {};
  },
  mounted() { },
  computed: {
    messages() {
      return this.$store.getters.messages
    }
  },
  methods: {
    addMessage() {
      this.$store.dispatch('addMessage', { content: this.$refs.message.value });
      this.$refs.message.value = "";
    },
  },
};
</script>

<style>

</style>