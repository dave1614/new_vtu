<style>
  body{
    background: #fff !important;
  }
</style>


<script setup>
import {

} from "@mdi/js";


import { useMainStore } from "@/Stores/main";
import { useForm, usePage, Head, Link, router } from '@inertiajs/vue3'
//import { Inertia } from '@inertiajs/inertia'
import { computed, ref, reactive, watch } from 'vue'
import _ from 'lodash';

const page = usePage();
const mainStore = useMainStore();

// const hasTermsAndPrivacyPolicyFeature = computed(() => page.props.jetstream?.hasTermsAndPrivacyPolicyFeature)
const props = defineProps({
  user: {
    type: Object
  },
  details: {
    type: Object
  },
  APP_NAME: {
    type: String
  }
});


const response = ref(JSON.parse(props.details.response));

const useSearchBtn = mainStore.useSearchBtn;


const lengthOptions = ref([
  10,
  20,
  50,
  100
]);






</script>

<template inheritAttrs="false">
  <div >
    <div class="px-3 pt-2 min-h-screen bg-[lightgrey]">
      <div class="sm:w-3/5 mx-auto">
        <div class="card" style="">
          <div class="text-center px-4">
            <div class="py-2 border-b-[2px] border-dotted border-[lightgrey]">
              <!-- <img src="/images/logo-img.jpeg" style="width: 80px;"> -->
              <h4 class="font-bold text-xl mt-1 font-kanit" style="color: #2596be;">{{ APP_NAME }}</h4>
              <h4 class="font-bold text-primary text-5xl" >₦ {{ mainStore.addCommas(details.amount) }}</h4>
              <h6 class="font-bold" style="font-size: 15px;">Successful Transaction</h6>
              <h6 class="font-bold text-secondary">{{ details.date }} {{ details.time }}</h6>
            </div>

            <div class="py-2 text-left grid grid-cols-12 gap-6">
              <h6 class="col-span-5 text-sm inline-block" >Transaction Type</h6>
              <h6 class="font-bold col-span-6 text-sm text-right inline-block" >Electricity</h6>

              <h6 class="col-span-5 text-sm inline-block" >Bill Provider</h6>
              <h6 class="font-bold col-span-6 text-sm text-right inline-block" >{{ response.data.disco }}</h6>

              <h6 class="col-span-5 text-sm inline-block" >Meter Number</h6>
              <h6 class="font-bold col-span-6 text-sm text-right inline-block" >{{ details.number }}</h6>

              <h6 class="col-span-5 text-sm inline-block" >Units</h6>
              <h6 class="font-bold col-span-6 text-sm text-right inline-block" >{{ response.data.units }}kWh</h6>

              <h6 class="col-span-5 text-sm inline-block" >Account Name</h6>
              <h6 class="font-bold col-span-6 text-sm text-right inline-block" >{{ response.data.name }}</h6>

              <h6 class="col-span-5 text-sm inline-block" >Payment Item</h6>
              <h6 class="font-bold col-span-6 text-sm text-right inline-block"  v-html="typeof response.data.token === 'undefined' ? 'Postpaid' : 'Prepaid'"></h6>

              <h6 v-if="typeof response.data.token != 'undefined'" class="col-span-5 text-sm inline-block" >Token</h6>
              <h6 v-if="typeof response.data.token != 'undefined'" class="font-bold col-span-6 text-sm text-right text-primary inline-block" >{{ response.data.token }}</h6>

              <div v-if="typeof response.data.token != 'undefined' && typeof response.data.parcels != 'undefined'" class="col-span-12">

                <div v-for="(tok, index) in response.data.parcels" class="grid grid-cols-12 gap-6 mb-4 " :key="index">
                  <h6 v-show="tok.type != 'TOKEN'" class="col-span-5 text-sm inline-block" >{{ tok.type }}</h6>
                  <h6 v-show="tok.type != 'TOKEN'" class="font-bold col-span-6 text-sm text-right text-primary inline-block" >{{ tok.content }}</h6>
                </div>
              </div>

              <h6 class="col-span-5 text-sm inline-block" >Transaction Id</h6>
              <h6 class="font-bold col-span-6 text-sm text-right inline-block" >{{ response.data.orderId }}</h6>

              <h6 class="col-span-5 text-sm inline-block" >Transaction Time</h6>
              <h6 class="font-bold col-span-6 text-sm text-right inline-block" >{{ response.data.vendTime }}</h6>

              <h6 class="col-span-5 text-sm inline-block" >Address</h6>
              <h6 class="font-bold col-span-6 text-sm text-right inline-block" >{{ response.data.address }}</h6>


            </div>

          </div>


        </div>


      </div>
    </div>

    <div class="" style="position: absolute; bottom: 0; display: none;">
      <div class="row">
        <div class="col-2 pr-1 text-right" style="background: #2596be;">
          <i class="fas fa-map-marker-alt" style="color: #fff;"></i>
        </div>
        <span class="font-bold col-10" style="font-size: 10px; line-height: 1.2;">NO8B AFOLABI ESAN CLOSE, ADEXON ILEKPO BUS STOP, AKESAN LAGOS</span>
      </div>
      <div class="row">
        <div class="col-2 pr-1 text-right" style="background: #2596be;">
          <i class="fas fa-phone" style="color: #fff;"></i>
        </div>
        <span class="font-bold col-10 mt-1" style="font-size: 10px; line-height: 1.2;">08095812402</span>
      </div>
      <div class="row">
        <div class="col-2 pr-1 text-right" style="background: #2596be;">
          <i class="fas fa-envelope" style="color: #fff;"></i>
        </div>
        <span class="font-bold col-10" style="font-size: 10px; line-height: 1.2; text-transform: lowercase;">geeklickservices@gmail.com</span>
      </div>

    </div>
  </div>
</template>
