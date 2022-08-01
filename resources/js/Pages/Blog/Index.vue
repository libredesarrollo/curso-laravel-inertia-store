<template>
  <web-layout>
    <div class="container">
      <div class="card">
        <div class="card-body">
          <div class="grid grid-cols-2 gap-2 mb-2">
            <div class="col-span-2 border grid grid-cols-2 gap-2 p-3">
              <jet-label value="Date From" />
              <jet-label value="Date To" />

              <jet-input
                class="w-full"
                type="date"
                v-model="from"
                placeholder="Date From"
              ></jet-input>
              <jet-input
                class="w-full"
                type="date"
                v-model="to"
                placeholder="Date to"
              ></jet-input>
            </div>

            <jet-input
              class="w-full"
              type="text"
              autofocus
              v-debounce.500ms="customSearch"
              :debounce-events="['keyup']"
              v-model="search"
              placeholder="Search by id, title or description"
            ></jet-input>

            <select
              @change="customSearch"
              class="rounded-md w-full border-gray-300"
              v-model="type"
            >
              <option :value="null">Type</option>
              <option value="adverd">Adverd</option>
              <option value="post">Post</option>
              <option value="course">Course</option>
              <option value="movie">Movie</option>
            </select>

            <select
              @change="customSearch"
              class="rounded-md w-full border-gray-300"
              v-model="category_id"
            >
              <option :value="null">Category</option>
              <option v-for="c in categories" :value="c.id" :key="c.id">
                {{ c.title }}
              </option>
            </select>

            <div>
              <jet-button @click="customSearch"> Filter </jet-button>
            </div>
            <div>
              <jet-button @click="cleanSearch"> Clean </jet-button>
            </div>
          </div>
        </div>
      </div>

      <div class="flex flex-col items-center mt-5">
        <div class="w-full sm:max-w-4xl overflow-hidden">
          <div v-for="p in posts.data" class="p-3" :key="p">
            <h4 class="text-center text-4xl mb-3">{{ p.title }}</h4>
            <p
              class="
                text-center text-sm text-gray-500
                italic
                font-bold
                uppercase
                tracking-widest
              "
            >
              {{ p.date }}
            </p>

            <img class="w-full rounded-md shadow-md my-4" :src="p.image  ?? '/image/default.jpg'" alt="">

            <p class="mx-4">{{ p.description }}</p>

            <div class="flex flex-col items-center mt-7">
              <a class="btn-primary" :href="route('web.show', p.slug)"
                >Read more!</a
              >
            </div>

            <hr class="my-16">

          </div>
        </div>
      </div>

      <pagination class="my-4" :links="posts" />
    </div>
  </web-layout>
</template>

<script>
import { Link } from "@inertiajs/inertia-vue3";
import { Inertia } from "@inertiajs/inertia";

import WebLayout from "@/Layouts/WebLayout";
import Modal from "@/Jetstream/Modal";
import JetButton from "@/Jetstream/Button";
import JetInput from "@/Jetstream/Input";
import JetLabel from "@/Jetstream/Label";
import ConfirmationModal from "@/Jetstream/ConfirmationModal";
import Pagination from "@/Shared/Pagination.vue";

export default {
  data() {
    return {};
  },
  components: {
    WebLayout,
    Link,
    Pagination,
    Modal,
    JetButton,
    JetInput,
    JetLabel,
    ConfirmationModal,
  },
  props: {
    posts: Object,
    categories: Object,
    type: "",
    category_id: "",
    posted: "",
    search: "",
    from: "",
    to: "",
  },
  methods: {
    customSearch() {
      Inertia.get(
        route("web.index", {
          category_id: this.category_id,
          type: this.type,
          search: this.search,
          from: this.from,
          to: this.to,
        })
      );
    },
    cleanSearch() {
      Inertia.get(route("web.index"));
    },
  },
};
</script>
