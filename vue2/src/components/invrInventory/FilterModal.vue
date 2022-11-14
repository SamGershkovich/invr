<template>
    <Modal :showModal="show" :showSave="false" @close="$store.commit('setShowFilterModal', false)">
        <template v-slot:title>
            <h3>Filters</h3>
        </template>
        <div class="grid grid-cols-2 w-full gap-5">
            <div>
                <div class="font-bold">Categories</div>
                <div class="overflow-y-auto h-25">
                    <div v-for="(category, index) in categories" :key="'category-' + index">
                        <input @change="toggleCategory(index)" type="checkbox" :checked="category.selected" />
                        {{category.name}}
                    </div>
                </div>
            </div>
            <div>
                <div class="font-bold">Sub Categories</div>
                <div style="max-height: 500px" class="overflow-y-auto">
                    <div v-for="(sub_category, index) in sub_categories" :key="'sub-category-' + index">
                        <input @change="toggleSubCategory(index)" type="checkbox" :checked="sub_category.selected" />
                        {{sub_category.name}}
                    </div>
                </div>
            </div>
            <!-- <div>
                <div class="font-bold">Country of Origins</div>
                <div class="overflow-y-auto h-25">
                    <div v-for="(country, index) in country_of_origins" :key="'category-of-origins-' + index">
                        <input @change="toggleCountry(index)" type="checkbox" :checked="country.selected" />
                        {{country.name}}
                    </div>
                </div>
            </div> -->
        </div>
    </Modal>
</template>
  
<script>


import Modal from "../invrModal.vue";
export default {
    name: "FilterModal",
    components: {
        Modal
    },
    props: {},
    data() {
        return {
        };
    },
    mounted() {
    },
    computed: {
        show() {
            return this.$store.getters.showFilterModal;
        },
        categories() {
            return this.$store.getters.categories;
        },
        sub_categories() {
            return this.$store.getters.sub_categories;
        },
        country_of_origins() {
            return this.$store.getters.country_of_origins;
        },
    },
    methods: {
        toggleCategory(index) {
            this.$store.commit('toggleCategory', index);
        },
        toggleSubCategory(index) {
            this.$store.commit('toggleSubCategory', index);
        },
        toggleCountry(index) {
            this.$store.commit('toggleCountry', index);
        },
    },
};
</script>
  
<style>

</style>