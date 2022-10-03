<template>
    <Modal :showModal="show" @save="inventory => save(inventory)" @close="$store.commit('setShowEditModal', false)">
        <template v-slot:title>
            <div>Inventory for</div>
            <div><b>{{products[productIndex].name}}</b></div>
        </template>
        <div class="w-full">
            <div>
                <div class="flex justify-between mb-5">
                    <div><b>Front Amount</b></div>
                    <label> <input @click="setFrontPerpetual()" ref="front_perpetual" type="checkbox"
                            :checked="frontPerpetual" /> Perpetual
                    </label>
                </div>
                <div :class="inputSectionClass">
                    <div :class="inputContainerClass">
                        <div>Front Cases</div>
                        <input ref="front_cases" type="number" :value="(frontCases != null) ? frontCases : ''"
                            placeholder="Front cases" :class="frontInputClass" />
                    </div>
                    <div :class="inputContainerClass">
                        <div>Front Partial</div>
                        <input ref="front_partial" type="number" :value="frontPartial ? frontPartial : ''"
                            placeholder="Front Partial" :class="frontInputClass" />
                    </div>
                </div>
                <br>
                <br>
                <div class="flex justify-between mb-5">
                    <div><b>Back Amount</b></div>
                    <label> <input @click="setBackPerpetual()" ref="back_perpetual" type="checkbox"
                            :checked="backPerpetual " /> Perpetual
                    </label>
                </div>
                <div :class="inputSectionClass">
                    <div :class="inputContainerClass">
                        <div>Back Cases</div>
                        <input ref="back_cases" type="number" :value="(backCases != null) ? backCases : ''"
                            placeholder="Back cases" :class="backInputClass" />
                    </div>
                    <div :class="inputContainerClass">
                        <div>Back Partial</div>
                        <input ref="back_partial" type="number" :value="backPartial ? backPartial : ''"
                            placeholder="Back partial" :class="backInputClass" />
                    </div>
                </div>
            </div>
        </div>
    </Modal>
</template>
  
<script>


import Modal from "../Modal.vue";
export default {
    name: "EditModal",
    components: {
        Modal
    },
    props: {},
    data() {
        return {
            frontP: undefined,
            backP: undefined,
        };
    },
    mounted() {


    },
    computed: {
        frontInputClass() {
            return this.inputClass(this.frontPerpetual)
        },
        backInputClass() {
            return this.inputClass(this.backPerpetual)
        },
        inputSectionClass() {
            return {
                'max-w-full flex justify-between gap-3': true,
            }
        },
        inputContainerClass() {
            return {
                'max-w-[48%]': true,
            }
        },
        show() {
            return this.$store.getters.showEditModal;
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
        frontCases() {
            if (this.products[this.productIndex].front_quantity != null)
                return Math.floor(this.products[this.productIndex].front_quantity);
            return undefined
        },
        frontPartial() {
            if (this.products[this.productIndex].front_quantity != null) {

                let value = (this.products[this.productIndex].front_quantity - this.frontCases) * (this.products[this.productIndex].weighted_product ? 1 : this.products[this.productIndex].amount_in_case);
                if (!this.weightedProduct) {
                    value = Math.round(value);
                }
                return value;
            }
            return undefined;
        },
        frontPerpetual() {
            return this.frontP !== undefined ? this.frontP : !!this.products[this.productIndex].front_perpetual;
        },
        backCases() {
            if (this.products[this.productIndex].back_quantity != null)
                return Math.floor(this.products[this.productIndex].back_quantity);
            return undefined
        },
        backPartial() {
            if (this.products[this.productIndex].back_quantity != null) {
                let value = (this.products[this.productIndex].back_quantity - this.backCases) * (this.products[this.productIndex].weighted_product ? 1 : this.products[this.productIndex].amount_in_case);
                if (!this.weightedProduct) {
                    value = Math.round(value);
                }
                return value;
            }
            return undefined;

        },
        backPerpetual() {
            return this.backP !== undefined ? this.backP : !!this.products[this.productIndex].back_perpetual;
        },

        weightedProduct() {
            return this.products[this.productIndex].weighted_product;
        },
        amountInCase() {
            return this.products[this.productIndex].amount_in_case;
        }
    },
    methods: {
        setFrontPerpetual() {
            this.frontP = this.$refs.front_perpetual.checked;
        },
        setBackPerpetual() {
            this.backP = this.$refs.back_perpetual.checked;
        },
        inputClass(perpetual) {
            return {
                'max-w-full': true,
                'border border-gray-300 text-gray-500 pointer-events-none': perpetual
            }
        },

        validateInput(input, cases, partial) {
            if (input === undefined) {
                return true;
            }

            if (input < 0) {
                alert("Please enter positive numbers only.");
                return false;
            }
            if (cases && input.toString().includes('.')) {
                alert("Case amounts must be a whole number.");
                return false;
            }
            if (this.weightedProduct && partial) {
                if ((!input.toString().includes('.') && input > 0)) {
                    alert("This is a weighted product, partial amounts must be a decimal.");
                    return false;
                }
            }
            return true;
        },

        save() {
            let front_cases = this.$refs.front_cases.value ? parseFloat(this.$refs.front_cases.value) : undefined;
            let back_cases = this.$refs.back_cases.value ? parseFloat(this.$refs.back_cases.value) : undefined;
            let front_partial = this.$refs.front_partial.value ? parseFloat(this.$refs.front_partial.value) : undefined;
            let back_partial = this.$refs.back_partial.value ? parseFloat(this.$refs.back_partial.value) : undefined;

            if (!this.validateInput(front_cases, true, false)) return;
            if (!this.validateInput(back_cases, true, false)) return;
            if (!this.validateInput(front_partial, false, true)) return;
            if (!this.validateInput(back_partial, false, true)) return;


            this.$store.commit('setShowEditModal', false);

            if (front_cases)
                front_cases = parseInt(front_cases);
            if (back_cases)
                back_cases = parseInt(back_cases);

            let front_quantity = (front_cases == undefined && front_partial == undefined) ? null : 0;
            let back_quantity = (back_cases == undefined && back_partial == undefined) ? null : 0;


            if (front_quantity !== null) {
                front_cases = front_cases ? front_cases : 0;
                front_partial = front_partial ? front_partial : 0;
                front_quantity = front_cases + front_partial / (this.products[this.productIndex].weighted_product ? 1 : (front_partial.toString().indexOf('.') >= 0 ? 1 : this.products[this.productIndex].amount_in_case))
            }
            if (back_quantity !== null) {
                back_cases = back_cases ? back_cases : 0;
                back_partial = back_partial ? back_partial : 0;
                back_quantity = back_cases + back_partial / (this.products[this.productIndex].weighted_product ? 1 : (back_partial.toString().indexOf('.') >= 0 ? 1 : this.products[this.productIndex].amount_in_case))
            }

            let inventory = {
                front_quantity,
                front_perpetual: this.$refs.front_perpetual.checked,
                back_quantity,
                back_perpetual: this.$refs.back_perpetual.checked,
            }
            this.$store.dispatch('saveInventory', { ...this.product, ...inventory });
        },
    },
};
</script>
  
<style>

</style>