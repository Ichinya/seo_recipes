<script setup>
const { path } = useRoute();

const { data } = await useAsyncData(`content-${path}`, async () => {
  let article = queryContent().where({ _path: path }).findOne();
  let surround = queryContent().only(["_path", "title", "description"]).sort({ date: 1 }).findSurround(path);

  return {
    article: await article,
    surround: await surround,
  };
});
// destrucure `prev` and `next` value from data
console.log(typeof data?.value?.surround)
let prev, next
if (typeof data?.value?.surround != "undefined") {
  [prev, next] = data.value.surround;
}
</script>
<template>
  <div class="max-w-8xl mx-auto px-4 sm:px-6 md:px-8">
    <SiteBar/>
    <main class="lg:pl-[19.5rem]">
      <article class="prose max-w-3xl mx-auto pt-10 xl:max-w-none xl:ml-0 xl:mr-[15.5rem] xl:pr-16">
        <ContentDoc/>

        <!-- PrevNext Component -->
        <PrevNext :prev="prev" :next="next"/>
      </article>

      <SiteFooter/>
      <Toc :links="data?.article?.body?.toc?.links"/>
    </main>
  </div>
</template>
