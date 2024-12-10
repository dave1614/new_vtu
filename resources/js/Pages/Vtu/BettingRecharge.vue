<style>
.frame-area {
  display: block;
  width: 100%;
  /* max-width: 400px; */
  height: 1000px;
  /* overflow: auto; */
  border: #999999 1px solid;
  margin: 0px;
  padding: 0px;
}

.subhead {
  font-weight: bold;
  font-size: 16px;
  margin-top: 15px;
}

.network-card {
  cursor: pointer;
  transition: border 0.05s;
}

.network-card,
.network-card .card-body,
.network-card img {
  padding: 0;
}



.network-card img {
  height: 100%;
}



@media screen and (min-width: 574px) {
  .amount-card {
    margin-right: 10px;
  }
}
</style>

<script setup>
import {
  mdiMonitorCellphone,
  mdiTableBorder,
  mdiTableOff,
  mdiGithub,
  mdiHospitalBuilding,
  mdiClose,
  mdiCellphoneDock,
  mdiAccountCog,
  mdiAccountCash,
  mdiCurrencyNgn,
  mdiPhone,
  mdiGmail,
  mdiTicketPercent,
  mdiHistory,
} from "@mdi/js";

import FormCheckRadioGroup from "@/Components/FormCheckRadioGroup.vue";
import FormField from "@/Components/FormField.vue";
import FormControl from "@/Components/FormControl.vue";
import SectionMain from "@/Components/SectionMain.vue";
import NotificationBar from "@/Components/NotificationBar.vue";
import CardBox from "@/Components/CardBox.vue";
import LayoutAuthenticated from "@/Layouts/LayoutAuthenticated.vue";
import SectionTitleLineWithButton from "@/Components/SectionTitleLineWithButton.vue";
import BaseDivider from "@/Components/BaseDivider.vue";
import BaseButton from "@/Components/BaseButton.vue";
import BaseButtons from "@/Components/BaseButtons.vue";
import BaseLevel from "@/Components/BaseLevel.vue";
import CardBoxComponentEmpty from "@/Components/CardBoxComponentEmpty.vue";
import CardBoxModal from "@/Components/CardBoxModal.vue";
import FloatingActionButton from "@/Components/FloatingActionButton.vue";
import FloatingTextButton from "@/Components/FloatingTextButton.vue";
import FormLoaderDark from '@/Loaders/form_loader_dark.gif'
import FormLoaderLight from '@/Loaders/form_loader_light.gif'

import { useMainStore } from "@/Stores/main";
import { useForm, usePage, Head, Link, router } from '@inertiajs/vue3'
//import { Inertia } from '@inertiajs/inertia'
import { computed, ref, reactive, watch } from 'vue'
import axios from "axios";
import _ from 'lodash';

const page = usePage();
const props = defineProps({
  user: {
    type: Object
  },
  betting_companies: {
    type: Array
  }
});

console.log(props.betting_companies)

const mainStore = useMainStore();

const btn_hovered = ref(false);

const meterTypeOptions = ref({
  prepaid: 'prepaid',
  postpaid: 'postpaid',

});


const show_other_overlay = ref(false);


const showPreviewTransactionModal = ref(false);

// const hasTermsAndPrivacyPolicyFeature = computed(() => page.props.jetstream?.hasTermsAndPrivacyPolicyFeature)



const useSearchBtn = mainStore.useSearchBtn;


const lengthOptions = ref([
  10,
  20,
  50,
  100
]);



const buy_betting_request = useForm({
  selected_company_index: null,
  company: null,
  id_number: null,
  amount: "",
  customer_name: "",
  payable: null,
  discount: null,
  service: "clubkonnect",

});
const check_disco_availability_request = useForm({
  disco: "",

});

const submit = () => {

};

