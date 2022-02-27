<script setup>
import { onMounted, reactive, ref } from 'vue';
import { useCommentsStore } from '../../comment.store';
import moment from 'moment';

import CommentItem from './CommentItem.vue';

const props = defineProps({
  comment: Object
})

const showReplyForm = ref(false)
const form = reactive({
  name: '',
  content: '',
})

const store = useCommentsStore()

onMounted(() => {
  store.getReplies(props.comment)
})

const attemptSubmitReply = () => {
  store.postReply(props.comment, {...form})
  form.name = ''
  form.content = ''
  showReplyForm.value = false
}
</script>

<template>
<li>
  <div
    class="p-2"
    :style="{
      marginLeft: ((comment.level + 1) * 20) + 'px'
    }"
  >
    <div class="text-sm">
      <span>{{ comment.name }}</span>
      <span class="mx-2">&#149;</span>
      <span class="text-gray-400">{{ moment(comment.created_at).fromNow() }}</span>
    </div>
    
    <div class="mt-2">
      <p>{{ comment.content }}</p>
    </div>

    <div class="mt-1" v-if="!comment.level || comment.level < 2">
      <button
        class="transition-colors hover:bg-gray-400 text-gray-600 hover:text-white border rounded text-sm px-1"
        @click="showReplyForm = !showReplyForm"
      >Reply</button>
    </div>

    <div class="m-2 border rounded" v-if="showReplyForm">
      <form @submit.prevent="attemptSubmitReply">
        <input
          type="text"
          class="text-sm px-2 border-b w-full m-0 bg-white"
          placeholder="Your name"
          v-model="form.name"
        >
        <textarea
          rows="2"
          class="text-sm px-2 w-full bg-white"
          placeholder="Enter your reply here..."
          v-model="form.content"
        ></textarea>
        <div class="bg-gray-200 p-1 flex justify-end">
          <input
            type="submit"
            value="Send"
            class="text-sm bg-gray-400 text-white px-2 rounded cursor-pointer"
          >
        </div>
      </form>
    </div>
  </div>

  <ul>
    <CommentItem
      v-for="(reply) in comment.comments"
      :key="'reply-' + reply.id"
      :comment="reply"
      class="border-t"
    ></CommentItem>
  </ul>
</li>
</template>