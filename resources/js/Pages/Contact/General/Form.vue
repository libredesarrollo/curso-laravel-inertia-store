<template>
  <contact-layout>

    <div class="card">
      <div class="card-body">
        <form @submit.prevent="submit">
          <div class="col-span-6">
            <jet-label>Subject</jet-label>
            <jet-input class="w-full" type="text" v-model="form.subject" />
            <jet-input-error :message="errors.subject" />
          </div>

          <div class="col-span-6">
            <jet-label value="Message" />
            <textarea
              class="rounded-md w-full border-gray-300"
              v-model="form.message"
            ></textarea>
            <jet-input-error :message="errors.message" />
          </div>

          <div class="col-span-6">
            <jet-label value="Type" />

            <select
              class="rounded-md w-full border-gray-300"
              v-model="form.type"
            >
              <!-- <option value="adverd">Adverd</option>
            <option value="post">Post</option>
            <option value="course">Course</option>
            <option value="movie">Movie</option> -->
              <option value="company">Company</option>
              <option value="person">Person</option>
            </select>

            <jet-input-error :message="errors.type" />
          </div>

          <jet-button class="mt-5" type="submit">Send</jet-button>
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
    contactGeneral: {
      type: Object,
      default: {
        id: "",
        subject: "",
        message: "",
        type: "",
      },
    },
  },
  setup(props) {
    const form = useForm({
      id: props.contactGeneral.id,
      subject: props.contactGeneral.subject,
      message: props.contactGeneral.message,
      type: props.contactGeneral.type,
    });
    function submit() {
      if (form.id == "") Inertia.post(route("contact-general.store"), form);
      else
        Inertia.post(route("contact-general.update", form.id), {
          _method: "put",
          subject: form.subject,
          type: form.type,
          message: form.message,
        });
    }
    return { form, submit };
  },
};
</script>