const proceedWithGsubz = () => {

var selected_company_index = buy_betting_request.selected_company_index;
var disco = buy_betting_request.disco;
var meter_type = buy_betting_request.meter_type;
var id_number = buy_betting_request.id_number;
var amount = buy_betting_request.amount;
var mobile_number = buy_betting_request.mobile_number;

var email = buy_betting_request.email;
var sms_check = buy_betting_request.sms_check;
var customer_name = buy_betting_request.customer_name;
var productCode = buy_betting_request.productCode;
var productToken = buy_betting_request.productToken;
var use_payscribe = buy_betting_request.use_payscribe;


console.log(selected_company_index)
console.log(disco)
console.log(meter_type)
console.log(id_number)
console.log(amount)
console.log(mobile_number)

console.log(email)
console.log(sms_check)
console.log(customer_name)
console.log(productCode)
console.log(productToken)
console.log(use_payscribe)

if(!buy_betting_request.processing){

  buy_betting_request.post(route('purchase_electricity_with_gsubz'), {
    preserveScroll: true,
    onSuccess: (page) => {

      var response = page.props.flash.data;
      console.log(response)

      if (response.success && response.order_id !== "") {
        var order_id = response.order_id;
        var transaction_pending = response.transaction_pending;
        var amount_debited = response.amount_debited;

        var text = "You Have Successfully Credited Your " + meter_type + " <em class='text-primary'>" + props.betting_companies[selected_company_index].name + "</em> With Meter Number: <em class='text-primary'>" + id_number + "</em> Account With <em class='text-primary'>₦" + mainStore.addCommas(amount) + "</em>. You have been debited <em class='text-primary'>₦" + mainStore.addCommas(amount_debited) + "</em>";


        if(meter_type == "prepaid"){
          if(response.metertoken != ""){
            var metertoken = response.metertoken;
            text += " Your Meter Token Is: <em class='text-primary'>"+metertoken+"</em>";


            // if(response.parcels != ""){
            //   text += "<div class='col-12 my-2'>";
            //   for (var i = 0; i < response.parcels.length; i++) {
            //     text += '<h4 class="col-5">'+response.parcels[i].type+'</h4>';

            //     text += '<h4 class="col-6 text-primary italic">'+response.parcels[i].content+'</h4>';

            //   }
            //   text += "</div>";
            // }
          }else{
            text += " Your Meter Token Will be Sent To Your Email And Notification Panel Soon.";
          }
        }


        Swal.fire({
          title: 'Info',
          html: text,
          icon: 'info',
          confirmButtonColor: '#3085d6',
          allowEscapeKey: false,
          allowOutsideClick: false,
        }).then((result) => {
          router.visit(route('electricity_topup'));

        });
      }else if(response.error_msg != ""){
        Swal.fire({
          title: 'Ooops!',
          html: `This transaction could not be completed. See details below. <br> <em class='text-emerald-500'>${response.error_msg}</em>`,
          icon: 'error'
        });
      } else if (response.invalid_meterno) {

        Swal.fire({
          title: 'Ooops!',
          html: "An invalid Meter number was entered. Your Money Has Been Refunded",
          icon: 'error'
        });
      } else if (response.meter_type_not_available) {

        Swal.fire({
          title: 'Ooops!',
          html: "Selected MeterType is not currently available. Your Money Has Been Refunded",
          icon: 'error'
        });
      } else if (response.insuffecient_funds) {

        Swal.fire({
          title: 'Ooops!',
          html: "Sorry You Do Not Have Suffecient Funds To Complete This Transaction.",
          icon: 'error'
        });
      } else {
        Swal.fire({
          title: 'Error',
          html: "Something Went Wrong. Please Try Again",
          icon: 'error'
        });
      }

    }, onError: (errors) => {
      var size = Object.keys(errors).length;
      Swal.fire({
        icon: 'error',
        title: 'Oops...',
        text: `There are ${size} form errors. Please fix them`,
      })
    },
  });

}
};

