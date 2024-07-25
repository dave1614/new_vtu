<template>
    <LayoutAuthenticated>
      <Head title="Referral Link" />
      <SectionMain>



      </SectionMain>
    </LayoutAuthenticated>
  </template>

  <script setup>
  import { useForm, usePage, Head } from '@inertiajs/vue3';
  import { computed, ref, onMounted } from "vue";
  import { useMainStore } from "@/Stores/main";
  import {
    mdiAccountMultiple,
    mdiCartOutline,
    mdiChartTimelineVariant,
    mdiMonitorCellphone,
    mdiReload,
    mdiGithub,
    mdiChartPie,
    mdiWallet,
    mdiCash,
    mdiCashCheck,
    mdiTable,
    mdiOpenInNew,
    mdiFacebook,
    mdiTwitter,
    mdiWhatsapp,
    mdiAccount
  } from "@mdi/js";
  import * as chartConfig from "@/Components/Charts/chart.config.js";
  import LineChart from "@/Components/Charts/LineChart.vue";
  import SectionMain from "@/Components/SectionMain.vue";
  import CardBoxWidget from "@/Components/CardBoxWidget.vue";
  import CardBox from "@/Components/CardBox.vue";
  import TableSampleClients from "@/Components/TableSampleClients.vue";
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


  const page = usePage()
  const chartData = ref(null);

  const fillChartData = () => {
    chartData.value = chartConfig.sampleChartData();
  };

  onMounted(() => {
    fillChartData();
  });

  const i = 1;
  const mainStore = useMainStore();

  const clientBarItems = computed(() => mainStore.clients.slice(0, 4));

  const transactionBarItems = computed(() => mainStore.history);


  const hasTermsAndPrivacyPolicyFeature = computed(() => page.props.value?.jetstream?.hasTermsAndPrivacyPolicyFeature)


  const props = defineProps({
    user: {}
  })



  Swal.fire({
      title: 'Referral Link',
      html: `Your referral link is ${route('register',{u: props.user.user_name})}`,
      icon: 'success',
  })

  </script>
