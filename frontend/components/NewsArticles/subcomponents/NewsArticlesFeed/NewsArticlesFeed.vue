<script setup>
const props = defineProps({
  withAds: Boolean,
  articles: Array,
  articleName: String,
})
const { withAds, articleName, articles } = props
</script>

<template>
  <div class="mainArticles section desktop">
    <div class="container">
      <div class="mainArticles-grid" :class="{ 'd-block': !withAds }">
        <div class="mainArticles-grid__banner" v-if="withAds">
          <div class="aside">
            <div class="aside__group">
              <div class="asideBanner aside-block rounded centered">
                <div>Рекламный <br />баннер</div>
              </div>
            </div>
          </div>
        </div>
        <div class="mainArticles-grid__content">
          <div class="mainArticles-list">
            <div
              class="mainArticles-list__item mainArticles-list__item--mb-20"
              v-for="article in articles"
              :key="article.id"
            >
              <NewsArticlesCard
                :height="300"
                :tag="articleName"
                :brand="'Volkswagen'"
                :date="article.updated_at"
                :views="article.views"
                :title="article.text"
                :link="`#`"
                :src="require('@/assets/images/content/b-1.png')"
                :srcset="require('@/assets/images/content/b-1.webp')"
                :alt="`img`"
              />
            </div>
          </div>
        </div>
        <div class="mainArticles-grid__banner" v-if="withAds">
          <div class="aside">
            <div class="aside__group">
              <div class="asideBanner aside-block rounded centered">
                <div>Рекламный <br />баннер</div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="mainArticles-more mainArticles-more--mt-20">
        <Button class="mainArticles-more__btn" :title="'Больше статей'" />
      </div>
    </div>
  </div>
</template>
