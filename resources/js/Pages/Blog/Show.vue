<template>
  <web-layout>
    <div class="container">
      <div class="card">
        <div class="card-body">
          <h1 class="text-center text-5xl mb-3">{{ post.title }}</h1>

          <img
            class="w-full rounded-md shadow-md my-4"
            :src="post.image ?? '/image/default.jpg'"
            alt=""
          />

          <p
            class="
              text-center text-sm text-gray-500
              italic
              font-bold
              uppercase
              tracking-widest
            "
          >
            {{ post.date }}
          </p>

          <span class="ml-4 rounded-md bg-purple-500 py-1 px-3 text-white">
            {{ post.type }}
          </span>
          <span class="ml-4 rounded-md bg-purple-500 py-1 px-3 text-white">
            {{ post.category.title }}
          </span>

          <div v-html="post.text"></div>

          <div v-if="post.type == 'adverd'">
            <cart-item :post="post"/>
          </div>

          <hr class="my-8" />

          <general-step :errors="errors" />
        </div>
      </div>
    </div>
  </web-layout>
</template>

<script>
import WebLayout from "@/Layouts/WebLayout";

import GeneralStep from "@/Pages/Contact/General/Step";
import CartItem from "@/Fragment/CartItem";

export default {
  components: {
    WebLayout,
    GeneralStep,
    CartItem,
  },
  props: {
    post: Object,
    errors: Object,
  },
};
</script>
