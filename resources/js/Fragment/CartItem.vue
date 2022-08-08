<template>
  <jet-input v-model="count" type="number" class="w-20" min="1" />
  {{ post.title }}
  <jet-button type="submit" @click="submit"> Send </jet-button>
</template>

<script>
import { Inertia } from "@inertiajs/inertia";
import JetInput from "@/Jetstream/Input";
import JetButton from "@/Jetstream/Button";
export default {
  components: {
    JetInput,
    JetButton,
  },
  data() {
    return {
      count: this.pcount,
    };
  },
  props: {
    post: {
      type: Object,
      required: true,
    },
    pcount: {
      type: String,
      default: "1",
    },
  },
  methods: {
    submit() {
      Inertia.post(
        route("shop.add", {
          post: this.post.id,
          count: this.count,
        })
      );

      this.$oruga.notification.open({
        message: "Applied changes",
        position: "top-right",
        variant: "success",
        duration: 2000,
        closable: true,
      });
    },
  },
};
</script>