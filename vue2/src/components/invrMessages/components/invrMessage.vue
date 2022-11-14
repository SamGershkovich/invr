<template>
    <div style="width:75%;" :style="{'align-self': data.user_id != user_id ? '': 'end'}"
        class="rounded border text-left"
        :class="{'bg-white':  data.user_id != user_id, 'bg-blue-100':data.user_id == user_id}">
        <div v-if="data.user_id != user_id" class="border-b p-2 flex flex-wrap justify-between">
            <div>{{data.user_name}}</div>
            <div v-if="data.role_id < 4" :class="roleClass">{{data.role}}</div>
        </div>
        <div class="p-2">{{data.content}}
            <div class="italic text-sm text-gray-500 text-right">{{data.time}}</div>
        </div>
    </div>
</template>
  
<script>
export default {
    name: "invrMessage",
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
    mounted() {
    },
    computed: {
        user_id() {
            return this.$store.state.user.data.id;
        },
        roleClass() {
            switch (this.data.role) {
                case 'Manager':
                    return 'text-purple-500';
                case 'Assitant Manager':
                    return 'text-blue-500';
                case 'Supervisor':
                    return 'text-green-500';
                default:
                    return 'text-gray-500';
            }
        }
    },
    methods: {},
};
</script>
  
<style>

</style>