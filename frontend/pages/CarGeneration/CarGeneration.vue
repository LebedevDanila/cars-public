<script setup>
import { isSuccessResponse } from '~/helpers/isSuccessResponse.js'
import { getResponseData } from '~/helpers/getResponseData.js'

const route = useRoute()
const { link } = route.params
const [generationResponse, articlesResponse] = await Promise.all([
  useFetch(`/api/car/generation/get?link=${link}`),
  useFetch(`/api/news/article/list`, {
    method: 'POST',
    body: {
      page: 1,
      limit: 8,
    },
  }),
])

const generationData = isSuccessResponse(generationResponse, true)
  ? getResponseData(generationResponse, true)
  : []

const listResponse = await useFetch('/api/car/generation/list', {
  method: 'POST',
  body: {
    brand_id: generationData?.brand.id,
    limit: 5,
  },
})
const similarCars = isSuccessResponse(listResponse, true)
  ? getResponseData(listResponse, true)
  : []
const articles = isSuccessResponse(articlesResponse, true)
  ? getResponseData(articlesResponse, true).items
  : []
</script>

<template>
  <div class="content">
    <Brands />
    <Breadcrumbs
      :pages="[
        { name: 'Главная', link: '/' },
        { name: 'Каталог автомобилей', link: '/catalog' },
        {
          name: generationData.brand.name,
          link: `/brand/${generationData.brand.name}`,
        },
        { name: generationData.name },
      ]"
    />

    <div class="sections">
      <div class="autoPage">
        <div class="container">
          <div class="autoPage__inner d-flex">
            <div class="autoPage__inner-left">
              <div class="autoPage-head">
                <div class="autoPage-head__inner d-flex">
                  <div class="autoPage-head__inner-left">
                    <div class="autoPage-head__logo centered rounded">
                      <picture>
                        <img
                          src="~assets/images/general/brands/1.png"
                          width="50"
                          height="54"
                          alt="img"
                        />
                      </picture>
                    </div>
                  </div>
                  <div class="autoPage-head__inner-right">
                    <h1 class="autoPage-head__title">
                      {{ generationData.name }}
                    </h1>
                  </div>
                </div>
              </div>
              <CarInfo
                :price="generationData.price_text_ru"
                :images="generationData?.images"
              />
            </div>
            <div class="autoPage__inner-right">
              <div class="aside">
                <div class="aside__group">
                  <div
                    class="asideBanner asideBanner--730 aside-block rounded centered"
                  >
                    <div>Рекламный <br />баннер</div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <CarModifications
        :modificationsData="generationData?.modifications"
        :name="'test'"
      />

      <div class="similar">
        <div class="container">
          <div class="brandPage__inner d-flex">
            <div class="brandPage__inner-left">
              <div class="similar-title block-title">Похожие автомобили</div>
              <CarList :items="similarCars" />
            </div>
            <div class="brandPage__inner-right">
              <div class="aside">
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

      <div class="articles section">
        <div class="container">
          <div class="articles-title block-title">Статьи по теме</div>
          <div class="articles-list">
            <div class="articles-list__item" v-for="article in articles">
              <NewsArticlesCard
                :height="160"
                :tag="article.category.name"
                :brand="generationData.brand.name"
                :date="article.created_at"
                :views="article.views"
                :title="article.name"
                :link="article.link"
                :src="article.image.path"
                :alt="'img'"
              />
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<style lang="scss">
@import './css/carGeneration.scss';
</style>
