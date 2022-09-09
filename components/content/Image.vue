<template>
  <div class="">
    <img :src="srcImage" :alt="alt ?? src"/>
  </div>
</template>
<script>
import {useRoute} from "nuxt/app";

const { path } = useRoute();

export default {
  props: ['alt', 'src'],
  computed: {
    srcImage() {
      return `/images${path}/${this.src}`
    }
  }
}


</script>
