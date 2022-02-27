<script setup>
import CreateComment from './comments/CreateComment.vue';
import CommentsList from './comments/CommentsList.vue';
</script>

<template>
<div class="mt-10">
  <div class="border-b border-gray-300 my-2"></div>

  <h2 class="text-center font-bold">Comments</h2>

  <div class="border-b border-gray-300 my-2"></div>

  <CreateComment></CreateComment>

  <div class="border-b border-gray-300 my-2"></div>

  <CommentsList></CommentsList>
</div>
</template>