<script setup>
import { isSuccessResponse } from '~/helpers/isSuccessResponse.js'
import { getResponseData } from '~/helpers/getResponseData.js'

const carInfoData = ref([])
const current = ref(1)
const pages = ref(0)
const total = ref(0)

const fetchData = async (page) => {
  current.value = page
  const catalogResponse = await useFetch(
    `/api/common/catalog?page=${current.value}`,
    {
      method: 'POST',
    },
  )

  const isSuccess = isSuccessResponse(catalogResponse, true)
  if (isSuccess) {
    const responseData = getResponseData(catalogResponse, true)

    carInfoData.value = isSuccess ? responseData.items : []
    pages.value = responseData.last_page
    total.value = responseData.total
  }
}
await fetchData(current.value)
</script>

<template>
  <div>
    <div class="content">
      <Brands />
      <Breadcrumbs
        :pages="[
          { name: 'Главная', link: '/' },
          { name: 'Каталог автомобилей' },
        ]"
      />
      <div class="sections">
        <div class="container catalog-container">
          <div class="catalog__top">
            <h1 class="catalog__title">Каталог автомобилей</h1>
            <div class="catalog__inner">
              <p class="catalog__results">{{ total }} авто найдено</p>
              <button class="catalog__backto-btn btn-reset">
                Все марки
                <svg
                  width="12"
                  height="7"
                  viewBox="0 0 12 7"
                  fill="none"
                  xmlns="http://www.w3.org/2000/svg"
                >
                  <path
                    d="M0.5 3.5H11M11 3.5L8 0.5M11 3.5L8 6.5"
                    stroke="#5887FF"
                  />
                </svg>
              </button>
            </div>
          </div>
          <CatalogList :items="carInfoData" />
        </div>
      </div>
      <Pagination :pages="pages" :current="current" @changePage="fetchData" />
    </div>
  </div>
</template>
<style scoped lang="scss">
@import './css/catalog.scss';
</style>
