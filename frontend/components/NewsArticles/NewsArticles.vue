<script setup>
import Button from '@/components/Button/Button.vue'
import { getResponseData } from '@/helpers/getResponseData.js'
import { computed, ref } from 'vue'
import { isSuccessResponse } from '~/helpers/isSuccessResponse.js'

const props = defineProps({
  articleName: String,
  withAds: Boolean,
  withBtn: Boolean,
  withFeed: Boolean,
  type: Number,
  page: Number,
})
const { articleName, withAds, withBtn, withFeed, type, page } = props

const articleIds = {
  Статьи: 1,
  Рейтинги: 2,
  'Тест-драйв': 3,
  Обзоры: 4,
  Сравнения: 5,
}
const listClass = `mainArticles-content__inner-left-${!!withAds ? 2 : 4}`
const itemClass = `mainArticles-list__item-col-${!!withAds ? 3 : 4}`

let limit = 10
let topArticles = ref([])
let bottomArticles = ref([])
let feed = ref([])

const bottomLengthLimit = computed(() => {
  if (type === 2) {
    return 11
  }
  return withAds ? 12 : 14
})

const calculateLimit = () => {
  let initialLimit = 0
  if (type === 2) {
    initialLimit = 10
  }
  if (type === 1) {
    initialLimit = 11
    if (!withAds) {
      initialLimit += 2
    }
  }

  if (withFeed) {
    initialLimit += 4
  }
  return initialLimit
}

const parseData = (data) => {
  topArticles.value = data.slice(0, 5)
  bottomArticles.value = data.slice(5, bottomLengthLimit)
  feed.value = data.slice(bottomLengthLimit)
}

const moreButtonClickHandler = async () => {
  limit += 4
  await fetchData()
}
const fetchData = async () => {
  const req = await useFetch(
    `/api/news/article/list?category_id=${articleIds[articleName]}&limit=${limit}&page=${page || 1}`,
    {
      method: 'POST',
      key: '/news/article/list',
    },
  )
  const data = isSuccessResponse(req, true) ? getResponseData(req, true) : []
  parseData(data.items)
}

limit = calculateLimit()
await fetchData()
</script>

