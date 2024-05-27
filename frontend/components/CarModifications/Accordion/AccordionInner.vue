<script setup>
import { ref } from 'vue'

const isVisible = ref(false)

const props = defineProps({
  title: String,
})
const { title } = props
const toggleVisible = () => {
  isVisible.value = !isVisible.value
}
</script>

<template>
  <div class="complete-list__item">
    <div class="complete-item" :class="{ open: isVisible }">
      <div class="complete-item__head">
        <a class="complete-item__open" @click.prevent="toggleVisible">
          <span class="complete-item__open-txt">{{ title }}</span>
          <span class="complete-item__open-icon icon">
            <svg class="svg-sprite-icon icon-down">
              <use xlink:href="~assets/images/svg/symbol/sprite.svg#down"></use>
            </svg>
          </span>
        </a>
      </div>
      <div
        class="complete-item__content"
        :style="{ 'max-height': isVisible ? 10000 + 'px' : '' }"
      >
        <div class="complete-item__content-inner">
          <slot />
        </div>
      </div>
    </div>
  </div>
</template>

<style scoped>
.complete-item {
  transition: all 0.4s ease-in-out;
}

.complete-item.open .complete-item__content {
  opacity: 1;
}

.complete-item__content {
  max-height: 0;
  overflow: hidden;
  opacity: 0;
  transition: all 0.4s ease-in-out;
}

.complete-item.open .complete-item__open-icon > .svg-sprite-icon {
  transform: rotate(-180deg);
}

.complete-item__open-icon > .svg-sprite-icon {
  transition: all 0.4s ease-in-out;
}
</style>
