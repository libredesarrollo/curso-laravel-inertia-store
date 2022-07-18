<template>
  <contact-layout>
    <div class="card">
      <div class="card-body">
        <form @submit.prevent="submit">
          <div class="col-span-6">
            <jet-label value="Extra" />
            <textarea
              class="rounded-md w-full border-gray-300"
              v-model="form.extra"
            ></textarea>
            <jet-input-error :message="errors.extra" />
          </div>

          <jet-button class="mt-5" type="submit">Send</jet-button>
          <span
            class="mt-5 ml-3 cursor-pointer"
            @click="$emit('backStepEvent', backStep)"
            >Back</span
          >
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
  emits: ["backStepEvent"],
  props: {
    errors: Object,
    contactDetail: {
      type: Object,
      default: {
        id: "",
        extra: "",
      },
    },
    contactGeneralId: {
      type: Number,
      default: {
        id: 0,
      },
    },
    backStep: {
      type: Number,
      default: {
        id: 2,
      },
    },
  },
  setup(props) {
    const form = useForm({
      id: props.contactDetail.id,
      extra: props.contactDetail.extra,
      contact_general_id: props.contactGeneralId,
    });
    function submit() {
      if (form.id == "") Inertia.post(route("contact-detail.store"), form);
      else
        Inertia.post(route("contact-detail.update", form.id), {
          _method: "put",
          extra: form.extra,
          contact_general_id: props.contactGeneralId,
        });
    }
    return { form, submit };
  },
};
</script>