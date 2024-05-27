<script setup>
const props = defineProps({
  title: String,
})
const { title } = props
</script>

<template>
  <div class="section-head">
    <div class="section-head__inner d-flex">
      <div class="section-head__inner-left">
        <div class="section-title">{{ title }}</div>
      </div>
    </div>
  </div>
</template>
