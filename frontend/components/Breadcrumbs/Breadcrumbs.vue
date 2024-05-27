<script setup>
const props = defineProps({
  pages: Array,
})
const { pages } = props
const lastPage = pages?.pop()
</script>

<template>
  <div class="breadcrumbs">
    <div class="container">
      <ul class="breadcrumbs-list flex">
        <li class="breadcrumbs-list__item" v-for="page in pages">
          <NuxtLink class="breadcrumbs-list__link" :to="page.link">{{
            page.name
          }}</NuxtLink>
        </li>
        <li class="breadcrumbs-list__item">{{ lastPage?.name }}</li>
      </ul>
    </div>
  </div>
</template>
<style scoped lang="scss">
@import './css/breadcrumbs.scss';
</style>
