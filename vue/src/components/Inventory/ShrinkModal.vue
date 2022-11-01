<template>
    <Modal :showModal="show" @save="shrink => save(shrink)" @close="$store.commit('setShowShrinkModal', false)">
        <template v-slot:title>
            <div>Shrink for</div>
            <div><b>{{products[productIndex].name}}</b></div>
        </template>
        <div class="w-full">
            <div>
                <div class="mt-10 text-center mb-10 flex justify-center gap-7">
                    <div>
                        <div class="mt-12 text-xl ">{{totalCases}}</div>
                        <div class="text-xs">total cases</div>
                    </div>
                    <div>
                        <span class="text-2xl font-bold">{{currentShrink}}</span><span
                            class="italic">{{this.weightedProduct ? " (g)" : ""}}</span>
                        <div>{{weightedProduct ? 'weighed' : 'counted'}}</div>
                    </div>
                    <div>
                        <div class="mt-12 text-xl ">{{totalShrink}}</div>
                        <div class="text-xs">total {{weightedProduct ? 'weight (g)' : 'quantity'}}</div>
                    </div>

                </div>
                <div class="mb-5">
                    <!-- <div class="text-center mb-5">Add/Subtract</div> -->
                    <div class="justify-center flex gap-5">
                        <div @click="subtract()">

                            <MinusCircleIcon class="w-10 cursor-pointer rounded-full hover:text-gray-500" />
                        </div>

                        <input ref="calc_qty" type="number" :placeholder="calculatorPlaceholder" class="" />

                        <div @click="add()">
                            <PlusCircleIcon class="w-10 cursor-pointer rounded-full hover:text-gray-500" />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </Modal>
</template>
  
<script>


import Modal from "../Modal.vue";
import {
    PlusCircleIcon, MinusCircleIcon
} from "@heroicons/vue/24/solid";
export default {
    name: "ShrinkModal",
    components: {
        Modal,
        PlusCircleIcon, MinusCircleIcon
    },
    props: {},
    data() {
        return {
            buttonClass: "bg-white hover:bg-gray-100 text-gray-800 font-bold text-lg py-2 px-3 border border-gray-400 rounded shadow",
            shrinkModified: 0,
        };
    },
    watch: {
        show: function (val) {
            if (val) {
                this.shrinkModified = 0;

            }
        }
    },
    computed: {
        currentShrink() {
            return this.toFixedIfNecessary(this.shrinkModified, 4);
        },

        totalShrink() {
            let value = 0;

            if (this.product.shrink == null && this.shrinkModified == 0) return '-';

            value = (parseFloat(this.shrinkModified) + parseFloat(this.product.shrink == null ? 0 : this.product.shrink));

            return this.toFixedIfNecessary(Math.max(value, 0), 4);
        },
        totalCases() {
            if (this.product.shrink == null && this.shrinkModified == 0) return '-';

            let convertedAmountInCase = this.weightedProduct ? ((this.amountInCase * 0.453592) * 1000) : this.amountInCase;

            return this.toFixedIfNecessary(Math.max(((parseFloat(this.shrinkModified) + parseFloat(this.product.shrink == null ? 0 : this.product.shrink)) / convertedAmountInCase), 0), 4);
        },
        calculatorPlaceholder() {
            return this.weightedProduct ? 'Enter weight (g)' : "Enter quantity";
        },

        show() {
            return this.$store.getters.showShrinkModal;
        },
        products() {
            return this.$store.getters.products;
        },
        productIndex() {
            return this.$store.getters.productIndex;
        },
        product() {
            return this.products[this.productIndex];
        },
        shrinkCases() {
            if (this.products[this.productIndex].shrink_quantity != null)
                return Math.floor(this.products[this.productIndex].shrink_quantity);
            return undefined
        },
        shrinkPartial() {
            if (this.products[this.productIndex].shrink_quantity != null) {

                let value = (this.products[this.productIndex].shrink_quantity - this.shrinkCases) * (this.products[this.productIndex].weighted_product ? 1 : this.products[this.productIndex].amount_in_case);
                if (!this.weightedProduct) {
                    value = Math.round(value);
                }
                return value;
            }
            return undefined;
        },
        weightedProduct() {
            return this.products[this.productIndex].weighted_product;
        },
        amountInCase() {
            return this.products[this.productIndex].amount_in_case;
        }
    },
    methods: {
        toFixedIfNecessary(value, dp) {
            return +parseFloat(value).toFixed(dp);
        },
        add() {
            if (this.$refs.calc_qty.value == "") return;
            this.shrinkModified += parseFloat(this.$refs.calc_qty.value);
        },
        subtract() {
            if (this.$refs.calc_qty.value == "") return;
            this.shrinkModified -= parseFloat(this.$refs.calc_qty.value);
        },
        save() {
            this.$store.commit('setShowShrinkModal', false);
            this.$store.dispatch('saveShrink', { ...this.product, shrink: isNaN(this.totalShrink) ? null : this.totalShrink });
        },
    },
};
</script>
  
<style>

</style>