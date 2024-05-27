import routes from './routes'

// @ts-ignore
export default defineNuxtConfig({

  modules: [
    '@nuxtjs/device',
    'vue3-carousel-nuxt',
    'dayjs-nuxt',
  ],

  // @ts-ignore
  css: [
    '~/assets/css/reset.scss',
    '~/assets/css/fonts.scss',
    '~/assets/css/vars.scss',
    '~/assets/css/mixins.scss',
    '~/assets/css/global.scss',
  ],

  components: [
    {
      path: '~/components',
      pathPrefix: false,
    },
  ],

  hooks: {
    'pages:extend' (pages: any) {
      // удаление дефолтных рутов
      pages.splice(0, pages.length)
      // добавление кастомных из routes.js
      pages.push(...routes)
    }
  },

  nitro: {
    routeRules: {
      '/api/**': { proxy: 'http://backend:9000/api/**' },
    }
  },

  dayjs: {
    locales: ['ru', 'en'],
    defaultLocale: 'ru',
  }
})
