
<script setup>
import { useForm, usePage, Head, router } from '@inertiajs/vue3';
import { computed, ref, onMounted } from "vue";
import { useMainStore } from "@/Stores/main";
//import { Inertia } from '@inertiajs/inertia'
import {
  mdiAccountEdit,
  mdiAccount,
  mdiMail,
  mdiBellBadge,
  mdiClose,
  mdiAlertCircle,
  mdiHistory
} from "@mdi/js";
import * as chartConfig from "@/Components/Charts/chart.config.js";
import LineChart from "@/Components/Charts/LineChart.vue";
import SectionMain from "@/Components/SectionMain.vue";
import CardBoxWidget from "@/Components/CardBoxWidget.vue";
import CardBox from "@/Components/CardBox.vue";
import TableSampleClients from "@/Components/TableSampleClients.vue";
import CustomNotificationBar from "@/Components/CustomNotificationBar.vue";
import NotificationBar from "@/Components/NotificationBar.vue";
import BaseButton from "@/Components/BaseButton.vue";
import CardBoxTransaction from "@/Components/CardBoxTransaction.vue";
import CardBoxClient from "@/Components/CardBoxClient.vue";
import LayoutAuthenticated from "@/Layouts/LayoutAuthenticated.vue";
import SectionTitleLineWithButton from "@/Components/SectionTitleLineWithButton.vue";
import SectionBannerStarOnGitHub from "@/Components/SectionBannerStarOnGitHub.vue";
import UserCard from "@/Components/UserCard.vue";
import UserAvatarCurrentUser from "@/Components/UserAvatarCurrentUser.vue";
import MultipurposeButton from '@/Components/MultipurposeButton.vue';
import BaseButtons from '@/Components/BaseButtons.vue';
import FormField from '@/Components/FormField.vue';
import FormControl from '@/Components/FormControl.vue';
import UserAvatar from '@/Components/UserAvatar.vue';
import BaseDivider from '@/Components/BaseDivider.vue';
import FloatingActionButton from '@/Components/FloatingActionButton.vue';

import FormLoaderDark from '@/Loaders/form_loader_dark.gif'
import FormLoaderLight from '@/Loaders/form_loader_light.gif'

const props = defineProps({
  user: {
    type: Object,
  },
  typeOptions: {
    type: Array
  },
  details_params: {
    type: Object
  }
})

// console.log(props.typeOptions)
const mainStore = useMainStore();
onMounted(() => {

});

const current_page = ref(1);

const sales_balance = ref(0.00);
const typeOptions = ref(props.typeOptions);
const subTypeOptions = ref([
  {id: 1, label: '---All---'},
]);

const serviceOptions = ref([
  {id: 1, label: '---All---'},
]);

const history_props = ref({
  'class': 'sales',
  'type': typeOptions.value[0],
  'sub_type': subTypeOptions.value[0],
  'service': serviceOptions.value[0],
  'start_month': null,
  'end_month': null,

})

const openPage = (page) => {
  current_page.value = page
}

const viewAccounts = async () => {

  try {

    console.log(history_props.value)
    Swal.fire({
      title: 'Please wait',
      html: 'Loading.....',
      icon: 'info',
      showConfirmButton: false,
      allowEscapeKey: false,
      allowOutsideClick: false,
    });

    let queryRoute = route('load_vtu_accounting_records_admin');

    const response = await axios.post(queryRoute, null, { params: history_props.value });

    console.log(response)
    Swal.close()

    if(response.data.success){
      sales_balance.value = response.data.total_sum;
      openPage(2);
    }else if(response.data.wrong_date_format){
      Swal.fire({
        title: 'Ooops!',
        html: 'The end date must be ahead of the start date',
        icon: 'error',
      });
    }else{
      Swal.fire({
        title: 'Ooops!',
        html: 'Something went wrong',
        icon: 'error',


      });
    }





  } catch (error) {

    Swal.close()
    console.log(error);

    if (error.response) {
      // Request made but the server responded with an error
      var status = error.response.status;
      if (status == 419) {
        document.location.reload()
      }

    } else if (error.request) {
      // Request made but no response is received from the server.
    } else {
      // Error occured while setting up the request
    }

    Swal.fire({
      title: 'Ooops!',
      html: 'Something went wrong',
      icon: 'error',


    });
  }

};

const typeControlChanged = () => {
  let ret_sub_types = [{id: 1, label: '---All---'}];
  let ret_services = [{id: 1, label: '---All---'}];

  if(history_props.value.type.id == 1){
    subTypeOptions.value = ret_sub_types;


    serviceOptions.value = ret_services;

  }else{
    let sub_types = props.details_params[history_props.value.type.label.toLowerCase()];
    let i = 1;
    for (const [key, value] of Object.entries(sub_types)) {
      i++;
      ret_sub_types.push({id: i, label: key.toUpperCase()});
    }
    subTypeOptions.value = ret_sub_types;
    serviceOptions.value = ret_services;


  }


  history_props.value.sub_type = subTypeOptions.value[0];
  history_props.value.service = serviceOptions.value[0];
  // viewSalesAccounts();



}

