<script setup>
import { ref } from 'vue'

const myCarousel = ref(null)
const activeSlide = ref(0)

const props = defineProps({
  price: String,
  images: Array,
})
const { images } = props
const onSlideChange = (idx) => {
  myCarousel.value.slideTo(idx)
  activeSlide.value = myCarousel.value.data.currentSlide.value
}
const prevSlide = () => {
  myCarousel.value.prev()
  activeSlide.value = myCarousel.value.data.currentSlide.value
}
const nextSlide = () => {
  myCarousel.value.next()
  activeSlide.value = myCarousel.value.data.currentSlide.value
}
</script>

<template>
  <div class="autoPage-content">
    <div class="autoPage-content__inner d-flex">
      <div class="autoPage-content__inner-left">
        <div class="autoPage-gallery-wrapper rounded">
          <div class="autoPage-gallery slider-container">
            <Carousel ref="myCarousel" :wrap-around="true">
              <Slide v-for="img in images" :key="img.id">
                <div class="autoPage-gallery__img slide">
                  <img :src="img.path" alt="img" />
                </div>
              </Slide>
            </Carousel>
            <div class="slider-nav__container">
              <span
                v-for="(img, idx) in images"
                :key="idx"
                :class="{ 'slider-nav__item--active': idx === activeSlide }"
                class="slider-nav__item"
                @click="onSlideChange(idx)"
              />
            </div>
          </div>
          <button
            @click="prevSlide"
            class="autoPage-gallery-btn autoPage-prev centred"
            type="button"
          >
            <img src="~/assets/images/general/prev.svg" alt="prev" />
          </button>
          <button
            @click="nextSlide"
            class="autoPage-gallery-btn autoPage-next centred"
            type="button"
          >
            <img src="~/assets/images/general/next.svg" alt="next" />
          </button>
        </div>
        <div class="autoPage-thumbs slider-container">
          <div
            class="autoPage-thumbs__img"
            v-for="(img, idx) in images"
            :key="img.id"
            @click="onSlideChange(idx)"
          >
            <picture>
              <img :src="img.path" width="152.5" height="100" alt="img" />
            </picture>
          </div>
        </div>
      </div>
      <div class="autoPage-content__inner-right">
        <div class="autoPage-info outline-block rounded">
          <div class="autoPage-info__parameter">
            <div class="autoPage-parameter">
              <div class="autoPage-parameter__visible">
                <div class="autoPage-parameter__group">
                  <div class="autoPage-parameter__title">Кузов</div>
                  <div class="autoPage-parameter__info txt">
                    <ul>
                      <li>ДхШхВ, мм: 4722х1860х1745</li>
                      <li>Колесная база, мм: 2710</li>
                      <li>Снаряженная масса, кг: 1541</li>
                      <li>Полная масса, кг: -------</li>
                      <li>Объем топливного бака, л: ----------</li>
                    </ul>
                  </div>
                </div>
                <div class="autoPage-parameter__group">
                  <div class="autoPage-parameter__title">Трансмиссия</div>
                  <div class="autoPage-parameter__info txt">
                    <ul>
                      <li>Количество передач: 7</li>
                      <li>Привод: передний</li>
                    </ul>
                  </div>
                </div>
                <div class="autoPage-parameter__group">
                  <div class="autoPage-parameter__title">
                    Подвеска, тормоза, шины
                  </div>
                  <div class="autoPage-parameter__info txt">
                    <ul>
                      <li>Передняя: Макферсон</li>
                      <li>Задняя подвеска: Многорычажная независимая</li>
                    </ul>
                  </div>
                </div>
              </div>
              <div
                class="autoPage-parameter__hidden collapse"
                id="hiddenAutoInfo"
              >
                <div class="autoPage-parameter__group">
                  <div class="autoPage-parameter__title">
                    Скрытая информация
                  </div>
                  <div class="autoPage-parameter__info txt">
                    <ul>
                      <li>Количество передач: 7</li>
                      <li>Привод: передний</li>
                    </ul>
                  </div>
                </div>
                <div class="autoPage-parameter__group">
                  <div class="autoPage-parameter__title">
                    Скрытая информация
                  </div>
                  <div class="autoPage-parameter__info txt">
                    <ul>
                      <li>Количество передач: 7</li>
                      <li>Привод: передний</li>
                    </ul>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="autoPage-info__more">
            <a
              class="autoPage-info__toggle"
              href="#hiddenAutoInfo"
              data-bs-toggle="collapse"
              >Все характеристики
            </a>
          </div>
          <div class="autoPage-info__price">
            <div class="autoPage-price txt">
              Цена - от <span>{{ price }}</span>
            </div>
            <a class="autoPage-show btn" href="#">Показать наличие </a>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
