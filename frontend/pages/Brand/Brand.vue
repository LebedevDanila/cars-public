<script setup>
import { isSuccessResponse } from '~/helpers/isSuccessResponse.js'
import { getResponseData } from '~/helpers/getResponseData.js'
import { computed, ref } from 'vue'

const route = useRoute()
const { link } = route.params
const selectedType = ref({})

const staticDataReq = await useNuxtData('common/static-data')
const staticData = process.client ? getResponseData(staticDataReq, true) : []
const generationTypes = staticData?.enums?.generation_types || {};

const [brandInfoResponse, newsResponse] = await Promise.all([
  useFetch(`/api/brand/get?link=${link}`),
  useFetch(`/api/news/article/list`, {
    method: 'POST',
    body: {
      limit: 10,
    },
  }),
])
const brandInfo = isSuccessResponse(brandInfoResponse, true)
  ? getResponseData(brandInfoResponse, true)
  : {}
const news = isSuccessResponse(newsResponse, true)
  ? getResponseData(newsResponse, true)?.items
  : []
const carsResponse = await useFetch(`/api/car/generation/list`, {
  method: 'POST',
  body: {
    brand_id: brandInfo.id,
  },
})
const cars = isSuccessResponse(carsResponse, true)
  ? getResponseData(carsResponse, true)
  : []

const carsTypes = [{name: 'Все'}, ...new Set(cars.map((car) => ({type: car.type, name: generationTypes[car.type]})))]
selectedType.value = carsTypes[0]
const filteredCars = computed(() => {
  if (selectedType.value.type) {
    return cars.filter((car) => car.type === selectedType.value.type)
  }
  return cars
})
</script>

<template>
  <div class="content">
    <Brands />
    <div class="sections">
      <Breadcrumbs
        :pages="[
          { name: 'Главная', link: '/' },
          { name: 'Каталог автомобилей', link: '/catalog' },
          { name: brandInfo.name },
        ]"
      />
      <div class="brandPage">
        <div class="container">
          <div class="brandPage__inner d-flex">
            <div class="brandPage__inner-left">
              <div class="brandPage-head">
                <div class="brandPage-head__top">
                  <div class="brandPage-info">
                    <div
                      class="brandPage-info__inner brandPage-info__inner--grid"
                    >
                      <div class="brandPage-info__inner-logo">
                        <div class="brandPage-info__logo centered rounded">
                          <img
                            :src="brandInfo?.image?.path"
                            width="50"
                            height="54"
                            alt="img"
                          />
                        </div>
                      </div>
                      <div class="brandPage-info__inner-title">
                        <h1 class="brandPage-info__title">
                          {{ brandInfo.name }}
                        </h1>
                      </div>
                      <div class="brandPage-info__inner-link">
                        <NuxtLink
                          class="brandPage-info__link txt"
                          :to="brandInfo.link"
                          >Дилеры {{ brandInfo.name }} в вашем городе
                        </NuxtLink>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="brandPage-head__bottom">
                  <div class="brandPage-head__txt txt">
                    {{ brandInfo.text }}
                  </div>
                </div>
              </div>
              <div class="brandPage-sorting">
                <div class="brandPage-sorting__list flex">
                  <div
                    class="brandPage-sorting__list-item"
                    v-for="carType in carsTypes"
                    :key="carType.type"
                  >
                    <a
                      class="brandPage-sorting__link rounded"
                      :class="{
                        'brandPage-sorting__link--selected':
                          selectedType.name === carType.name,
                      }"
                      @click="selectedType = carType"
                      >{{ carType.name }}</a
                    >
                  </div>
                </div>
              </div>
              <CarList :items="filteredCars" />
            </div>
            <div class="brandPage__inner-right">
              <div class="aside">
                <div class="aside__group">
                  <div class="asideNews aside-block rounded">
                    <div class="asideNews-title block-title block-title--small">
                      Свежие новости
                    </div>
                    <div class="asideNews-list">
                      <div
                        class="asideNews-list__item"
                        v-for="item in news"
                        :key="item.id"
                      >
                        <div class="asideNews-card">
                          <div class="asideNews-card__inner d-flex">
                            <div class="asideNews-card__inner-left">
                              <div class="asideNews-card__img">
                                <img
                                  :src="item.image.path"
                                  width="60"
                                  height="60"
                                  alt="img"
                                />
                              </div>
                            </div>
                            <div class="asideNews-card__inner-right">
                              <div class="asideNews-card__title">
                                <NuxtLink class="full-link" :to="item.link">
                                  {{ item.name }}
                                </NuxtLink>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="aside__group">
                  <div class="asideBanner aside-block rounded centered">
                    <div>Рекламный <br />баннер</div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
<style scoped lang="scss">
@import './css/brand.scss';
</style>
