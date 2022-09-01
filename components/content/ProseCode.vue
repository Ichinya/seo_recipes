<script lang="ts">
import { defineComponent } from '#imports'

export default defineComponent({
  props: {
    code: {
      type: String,
      default: ''
    },
    language: {
      type: String,
      default: null
    },
    filename: {
      type: String,
      default: null
    },
    highlights: {
      type: Array as () => number[],
      default: () => []
    }
  }
})
</script>

<template>
  <div class="relative">
    <div class="absolute mr-4 mt-2 right-0 text-slate-400 top-0">{{ filename }}</div>
    <slot/>
  </div>
</template>

<style>
pre code .line {
  display: block;
  min-height: 1rem;
}

pre code .highlight {
  border-radius: 0.25rem;
  padding: 0.125rem 0.1875rem;
  margin: 0 -0.1875rem;
  background-color: rgb(125 211 252/.1);
}
</style>
