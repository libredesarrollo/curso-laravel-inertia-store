<template>
  <!-- <o-modal v-model:active="confirmDeleteActive">
    <p class="p-4">Are you sure you want to delete the record?</p>

    <div class="flex flex-row-reverse gap-2 bg-gray-100 p-3">
      <o-button variant="danger" @click="deletePost">Delete</o-button>
      <o-button @click="confirmDeleteActive = false">Cancel</o-button>
    </div>
  </o-modal> 
  
  <modal :show="true">
    Hello Inertia
  </modal>
  
  -->

  <confirmation-modal :show="confirmDeleteActive">
    <template v-slot:title> Confirmation </template>

    <template v-slot:content>
      <p class="p-4">Are you sure you want to delete the record?</p>
    </template>

    <template v-slot:footer>
      <o-button variant="danger" @click="deletePost">Delete</o-button>
      <div class="mr-3"></div>
      <o-button @click="confirmDeleteActive = false">Cancel</o-button>
    </template>
  </confirmation-modal>

  <app-layout>
    <div class="container">
      <div class="card">
        <div class="card-body">
          <Link class="link-button-default my-3" :href="route('post.create')"
            >Create</Link
          >

          <div class="grid grid-cols-2 gap-2 mb-2">
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
            <jet-input
              class="w-full"
              type="text"
              v-debounce.500ms="customSearch"
              :debounce-events="['keyup']"
              v-model="search"
              placeholder="Search by id, title or description"
            ></jet-input>

            <select
              @change="customSearch"
              class="rounded-md w-full border-gray-300"
              v-model="posted"
            >
              <option value="not">No</option>
              <option value="yes">Yes</option>
            </select>

            <select
              @change="customSearch"
              class="rounded-md w-full border-gray-300"
              v-model="type"
            >
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
              <option value=""></option>
              <option v-for="c in categories" :value="c.id" :key="c.id">
                {{ c.title }}
              </option>
            </select>

            <jet-button @click="customSearch"> Filter </jet-button>
          </div>

          <table class="w-full border">
            <thead class="bg-gray-100">
              <tr class="border-b">
                <th v-for="(c, k) in columns" class="p-3" :key="c">
                 <button @click="customSearch(k)">
                   {{ c }}
                  <template v-if="k == sortColumn">
                    <template v-if="'asc' == sortDirection">
                       &uarr;
                    </template>
                    <template v-else>
                       &darr;
                    </template>
                  </template>
                 </button>
                </th>

                <th class="p-3">Actions</th>
              </tr>
            </thead>
            <tbody>
              <tr class="border-b" v-for="p in posts.data" :key="p.id">
                <td class="p-2">{{ p.id }}</td>
                <td class="p-2">{{ p.date }}</td>
                <td class="p-2">{{ p.title.substring(0, 15) }}</td>
                <td class="p-2">
                  <textarea class="w-48">
                  {{ p.description }}
                </textarea
                  >
                </td>
                <td class="p-2">{{ p.category.title }}</td>
                <td class="p-2">{{ p.type }}</td>
                <td class="p-2">
                  <Link
                    class="text-sm text-purple-400 hover:text-purple-700 mr-4"
                    :href="route('post.edit', p.id)"
                    >Edit</Link
                  >
                  <!-- <Link as="button" type="button" method="DELETE" class="text-sm text-red-400 hover:text-red-700 ml-2" :href="route('post.destroy', p.id)">Delete</Link> -->

                  <o-button
                    iconLeft="delete"
                    rounded
                    size="small"
                    variant="danger"
                    @click="
                      confirmDeleteActive = true;
                      deletePostRow = p.id;
                    "
                  >
                    Delete
                  </o-button>
                </td>
              </tr>
            </tbody>
          </table>
          <!-- <template v-for="l in categories.links" :key="l">
            <Link v-if="!l.active" class="px-2 py-1" :href="l.url" v-html="l.label"/>
            <span v-else class="px-2 py-1 cursor-pointer text-gray-500"  v-html="l.label"  />
        </template> -->

          <pagination class="my-4" :links="posts" />
        </div>
      </div>
    </div>
  </app-layout>
</template>

<script>
import { Link } from "@inertiajs/inertia-vue3";
import { Inertia } from "@inertiajs/inertia";

import AppLayout from "@/Layouts/AppLayout";
import Modal from "@/Jetstream/Modal";
import JetButton from "@/Jetstream/Button";
import JetInput from "@/Jetstream/Input";
import ConfirmationModal from "@/Jetstream/ConfirmationModal";
import Pagination from "@/Shared/Pagination.vue";

export default {
  data() {
    return {
      confirmDeleteActive: false,
      deletePostRow: "",
    };
  },
  components: {
    AppLayout,
    Link,
    Pagination,
    Modal,
    JetButton,
    JetInput,
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
    sortColumn: "",
    sortDirection: "",
    columns: "",
  },
  methods: {
    deletePost() {
      Inertia.delete(route("post.destroy", this.deletePostRow));
      this.confirmDeleteActive = false;
    },
    customSearch(column='id') {
      Inertia.get(
        route("post.index", {
          category_id: this.category_id,
          type: this.type,
          posted: this.posted,
          search: this.search,
          from: this.from,
          to: this.to,
          sortColumn: column,
          sortDirection: this.sortDirection == 'asc' ? 'desc' : 'asc',
        })
      );
    },
  },

  // setup(props) {
  //   function deletePost() {
  //     //Inertia.delete(route("post.destroy", props.deletePostRow));
  //     props.confirmDeleteActives = false;
  //   }

  //   return { deletePost };
  // },
};
</script>
