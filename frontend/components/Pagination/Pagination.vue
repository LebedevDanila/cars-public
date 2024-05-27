<script setup>
const props = defineProps({
  current: Number,
  pages: Number,
})
const emit = defineEmits(['changePage'])
let { current, pages } = props
const clickHandler = (page) => {
  if (page > 0 && page <= pages) {
    current = page
    emit(`changePage`, page)
  }
}
</script>

<template>
  <div class="pagination">
    <div class="pagination__inner d-flex">
      <div class="pagination__inner-prev">
        <a
          class="pagination-prev pagination-btn centered"
          @click="clickHandler(current - 1)"
          :class="{ disabled: current === 1 }"
        >
          <svg class="svg-sprite-icon icon-prev">
            <use xlink:href="~assets/images/svg/symbol/sprite.svg#prev"></use>
          </svg>
        </a>
      </div>
      <div class="pagination__inner-list">
        <ul class="pagination-list d-flex">
          <li class="pagination-list__item" v-for="page in pages">
            <a
              class="pagination-list__link centered"
              :class="{ 'pagination-list__link--selected': page === current }"
              @click="clickHandler(page)"
            >
              {{ page }}
            </a>
          </li>
          <li
            class="pagination-list__item"
            v-if="pages < 5"
            v-for="page in 5 - pages"
          >
            <a class="pagination-list__link centered disabled">{{
              page + pages
            }}</a>
          </li>
        </ul>
      </div>
      <div class="pagination__inner-next">
        <a
          class="pagination-next pagination-btn centered"
          :class="{ disabled: current === pages }"
          @click="clickHandler(current + 1)"
        >
          <span class="pagination-next__txt">Далее</span>
          <span class="pagination-next__icon">
            <svg class="svg-sprite-icon icon-next">
              <use xlink:href="~assets/images/svg/symbol/sprite.svg#next"></use>
            </svg>
          </span>
        </a>
      </div>
    </div>
  </div>
</template>

<style scoped lang="scss">
@import './css/pagination.scss';
</style>
