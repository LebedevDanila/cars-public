<script setup>
const props = defineProps({
  items: Array,
})
props.items.forEach((item) => (item.currentImage = 0))
const { items } = toRefs(props)
</script>

<template>
  <div class="brandPage-list">
    <div class="brandPage-list__item" v-for="item in items" :key="item.id">
      <div class="brandCard rounded">
        <div class="brandCard__inner d-flex">
          <div class="brandCard__inner-left">
            <div class="brandCard-gallery-wrapper">
              <div class="brandCard-gallery slider-container">
                <img
                  :src="item.images[item.currentImage].path"
                  width="310"
                  height="247"
                  alt="img"
                  class="brandCard-gallery__img"
                />
                <div class="slider-nav__container">
                  <span
                    v-for="(img, idx) in item.images"
                    :key="idx"
                    :class="{
                      'slider-nav__item--active': idx === item.currentImage,
                    }"
                    class="slider-nav__item"
                    @click="item.currentImage = idx"
                  />
                </div>
              </div>
            </div>
          </div>
          <div class="brandCard__inner-right">
            <div class="brandCard-info">
              <div class="brandCard-info__group brandCard-info__group--top">
                <div class="brandCard-info__title">
                  <NuxtLink
                    class="full-link"
                    :to="`/car/generation/${item.link}`"
                    >{{ item.name }}</NuxtLink
                  >
                </div>
                <div class="brandCard-info__txt txt" v-if="item.other_names">
                  ({{ item.other_names }})
                </div>
              </div>
              <div class="brandCard-info__group brandCard-info__group--center">
                <ul class="brandCard-info__list txt">
                  <li v-for="(param, idx) in item.specs_entities" :key="idx">
                    {{ param.name }}: {{ param.values.join(', ') }}
                  </li>
                </ul>
              </div>
              <div class="brandCard-info__group brandCard-info__group--bottom">
                <div class="brandCard-price txt">
                  <div class="brandCard-price__item">
                    <div class="brandCard-price__item-inner d-flex">
                      <div class="brandCard-price__item-img">
                        <img
                          src="~/assets/images/general/china.svg"
                          alt="china"
                        />
                      </div>
                      <div class="brandCard-price__item-txt">
                        Цена в Китае: {{ item.price_text_cn }}
                      </div>
                    </div>
                  </div>
                  <div class="brandCard-price__item">
                    <div class="brandCard-price__item-inner d-flex">
                      <div class="brandCard-price__item-img">
                        <img
                          src="~/assets/images/general/russia.svg"
                          alt="russia"
                        />
                      </div>
                      <div class="brandCard-price__item-txt">
                        Продается в России. Цена - от {{ item.price_text_ru }}
                      </div>
                    </div>
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
@import './css/carList.scss';
</style>
