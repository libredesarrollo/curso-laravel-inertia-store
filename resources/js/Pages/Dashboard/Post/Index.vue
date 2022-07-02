<template>
  <!-- <o-modal v-model:active="confirmDeleteActive">
    <p class="p-4">Are you sure you want to delete the record?</p>

    <div class="flex flex-row-reverse gap-2 bg-gray-100 p-3">
      <o-button variant="danger" @click="deletePost">Delete</o-button>
      <o-button @click="confirmDeleteActive = false">Cancel</o-button>
    </div>
  </o-modal> 
  
  <modal :show="false">
    Hola Inertia
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

          <table class="w-full border">
            <thead class="bg-gray-100">
              <tr class="border-b">
                <th class="p-3">Id</th>
                <th class="p-3">Title</th>
                <th class="p-3">Slug</th>
                <th class="p-3">Actions</th>
              </tr>
            </thead>
            <tbody>
              <tr class="border-b" v-for="c in categories.data" :key="c.id">
                <td class="p-2">{{ c.id }}</td>
                <td class="p-2">{{ c.title }}</td>
                <td class="p-2">{{ c.slug }}</td>
                <td class="p-2">
                  <Link
                    class="text-sm text-purple-400 hover:text-purple-700 mr-4"
                    :href="route('post.edit', c.id)"
                    >Edit</Link
                  >
                  <!-- <Link as="button" type="button" method="DELETE" class="text-sm text-red-400 hover:text-red-700 ml-2" :href="route('post.destroy', c.id)">Delete</Link> -->

                  <o-button
                    iconLeft="delete"
                    rounded
                    size="small"
                    variant="danger"
                    @click="
                      confirmDeleteActive = true;
                      deletePostRow = c.id;
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

          <pagination class="my-4" :links="categories" />
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
    ConfirmationModal,
  },
  props: {
    categories: Object,
  },
  methods: {
    deletePost() {
      Inertia.delete(route("post.destroy", this.deletePostRow));
      this.confirmDeleteActive = false;
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
