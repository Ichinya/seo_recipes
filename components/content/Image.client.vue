<template>
  <span class="">
    <img :src="srcImage" :alt="alt ?? src"/>
  </span>
</template>
<script lang="ts">
export default {
  props: ['alt', 'src'],
  computed: {
    srcImage() {
      return `/images${this.$route.path}/${this.src}`
    }
  }
}
</script>
