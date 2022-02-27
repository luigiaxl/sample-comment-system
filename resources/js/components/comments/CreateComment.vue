<script setup>
import { reactive } from 'vue';
import { useCommentsStore } from '../../comment.store';

const store = useCommentsStore();

const form = reactive({
  name: '',
  content: '',
})

const clearForm = () => {
  form.name = ''
  form.content = ''
}

const attemptCreateComment = () => {
  const data = {...form}

  store.postComment(data)

  clearForm()
}
</script>

<template>
<div>
  <h3 class="text-sm font-bold mt-2">Leave A Comment</h3>

  <form @submit.prevent="attemptCreateComment">
    <div class="mt-2">
      <input
        type="text"
        placeholder="Your name"
        class="w-full rounded border p-2"
        v-model="form.name"
      >
    </div>

    <div class="mt-2">
      <textarea
        rows="4"
        class="bg-white rounded border w-full p-2"
        placeholder="Your thoughts?"
        v-model="form.content"
      ></textarea>
    </div>

    <div>
      <input
        type="submit"
        value="Send"
        class="bg-blue-600 rounded px-2 py-1 w-full text-white cursor-pointer transition-colors hover:bg-blue-800"
      >
    </div>
  </form>
</div>
</template>