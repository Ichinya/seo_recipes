<template>
  <div class="relative">
    <span
        class="text-xs leading-5 font-semibold bg-slate-400/10 rounded-full py-1 px-3 flex items-center space-x-2 hover:bg-slate-400/20 dark:highlight-white/5"
        id="headlessui-menu-button-1">
    v {{ version }}
    </span>
  </div>
</template>

<script lang="ts">
export default defineComponent({
  async setup() {
    const [{ data: tags }] = await Promise.all([
      useFetch(`https://api.github.com/repos/ichinya/seo_recipes/git/refs/tags`)
    ])

    let tag = tags.value[tags.value.length - 1]
    let version = tag.ref.split('/').pop()

    return { version }
  }
})
</script>
