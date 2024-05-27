<script setup>
const props = defineProps({
  items: Array,
})
const { items } = toRefs(props)
</script>

<template>
  <div class="catalog__list">
    <div class="catalog__item item" v-for="item in items">
      <div class="item__top">
        <div class="item__image">
          <img :src="item.image.path" :alt="item.name" />
        </div>
        <div class="item__title">
          <h2>{{ item.name.toUpperCase() }}</h2>
          <NuxtLink :to="'/brand/' + item.link"
            >Дилеры {{ item.name.toUpperCase() }} в вашем городе</NuxtLink
          >
        </div>
      </div>
      <div class="item__info">
        <div class="item__info-top">
          <p>Модель авто</p>
          <svg
            width="16"
            height="11"
            viewBox="0 0 16 11"
            fill="none"
            xmlns="http://www.w3.org/2000/svg"
          >
            <path
              d="M6.5 1.5H14.5"
              stroke="#5887FF"
              stroke-width="1.5"
              stroke-linecap="round"
            />
            <path
              d="M4 5.5H12"
              stroke="#5887FF"
              stroke-width="1.5"
              stroke-linecap="round"
            />
            <path
              d="M1.5 9.5H9.5"
              stroke="#5887FF"
              stroke-width="1.5"
              stroke-linecap="round"
            />
          </svg>
        </div>
        <div class="item__type" v-for="type in item.types">
          <p class="item__type-title">{{ type.name }}</p>
          <ul class="item__type-list list-reset">
            <li v-for="generation in type.generations">
              <NuxtLink :to="`/car/generation/${generation.link}`">
                {{ generation.name }}
              </NuxtLink>
            </li>
          </ul>
        </div>
      </div>
      <div class="item__more">
        <p>Больше авто на странице бренда</p>
        <button class="item__more-btn btn-reset">Подробнее</button>
      </div>
    </div>
  </div>
</template>

<style scoped lang="scss">
@import './css/catalogList.scss';
</style>
