<script setup></script>

<template>
  <div class="content">
    <Brands />
    <div class="sections">
      <NewsArticles
        :articleName="'Рейтинги'"
        :withBtn="true"
        :withAds="false"
        :type="1"
      />
      <NewsArticles
        :articleName="'Тест-драйв'"
        :withBtn="true"
        :withAds="false"
        :type="1"
      />
      <NewsArticles
        :articleName="'Обзоры'"
        :withBtn="true"
        :withAds="false"
        :type="1"
      />
      <NewsArticles
        :articleName="'Сравнения'"
        :withBtn="true"
        :withFeed="false"
        :type="2"
      />
    </div>
  </div>
</template>
