<template>
  
    <app-layout >
      <jet-form-section @submitted="submit" class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
        <template #title> Create Post </template>
        <template #description> Create a Post </template>
        <template #form>
          <div class="col-span-6">
            <jet-label>Title</jet-label>
            <jet-input class="w-full" type="text" v-model="form.title" />
            <jet-input-error :message="errors.title" />
          </div>

          <div class="col-span-6">
            <jet-label value="Slug" />
            <jet-input class="w-full" type="text" v-model="form.slug" />
            <jet-input-error :message="errors.slug" />
          </div>
          <div class="col-span-6">
            <jet-label value="Date" />
            <jet-input class="w-full" type="date" v-model="form.date" />
            <jet-input-error :message="errors.date" />
          </div>
          <div class="col-span-6">
            <jet-label value="Text" />
            <textarea class="rounded-md w-full border-gray-300" v-model="form.text"></textarea>
            <jet-input-error :message="errors.text" />
          </div>
          <div class="col-span-6">
            <jet-label value="Description" />
            <textarea class="rounded-md w-full border-gray-300" v-model="form.description"></textarea>
            <jet-input-error :message="errors.description" />
          </div>
          <div class="col-span-6">
            <jet-label value="Posted" />
            
            <select  class="rounded-md w-full border-gray-300" v-model="form.posted">
              <option value="not">No</option>
              <option value="yes">Yes</option>
            </select>
            
            <jet-input-error :message="errors.posted" />
          </div>
          <div class="col-span-6">
            <jet-label value="Type" />
            
            <select  class="rounded-md w-full border-gray-300" v-model="form.type">
              <option value="adverd">Adverd</option>
              <option value="post">Post</option>
              <option value="course">Course</option>
              <option value="movie">Movie</option>
            </select>
            
            <jet-input-error :message="errors.type" />
          </div>
          <div class="col-span-6">
            <jet-label value="Category" />
            <select  class="rounded-md w-full border-gray-300" v-model="form.category_id">
              <option value=""></option>
              <option v-for="c in categories" :value="c.id" :key="c.id">{{ c.title }}</option>
            </select>
            <jet-input-error :message="errors.category_id" />
          </div>
        </template>
        <template #actions>
          <jet-button type="submit">Send</jet-button>
        </template>
      </jet-form-section>
    </app-layout>
</template>
 
<script>
import { Inertia } from "@inertiajs/inertia";
import { useForm } from "@inertiajs/inertia-vue3";

// import AppLayout from "../../../Layouts/AppLayout"
import AppLayout from "@/Layouts/AppLayout";

import JetInput from "@/Jetstream/Input";
import JetInputError from "@/Jetstream/InputError";
import JetLabel from "@/Jetstream/Label";
import JetButton from "@/Jetstream/Button";
import JetFormSection from "@/Jetstream/FormSection";

export default {
  components: {
    AppLayout,
    JetInput,
    JetInputError,
    JetLabel,
    JetButton,
    JetFormSection,
  },
  props: {
    errors: Object,
    categories: Object
  },
  setup() {
    const form = useForm({
      title: null,
      slug: null,
      date: null,
      text: null,
      description: null,
      posted: null,
      type: null,
    });

    function submit() {
      Inertia.post(route("post.store"), form);
    }

    return { form, submit };
  },
};
</script>
