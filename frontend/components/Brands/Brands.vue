<script setup>
import { getResponseData } from '~/helpers/getResponseData'

const { isMobile } = useDevice()

const countBrands = isMobile ? 3 : 10
const staticDataReq = await useNuxtData('common/static-data')
let brands = process.client
  ? getResponseData(staticDataReq, true).brands.filter(
      (brand, key) => key < countBrands,
    )
  : []
</script>

<template>
  <div class="brands">
    <div class="container">
      <div class="brands__inner d-flex">
        <div class="brands__inner-left">
          <client-only>
            <div class="brands-list d-flex">
              <div
                class="brands-list__item"
                v-for="(brand, key) in brands"
                :key="key"
              >
                <a
                  class="brands-list__link centered rounded outline-block"
                  :href="`/brand/${brand.link}`"
                >
                  <span>
                    <img
                      :src="brand.image.path"
                      width="80"
                      height="34"
                      alt="img"
                    />
                  </span>
                </a>
              </div>
            </div>
          </client-only>
        </div>
        <div class="brands__inner-right">
          <a class="brands-btn centered rounded outline-block" href="#">
            <span class="brands-btn__txt">Все марки</span>
            <span class="brands-btn__icon icon">
              <svg class="svg-sprite-icon icon-a-right">
                <use
                  xlink:href="~assets/images/svg/symbol/sprite.svg#a-right"
                ></use>
              </svg>
            </span>
          </a>
        </div>
      </div>
    </div>
  </div>
</template>

<style scoped lang="scss">
@import './css/brands.scss';
</style>