const proceedWithClub = () => {

  var selected_company_index = buy_betting_request.selected_company_index;
  var company = buy_betting_request.company;
  var id_number = buy_betting_request.id_number;
  var amount = buy_betting_request.amount;

  var customer_name = buy_betting_request.customer_name;



  console.log(selected_company_index)
  console.log(company)

  console.log(id_number)
  console.log(amount)

  console.log(customer_name)


  if(!buy_betting_request.processing){

    buy_betting_request.post(route('purchase_betting_with_club'), {
      preserveScroll: true,
      onSuccess: (page) => {

        var response = page.props.flash.data;
        console.log(response)

        if (response.success && response.order_id !== "") {
          var order_id = response.order_id;

          var amount_debited = response.amount_debited;

          var text = "You Have Successfully Credited Your  <em class='text-primary'>" + props.betting_companies[selected_company_index].name + "</em> Wallet With Id Number: <em class='text-primary'>" + id_number + "</em> Account With <em class='text-primary'>₦" + mainStore.addCommas(amount) + "</em>. You have been debited <em class='text-primary'>₦" + mainStore.addCommas(amount_debited) + "</em>";

          Swal.fire({
            title: 'Info',
            html: text,
            icon: 'info',
            confirmButtonColor: '#3085d6',
            allowEscapeKey: false,
            allowOutsideClick: false,
          }).then((result) => {
            router.visit(route('betting_recharge'));

          });
        }else if(response.error_msg != ""){
          Swal.fire({
            title: 'Ooops!',
            html: `This transaction culd not be completed. See details below. <br> <em class='text-emerald-500'>${response.error_msg}</em>`,
            icon: 'error'
          });
        } else if (response.insuffecient_funds) {

          Swal.fire({
            title: 'Ooops!',
            html: "Sorry You Do Not Have Suffecient Funds To Complete This Transaction.",
            icon: 'error'
          });
        } else {
          Swal.fire({
            title: 'Error',
            html: "Something Went Wrong. Please Try Again",
            icon: 'error'
          });
        }

      }, onError: (errors) => {
        var size = Object.keys(errors).length;
        Swal.fire({
          icon: 'error',
          title: 'Oops...',
          text: `There are ${size} form errors. Please fix them`,
        })
      },
    });

  }
};

const proceedWithPayscribe = () => {

  var selected_company_index = buy_betting_request.selected_company_index;
  var disco = buy_betting_request.disco;
  var meter_type = buy_betting_request.meter_type;
  var id_number = buy_betting_request.id_number;
  var amount = buy_betting_request.amount;
  var mobile_number = buy_betting_request.mobile_number;

  var email = buy_betting_request.email;
  var sms_check = buy_betting_request.sms_check;
  var customer_name = buy_betting_request.customer_name;
  var productCode = buy_betting_request.productCode;
  var productToken = buy_betting_request.productToken;
  var use_payscribe = buy_betting_request.use_payscribe;


  console.log(selected_company_index)
  console.log(disco)
  console.log(meter_type)
  console.log(id_number)
  console.log(amount)
  console.log(mobile_number)

  console.log(email)
  console.log(sms_check)
  console.log(customer_name)
  console.log(productCode)
  console.log(productToken)
  console.log(use_payscribe)

  if(!buy_betting_request.processing){
    buy_betting_request.post(route('purchase_electricity_with_payscribe'), {
      preserveScroll: true,
      onSuccess: (page) => {

        var response = page.props.flash.data;
        console.log(response)

        if (response.success && response.order_id !== "") {
          var order_id = response.order_id;
          var transaction_pending = response.transaction_pending;
          var amount_debited = response.amount_debited;



          var text = "You Have Successfully Credited Your " + meter_type + " <em class='text-primary'>" + props.betting_companies[selected_company_index].name + "</em> With Meter Number: <em class='text-primary'>" + id_number + "</em> Account With ₦" + mainStore.addCommas(amount) + ". You have been debited <em class='text-primary'>₦" + mainStore.addCommas(amount_debited) + "</em>";
          if (transaction_pending) {


            if (meter_type == "prepaid") {
              text += " Note: This Order Is Currently Pending. You Have Been Debited. To See The Status Of Your Transaction And Your Meter Token, Track This Transaction From The Recharge Vtu Transaction History Page";
            } else {
              text += " Note: This Order Is Currently Pending. You Have Been Debited. To See The Status Of Your Transaction, Track This Transaction From The Recharge Vtu Transaction History Page";
            }

          } else {

            if (meter_type == "prepaid") {
              if (response.metertoken != "") {
                var metertoken = response.metertoken;
                text += " Your Meter Token Is: <em class='text-primary'>" + metertoken + "</em>";
              } else {
                text += " Your Meter Token Will be Sent To Your Email And Notification Panel Soon.";
              }
            }
          }

          Swal.fire({
            title: 'Info',
            html: text,
            icon: 'info',
            confirmButtonColor: '#3085d6',
            allowEscapeKey: false,
            allowOutsideClick: false,
          }).then((result) => {
            router.visit(route('electricity_topup'));

          });
        } else if (response.invalid_meterno) {

          Swal.fire({
            title: 'Ooops!',
            html: "An invalid Meter number was entered. Your Money Has Been Refunded",
            icon: 'error'
          });
        } else if (response.meter_type_not_available) {

          Swal.fire({
            title: 'Ooops!',
            html: "Selected MeterType is not currently available. Your Money Has Been Refunded",
            icon: 'error'
          });
        } else if (response.insuffecient_funds) {

          Swal.fire({
            title: 'Ooops!',
            html: "Sorry You Do Not Have Suffecient Funds To Complete This Transaction.",
            icon: 'error'
          });
        } else {
          Swal.fire({
            title: 'Error',
            html: "Something Went Wrong. Please Try Again",
            icon: 'error'
          });
        }

      }, onError: (errors) => {
        var size = Object.keys(errors).length;
        Swal.fire({
          icon: 'error',
          title: 'Oops...',
          text: `There are ${size} form errors. Please fix them`,
        })
      },
    });


}
}

