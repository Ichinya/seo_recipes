<template>
  <div>
    <SiteHeader/>
    <div>
        <NuxtPage/>
    </div>
  </div>
</template>
<script>
import SiteBar from "./components/SiteBar";
import SiteFooter from "./components/SiteFooter";

export default {
  components: { SiteFooter, SiteBar }
}
</script>
