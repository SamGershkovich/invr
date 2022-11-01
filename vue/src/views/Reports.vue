<template>
  <div>
    <header class="bg-white shadow">
      <div class="mx-auto max-w-7xl py-6 px-4 sm:px-6 lg:px-8">
        <h1 class="text-3xl font-bold tracking-tight text-gray-900">
          Reports
        </h1>
      </div>
    </header>
    <main class="h-full">
      <div style="height: 500px" class="relative mx-auto max-w-7xl py-6 lg:px-8 h-full">
        <!-- Replace with your content -->
        <div class="px-4 py-6 lg:grid lg:grid-cols-3 gap-5 h-full block relative">
          <div class="col-span-2">
            <!-- Controls -->
            <div
              class="grid grid-flow-row lg:grid-flow-col lg:grid-cols-3 md:grid-flow-col md:grid-cols-3 grid-cols-2 gap-5 items-end m-auto"
              style="max-width: 800px;">

              <!-- Date -->
              <div class="text-left">
                <div>Select Date</div>
                <input class="w-full" type="date" v-model="dateInput" />
              </div>

              <!-- Type -->
              <div class="text-left">
                <div>Select Report Type</div>
                <select class="w-full" v-model="typeInput">
                  <option v-for="(option, index) in reportOptions" :key="index" :value="option.value"
                    :selected="option.selected">
                    {{ option.name }}
                  </option>
                </select>
              </div>

              <div class="col-span-2">
                <button @click="generateReport()" style="height: fit-content;"
                  class="block bg-blue-500 hover:bg-blue-400 text-white rounded w-full px-3 py-1">Generate
                  Report</button>
              </div>
            </div>
            <div style="height: fit-content; max-height: 460px;" class="mt-3 w-full border overflow-y-auto">
              <!-- Table header -->
              <div class="sticky top-0 grid grid-flow-col grid-cols-6 bg-gray-200 font-bold">
                <div class="border h-min py-3">Category</div>
                <div class="border h-min py-3">Sub Category</div>
                <div class="border h-min py-3 col-span-2">Product</div>

                <div v-if="typeInput == 'inventory'" class="border h-min py-3">Front</div>
                <div v-if="typeInput == 'inventory'" class="border h-min py-3">Back</div>

                <div v-if="typeInput == 'shrink'" class="border h-min py-3">Weight/Qty</div>
                <div v-if="typeInput == 'shrink'" class="border h-min py-3">Cases</div>

              </div>
              <!-- Table body -->
              <div class="grid">

                <div v-for="row in reportData" :key="row.id" class="grid grid-flow-col grid-cols-6 text-left">
                  <div class="border px-1">{{ row.category }}</div>
                  <div class="border px-1">{{ row.sub_category }}</div>
                  <div class="border col-span-2 text-left px-1">{{ row.name }}</div>

                  <div v-if="typeInput == 'inventory'" class="border px-1">{{ frontAmount(row) }}</div>
                  <div v-if="typeInput == 'inventory'" class="border px-1">{{ backAmount(row) }}</div>

                  <div v-if="typeInput == 'shrink'" class="border px-1 text-center">{{ shrinkWeight(row) }}</div>
                  <div v-if="typeInput == 'shrink'" class="border px-1 text-center">{{ shrinkCases(row) }}</div>
                </div>

              </div>
            </div>
          </div>

          <MessagesContainer />
        </div>
        <!-- /End replace -->
      </div>
    </main>
  </div>
</template>

<script>
import {
  Disclosure,
  DisclosureButton,
  DisclosurePanel,
  Menu,
  MenuButton,
  MenuItem,
  MenuItems,
} from "@headlessui/vue";
import { Bars3Icon, BellIcon, XMarkIcon } from "@heroicons/vue/24/outline";
import MessagesContainer from "../components/Messages/MessagesContainer.vue";
import axiosClient from '../axios';

export default {
  components: {
    Disclosure,
    DisclosureButton,
    DisclosurePanel,
    Menu,
    MenuButton,
    MenuItem,
    MenuItems,
    Bars3Icon,
    BellIcon,
    XMarkIcon,
    MessagesContainer,

  },
  data() {
    return {
      dateInput: "",
      typeInput: "",
      report_data: [],
    }
  },
  computed: {
    reportOptions() {
      return [
        { name: "-- Select Type --", value: "", selected: "true" },
        { name: "Inventory", value: "inventory", selected: "false" },
        { name: "Shrink", value: "shrink", selected: "false" },
      ];
    },
    reportData() {
      return this.report_data
    }
  },
  methods: {
    async generateReport() {
      if (this.dateInput == "") {
        alert("Please select a date.");
        return;
      }
      if (this.typeInput == "") {
        alert("Please select a report type.");
        return;
      }
      //alert("Generating report: " + this.typeInput + " for " + this.dateInput);
      await axiosClient.post('/reports', { date: this.dateInput, type: this.typeInput }).then(response => {
        this.report_data = response.data.report;
      });
    },
    frontAmount(row) {
      if (row.front_perpetual == 1)
        return 'P';

      if (row.front_quantity == null)
        return '';

      return row.front_quantity;
    },
    backAmount(row) {
      if (row.back_perpetual == 1)
        return 'P';

      if (row.back_quantity == null)
        return '';

      return row.back_quantity;
    },
    shrinkCases(row) {
      let convertedAmountInCase = row.weighted_product ? ((row.amount_in_case * 0.453592) * 1000) : row.amount_in_case;

      return this.toFixedIfNecessary(Math.max((parseFloat(row.quantity) / convertedAmountInCase), 0), 4);
    },

    shrinkWeight(row) {
      return this.toFixedIfNecessary(Math.max(parseFloat(row.quantity), 0), 4) + (row.weighted_product ? 'g' : '');
    },

    toFixedIfNecessary(value, dp) {
      return +parseFloat(value).toFixed(dp);
    },
  }
};
</script>