const confirmAndProceedWithTransaction = () => {

  var selected_company_index = buy_betting_request.selected_company_index;
  var disco = buy_betting_request.disco;
  var meter_type = buy_betting_request.meter_type;
  var id_number = buy_betting_request.id_number;
  var amount = buy_betting_request.amount;
  var mobile_number = buy_betting_request.mobile_number;

  var email = buy_betting_request.email;
  var sms_check = buy_betting_request.sms_check;
  var customer_name = buy_betting_request.customer_name;
  var productCode = buy_betting_request.productCode;
  var productToken = buy_betting_request.productToken;
  var use_payscribe = buy_betting_request.use_payscribe;
  var service = buy_betting_request.service;


  console.log(selected_company_index)
  console.log(disco)
  console.log(meter_type)
  console.log(id_number)
  console.log(amount)
  console.log(mobile_number)

  console.log(email)
  console.log(sms_check)
  console.log(customer_name)
  console.log(productCode)
  console.log(productToken)
  console.log(use_payscribe)



    showPreviewTransactionModal.value = true;
    // if(disco == "eko"){
    //   self.proceedWithGsubz();
    // }else{
    // if (use_payscribe) {
    //   proceedWithPayscribe();
    // } else {
    //   proceedWithClub();
    // }
    // }

    // if(service == "payscribe"){
    //   proceedWithPayscribe();
    // }else if(service == "buypower"){
    //   proceedWithClub();
    // }else if(service == "gsubz"){
    //   proceedWithGsubz();
    // }

    proceedWithClub()


};

