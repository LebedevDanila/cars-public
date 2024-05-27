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
  <div class="complete-info__group">
    <div class="complete-group" :class="{ open: isVisible }">
      <div class="complete-group__head">
        <a class="complete-group__open" @click.prevent="toggleVisible">
          <span class="complete-group__open-txt">{{ title }}</span>
          <span class="complete-group__open-icon centered">
            <svg class="svg-sprite-icon icon-plus">
              <use xlink:href="~assets/images/svg/symbol/sprite.svg#plus"></use>
            </svg>
          </span>
        </a>
      </div>
      <div
        class="complete-group__content"
        :style="{ 'max-height': isVisible ? 10000 + 'px' : '' }"
      >
        <div class="complete-group__content-inner">
          <div class="complete-list">
            <slot />
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<style scoped>
.complete-group {
  transition: all 0.3s ease-in-out;
}

.complete-group.open .complete-group__content {
  opacity: 1;
}

.complete-group__content {
  max-height: 0;
  overflow: hidden;
  opacity: 0;
  transition: all 0.3s ease-in-out;
}

.complete-group.open .complete-group__open-icon > .svg-sprite-icon {
  transform: rotate(45deg);
}

.complete-group.open .complete-group__open-icon > .svg-sprite-icon {
  stroke: var(--white);
}

.complete-group.open .complete-group__open-icon {
  background: var(--blue);
}

.complete-group > .complete-group__open-icon {
  transition: all 0.3s ease-in-out;
}

.complete-group__open-icon > .svg-sprite-icon {
  transition: all 0.3s ease-in-out;
}
</style>
