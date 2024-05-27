<script setup>
import { getResponseData } from '~/helpers/getResponseData'
import { isSuccessResponse } from '~/helpers/isSuccessResponse'

const staticDataReq = await useFetch('/api/common/static-data', {
  key: 'common/static-data',
})
const staticData = isSuccessResponse(staticDataReq, true)
  ? getResponseData(staticDataReq, true)
  : []

const isSearchOpened = ref(false);
const isBurgerOpened = ref(false);
const toggleBurgerHandler = () => {
  isBurgerOpened.value = !isBurgerOpened.value;
  if (isBurgerOpened.value) {
    document.querySelector('body').classList.add('o-hidden');
  } else {
    document.querySelector('body').classList.remove('o-hidden');
  }
}
</script>

<template>
  <header class="header">
    <div class="header__container">
      <div class="header__content d-flex">
        <div class="header__logo">
          <NuxtLink class="logo centered" to="/">CnxCars</NuxtLink>
        </div>
        <div class="header__menu" :class="{'header__menu--open': isBurgerOpened}">
          <nav class="nav" :class="{'nav--open': isBurgerOpened}">
            <ul class="menu flex">
              <li
                class="menu__item"
                v-for="(menuItem, key) in staticData.menu"
                :key="key"
              >
                <NuxtLink class="menu__link" :to="menuItem.link">{{
                  menuItem.name
                }}</NuxtLink>
              </li>
            </ul>
          </nav>
        </div>
        <div class="header__search" :class="{'header__search--open': isSearchOpened}">
          <div class="header__search-inner">
            <form class="searchForm">
              <input class="searchForm-input" type="text" placeholder="Поиск" />
              <button class="searchForm-btn icon" type="submit">
                <svg class="svg-sprite-icon icon-search">
                  <use
                    xlink:href="~assets/images/svg/symbol/sprite.svg#search"
                  ></use>
                </svg>
              </button>
            </form>
          </div>
        </div>
        <div class="header__controls">
          <div class="header-controls">
            <div class="header-controls__inner d-flex">
              <div class="header-controls__inner-item">
                <a class="open-search icon" @click="isSearchOpened = !isSearchOpened">
                  <svg class="svg-sprite-icon icon-search">
                    <use
                      xlink:href="~assets/images/svg/symbol/sprite.svg#search"
                    ></use></svg
                ></a>
              </div>
              <div class="header-controls__inner-item">
                <a class="open-menu centered" :class="{'active': isBurgerOpened}" @click="toggleBurgerHandler"
                  ><span></span
                ></a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </header>
</template>
<style lang="scss">
@import './css/header.scss';
</style>
