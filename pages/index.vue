<!-- ./pages/index.vue -->
<template>
  <main>
    <section class="hero-section">
      <header>
        <h1 class="font-black text-8xl">SEO Book</h1>
        <p>Книга рецептов по SEO:</p>

        <ul>
          <li>Теория, где можно узнать некоторые вещи, например, про санкции поисковых систем</li>
          <li>Различные практики по поисковой оптимизации</li>
          <li>Инструкции по установке и настройки. Например, установка рекламы РСЯ</li>
        </ul>
        <p>Также свои статьи можно добавлять на проект расположенный на <a href="https://github.com/Ichinya/seo_book" target="_blank">GitHub</a>. Статьи будут добавлены с подписью автора и его ссылкой.</p>
      </header>
    </section>
  </main>
</template>

<style scoped>
.hero-section {
  @apply flex items-center justify-center text-center w-full h-screen bg-slate-50 text-slate-700;
}
</style>
