<script setup>
import { getResponseData } from '@/helpers/getResponseData.js'
import { isSuccessResponse } from '~/helpers/isSuccessResponse.js'
import { ref } from 'vue'

const props = defineProps({
  articleName: String,
})
const { articleName } = props
let limit = 8
const data = ref([])
const moreButtonClickHandler = async () => {
  limit += 4
  await fetchData()
}
const fetchData = async () => {
  const req = await useFetch(`/api/car/model/list?limit=${limit}&page=1`, {
    method: 'GET',
    key: '/car/model/list',
  })
  const { items } = isSuccessResponse(req, true)
    ? getResponseData(req, true)
    : []
  data.value = items
}
await fetchData()
</script>

<template>
  <section class="models">
    <div class="models__container">
      <h2 class="models__caption">{{ articleName }}</h2>
      <div class="models__inner">
        <div class="models__card" v-for="model in data">
          <div
            class="models__card-state"
            v-if="$dayjs().diff($dayjs(model.created_at), 'day') <= 3"
          >
            Новый
          </div>
          <picture class="models__card-img">
            <img :src="model.image.path" :alt="model.image.id" />
          </picture>
          <p class="models__card-img-descr">{{ model.name }}</p>
        </div>
      </div>
      <Button
        class="models__btn"
        title="Показать ещё"
        :handler="moreButtonClickHandler"
      />
    </div>
  </section>
</template>
<style scoped>
@import 'css/models.scss';
</style>