const subTypeControlChanged = () => {

  let ret_services = [{id: 1, label: '---All---'}];

  if(history_props.value.sub_type.id == 1){
    serviceOptions.value = ret_services;
    history_props.value.service = serviceOptions.value[0];

  }else{
    let sub_types = props.details_params[history_props.value.type.label.toLowerCase()];

    for (const [key, value] of Object.entries(sub_types)) {
      if(key == history_props.value.sub_type.label.toLowerCase()){
        for(let j = 0; j < value.length; j++){
          ret_services.push({id: j+2, label: value[j].toUpperCase()})
        }
      }
    }
    serviceOptions.value = ret_services;


  }

  // viewSalesAccounts();
}

const serviceControlChanged = () => {

}


const resetFilterForm = () => {
  history_props.value.class = 'sales';
  history_props.value.type = typeOptions.value[0];
  history_props.value.sub_type = subTypeOptions.value[0];
  history_props.value.service = serviceOptions.value[0];
  history_props.value.start_month = null;
  history_props.value.end_month = null;
}


const viewSalesAccount = () => {
  history_props.value.class = 'sales';
  viewAccounts();
}

const viewProfitAccount = () => {
  history_props.value.class = 'profit';
  viewAccounts();
}

const goBackToPage1 = () => {
  resetFilterForm();
  current_page.value = 1;
}
</script>


<template>
  <LayoutAuthenticated>

    <Head :title="`Vtu Accounting`" />
    <SectionMain>
      <SectionTitleLineWithButton :icon="mdiHistory" :title="`Vtu Accounting History`" main>
        <!-- <BaseButton
          href="https://github.com/justboil/admin-one-vue-tailwind"
          target="_blank"
          :icon="mdiGithub"
          label="Star on GitHub"
          color="contrast"
          rounded-full
          small
        /> -->
      </SectionTitleLineWithButton>



      <div v-if="current_page == 2" class="">



        <CardBox isForm @submit.prevent="viewAccounts" class="">

          <h4 class="text-xl font-bold mt-2 mb-4 capitalize">Total {{ history_props.class }} accounting</h4>
          <div class="sm:grid sm:grid-cols-12 sm:gap-6">
            <FormField class="sm:col-span-3" label="Type">
              <FormControl @change="typeControlChanged" v-model="history_props.type" :options="typeOptions" />
            </FormField>

            <FormField class="sm:col-span-3" label="Sub Type">
              <FormControl @change="subTypeControlChanged" v-model="history_props.sub_type" :options="subTypeOptions" />
            </FormField>

            <FormField class="sm:col-span-3" label="Service Type">
              <FormControl @change="serviceControlChanged" v-model="history_props.service" :options="serviceOptions" />
            </FormField>


            <FormField class="sm:col-span-3" label="Start Month">
              <FormControl v-model="history_props.start_month" type="month" />
            </FormField>

            <FormField class="sm:col-span-3" label="End Month">
              <FormControl v-model="history_props.end_month" type="month" />
            </FormField>



          </div>
          <BaseButtons class="mt-5 mb-2">
            <BaseButton type="submit" color="info" label="Filter" class="px-5 mb-0" />

            <BaseButton @click="resetFilterForm" type="reset" color="info" outline label="Reset"
              :icon="mdiClose" class="px-5 mb-0" />
          </BaseButtons>
          <BaseDivider />
        </CardBox>

        <CardBox class="mb-4" >
          <h4 class="text-xl">Balance</h4>
          <h5 class="text-emerald-500 text-4xl font-bold">{{ mainStore.addCommas(sales_balance) }}</h5>
        </CardBox>

      </div>



      <div v-if="current_page == 1" class="mt-[30px]">
        <CardBox class="mb-6">

          <h3 class="text-2xl font-semibold">Choose Action</h3>

          <ul class="divide-y-2 divide-gray-400 mt-[50px]">

            <li @click="viewSalesAccount()" class="listview-list">
              <span class="font-semibold ">1. View sales accounts </span>
            </li>

            <li @click="viewProfitAccount()" class="listview-list">
              <span class="font-semibold ">2. View profits accounts</span>
            </li>




          </ul>
        </CardBox>
      </div>


      <FloatingActionButton v-if="current_page == 2" @click="goBackToPage1" :styles="'background: 9124a3;'"
        :title="'Go Back'">
        <font-awesome-icon class="text-white text-2xl" icon="fa-solid fa-arrow-left" />
      </FloatingActionButton>

    </SectionMain>


  </LayoutAuthenticated>
</template>

