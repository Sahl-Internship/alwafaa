<template>
  <q-card
    :class="{
      border: borderPrimary || borderSecondary,
      borderedPrimary: borderPrimary,
      borderedSecondary: borderSecondary,
    }"
  >
    <slot name="cardImg"></slot>

    <q-card-section>
      <slot name="cardHeader"></slot>
    </q-card-section>

    <q-card-section
      :class="{
        'q-pt-none': true,
        column: borderPrimary || borderSecondary,
        'q-gutter-y-sm': borderPrimary || borderSecondary,
      }"
    >
      <slot name="cardDescription"></slot>
    </q-card-section>

    <q-separator v-if="!(borderPrimary || borderSecondary)" />

    <q-card-actions class="q-pa-none justify-center">
      <slot name="cardAction"></slot>
    </q-card-actions>
  </q-card>
</template>

<script>
export default {
  name: 'BasicCard',
  props: ['borderPrimary', 'borderSecondary']
}
</script>

<style lang="scss" scoped>
.border {
  border-radius: 5px;
}
.borderedPrimary {
  border: solid 2px $primary;
  height: 180px;
  margin-top: 15px;
  &:hover {
    background-color: $grey-1;
  }
}

.borderedSecondary {
  border: solid 2px $orange-1;
  background-color: $grey-1;
  border-radius: 5px;
  height: 210px;
  &:hover {
    background-color: $grey;
  }
}
</style>
