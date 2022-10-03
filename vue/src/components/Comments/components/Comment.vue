<template>
    <div class="bg-white rounded border w-full text-left">
        <div class="border-b p-2 flex flex-wrap justify-between">
            <div>{{data.user_name}}</div>
            <div class="italic text-sm text-gray-500">{{data.time}}</div>
        </div>
        <div class="p-2">{{data.content}}</div>
    </div>
</template>
  
<script>
export default {
    name: "Comment",
    components: {},
    props: {
        data: {
            type: Object,
            required: true,
        },
    },
    data() {
        return {};
    },
    mounted() { },
    computed: {},
    methods: {},
};
</script>
  
<style>

</style>