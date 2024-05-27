<template>
  <div>
    <div class="content">
      <Brands />
      <div class="home-page">
        <section class="brands-list home-page__section">
          <div class="brands-list__container">
            <ul class="brands-list__list">
              <li class="brands-list__list-item" v-for="i in 30">
                <p class="brands-list__list-item-content">matiz</p>
                <p class="brands-list__list-item-amount">666</p>
              </li>
            </ul>
          </div>
        </section>
        <Models class="home-page__section" articleName="Популярные модели" />
        <DealersList class="home-page__section" articleName="Дилеры" />
        <DealersList
          class="home-page__section"
          articleName="Магазин запчастей"
        />
      </div>
    </div>
  </div>
</template>
<style scoped lang="scss">
@import 'css/home.scss';
</style>
<script setup lang="ts"></script>
