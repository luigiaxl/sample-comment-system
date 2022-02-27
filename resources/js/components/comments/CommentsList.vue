<script setup>
import { computed, onMounted } from 'vue';
import { useCommentsStore } from '../../comment.store';

import CommentItem from './CommentItem.vue';

const store = useCommentsStore();

const comments = computed(() => store.comments);

onMounted(() => {
  store.getComments();
})
</script>

<template>
<div>
  <h3 class="text-sm font-bold mt-2">User Comments</h3>

  <div class="bg-white rounded border">
    <ul>
      <CommentItem
        v-for="(comment, i) in comments"
        :key="'comment-' + comment.id"
        :comment="comment"
        :class="{
          'border-t': i > 0
        }"
      ></CommentItem>
    </ul>
  </div>
</div>
</template>