<template>
  <div>
    <div>
      <img
        class="mx-auto h-12 w-auto"
        src="/logistics.png"
        alt="Your Company"
      />
      <h2
        class="mt-6 text-center text-3xl font-bold tracking-tight text-gray-900"
      >
        Log in to your department
      </h2>
    </div>
    <form class="mt-8 space-y-6" @submit="login">
      <input type="hidden" name="remember" value="true" />
      <div class="-space-y-px rounded-md shadow-sm">
        <div>
          <label for="employee-number" class="sr-only">Employee number</label>
          <input
            v-model="user.employee_number"
            id="employee-number"
            name="employee_number"
            type="number"
            required=""
            class="
              relative
              block
              w-full
              appearance-none
              rounded-none rounded-t-md
              border border-gray-300
              px-3
              py-2
              text-gray-900
              placeholder-gray-500
              focus:z-10
              focus:border-indigo-500
              focus:outline-none
              focus:ring-indigo-500
              sm:text-sm
            "
            placeholder="Employee number"
          />
        </div>
        <div>
          <label for="password" class="sr-only">Password</label>
          <input
            v-model="user.password"
            id="password"
            name="password"
            type="password"
            autocomplete="current-password"
            required=""
            class="
              relative
              block
              w-full
              appearance-none
              rounded-none rounded-b-md
              border border-gray-300
              px-3
              py-2
              text-gray-900
              placeholder-gray-500
              focus:z-10
              focus:border-indigo-500
              focus:outline-none
              focus:ring-indigo-500
              sm:text-sm
            "
            placeholder="Password"
          />
        </div>
      </div>

      <div class="flex items-center justify-between">
        <div class="flex items-center">
          <input
            v-model="user.remember"
            id="remember-me"
            name="remember-me"
            type="checkbox"
            class="
              h-4
              w-4
              rounded
              border-gray-300
              text-indigo-600
              focus:ring-indigo-500
            "
          />
          <label for="remember-me" class="ml-2 block text-sm text-gray-900"
            >Remember me</label
          >
        </div>

        <div class="text-sm">
          <a href="#" class="font-medium text-indigo-600 hover:text-indigo-500"
            >Forgot your password?</a
          >
        </div>
      </div>

      <div>
        <button
          type="submit"
          class="
            group
            relative
            flex
            w-full
            justify-center
            rounded-md
            border border-transparent
            bg-indigo-600
            py-2
            px-4
            text-sm
            font-medium
            text-white
            hover:bg-indigo-700
            focus:outline-none
            focus:ring-2
            focus:ring-indigo-500
            focus:ring-offset-2
          "
        >
          <span class="absolute inset-y-0 left-0 flex items-center pl-3">
            <LockClosedIcon
              class="h-5 w-5 text-indigo-500 group-hover:text-indigo-400"
              aria-hidden="true"
            />
          </span>
          Log in
        </button>
      </div>
    </form>
  </div>
</template>

<script setup>
import { LockClosedIcon } from "@heroicons/vue/20/solid";
import router from "../router";
import store from "../store";

const user = {
  employee_number: undefined,
  password: "",
  remember: false,
};

function login(ev) {
  ev.preventDefault();

  store.dispatch("login", user).then(() => {
    router.push({ name: "Dashboard" });
  });
}
</script>
