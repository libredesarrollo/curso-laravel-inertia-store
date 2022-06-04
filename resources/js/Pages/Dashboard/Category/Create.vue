<template>
  <form @submit.prevent="submit">
    <label for="">Title</label>
    <input type="text" v-model="form.title" />
    <label for="">Slug</label>
    <input type="text" v-model="form.slug" />
    <button type="submit">Send</button>
  </form>
</template>

<script>
import { Inertia } from "@inertiajs/inertia";
import { useForm } from "@inertiajs/inertia-vue3";

export default {
  setup() {
    const form = useForm({
      title: null,
      slug: null,
    });

    function submit() {
      Inertia.post(route("category.store"), form);
    }

    return { form, submit };
  },
};
</script>