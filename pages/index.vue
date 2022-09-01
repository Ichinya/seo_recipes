<template>
  <main class="">
    <section class="hero-section">
      <header class="prose w-full max-w-full prose-xl">
        <h1 class="font-black text-6xl mt-0 mb-2">SEO Рецепты</h1>
        <h2 class="m-2">Книга рецептов по SEO</h2>
        <ul class="">
          <li>Теория, где можно узнать некоторые вещи, например, про санкции поисковых систем</li>
          <li>Различные практики по поисковой оптимизации</li>
          <li>Инструкции по установке и настройки. Например, установка рекламы РСЯ</li>
          <li>Рецепты установки различных модулей, например,
            <nuxt-link :to="'mediawiki/sitemap'">карта сайта для сайта на движке MediaWiki</nuxt-link>
          </li>
        </ul>
        <p class="">Также свои статьи можно добавлять на проект расположенный на
          <nuxt-link href="https://github.com/Ichinya/seo_book" target="_blank" :external="true">GitHub</nuxt-link>. Статьи будут добавлены с подписью автора и его ссылкой.
        </p>
      </header>
    </section>
  </main>
</template>

<style scoped>
.hero-section {
  @apply flex items-center justify-center text-center w-full h-screen bg-slate-50 text-slate-700;
}
</style>
