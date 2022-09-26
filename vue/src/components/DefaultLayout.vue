<template>
  <div class="min-h-full">
    <Disclosure as="nav" class="bg-gray-800" v-slot="{ open }">
      <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="flex h-16 items-center justify-between">
          <div class="flex items-center">
            <div class="flex-shrink-0">
              <img
                class="h-8 w-8"
                src="http://127.0.0.1:5173/logistics.png"
                alt="Your Company"
              />
            </div>
            <div class="hidden md:block">
              <div class="ml-10 flex items-baseline space-x-4">
                <a
                  v-for="item in navigation"
                  :key="item.name"
                  :href="item.href"
                  :class="[
                    item.current
                      ? 'bg-gray-900 text-white'
                      : 'text-gray-300 hover:bg-gray-700 hover:text-white',
                    'px-3 py-2 rounded-md text-sm font-medium',
                  ]"
                  :aria-current="item.current ? 'page' : undefined"
                  >{{ item.name }}</a
                >
              </div>
            </div>
          </div>
          <div class="hidden md:block">
            <div class="ml-4 flex items-center md:ml-6">
              <!-- Profile dropdown -->
              <Menu as="div" class="relative ml-3">
                <div>
                  <MenuButton
                    class="
                      flex
                      max-w-xs
                      items-center
                      rounded-full
                      bg-gray-800
                      text-sm text-white
                      focus:outline-none
                      focus:ring-2
                      focus:ring-white
                      focus:ring-offset-2
                      focus:ring-offset-gray-800
                    "
                  >
                    {{ user.name }}
                  </MenuButton>
                </div>
                <transition
                  enter-active-class="transition ease-out duration-100"
                  enter-from-class="transform opacity-0 scale-95"
                  enter-to-class="transform opacity-100 scale-100"
                  leave-active-class="transition ease-in duration-75"
                  leave-from-class="transform opacity-100 scale-100"
                  leave-to-class="transform opacity-0 scale-95"
                >
                  <MenuItems
                    class="
                      absolute
                      right-0
                      z-10
                      mt-2
                      w-48
                      origin-top-right
                      rounded-md
                      bg-white
                      py-1
                      shadow-lg
                      ring-1 ring-black ring-opacity-5
                      focus:outline-none
                    "
                  >
                    <MenuItem v-slot="{ active }">
                      <a
                        href="#"
                        :class="[
                          active ? 'bg-gray-100' : '',
                          'block px-4 py-2 text-sm text-gray-700',
                        ]"
                      >
                        Your Profile
                      </a>
                    </MenuItem>
                    <MenuItem v-slot="{ active }">
                      <a
                        href="#"
                        :class="[
                          active ? 'bg-gray-100' : '',
                          'block px-4 py-2 text-sm text-gray-700',
                        ]"
                      >
                        Settings
                      </a>
                    </MenuItem>
                    <MenuItem v-slot="{ active }" @click="logout">
                      <a
                        href="#"
                        :class="[
                          active ? 'bg-gray-100' : '',
                          'block px-4 py-2 text-sm text-gray-700',
                        ]"
                      >
                        Log out
                      </a>
                    </MenuItem>
                  </MenuItems>
                </transition>
              </Menu>
            </div>
          </div>
          <div class="-mr-2 flex md:hidden">
            <!-- Mobile menu button -->
            <DisclosureButton
              class="
                inline-flex
                items-center
                justify-center
                rounded-md
                bg-gray-800
                p-2
                text-gray-400
                hover:bg-gray-700 hover:text-white
                focus:outline-none
                focus:ring-2
                focus:ring-white
                focus:ring-offset-2
                focus:ring-offset-gray-800
              "
            >
              <span class="sr-only">Open main menu</span>
              <Bars3Icon
                v-if="!open"
                class="block h-6 w-6"
                aria-hidden="true"
              />
              <XMarkIcon v-else class="block h-6 w-6" aria-hidden="true" />
            </DisclosureButton>
          </div>
        </div>
      </div>

      <DisclosurePanel class="md:hidden">
        <div class="space-y-1 px-2 pt-2 pb-3 sm:px-3">
          <DisclosureButton
            v-for="item in navigation"
            :key="item.name"
            as="a"
            :href="item.href"
            :class="[
              item.current
                ? 'bg-gray-900 text-white'
                : 'text-gray-300 hover:bg-gray-700 hover:text-white',
              'block px-3 py-2 rounded-md text-base font-medium',
            ]"
            :aria-current="item.current ? 'page' : undefined"
            >{{ item.name }}</DisclosureButton
          >
        </div>
        <div class="border-t border-gray-700 pt-4 pb-3">
          <div class="flex items-center px-5">
            <div class="ml-3">
              <div class="text-base font-medium leading-none text-white">
                {{ user.name }}
              </div>
              <div class="text-sm font-medium leading-none text-gray-400">
                {{ user.email }}
              </div>
            </div>
          </div>
          <div class="mt-3 space-y-1 px-2">
            <DisclosureButton
              as="a"
              href="#"
              class="
                block
                rounded-md
                px-3
                py-2
                text-base
                font-medium
                text-gray-400
                hover:bg-gray-700 hover:text-white
              "
            >
              Your Profile
            </DisclosureButton>
            <DisclosureButton
              as="a"
              href="#"
              class="
                block
                rounded-md
                px-3
                py-2
                text-base
                font-medium
                text-gray-400
                hover:bg-gray-700 hover:text-white
              "
            >
              Settings
            </DisclosureButton>
            <DisclosureButton
              as="a"
              @click="logout"
              href="#"
              class="
                block
                rounded-md
                px-3
                py-2
                text-base
                font-medium
                text-gray-400
                hover:bg-gray-700 hover:text-white
              "
            >
              Log out
            </DisclosureButton>
          </div>
        </div>
      </DisclosurePanel>
    </Disclosure>

    <router-view></router-view>
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

export default {
  components: {
    Disclosure,
    DisclosureButton,
    DisclosurePanel,
    Menu,
    MenuButton,
    MenuItem,
    MenuItems,
    BellIcon,
    Bars3Icon,
    XMarkIcon,
  },
  data() {
    return {};
  },

  computed: {
    user() {
      return this.$store.state.user.data;
    },
    navigation() {
      if (this.user) {
        if (this.user.role_id == 1) {
          return [
            { name: "Dashboard", href: "#", current: true },
            { name: "Reports", href: "#", current: false },
          ];
        }
      }
      return [{ name: "Dashboard", href: "#", current: true }];
    },
  },
  methods: {
    logout() {
      this.$store.dispatch("logout").then(() => {
        this.$router.push({
          name: "Login",
        });
      });
    },
  },
};
</script>