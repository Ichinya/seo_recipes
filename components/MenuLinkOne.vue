<template>
  <div class="text-slate-700 hover:text-slate-900 dark:text-slate-400 dark:hover:text-slate-300">
    <NuxtLink :to="link._path"
              :active-class="'block border-l pl-4 -ml-px text-sky-500 border-current font-semibold dark:text-sky-400'"
              class="group flex items-center lg:text-sm lg:leading-6 mb-4 font-medium">
      <div v-if="link.icon"
           class="w-6 h-6 text-center mr-4 place-content-center rounded-md ring-1 ring-slate-900/5 shadow-sm group-hover:shadow group-hover:ring-slate-900/10 dark:ring-0 dark:shadow-none dark:group-hover:shadow-none dark:group-hover:highlight-white/10 group-hover:shadow-purple-200 dark:group-hover:bg-purple-400 dark:bg-slate-800 dark:highlight-white/5">
        <span>{{ link.icon }}</span>
      </div>
      {{ link.title }}
    </NuxtLink>
  </div>
</template>

<script>
export default {
  name: "MenuLinkOne",
  props: ['link'],
}
</script>

<style scoped>

</style>
