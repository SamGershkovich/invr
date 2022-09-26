<template>
  <div>
    <header class="bg-white shadow">
      <div class="mx-auto max-w-7xl py-6 px-4 sm:px-6 lg:px-8">
        <h1 class="text-3xl font-bold tracking-tight text-gray-900">
          Inventory
        </h1>
      </div>
    </header>
    <main class="h-full">
      <div style="height: 500px" class="mx-auto max-w-7xl py-6 lg:px-8 h-full">
        <!-- Replace with your content -->
        <div
          class="px-4 py-6 lg:grid lg:grid-cols-4 gap-5 h-full block relative"
        >
          <CommentsContainer />
          <Inventory class="col-span-2" />
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
import Comments from "../components/Comments/Comments.vue";
import Inventory from "../components/Inventory/Inventory.vue";
import CommentsContainer from "../components/Comments/CommentsContainer.vue";
import MessagesContainer from "../components/Messages/MessagesContainer.vue";

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
    Comments,
    Inventory,
    CommentsContainer,
    MessagesContainer,
  },
  computed: {
    user() {
      return {
        name: "Tom Cook",
        email: "tom@example.com",
        imageUrl:
          "https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80",
      };
    },
    navigation() {
      return [
        { name: "Dashboard", href: "#", current: true },
        { name: "Team", href: "#", current: false },
        { name: "Projects", href: "#", current: false },
        { name: "Calendar", href: "#", current: false },
      ];
    },
    userNavigation() {
      return [
        { name: "Your Profile", href: "#" },
        { name: "Settings", href: "#" },
        { name: "Sign out", href: "#" },
      ];
    },
  },
};
</script>