const verifyBettingDetails = () => {

  var selected_company_index = buy_betting_request.selected_company_index;
  var company = buy_betting_request.company;

  var id_number = buy_betting_request.id_number;
  var amount = buy_betting_request.amount;



  console.log(selected_company_index)

  console.log(id_number)
  console.log(amount)

  if (company == null) {
    Swal.fire({
      title: 'Error!',
      html: "No Company Was Selected. Please Select A Company To Proceed.",
      icon: 'error'
    });

    return;
  }

  if (id_number == "" || id_number == null) {
    Swal.fire({
      title: 'Error!',
      html: "The ID number field cannot be blank. Please enter your ID number to proceed.",
      icon: 'error'
    });

    return;
  }

  if (amount == "" || amount == null) {
    Swal.fire({
      title: 'Error!',
      html: "The amount field cannot be blank. Please enter the amount you want to recharge to proceed.",
      icon: 'error'
    });

    return;
  }



  buy_betting_request.post(route('validate_id_number_betting_company'), {
    preserveScroll: true,
    onSuccess: (page) => {

      var response = page.props.flash.data;
      console.log(response)

      if (response.success && response.customer_name !== "") {
        var proceed = false;
        buy_betting_request.customer_name = response.customer_name;

        Swal.fire({
          title: 'Info',
          icon: 'info',
          html: `Is This Your Name ? <br> <em class='text-center text-primary'>${buy_betting_request.customer_name}</em>`,
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Yes Proceed!',
          cancelButtonText: "No"
        }).then((result) => {
          /* Read more about isConfirmed, isDenied below */
          if (result.isConfirmed) {

            showPreviewTransactionModal.value = true;
          }
        });

      } else if (response.invalid_user) {

        Swal.fire({
          title: 'Error!',
          html: "The Details Entered Were Invalid. Please Try Again.",
          icon: 'error'
        });
      } else {
        Swal.fire({
          title: 'Error',
          html: "Something Went Wrong. Please Try Again",
          icon: 'error'
        });
      }

    }, onError: (errors) => {
      var size = Object.keys(errors).length;
      Swal.fire({
        icon: 'error',
        title: 'Oops...',
        text: `There are ${size} form errors. Please fix them`,
      })
    },
  });


};

const selectedCompany = (index, discount) => {

  if (buy_betting_request.selected_company_index != index) {

      buy_betting_request.selected_company_index = index;
      buy_betting_request.company = props.betting_companies[index].name;
      buy_betting_request.discount = discount;


  }


};

const outputDiscoRowClasses = (index) => {

  var str = "";
  if (buy_betting_request.selected_company_index == index) {
    str += 'col-span-3 sm:col-span-1 col-3 col-sm-1 card disco-card selected';
  } else {
    str += 'col-span-3 sm:col-span-1 col-3 col-sm-1 card disco-card';
  }

  if (index != 0) {
    str += ' offset-1';
  }
  return str;
}


const calculatePayableAmount = computed(() => {
  var amount = buy_betting_request.amount;
  amount += buy_betting_request.sms_check ? props.sms_charge : 0;

  amount = amount - ((buy_betting_request.discount / 100) * amount);

  return parseFloat(amount).toFixed(2);
});
</script>



