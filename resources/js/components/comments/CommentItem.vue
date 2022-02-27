<script setup>
const props = defineProps({
  comment: Object
})
</script>

<template>
<li>
  <div class="p-2">
    <div class="text-sm">
      <span>{{ comment.name }}</span>
      <span class="mx-2">&#149;</span>
      <span class="text-gray-400">{{ comment.created_at }}</span>
    </div>
    
    <div class="mt-2">
      <p>{{ comment.content }}</p>
    </div>

    <div class="mt-1">
      <button class="transition-colors hover:bg-gray-400 text-gray-600 hover:text-white border rounded text-sm px-1">Reply</button>
    </div>
  </div>
</li>
</template>