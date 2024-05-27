<script setup>
import { getResponseData } from '@/helpers/getResponseData.js'
import { isSuccessResponse } from '~/helpers/isSuccessResponse.js'
import { ref } from 'vue'

const props = defineProps({
  articleName: String,
})
const { articleName } = props
let page = 1
const data = ref([
  {
    img: 'https://img.freepik.com/premium-photo/white-cat-standing-in-the-snow-with-its-mouth-open-generative-ai_791316-18854.jpg?size=626&ext=jpg',
  },
  {
    img: 'https://img.freepik.com/free-photo/cute-domestic-cat-staring-at-the-camera-generative-ai_188544-12496.jpg?size=626&ext=jpg&ga=GA1.1.1443939541.1709296924&semt=ais',
  },
  {
    img: 'https://img.freepik.com/free-photo/the-adorable-illustration-of-kittens-playing-in-the-forest-generative-ai_260559-483.jpg?size=626&ext=jpg&ga=GA1.1.1443939541.1709296924&semt=ais',
  },
  {
    img: 'https://img.freepik.com/free-photo/closeup-shot-of-a-european-cat-with-camera-lens_181624-56293.jpg?size=626&ext=jpg&ga=GA1.1.1443939541.1709296924&semt=ais',
  },
])
const moreButtonClickHandler = async () => {
  page++
  await fetchData()
}
const fetchData = async () => {
  // const req = await useFetch(
  //   `/api/dealers-list?limit=${4}&page=${page}`,
  //   {
  //     method: 'POST',
  //     key: '/news/article/list',
  //   },
  // )
  // const { items } = isSuccessResponse(req) ? getResponseData(req) : []
  // data.value.push(items)
}
await fetchData()
</script>

<template>
  <section class="dealers-list">
    <div class="dealers-list__container">
      <h2 class="dealers-list__caption">{{ articleName }}</h2>
      <div class="dealers-list__inner">
        <div class="dealers-list__card" v-for="item in data">
          <a href="#" class="dealers-list__card-main-link"></a>
          <picture class="dealers-list__img">
            <img :src="item.img" alt="" />
          </picture>
          <div class="dealers-list__card-content">
            <p class="dealers-list__card-title">Авто центр “Auto”</p>
            <div class="dealers-list__card-rating">
              <p>4.9</p>
              <div class="dealers-list__card-rating-stars">
                <svg
                  width="13.316406"
                  height="12.663119"
                  viewBox="0 0 13.3164 12.6631"
                  fill="none"
                  xmlns="http://www.w3.org/2000/svg"
                  xmlns:xlink="http://www.w3.org/1999/xlink"
                >
                  <path
                    id="Star 1"
                    d="M6.6582 0L4.60156 4.16844L0 4.83688L3.33008 8.08156L2.54297 12.6631L6.6582 10.5L10.7734 12.6631L9.98633 8.08156L13.3164 4.83688L8.71484 4.16844L6.6582 0Z"
                    fill="#FBBC38"
                    fill-opacity="1.000000"
                    fill-rule="evenodd"
                  />
                </svg>
                <svg
                  width="13.316406"
                  height="12.663119"
                  viewBox="0 0 13.3164 12.6631"
                  fill="none"
                  xmlns="http://www.w3.org/2000/svg"
                  xmlns:xlink="http://www.w3.org/1999/xlink"
                >
                  <path
                    id="Star 1"
                    d="M6.6582 0L4.60156 4.16844L0 4.83688L3.33008 8.08156L2.54297 12.6631L6.6582 10.5L10.7734 12.6631L9.98633 8.08156L13.3164 4.83688L8.71484 4.16844L6.6582 0Z"
                    fill="#FBBC38"
                    fill-opacity="1.000000"
                    fill-rule="evenodd"
                  />
                </svg>
                <svg
                  width="13.316406"
                  height="12.663119"
                  viewBox="0 0 13.3164 12.6631"
                  fill="none"
                  xmlns="http://www.w3.org/2000/svg"
                  xmlns:xlink="http://www.w3.org/1999/xlink"
                >
                  <path
                    id="Star 1"
                    d="M6.6582 0L4.60156 4.16844L0 4.83688L3.33008 8.08156L2.54297 12.6631L6.6582 10.5L10.7734 12.6631L9.98633 8.08156L13.3164 4.83688L8.71484 4.16844L6.6582 0Z"
                    fill="#FBBC38"
                    fill-opacity="1.000000"
                    fill-rule="evenodd"
                  />
                </svg>
                <svg
                  width="13.316406"
                  height="12.663119"
                  viewBox="0 0 13.3164 12.6631"
                  fill="none"
                  xmlns="http://www.w3.org/2000/svg"
                  xmlns:xlink="http://www.w3.org/1999/xlink"
                >
                  <path
                    id="Star 1"
                    d="M6.6582 0L4.60156 4.16844L0 4.83688L3.33008 8.08156L2.54297 12.6631L6.6582 10.5L10.7734 12.6631L9.98633 8.08156L13.3164 4.83688L8.71484 4.16844L6.6582 0Z"
                    fill="#FBBC38"
                    fill-opacity="1.000000"
                    fill-rule="evenodd"
                  />
                </svg>
                <svg
                  width="13.316406"
                  height="12.663119"
                  viewBox="0 0 13.3164 12.6631"
                  fill="none"
                  xmlns="http://www.w3.org/2000/svg"
                  xmlns:xlink="http://www.w3.org/1999/xlink"
                >
                  <path
                    id="Star 1"
                    d="M6.6582 0L4.60156 4.16844L0 4.83688L3.33008 8.08156L2.54297 12.6631L6.6582 10.5L10.7734 12.6631L9.98633 8.08156L13.3164 4.83688L8.71484 4.16844L6.6582 0Z"
                    fill="#FBBC38"
                    fill-opacity="1.000000"
                    fill-rule="evenodd"
                  />
                </svg>
              </div>
            </div>
            <a class="dealers-list__card-address"
              >ул. Уличная, д. 20, корп. 1, г. Санкт-Петербург</a
            >
            <a href="#" class="dealers-list__card-link">link</a>
            <div class="dealers-list__card-swiper">
              <div class="dealers-list__card-swiper-content"></div>
              <button class="dealers-list__card-swiper-pagination">
                <svg
                  width="8.250000"
                  height="15.125023"
                  viewBox="0 0 8.25 15.125"
                  fill="none"
                  xmlns="http://www.w3.org/2000/svg"
                  xmlns:xlink="http://www.w3.org/1999/xlink"
                >
                  <path
                    id="Down_Arrow_3_"
                    d="M8.25 7.56248C8.25 7.7383 8.18359 7.91431 8.04883 8.04855L1.17383 14.9235C0.904297 15.1922 0.470703 15.1922 0.201172 14.9235C-0.0664062 14.6549 -0.0664062 14.2199 0.201172 13.9514L6.58984 7.56248L0.201172 1.17355C-0.0664062 0.9049 -0.0664062 0.469887 0.201172 0.201416C0.470703 -0.0670547 0.904297 -0.0672226 1.17383 0.201416L8.04883 7.07642C8.18359 7.21066 8.25 7.38665 8.25 7.56248Z"
                    fill="#FFFFFF"
                    fill-opacity="1.000000"
                    fill-rule="nonzero"
                  />
                </svg>
              </button>
            </div>
          </div>
        </div>
      </div>
      <Button
        class="dealers-list__btn"
        title="Показать еще"
        :handler="moreButtonClickHandler"
      />
    </div>
  </section>
</template>
<style scoped>
@import './css/dealers-list.scss';
</style>
