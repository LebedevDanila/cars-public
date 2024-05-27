const mainRoutes = [
  {
    name: 'Home',
    path: '/',
    file: '/pages/Home/Home.vue',
  },
  {
    name: 'Catalog',
    path: '/catalog',
    file: '/pages/Catalog/Catalog.vue',
  },
  {
    name: 'Generation',
    path: '/car/generation/:link',
    file: '/pages/CarGeneration/CarGeneration.vue',
  },
  {
    name: 'Brand',
    path: '/brand/:link',
    file: '/pages/Brand/Brand.vue',
  },
]

const adminRoutes = [
  {
    name: 'AdminBrandList',
    path: '/admin/brands',
    file: '/pages/Brand/BrandList.vue',
  },
  {
    name: 'AdminBrandCreate',
    path: '/admin/brand/create',
    file: '/pages/Brand/BrandConstructor.vue',
  },
  {
    name: 'AdminBrandEdit',
    path: '/admin/brand/:id',
    file: '/pages/Brand/BrandConstructor.vue',
  },
  {
    name: 'AdminCarModelList',
    path: '/admin/car/models',
    file: '/pages/CarModel/CarModelList.vue',
  },
  {
    name: 'AdminCarModelCreate',
    path: '/admin/car/model/create',
    file: '/pages/CarModel/CarModelConstructor.vue',
  },
  {
    name: 'AdminCarModelEdit',
    path: '/admin/car/model/:id',
    file: '/pages/CarModel/CarModelConstructor.vue',
  },
]

export default [...mainRoutes, ...adminRoutes]
