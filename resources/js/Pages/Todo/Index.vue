<template>
  <web-layout>
    <!-- <draggable v-model="myArray">
      <template #item="{ element }">
        <div>
          {{ element }}
        </div>
      </template>
    </draggable> -->

    <confirmation-modal :show="confirmDeleteActive">
      <template v-slot:title> Confirmation </template>

      <template v-slot:content>
        <p class="p-4">Are you sure you want to delete the record?</p>
      </template>

      <template v-slot:footer>
        <o-button variant="danger" @click="destroy">Delete</o-button>
        <div class="mr-3"></div>
        <o-button @click="confirmDeleteActive = false">Cancel</o-button>
      </template>
    </confirmation-modal>

    <div class="card">
      <div class="card-body">
        <h3>App To do</h3>

        <form @submit.prevent="create" class="flex gap-2 mt-2">
          <jet-input
            :class="{ 'bg-red-200 text-red-400': errors.name }"
            placeholder="Create To Do"
            v-model="form.name"
          />
          <jet-button>Create</jet-button>
        </form>
        <jet-input-error v-if="todoSelected == 0" :message="errors.name" />

        <ul id="list-to-do">
          <draggable v-model="todos" item-key="id" @end="order">
            <template #item="{ element }">
              <li :data-id="element.id" class="border py-3 px-4 mt-2">
                <!-- <input type="checkbox" v-model="t.status" @change="status(t)" /> -->

                <svg
                  xmlns="http://www.w3.org/2000/svg"
                  class="h-4 w-4 inline mr-1"
                  fill="none"
                  viewBox="0 0 24 24"
                  :stroke="element.status == '1' ? '#0F0' : '#000'"
                  stroke-width="1"
                  @click="status(element)"
                >
                  <path
                    v-if="element.status == '1'"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"
                  />

                  <path
                    v-else
                    fill-rule="evenodd"
                    d="M13.477 14.89A6 6 0 015.11 6.524l8.367 8.368zm1.414-1.414L6.524 5.11a6 6 0 018.367 8.367zM18 10a8 8 0 11-16 0 8 8 0 0116 0z"
                    clip-rule="evenodd"
                  />
                </svg>

                <span
                  v-show="!element.editMode"
                  @click="element.editMode = true"
                >
                  {{ element.name }}
                </span>
                <jet-input
                  v-show="element.editMode == true"
                  v-model="element.name"
                  @keyup.enter="update(element)"
                />
                <jet-input-error
                  v-if="todoSelected == element.id"
                  :message="errors.name"
                />
                <button
                  @click="
                    deleteTodoRow = element.id;
                    confirmDeleteActive = true;
                  "
                  class="float-right"
                >
                  <svg
                    xmlns="http://www.w3.org/2000/svg"
                    class="h-6 w-6"
                    fill="#F00"
                    viewBox="0 0 24 24"
                    stroke="currentColor"
                    stroke-width="2"
                  >
                    <path
                      stroke-linecap="round"
                      stroke-linejoin="round"
                      d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"
                    />
                  </svg>
                </button>
              </li>
            </template>
          </draggable>
        </ul>

        <div class="flex flex-row-reverse">
          <div>
            <jet-button class="mt-2" @click="destroyAll">
              <svg
                xmlns="http://www.w3.org/2000/svg"
                class="h-6 w-6"
                fill="#F00"
                viewBox="0 0 24 24"
                stroke="currentColor"
                stroke-width="2"
              >
                <path
                  stroke-linecap="round"
                  stroke-linejoin="round"
                  d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"
                />
              </svg>
              Delete All</jet-button
            >
          </div>
        </div>
      </div>
    </div>
  </web-layout>
</template>

<script>
import WebLayout from "@/Layouts/WebLayout";

import ConfirmationModal from "@/Jetstream/ConfirmationModal";
import JetButton from "@/Jetstream/Button";
import JetInput from "@/Jetstream/Input";
import JetInputError from "@/Jetstream/InputError";

import { Inertia } from "@inertiajs/inertia";

import draggable from "vuedraggable";

export default {
  components: {
    WebLayout,
    ConfirmationModal,
    JetButton,
    JetInput,
    JetInputError,
    draggable,
  },
  props: {
    errors: Object,
    todos: Object,
  },
  data() {
    return {
      myArray: ["Test", "Test 2", "Test 3", "Test 4"],
      form: {
        name: "",
      },
      todoSelected: 0,
      confirmDeleteActive: false,
      deleteTodoRow: "",
    };
  },
  methods: {
    create() {
      this.todoSelected = 0;
      Inertia.post(
        route("todo.store", {
          name: this.form.name,
        })
      );
      this.form.name = "";
    },
    update(todo) {
      this.todoSelected = todo.id;
      todo.editMode = false;
      Inertia.put(route("todo.update", todo.id), {
        name: todo.name,
      });
    },
    status(todo) {
      todo.status = !todo.status;
      console.log(todo.status);
      Inertia.post(route("todo.status", todo.id), {
        status: todo.status,
      });
    },
    order() {
      let ids = [];
      document.querySelectorAll("#list-to-do li").forEach((li) => {
        // console.log(li.getAttribute("data-id"));
        // ids += li.getAttribute("data-id") + ",";
        ids.push(li.getAttribute("data-id"));
      });
      Inertia.post(route("todo.orden"), {
        ids: ids,
      });
      //console.log(ids.slice(0,-1))
    },
    destroy() {
      this.confirmDeleteActive = false;
      Inertia.delete(route("todo.destroy", this.deleteTodoRow));
    },
    destroyAll() {
      Inertia.delete(route("todo.destroy"));
    },
  },
};
</script>