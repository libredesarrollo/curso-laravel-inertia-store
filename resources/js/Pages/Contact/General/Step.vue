<template>
  <div>
    <contact-layout>
      {{ $page.props.step }}

      <div class="flex" v-if="$page.props.step != 4">
        <div class="flex mx-auto flex-col sm:flex-row">
          <div class="step" :class="{ active: $page.props.step == 1 }">
            STEP 1
          </div>
          <div
            class="step"
            :class="{ active: parseInt($page.props.step) == 2 }"
          >
            STEP 2
          </div>
          <div class="step" :class="{ active: $page.props.step == 3 }">
            STEP 3
          </div>
        </div>
      </div>

      <general-form
        v-if="$page.props.step == 1"
        :errors="errors"
        :contactGeneral="contactGeneral"
      />
      <company-form
        v-if="$page.props.step == 2.5"
        :errors="errors"
        :contactCompany="contactGeneral.company"
        :contactGeneralId="contactGeneral.id"
        @back-step-event="backStep"
      />
      <person-form
        v-if="$page.props.step == 2"
        :errors="errors"
        :contactPerson="contactGeneral.person"
        :contactGeneralId="contactGeneral.id"
        @back-step-event="backStep"
      />
      <detail-form
        v-if="$page.props.step == 3"
        :errors="errors"
        :contactDetail="contactGeneral.detail"
        :backStep="contactGeneral.type == 'person' ? 2 : 2.5"
        :contactGeneralId="contactGeneral.id"
        @back-step-event="backStep"
      />
      <div v-if="$page.props.step == 4">
        <h3 class="text-center">Contact made successfully</h3>
      </div>
    </contact-layout>
  </div>
</template>
<script>
import ContactLayout from "@/Layouts/ContactLayout";
import GeneralForm from "@/Pages/Contact/General/Form";
import CompanyForm from "@/Pages/Contact/Company/Form";
import PersonForm from "@/Pages/Contact/Person/Form";
import DetailForm from "@/Pages/Contact/Detail/Form";

export default {

  methods:{
    backStep(value){
      this.$page.props.step=value
    }
  },
  props: {
    errors: Object,
    contactGeneral: Object,
  },
  components: {
    ContactLayout,
    GeneralForm,
    CompanyForm,
    PersonForm,
    DetailForm,
  },
};
</script>