<template>
    <app-layout >
      <jet-form-section @submitted="submit" class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
        <template #title> Create Category </template>
        <template #description> Create a Category </template>
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
    category: Object,
  },
  setup(props) {
    const form = useForm({
      id: props.category.id,
      title: props.category.title,
      slug: props.category.slug,
    });

    function submit() {
      Inertia.put(route("category.update",form.id), form);
    }

    return { form, submit };
  },
};
</script>
