<script setup>
// import icons
// define prev and next props
defineProps(["prev", "next"]);
</script>

<template>


  <div class="text-sm leading-6 mt-12">
    <div class="mb-10 text-slate-700 font-semibold flex items-center dark:text-slate-200">
      <NuxtLink v-if="prev" :to="prev._path" class="group flex items-center hover:text-slate-900 dark:hover:text-white">
        <svg viewBox="0 0 3 6"
             class="mr-3 w-auto h-1.5 text-slate-400 overflow-visible group-hover:text-slate-600 dark:group-hover:text-slate-300">
          <path d="M3 0L0 3L3 6" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                stroke-linejoin="round">
          </path>
        </svg>
        {{ prev.title }}
      </NuxtLink>
      <NuxtLink v-if="next" :to="next._path"
                class="group ml-auto flex items-center hover:text-slate-900 dark:hover:text-white">
        {{ next.title }}
        <svg viewBox="0 0 3 6"
             class="ml-3 w-auto h-1.5 text-slate-400 overflow-visible group-hover:text-slate-600 dark:group-hover:text-slate-300">
          <path d="M0 0L3 3L0 6" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                stroke-linejoin="round">
          </path>
        </svg>
      </NuxtLink>
    </div>
  </div>

</template>
