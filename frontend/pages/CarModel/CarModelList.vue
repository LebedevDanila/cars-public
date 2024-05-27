<script setup>
import { isSuccessResponse } from '~/helpers/isSuccessResponse.js'
import { getResponseData } from '~/helpers/getResponseData.js'

definePageMeta({
  layout: 'empty',
})

const status = ref(1)
const list = ref([])

const fetchData = async () => {
  const modelsReq = await useFetch(`/api/admin/car/model/list`)
  if (isSuccessResponse(modelsReq, true)) {
    list.value = getResponseData(modelsReq, true)
  }
}
await fetchData()

const remove = async (id) => {
  if (!confirm('Вы уверены?')) {
    return false
  }

  await $fetch('/api/admin/car/model/delete', {
    method: 'POST',
    body: { id },
  })

  list.value = list.value.filter((item) => item.id !== id)
}
</script>

<template>
  <div class="admin-content">
    <h1 class="admin-h1">Список моделей авто</h1>
    <div class="admin-field">
      <div class="admin-list __SMALL" v-if="list.length">
        <div class="admin-list__elem" v-for="(item, key) in list" :key="key">
          <span class="title">{{ item.name }}</span>
          <div class="group">
            <NuxtLink
              class="action admin-btn __GET"
              :to="`/car/model/${item.link}`"
              >Перейти</NuxtLink
            >
            <NuxtLink
              class="action admin-btn __UPDATE"
              :to="`/admin/car/model/${item.id}`"
              >Обновить</NuxtLink
            >
            <div class="action admin-btn __DELETE" @click="remove(item.id)">
              Удалить
            </div>
          </div>
        </div>
      </div>
      <div class="admin-empty" v-else>Пусто</div>
    </div>
  </div>
</template>

<style lang="scss">
@import '@/assets/css/admin.scss';
</style>
