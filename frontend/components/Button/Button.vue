<script setup>
const props = defineProps({
  title: String,
  handler: Function,
})
const { title, handler } = props
</script>

<template>
  <a class="btn" @click="handler">{{ title }}</a>
</template>
