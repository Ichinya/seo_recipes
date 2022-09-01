<script setup>
import {useRoute} from "nuxt/app";

const { path } = useRoute();

defineProps({
  src: {
    type: String,
    required: true,
  },
  alt: {
    type: String,
    default: ''
  },
})


</script>
<template>
  <div class="">
    <nuxt-img :src="`/${path}/${src}`" :alt="alt ?? src"/>
  </div>
</template>
