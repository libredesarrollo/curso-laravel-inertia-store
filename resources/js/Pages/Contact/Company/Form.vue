<template>
  <contact-layout>
    <div class="card">
      <div class="card-body">
        <form @submit.prevent="submit">
          <div class="col-span-6">
            <jet-label>Name</jet-label>
            <jet-input class="w-full" type="text" v-model="form.name" />
            <jet-input-error :message="errors.name" />
          </div>
          <div class="col-span-6">
            <jet-label>ID</jet-label>
            <jet-input
              class="w-full"
              type="text"
              v-model="form.identification"
            />
            <jet-input-error :message="errors.identification" />
          </div>
          <div class="col-span-6">
            <jet-label>Email</jet-label>
            <jet-input class="w-full" type="email" v-model="form.email" />
            <jet-input-error :message="errors.email" />
          </div>

          <div class="col-span-6">
            <jet-label value="Extra" />
            <textarea
              class="rounded-md w-full border-gray-300"
              v-model="form.extra"
            ></textarea>
            <jet-input-error :message="errors.extra" />
          </div>

          <div class="col-span-6">
            <jet-label value="Choice" />

            <select
              class="rounded-md w-full border-gray-300"
              v-model="form.choices"
            >
              <option value="adverd">Adverd</option>
              <option value="post">Post</option>
              <option value="course">Course</option>
              <option value="movie">Movie</option>
            </select>

            <jet-input-error :message="errors.choices" />
          </div>

          <jet-button class="mt-5" type="submit">Send</jet-button>
          <span class="mt-5 ml-3 cursor-pointer" @click="$emit('backStepEvent',1)">Back</span>
        </form>
      </div>
    </div>
  </contact-layout>
</template>
 
<script>
import { Inertia } from "@inertiajs/inertia";
import { useForm } from "@inertiajs/inertia-vue3";

import ContactLayout from "@/Layouts/ContactLayout";
import JetInput from "@/Jetstream/Input";
import JetInputError from "@/Jetstream/InputError";
import JetLabel from "@/Jetstream/Label";
import JetButton from "@/Jetstream/Button";
import JetDangerButton from "@/Jetstream/DangerButton";
import JetFormSection from "@/Jetstream/FormSection";
export default {
  components: {
    ContactLayout,
    JetInput,
    JetInputError,
    JetLabel,
    JetButton,
    JetDangerButton,
    JetFormSection,
  },
  props: {
    errors: Object,
    contactCompany: {
      type: Object,
      default: {
        id: "",
        name: "",
        identification: "",
        email: "",
        extra: "",
        choices: "",
      },
    },
    contactGeneralId: {
      type: Number,
      default: {
        id: 0
      },
    },
  },
  emits:['backStepEvent'],
  setup(props) {
    const form = useForm({
      id: props.contactCompany.id,
      name: props.contactCompany.name,
      identification: props.contactCompany.identification,
      email: props.contactCompany.email,
      extra: props.contactCompany.extra,
      choices: props.contactCompany.choices,
      contact_general_id: props.contactGeneralId,
    });
    function submit() {
      if (form.id == "") Inertia.post(route("contact-company.store"), form);
      else
        Inertia.post(route("contact-company.update", form.id), {
          _method: "put",
          name: form.name,
          identification: form.identification,
          email: form.email,
          extra: form.extra,
          choices: form.choices,
          contact_general_id: props.contactGeneralId,
        });
    }
    return { form, submit };
  },
};
</script>