<script setup>
import { getResponseData } from '~/helpers/getResponseData'

const staticDataReq = await useNuxtData('common/static-data')
const staticData = process.client ? getResponseData(staticDataReq, true) : []
</script>

<template>
  <footer class="footer">
    <div class="footer__group">
      <div class="footer__container">
        <div class="footer__head d-flex">
          <div class="footer__head-menu">
            <nav class="nav">
              <ul class="footer-menu flex">
                <li
                  class="footer-menu__item"
                  v-for="(menuItem, key) in staticData.menu"
                  :key="key"
                >
                  <NuxtLink class="footer-menu__link" :to="menuItem.link">{{
                    menuItem.name
                  }}</NuxtLink>
                </li>
              </ul>
            </nav>
          </div>
          <div class="footer__head-search">
            <form class="searchForm">
              <input
                class="searchForm-input searchForm-input--white"
                type="text"
                placeholder="Поиск"
              />
              <button class="searchForm-btn icon" type="submit">
                <svg class="svg-sprite-icon icon-search">
                  <use
                    xlink:href="~assets/images/svg/symbol/sprite.svg#search"
                  ></use>
                </svg>
              </button>
            </form>
          </div>
          <div class="footer__head-logo mobile">
            <a class="footer-logo centered" href="#">Автолюбитель</a>
          </div>
        </div>
      </div>
    </div>
    <div class="footer__group">
      <div class="footer__container">
        <div class="footer__cities d-flex">
          <div class="footer__cities-col">
            <ul class="footer-city">
              <li class="footer-city__item">
                <a class="footer-city__link" href="#">Краснодарский край</a>
              </li>
              <li class="footer-city__item">
                <a class="footer-city__link" href="#">Москва</a>
              </li>
              <li class="footer-city__item">
                <a class="footer-city__link" href="#">Санкт-Петербург</a>
              </li>
              <li class="footer-city__item">
                <a class="footer-city__link" href="#">Владимир</a>
              </li>
              <li class="footer-city__item">
                <a class="footer-city__link" href="#">Волгоград</a>
              </li>
              <li class="footer-city__item">
                <a class="footer-city__link" href="#">Воронеж</a>
              </li>
              <li class="footer-city__item">
                <a class="footer-city__link" href="#">Екатеринбург</a>
              </li>
            </ul>
          </div>
          <div class="footer__cities-col">
            <ul class="footer-city">
              <li class="footer-city__item">
                <a class="footer-city__link" href="#">Краснодарский край</a>
              </li>
              <li class="footer-city__item">
                <a class="footer-city__link" href="#">Москва</a>
              </li>
              <li class="footer-city__item">
                <a class="footer-city__link" href="#">Санкт-Петербург</a>
              </li>
              <li class="footer-city__item">
                <a class="footer-city__link" href="#">Владимир</a>
              </li>
              <li class="footer-city__item">
                <a class="footer-city__link" href="#">Волгоград</a>
              </li>
              <li class="footer-city__item">
                <a class="footer-city__link" href="#">Воронеж</a>
              </li>
              <li class="footer-city__item">
                <a class="footer-city__link" href="#">Екатеринбург</a>
              </li>
            </ul>
          </div>
          <div class="footer__cities-col">
            <ul class="footer-city">
              <li class="footer-city__item">
                <a class="footer-city__link" href="#">Краснодарский край</a>
              </li>
              <li class="footer-city__item">
                <a class="footer-city__link" href="#">Москва</a>
              </li>
              <li class="footer-city__item">
                <a class="footer-city__link" href="#">Санкт-Петербург</a>
              </li>
              <li class="footer-city__item">
                <a class="footer-city__link" href="#">Владимир</a>
              </li>
              <li class="footer-city__item">
                <a class="footer-city__link" href="#">Волгоград</a>
              </li>
              <li class="footer-city__item">
                <a class="footer-city__link" href="#">Воронеж</a>
              </li>
              <li class="footer-city__item">
                <a class="footer-city__link" href="#">Екатеринбург</a>
              </li>
            </ul>
          </div>
          <div class="footer__cities-col">
            <ul class="footer-city">
              <li class="footer-city__item">
                <a class="footer-city__link" href="#">Краснодарский край</a>
              </li>
              <li class="footer-city__item">
                <a class="footer-city__link" href="#">Москва</a>
              </li>
              <li class="footer-city__item">
                <a class="footer-city__link" href="#">Санкт-Петербург</a>
              </li>
              <li class="footer-city__item">
                <a class="footer-city__link" href="#">Владимир</a>
              </li>
              <li class="footer-city__item">
                <a class="footer-city__link" href="#">Волгоград</a>
              </li>
              <li class="footer-city__item">
                <a class="footer-city__link" href="#">Воронеж</a>
              </li>
              <li class="footer-city__item">
                <a class="footer-city__link" href="#">Екатеринбург</a>
              </li>
            </ul>
          </div>
          <div class="footer__cities-col">
            <ul class="footer-city">
              <li class="footer-city__item">
                <a class="footer-city__link" href="#">Краснодарский край</a>
              </li>
              <li class="footer-city__item">
                <a class="footer-city__link" href="#">Москва</a>
              </li>
              <li class="footer-city__item">
                <a class="footer-city__link" href="#">Санкт-Петербург</a>
              </li>
              <li class="footer-city__item">
                <a class="footer-city__link" href="#">Владимир</a>
              </li>
              <li class="footer-city__item">
                <a class="footer-city__link" href="#">Волгоград</a>
              </li>
              <li class="footer-city__item">
                <a class="footer-city__link" href="#">Воронеж</a>
              </li>
              <li class="footer-city__item">
                <a class="footer-city__link" href="#">Екатеринбург</a>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </div>
    <div class="footer__group">
      <div class="footer__container">
        <div class="footer-info">
          <div class="footer-info__inner d-flex">
            <div class="footer-info__inner-left">
              <div class="footer-info__group d-flex">
                <div class="footer-info__group-col">
                  <div class="footer-info__txt txt">
                    Рыбатекст используется дизайнерами, проектировщиками и
                    фронтендерами, когда нужно быстро заполнить макеты или
                    прототипы содержимым. Это тестовый контент, который не
                    должен нести никакого смысла, лишь показать наличие самого
                    текста или продемонстрировать....
                  </div>
                </div>
                <div class="footer-info__group-col">
                  <div class="footer-info__txt txt">
                    Рыбатекст используется дизайнерами, проектировщиками и
                    фронтендерами, когда нужно быстро заполнить макеты или
                    прототипы содержимым. Это тестовый контент, который не
                    должен нести никакого смысла, лишь показать наличие самого
                    текста или продемонстрировать....
                  </div>
                </div>
              </div>
            </div>
            <div class="footer-info__inner-right">
              <a class="footer-logo centered" href="#">Автолюбитель </a>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="footer__group">
      <div class="footer__container">
        <div class="footer-bottom txt">
          <div class="footer-bottom__inner d-flex">
            <div class="footer-bottom__inner-left">
              <div class="footer-copyright">
                © ООО “Автолюбитель” 2023 – актуальные автоновости
              </div>
            </div>
            <div class="footer-bottom__inner-right">
              <div class="footer-links">
                <div class="footer-links__inner d-flex">
                  <div class="footer-links__inner-item">
                    <a class="footer-links__item" href="#"
                      >Политика конфиденциальности</a
                    >
                  </div>
                  <div class="footer-links__inner-item">
                    <a class="footer-links__item" href="#"
                      >Телефон: +7 (999) 999-99-99</a
                    >
                  </div>
                  <div class="footer-links__inner-item">
                    <a class="footer-links__item" href="#"
                      >Email: info@email.ru</a
                    >
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </footer>
</template>
<style scoped lang="scss">
@import './css/footer.scss';
</style>
