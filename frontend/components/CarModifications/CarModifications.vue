<script setup>
import { computed, ref } from 'vue'

const page = ref(0)

const props = defineProps({
  name: String,
  modificationsData: Array,
})
const { modificationsData, name } = props

const specifications = computed(() => {
  const res = []
  modificationsData
    .map((i) => i.specs)
    .forEach((specs) => {
      specs.forEach((spec) => {
        const resItem = res.find((item) => item.code === spec.code)
        if (!resItem) {
          const entities = []
          for (let i = 0; i < modificationsData.length; i++) {
            const ents = modificationsData[i].specs
              .filter((f) => f.code === spec.code)
              .map((e) => e.entities)
            for (let j = 0; j < ents.length; j++) {
              for (let k = 0; k < ents[j].length; k++) {
                const foundEnt = entities.find(
                  (ent) => ent.name === ents[j][k].name,
                )
                if (!foundEnt) {
                  entities.push({
                    name: ents[j][k].name,
                    code: ents[j][k].code,
                    values: [ents[j][k].value],
                  })
                } else {
                  foundEnt.values.push(ents[j][k].value)
                }
              }
            }
          }
          res.push({
            code: spec.code,
            name: spec.name,
            entities,
          })
        }
      })
    })
  return res
})

const equipments = computed(() => {
  const res = []
  modificationsData
    .map((i) => i.equipments)
    .forEach((equip) => {
      equip.forEach((equipment) => {
        const resItem = res.find((item) => item.code === equipment.code)
        const entities = resItem ? resItem.entities : []
        for (let i = 0; i < modificationsData.length; i++) {
          const ents = modificationsData[i].equipments
            .filter((f) => f.code === equipment.code)
            .map((e) => e.entities)
          for (let j = 0; j < ents.length; j++) {
            for (let k = 0; k < ents[j].length; k++) {
              const foundEnt = entities.find(
                (ent) => ent.name === ents[j][k].name,
              )
              if (!foundEnt) {
                const values = new Array(modificationsData.length).fill(false)
                values[i] = true
                entities.push({
                  name: ents[j][k].name,
                  code: ents[j][k].code,
                  values,
                })
              } else {
                foundEnt.values[i] = true
              }
            }
          }
        }
        if (!resItem) {
          res.push({
            code: equipment.code,
            name: equipment.name,
            entities,
          })
        } else {
          resItem.entities = entities
        }
      })
    })

  return res
})
</script>

<template>
  <div class="complete" v-if="modificationsData">
    <div class="container">
      <div class="complete-head">
        <div class="complete-head__inner d-flex">
          <div class="complete-head__inner-title">
            <div class="complete-head__title">Комплектации авто</div>
          </div>
          <div class="complete-head__inner-txt">
            <div class="complete-head__txt">
              {{ modificationsData.length }} комплектаций доступно
            </div>
          </div>
          <div class="complete-head__inner-link">
            <a class="complete-head__link" href="#">
              <span class="complete-head__link-txt">Документация</span
              ><span class="complete-head__link-icon">
                <img src="~assets/images/general/right.svg" alt="icon" /></span
            ></a>
          </div>
        </div>
      </div>
      <div class="complete-auto-container">
        <div class="complete-auto-wrapper">
          <div
            class="complete-auto-item"
            v-for="modification in modificationsData"
            :key="modification.id"
          >
            <img
              :src="modification.image.path"
              alt="car"
              class="complete-auto-img"
            />
            <p class="complete-auto-title">{{ modification.name }}</p>
          </div>
        </div>
      </div>
      <div class="complete-info">
        <AccordionMain :title="'Технические характеристики'">
          <AccordionInner
            v-for="specification in specifications"
            :key="specification.code"
            :title="specification.name"
          >
            <div
              class="complete-auto__inner-accordion"
              v-for="entity in specification.entities"
              :key="entity.code"
            >
              <p class="complete-auto__inner-title">{{ entity.name }}</p>
              <div class="complete-auto__inner-wrapper">
                <div
                  class="complete-auto__inner-item"
                  v-for="(value, idx) in entity.values"
                  :key="idx"
                >
                  {{ value }}
                </div>
              </div>
            </div>
          </AccordionInner>
        </AccordionMain>

        <AccordionMain :title="'Комплектации'">
          <AccordionInner
            v-for="equipment in equipments"
            :key="equipment.code"
            :title="equipment.name"
          >
            <div class="complete-auto-container">
              <div
                class="complete-auto__inner-accordion"
                v-for="entity in equipment.entities"
                :key="entity.code"
              >
                <p class="complete-auto__inner-title">{{ entity.name }}</p>
                <div class="complete-auto__inner-wrapper">
                  <div
                    class="complete-auto__inner-item"
                    v-for="(value, idx) in entity.values"
                    :key="idx"
                  >
                    <svg
                      class="svg-sprite-icon icon-ok"
                      v-if="value"
                      width="30px"
                      height="30px"
                    >
                      <use
                        xlink:href="~assets/images/svg/symbol/sprite.svg#okk"
                      ></use>
                    </svg>
                    <svg
                      class="svg-sprite-icon icon-error"
                      v-else
                      width="30px"
                      height="30px"
                    >
                      <use
                        xlink:href="~assets/images/svg/symbol/sprite.svg#err"
                      ></use>
                    </svg>
                  </div>
                </div>
              </div>
            </div>
          </AccordionInner>
        </AccordionMain>
      </div>
    </div>
  </div>
</template>

<style scoped lang="scss">
@import './css/carModification.scss';
</style>
