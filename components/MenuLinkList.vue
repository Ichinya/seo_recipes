<template>
  <li>
    <h5 class="mb-2 mt-8 lg:mb-3 font-semibold text-slate-900 dark:text-slate-200">{{ links.title }}</h5>
    <ul class="space-y-6 lg:space-y-2 border-l border-slate-100 dark:border-slate-800">
      <li v-for="link of links.children" :key="link._path"
          :class="'text-slate-700 dark:text-slate-400'">
        <NuxtLink :to="link._path"
                  :active-class="'block border-l pl-4 -ml-px text-sky-500 border-current font-semibold dark:text-sky-400'"
                  class="block border-l pl-4 -ml-px border-transparent hover:border-slate-400 dark:hover:border-slate-500 hover:text-slate-900 dark:hover:text-slate-300">
          {{ link.title }}
        </NuxtLink>
      </li>
    </ul>
  </li>
</template>

<script>
export default {
  name: "MenuLinkList",
  props: ['links'],
}
</script>

<style scoped>

</style>
