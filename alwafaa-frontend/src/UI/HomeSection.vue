<template>
  <div>
      <div class="row q-px-xl q-my-lg">
        <h5 class="col q-my-none section-title">Academy Sections</h5>
        <div class="column items-end">
          <q-btn dense flat color="secondary" label="See All" />
        </div>
      </div>
      <div class="row justify-around">
        <basic-card class="col-2"></basic-card>
        <basic-card class="col-2"></basic-card>
        <basic-card class="col-2"></basic-card>
        <basic-card class="col-2"></basic-card>
      </div>
    </div>
</template>

<script>
import BasicCard from './BasicCard'

export default {
  name: 'HomeSection',
  components: { BasicCard }
}
</script>

<style lang="scss" scoped>
  .section-title {
    color: $primary;
  }
</style>
