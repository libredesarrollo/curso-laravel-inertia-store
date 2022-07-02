<template>
  <o-modal v-model:active="confirmDeleteActive">
    <p class="p-4">Are you sure you want to delete the record?</p>

    <div class="flex flex-row-reverse gap-2 bg-gray-100 p-3">
      <o-button variant="danger" @click="deleteCategory">Delete</o-button>
      <o-button @click="confirmDeleteActive = false">Cancel</o-button>
    </div>
  </o-modal>
  <app-layout>
    <div class="container">
      <div class="card">
        <div class="card-body">
          <Link
            class="link-button-default my-3"
            :href="route('category.create')"
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
                    class="text-sm mr-4 text-purple-400 hover:text-purple-700"
                    :href="route('category.edit', c.id)"
                    >Edit</Link
                  >
                  <!-- <Link as="button" type="button" method="DELETE" class="text-sm text-red-400 hover:text-red-700 ml-2" :href="route('category.destroy', c.id)">Delete</Link> -->

                  <o-button
                    iconLeft="delete"
                    rounded
                    size="small"
                    variant="danger"
                    @click="
                      confirmDeleteActive = true;
                      deleteCategoryRow = c.id;
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
import AppLayout from "@/Layouts/AppLayout";
import Pagination from "@/Shared/Pagination.vue";
import { Inertia } from "@inertiajs/inertia";

export default {
  data() {
    return {
      confirmDeleteActive: false,
      deleteCategoryRow: "",
    };
  },
  components: {
    AppLayout,
    Link,
    Pagination,
  },
  props: {
    categories: Object,
  },
  methods: {
    deleteCategory() {
      Inertia.delete(route("category.destroy", this.deleteCategoryRow));
      this.confirmDeleteActive = false;
    },
  },
};
</script>
