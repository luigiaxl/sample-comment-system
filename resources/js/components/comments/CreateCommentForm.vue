<template>
<div>
  <h3 class="text-sm font-bold mt-2">Leave A Comment</h3>

  <form @submit.prevent>
    <div class="mt-2">
      <input
        type="text"
        placeholder="Your name"
        class="w-full rounded border p-2"
      >
    </div>

    <div class="mt-2">
      <textarea
        rows="4"
        class="bg-white rounded border w-full p-2"
        placeholder="Your thoughts?"
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