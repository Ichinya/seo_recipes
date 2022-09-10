<script setup lang="ts">
// define links prop
defineProps(["links"]);

// flatten TOC links nested arrays to one array
const flattenLinks = (links) => {
  if (!links)
    return
  let _links = links
      .map((link) => {
        let _link = [link];
        if (link.children) {
          let flattened = flattenLinks(link.children);
          _link = [link, ...flattened];
        }
        return _link;
      })
      .flat(1);

  console.log({ _links });

  return _links;
};
</script>

<template>
  <nav class="fixed z-20 top-[3.8125rem] bottom-0 right-0 w-[19.5rem] py-10 px-8 overflow-y-auto hidden xl:block">
    <header class="toc-header">
      <h3 class="text-xl font-bold">Содержание</h3>
    </header>
    <ul class="toc-links">
      <!-- render each link with depth class -->
      <li v-for="link of flattenLinks(links)" :key="link.id" :class="`toc-link _${link.depth}`">
        <a :href="`#${link.id}`">
          {{ link.text }}
        </a>
      </li>
    </ul>
  </nav>
</template>

<style scoped>
</style>