<template inheritAttrs="false">
  <LayoutAuthenticated>

    <Head :title="`Betting Recharge`" />
    <SectionMain>
      <SectionTitleLineWithButton :icon="mdiTicketPercent" :title="`Betting Recharge`" main>
        <!-- <BaseButton href="https://github.com/justboil/admin-one-vue-tailwind" target="_blank" :icon="mdiGithub"
          label="Star on GitHub" color="contrast" rounded-full small /> -->

        <BaseButton :href="route('user_vtu_history_page') + '?length=10&type=betting&isDirty=true&__rememberable=true'"
          :icon="mdiHistory" label="View His." color="success" rounded-full small />
      </SectionTitleLineWithButton>
      <!-- <NotificationBar color="info" :icon="mdiMonitorCellphone">
        <b>Responsive table.</b> Collapses on mobile
      </NotificationBar> -->



      <CardBox isForm @submit.prevent="verifyBettingDetails" class="">

        <h4 class="subhead">Select Betting Company</h4>

        <div class="mx-2 my-9">
          <div class="grid grid-cols-12 gap-3">

            <!-- <div v-for="(disco,index) in betting_companies" :key="index" :class="outputDiscoRowClasses(index)"
              @click="selectedCompany(index)">
              <div class="card-body text-center">
                <img :src="'/images/'+ disco.image" :alt="disco.name" class="col-12">
                <span v-html="disco.name"></span>
              </div>

            </div> -->

            <template v-for="(company, index) in betting_companies" :key="index">
              <div :class="outputDiscoRowClasses(index)"
                @click="selectedCompany(index, company.discount)"
                class="col-span-2 sm:col-span-1 card operator-card">
                <div class="card-body text-center">
                  <div v-if="company.discount > 0"
                    class="bg-primary rounded-lg mb-2 text-xs px-1 py-1 font-semibold text-white">{{ company.discount
                    }}% discount</div>
                  <img :src="company.image" :alt="company.name" class="">
                  <span class="capitalize" v-html="company.name"></span>
                  <!-- <p>MTN</p> -->
                </div>

              </div>

              <div class="col-span-1">

              </div>

            </template>


          </div>
          <div class="row">
            <div v-if="buy_betting_request.errors.company" class="form-error">{{ buy_betting_request.errors.company }}</div>
          </div>
        </div>



        <h4 class="subhead my-5">Your Id Number</h4>

        <FormField class="" label="">
          <FormControl v-model="buy_betting_request.id_number" :error="buy_betting_request.errors.id_number"
             type="text" id="id_number" placeholder="e.g 45062872259" />
        </FormField>

        <h4 class="subhead my-5">Amount</h4>

        <FormField class="" label="">
          <FormControl v-model="buy_betting_request.amount" :error="buy_betting_request.errors.amount"
            type="number" :icon="mdiCurrencyNgn" id="amount" placeholder="In Naira(₦)" />
        </FormField>



        <button :class="buy_betting_request.processing ? 'opacity-80 cursor-not-allowed' : ''"
          @mouseleave="btn_hovered = false" @mouseover="btn_hovered = true" type="submit"
          class="app-form-button mt-9 text-left pl-6">
          Continue
          <img v-if="buy_betting_request.processing" class="inline-block w-7 h-6 float-right"
            :src="btn_hovered ? FormLoaderDark : FormLoaderLight" alt="">
        </button>
      </CardBox>

      <CardBoxModal v-model="showPreviewTransactionModal" button="danger" buttonLabel="Close"
        :title="`Preview Transaction`">
        <div class="">
          <div class="text-center">
            <p>Kindly confirm that the details you entered are valid before clicking the "Confirm" button.</p>

          </div>

          <div class="">
            <table class="table table-bordered ">
              <tbody v-if="buy_betting_request.company != null">
                <tr>
                  <td>COMPANY</td>
                  <td><em v-html="buy_betting_request.company" class="text-primary"></em></td>
                </tr>

                <tr>
                  <td>ID NUMBER</td>
                  <td><em v-html="buy_betting_request.id_number" class="text-primary"></em></td>
                </tr>

                <tr>
                  <td>AMOUNT</td>
                  <td><em v-html="'₦ ' + mainStore.addCommas(buy_betting_request.amount)" class="text-primary"></em></td>
                </tr>

                <tr>
                  <td>CUSTOMER NAME</td>
                  <td><em v-html="buy_betting_request.customer_name" class="text-primary"></em></td>
                </tr>




                <tr>
                  <td>DISCOUNT</td>
                  <td><em v-html="`${buy_betting_request.discount}%`" class="text-primary"></em></td>

                </tr>

                <tr>
                  <td>PAYABLE</td>
                  <td><em v-html="'₦ ' + mainStore.addCommas(calculatePayableAmount)" class="text-primary"></em></td>
                </tr>
              </tbody>
            </table>
          </div>

          <div class="justify-content-center text-center">

            <BaseButton @click="confirmAndProceedWithTransaction" class="" label="Confirm" color="success" rounded />
            <br>
            <p class="text-red-500 cursor-pointer" @click="showPreviewTransactionModal = false">Cancel and return</p>
          </div>
        </div>

      </CardBoxModal>
    </SectionMain>

  </LayoutAuthenticated>

</template>
