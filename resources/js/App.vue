<script setup>
import BlogTitle from './components/BlogTitle.vue'
import BlogContent from './components/BlogContent.vue'
import BlogComments from './components/BlogComments.vue'
</script>

<template>
<main>
  <div class="content m-2 md:mx-auto">
    <BlogTitle></BlogTitle>
    <BlogContent></BlogContent>
    <BlogComments></BlogComments>
  </div>
</main>
</template>

<style scoped>
.content {
  max-width: 750px;
}
</style>