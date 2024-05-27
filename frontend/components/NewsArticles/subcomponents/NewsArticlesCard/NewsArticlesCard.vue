<script setup>
import { computed } from 'vue'

const props = defineProps({
  isBackgroundCard: Boolean,
  isBig: Boolean,
  height: Number,
  mobileHeight: Number,
  tag: String,
  brand: String,
  src: String,
  alt: String,
  link: String,
  title: String,
  date: String,
  views: Number,
  textContent: String,
})
const {
  isBackgroundCard,
  isBig,
  height,
  mobileHeight,
  tag,
  brand,
  src,
  alt,
  link,
  title,
  date,
  views,
  textContent,
} = props
const className =
  'newsCard-img' +
  (height ? ' newsCard-img--' + height : '') +
  (mobileHeight ? ' newsCard-img--m-' + mobileHeight : '')

const width = computed(() => {
  const currentHeight = height || mobileHeight
  switch (currentHeight) {
    case 160:
      return 290
    case 300 || 456:
      return 600
    default:
      return 300
  }
})
</script>

<template>
  <div
    class="mainIntro-card"
    v-if="isBackgroundCard"
    :class="{
      'mainIntro-card--big': isBig,
      'mainIntro-card--m-280': mobileHeight === 280,
      'mainIntro-card--mh-600': height === 600,
    }"
  >
    <div
      class="mainIntro-card__img"
      :class="{ 'mainIntro-card__img--big': isBig }"
    >
      <img
        :src="src"
        :width="isBig ? 640 : 340"
        :height="isBig ? 600 : 193"
        :alt="alt"
      />
    </div>
    <div
      class="mainIntro-card__info"
      :class="{ 'mainIntro-card__info--big': isBig }"
    >
      <div class="mainIntro-card__tags">
        <div class="mainIntro-card__tags-inner d-flex">
          <div class="mainIntro-card__tags-inner-item">
            <div class="mainIntro-card__tags-item outline-block">{{ tag }}</div>
          </div>
          <div class="mainIntro-card__tags-inner-item">
            <div class="mainIntro-card__tags-item outline-block">
              {{ brand }}
            </div>
          </div>
        </div>
      </div>
      <div
        class="mainIntro-card__title"
        :class="{ 'mainIntro-card__title--big': isBig }"
      >
        <NuxtLink class="full-link" :to="link">{{ title }}</NuxtLink>
      </div>
      <div class="mainIntro-card__stats">
        <div class="mainIntro-card__stats-inner d-flex">
          <div class="mainIntro-card__stats-inner-item">
            <div class="mainIntro-card__stats-item">
              {{ $dayjs(date).format('DD MMMM YYYY HH:mm') }}
            </div>
          </div>
          <div class="mainIntro-card__stats-inner-item">
            <div class="mainIntro-card__stats-item">
              <div class="mainIntro-card__stats-item-icon icon">
                <svg class="svg-sprite-icon icon-eye">
                  <use
                    xlink:href="~assets/images/svg/symbol/sprite.svg#eye"
                  ></use>
                </svg>
              </div>
              <div class="mainIntro-card__stats-item-txt">{{ views }}</div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="newsCard newsCard--no-border rounded" v-else>
    <div :class="className">
      <img :src="src" :width="width" :height="height" :alt="alt" />
    </div>
    <div class="newsCard-info">
      <div class="newsCard-tags">
        <div class="newsCard-tags__inner flex">
          <div class="newsCard-tags__inner-item">
            <div class="newsCard-tags__item">{{ tag }}</div>
          </div>
          <div class="newsCard-tags__inner-item">
            <div class="newsCard-tags__item">{{ brand }}</div>
          </div>
        </div>
      </div>
      <div class="newsCard-title">
        <NuxtLink :to="link">{{ title }}</NuxtLink>
      </div>
      <div class="newsCard-txt txt" v-if="textContent">{{ textContent }}</div>
      <div class="newsCard-stats">
        <div class="newsCard-stats__inner d-flex">
          <div class="newsCard-stats__inner-item">
            <div class="newsCard-stats__item">
              {{ $dayjs(date).format('DD MMMM YYYY HH:mm') }}
            </div>
          </div>
          <div class="newsCard-stats__inner-item">
            <div class="newsCard-stats__item">
              <div class="newsCard-stats__item-icon centered">
                <img src="~assets/images/general/eye.svg" alt="" />
              </div>
              <div class="newsCard-stats__item-txt">{{ views }}</div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<style scoped lang="scss">
@import './css/newsArticlesCard.scss';
</style>
