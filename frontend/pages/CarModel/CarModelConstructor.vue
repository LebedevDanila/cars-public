<script setup>
import { isSuccessResponse } from '~/helpers/isSuccessResponse.js'
import { getResponseData } from '~/helpers/getResponseData.js'

definePageMeta({
  layout: 'empty',
})

const route = useRoute()

const state = reactive({
  id: route.params.id ? Number(route.params.id) : null,
  image_id: null,
  image_path: null,
  name: '',
  link: '',
  meta_title: '',
  meta_description: '',
  meta_keywords: '',
})
const uploadImageInput = ref(null)
const pageTitle = `${state.id === null ? 'Создание' : 'Редактирование'} модели авто`

useHead({
  title: pageTitle,
})

const fetchData = async () => {
  if (state.id === null) {
    return false
  }

  const modelReq = await useFetch(`/api/car/model/get?id=${state.id}`)
  const modelRes = getResponseData(modelReq, true)
  if (!isSuccessResponse(modelReq, true)) {
    throw createError({
      statusCode: 404,
      statusMessage: modelRes,
    })
  }

  Object.entries(modelRes).forEach(([key, value]) => {
    if ((key === 'meta' || key === 'image') && value !== null) {
      Object.entries(value).forEach(
        ([innerKey, innerValue]) => (state[`${key}_${innerKey}`] = innerValue),
      )
    } else {
      state[key] = value
    }
  })
}
await fetchData()

const validate = () => {
  if (state.name === '') {
    alert('Поле Название не заполнено')
    return false
  }
  if (state.image_id === null) {
    alert('Изображение не загружено')
    return false
  }

  return true
}

const submit = async () => {
  if (!validate()) return

  const upsertReq = await $fetch('/api/admin/car/model/upsert', {
    method: 'POST',
    body: state,
  })
  if (isSuccessResponse(upsertReq)) {
    const upsertRes = getResponseData(upsertReq)
    window.location.href = `/admin/car/model/${upsertRes.id}`
  }
}

const triggerUploadImageInput = () => {
  uploadImageInput.value.click()
}
const uploadImage = async (e) => {
  const formData = new FormData()
  formData.append('file', e.target.files[0])
  const imageReq = await $fetch('/api/admin/image/upload', {
    method: 'POST',
    body: formData,
  })
  if (!isSuccessResponse(imageReq)) {
    return alert('Не получилось загрузить изображение')
  }
  const imageRes = getResponseData(imageReq)
  state.image_id = imageRes.id
  state.image_path = imageRes.path
}
</script>

<template>
  <div class="admin-content">
    <h1 class="admin-h1">{{ pageTitle }}</h1>
    <div class="admin-mainColumn">
      <div class="admin-mainCover" @click="triggerUploadImageInput">
        <img :src="state.image_path" alt="image" v-if="state.image_path" />
        <div class="empty" v-else>Загрузить изображение</div>
        <input
          type="file"
          accept="image/*"
          style="display: none"
          ref="uploadImageInput"
          @change="uploadImage"
        />
      </div>
      <div>
        <div class="admin-field">
          <label>Название*:</label>
          <input type="text" placeholder="Haval" v-model="state.name" />
        </div>
        <div class="admin-field">
          <label>Имя ссылки:</label>
          <input
            type="text"
            placeholder="Если не заполнено, переводится из названия латиницой"
            v-model="state.link"
          />
        </div>
      </div>
    </div>
    <div class="admin-field">
      <label>Seo Title:</label>
      <input
        type="text"
        placeholder="Title страницы"
        v-model="state.meta_title"
      />
    </div>
    <div class="admin-field">
      <label>Seo Description:</label>
      <input
        type="text"
        placeholder="Description страницы"
        v-model="state.meta_description"
      />
    </div>
    <div class="admin-field">
      <label>Seo Keywords:</label>
      <input
        type="text"
        placeholder="Keywords страницы"
        v-model="state.meta_keywords"
      />
    </div>
    <div class="admin-btn" @click="submit">
      {{ state.id === null ? 'Создать' : 'Сохранить' }}
    </div>
  </div>
</template>

<style lang="scss">
@import '@/assets/css/admin.scss';
</style>