<template>
  <div class="mainArticles mainRating section">
    <div class="container">
      <SectionHeader :title="articleName" />
      <div class="mainArticles-content">
        <div class="mainArticles-content__group">
          <div class="mainRating-content">
            <div class="mainRating-content__inner d-flex">
              <div class="mainRating-content__inner-left">
                <div class="mobile-negative">
                  <NewsArticlesCard
                    :isBackgroundCard="true"
                    :isBig="true"
                    :height="600"
                    :mobileHeight="280"
                    :tag="topArticles[0].category.name"
                    :brand="'Volkswagen'"
                    :date="topArticles[0].created_at"
                    :views="topArticles[0].views"
                    :title="topArticles[0].text"
                    :link="topArticles[0].link"
                    :src="topArticles[0].image.path"
                    :alt="`img`"
                  />
                </div>
              </div>
              <div class="mainRating-content__inner-right">
                <div class="mainArticles-slider-wrapper">
                  <div class="mainArticles-slider">
                    <div class="mainArticles-slider__row--desktop flex">
                      <div
                        class="mainArticles-slider__slide"
                        v-for="article in topArticles.slice(1, 5)"
                        :key="article.id"
                      >
                        <NewsArticlesCard
                          :height="150"
                          :tag="article.category.name"
                          :brand="'Volkswagen'"
                          :date="article.created_at"
                          :views="article.views"
                          :title="article.text"
                          :link="article.link"
                          :src="article.image.path"
                          :alt="`img`"
                        />
                      </div>
                    </div>

                    <Carousel
                      :wrap-around="true"
                      class="mainArticles-slider__row--mobile"
                    >
                      <Slide
                        class="mainArticles-slider__slide slide"
                        v-for="article in topArticles.slice(1, 5)"
                        :key="article.id"
                      >
                        <NewsArticlesCard
                          :height="150"
                          :tag="article.category.name"
                          :brand="'Volkswagen'"
                          :date="article.created_at"
                          :views="article.views"
                          :title="article.text"
                          :link="article.link"
                          :src="article.image.path"
                          :alt="`img`"
                        />
                      </Slide>
                    </Carousel>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div
          class="mainArticles-content__group"
          v-if="type === 1 && bottomArticles.length"
        >
          <div
            class="mainArticles-content__inner mainArticles-content__inner--reverce d-flex"
          >
            <div :class="listClass">
              <div class="mobile-negative">
                <div
                  class="mainArticles-list mainArticles-list-grid mainArticles-list-m-4-item mainArticles-list--mx-10"
                >
                  <div
                    class="mainArticles-list__item mainArticles-list__item-grid mainArticles-list__item--px-10"
                    :class="itemClass"
                    v-for="article in bottomArticles"
                    :key="article.id"
                  >
                    <NewsArticlesCard
                      :height="160"
                      :tag="article.category.name"
                      :brand="'Volkswagen'"
                      :date="article.created_at"
                      :views="article.views"
                      :title="article.text"
                      :link="article.link"
                      :src="article.image.path"
                      :alt="`img`"
                    />
                  </div>
                </div>
              </div>
              <div
                class="mainArticles-more mainArticles-more--mt-0"
                v-if="withBtn"
              >
                <Button
                  class="mainArticles-more__btn"
                  :title="`Все ${articleName.toLowerCase()}`"
                />
              </div>
            </div>
            <div
              class="mainArticles-content__inner-right mainArticles-content__inner-right--t-grow"
              v-if="withAds"
            >
              <div class="mobile-negative">
                <div class="aside">
                  <div class="aside__group">
                    <div
                      class="asideBanner asideBanner-100 aside-block rounded centered mainArticles-ads"
                    >
                      <div>Рекламный <br />баннер</div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div
          class="mainArticles-content__grid-wrapper"
          v-if="type === 2 && bottomArticles.length"
        >
          <div class="mobile-negative">
            <div class="mainArticles-content__grid">
              <div class="mainArticles-content__grid-col">
                <div class="mainArticles-list">
                  <div
                    class="mainArticles-list__item"
                    v-for="article in bottomArticles.slice(0, 2)"
                    :key="article.id"
                  >
                    <NewsArticlesCard
                      :height="140"
                      :mobileHeight="160"
                      :tag="article.category.name"
                      :brand="'Volkswagen'"
                      :date="article.created_at"
                      :views="article.views"
                      :title="article.text"
                      :link="article.link"
                      :src="article.image.path"
                      :alt="`img`"
                    />
                  </div>
                </div>
              </div>
              <div class="mainArticles-content__grid-col">
                <div class="mainArticles-list">
                  <div
                    class="mainArticles-list__item"
                    v-for="article in bottomArticles.slice(2, 4)"
                    :key="article.id"
                  >
                    <NewsArticlesCard
                      :height="140"
                      :mobileHeight="160"
                      :tag="article.category.name"
                      :brand="'Volkswagen'"
                      :date="article.created_at"
                      :views="article.views"
                      :title="article.text"
                      :link="article.link"
                      :src="article.image.path"
                      :alt="`img`"
                    />
                  </div>
                </div>
              </div>
              <div class="mainArticles-content__grid-col desktop">
                <NewsArticlesCard
                  :height="140"
                  :mobileHeight="160"
                  :tag="bottomArticles[bottomArticles.length - 1].category.name"
                  :brand="'Volkswagen'"
                  :date="bottomArticles[bottomArticles.length - 1].created_at"
                  :views="bottomArticles[bottomArticles.length - 1].views"
                  :title="bottomArticles[bottomArticles.length - 1].text"
                  :link="bottomArticles[bottomArticles.length - 1].link"
                  :src="bottomArticles[bottomArticles.length - 1].image.path"
                  :alt="`img`"
                />
              </div>
            </div>
          </div>
          <div
            class="mainArticles-more mainArticles-more--mt-20"
            v-if="withBtn"
          >
            <Button
              class="mainArticles-more__btn"
              :handler="moreButtonClickHandler"
              :title="`Все ${articleName.toLowerCase()}`"
            />
          </div>
        </div>
      </div>
    </div>
    <NewsArticlesFeed
      :withAds="true"
      v-if="withFeed && feed.length > 0"
      :articles="feed"
      :articleName="articleName"
    />
  </div>
</template>
<style scoped lang="scss">
@import './css/newsArticles.scss';
</style>
