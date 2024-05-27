<script setup>
import { isSuccessResponse } from '~/helpers/isSuccessResponse.js'
import { getResponseData } from '~/helpers/getResponseData.js'

definePageMeta({
  layout: 'empty',
})

const status = ref(1)
const list = reactive({
  public: [],
  hidden: [],
})

const getCurrentList = (status) =>
  status === true || status === 1 ? 'public' : 'hidden'

const fetchData = async () => {
  const brandsReq = await useFetch(`/api/admin/brand/list`)
  if (isSuccessResponse(brandsReq, true)) {
    const brandsRes = getResponseData(brandsReq, true)
    brandsRes.forEach((item) => list[getCurrentList(item.status)].push(item))
  }
}
await fetchData()

const remove = async (id) => {
  if (!confirm('Вы уверены?')) {
    return false
  }

  await $fetch('/api/admin/brand/delete', {
    method: 'POST',
    body: { id },
  })

  const currentList = getCurrentList(status.value)
  list[currentList] = list[currentList].filter((item) => item.id !== id)
}

const switchStatus = async (id, status) => {
  await $fetch('/api/admin/brand/upsert', {
    method: 'POST',
    body: { id, status },
  })

  const sourceArray = status ? list.hidden : list.public
  const targetArray = status ? list.public : list.hidden

  const index = sourceArray.findIndex((item) => item.id === id)
  targetArray.unshift(sourceArray[index])
  sourceArray.splice(index, 1)
}
</script>

<template>
  <div class="admin-content">
    <h1 class="admin-h1">Список брендов</h1>
    <div class="admin-tabs">
      <span @click="status = 1" :class="{ __ACTIVATED: status === 1 }"
        >Опубликованные</span
      >
      <span @click="status = 0" :class="{ __ACTIVATED: status === 0 }"
        >Скрытые</span
      >
    </div>
    <div class="admin-field">
      <div
        class="admin-list __SMALL"
        v-if="list[getCurrentList(status)].length"
      >
        <div
          class="admin-list__elem"
          v-for="(item, key) in list[getCurrentList(status)]"
          :key="key"
        >
          <span class="title">{{ item.name }}</span>
          <div class="group" v-if="status === 1">
            <NuxtLink class="action admin-btn __GET" :to="`/brand/${item.link}`"
              >Перейти</NuxtLink
            >
            <NuxtLink
              class="action admin-btn __UPDATE"
              :to="`/admin/brand/${item.id}`"
              >Обновить</NuxtLink
            >
            <div
              class="action admin-btn __HIDE"
              @click="switchStatus(item.id, false)"
            >
              Скрыть
            </div>
          </div>
          <div class="group" v-else>
            <NuxtLink
              class="action admin-btn __UPDATE"
              :to="`/admin/brand/${item.id}`"
              >Обновить</NuxtLink
            >
            <div
              class="action admin-btn __APPROVE"
              @click="switchStatus(item.id, true)"
            >
              Одобрить
            </div>
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
