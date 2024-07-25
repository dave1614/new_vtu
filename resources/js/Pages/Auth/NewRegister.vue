<script setup>
import { useForm, usePage, Head, Link, router } from '@inertiajs/vue3'
import { computed, ref } from 'vue'
import { mdiAccount, mdiEmail, mdiFormTextboxPassword } from '@mdi/js'
import LayoutGuest from '@/Layouts/LayoutGuest.vue'
import SectionFullScreen from '@/Components/SectionFullScreen.vue'
import CardBox from '@/Components/CardBox.vue'
import FormCheckRadioGroup from '@/Components/FormCheckRadioGroup.vue'
import FormField from '@/Components/FormField.vue'
import FormControl from '@/Components/FormControl.vue'
import BaseDivider from '@/Components/BaseDivider.vue'
import BaseButton from '@/Components/BaseButton.vue'
import BaseButtons from '@/Components/BaseButtons.vue'
import FormValidationErrors from '@/Components/FormValidationErrors.vue'
// import Logo from '@/Icons/onehealth_logo_icon.svg'
import Logo from '@/Icons/easybizu_logo.jpeg'
import GoogleIcon from '@/Icons/google_icon.svg'
import FacebookIcon from '@/Icons/facebook_icon.svg'
import AppleIcon from '@/Icons/apple_icon.svg'
import FacilityIcon from '@/Icons/facility_icon.svg'
import PatientIcon from '@/Icons/patient_icon.svg'
import LoginInput from '@/Components/LoginInput.vue'
import FormLoaderDark from '@/Loaders/form_loader_dark.gif'
import FormLoaderLight from '@/Loaders/form_loader_light.gif'
import FlashMessages from '@/Components/FlashMessages.vue'

import SecondLoginImage from '@/Images/second_login.jpg'

const props = defineProps({
  prop_referral_id: {
	type: Number,
    default: 0,
  }
});



const page = usePage()
const hasTermsAndPrivacyPolicyFeature = computed(() => page.props.jetstream?.hasTermsAndPrivacyPolicyFeature)



const login_btn_hovered = ref(false);

const form = useForm({
  name: null,
  user_name: null,
  email: null,
  // country: 1,
  phone: null,
  password: null,
  password_confirmation: null,
})


const submit = () => {

  if (!form.processing) {
    let url = props.prop_referral_id == 0 ? route('register') : route('register') + '?id='+props.prop_referral_id;
    form.post(url, {
      preserveScroll: true,
      onSuccess: (page) => {

        var response = page.props.flash.data;
        if (response.success) {

        }
        else {
          Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: 'Something went wrong.',
          })
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


</script>

<template>
  <LayoutGuest class="font-nunito">

    <Head title="Create a new cosrosmos account" />

    <SectionFullScreen v-slot="{ cardClass }" bg="" class="bg-gradient-to-r from-gray-200 to-gray-300">


      <div class="w-full mx-3 sm:w-11/12 my-5 rounded-[17px] shadow-lg bg-white sm:px-1 py-1">
        <div class="bg-white rounded-[20px]">

          <div class="sm:grid sm:grid-cols-12 sm:gap-6">

            <div class="px-4 sm:px-[80px] py-8 sm:col-span-6 text-black">
              <!-- <p class="float-right text-xs font-bold ">Not a member?
                <Link :href="route('register')" class="text-blue-400 hover:underline">Register now</Link>
              </p> -->
              <div class="logo-icon mt-[10px]">
                <span class="text-black font-bold text-sm">Cosrosmos</span>
              </div>
              <h4 class="text-black font-extrabold text-3xl my-2 capitalize mt-[30px]">Registration</h4>
              <p class="text-gray-400 text-sm">Create your free account</p>



              <form @submit.prevent="submit" class="pt-1 mt-[20px]">
                <flash-messages />
                <div class="">


                  <login-input v-model="form.name" :error="form.errors.name" type="text" id="name"
                    placeholder="Full Name" class="" />

                  <login-input v-model="form.user_name" :error="form.errors.user_name" type="text"
                    placeholder="Username" id="user_name" class="" />

                  <login-input v-model="form.email" :error="form.errors.email" type="email" placeholder="Email Address"
                    id="email" class="" />


                  <login-input v-model="form.phone" :error="form.errors.phone" type="number" placeholder="Phone Number"
                    id="phone" class="" />


                  <login-input v-model="form.password" :error="form.errors.password" type="password"
                    placeholder="Password" id="password" class="" />

                  <login-input v-model="form.password_confirmation" :error="form.errors.password_confirmation"
                    type="password" placeholder="Confirm Password" id="password_confirmation" class="mb-6" />





                </div>
                <div class="mt-2 px-1">



                </div>
                <!-- <div class="mt-4 mb-3 px-1">
                  <div class="inline-block">
                    <input type="checkbox" name="remember_me" class="login-checkbox" id="terms"
                    v-model="form.remember_me" />
                    <label for="terms" class="login-checkbox-label text-gray-400">Remember me</label>
                  </div>

                  <Link :href="route('password.request')"
                    class="login-checkbox-label mt-1 float-right hover:text-primary text-slate-700 hover:underline">
                  Forgot Password?
                  </Link>
                </div> -->

                <button name="login-btn" :class="form.processing ? 'opacity-80 cursor-not-allowed' : ''"
                  @mouseleave="login_btn_hovered = false" @mouseover="login_btn_hovered = true" type="submit"
                  class="login-button mt-[30px]">
                  Register
                  <img v-if="form.processing" class="inline-block w-7 h-6 float-right"
                    :src="login_btn_hovered ? FormLoaderDark : FormLoaderLight" alt="">
                </button>

                <p class=" text-xs font-bold mt-[40px]">Already registered?
                    <Link :href="route('login')" class="text-primary hover:underline">Login now</Link>
                </p>

                <!-- <div class="grid grid-cols-11 gap-2 mt-4">
                  <div class="col-span-4 bg-white h-[1px] mt-[8px]"></div>
                  <span class="col-span-3 text-xs text-slate-600">Or continue with</span>
                  <div class="col-span-4 bg-white h-[1px] mt-[8px]"></div>
                </div> -->

                <!-- <div class="py-2 grid grid-cols-12 gap-6">
                  <div
                    class="col-span-4 px-2 py-2 border border-white h-[40px] rounded cursor-pointer hover:bg-white transition ease-in-out duration-500">
                    <img :src="GoogleIcon" alt="" class="w-full h-full">
                  </div>

                  <div
                    class="col-span-4 px-2 py-2 border border-white h-[40px] rounded cursor-pointer hover:bg-white transition ease-in-out duration-500">
                    <img :src=" FacebookIcon" alt="" class="w-full h-full">
                  </div>

                  <div
                    class="col-span-4 px-2 py-2 border border-white h-[40px] rounded cursor-pointer hover:bg-white transition ease-in-out duration-500">
                    <img :src=" AppleIcon" alt="" class="w-full h-full">
                  </div>

                </div> -->



              </form>
            </div>

            <div
              class="sm:col-span-6 sm:block hidden bg-login-left-background bg-cover bg-no-repeat bg-center rounded-[16px] min-h-[500px]">
              <!-- <img :src="SecondLoginImage" alt="" class="w-full h-full rounded-[30px]"> -->
            </div>


          </div>


        </div>
      </div>

    </SectionFullScreen>
  </LayoutGuest>
</template>
