<template>
  <div class="bg-white">
      <q-toolbar>
        <q-avatar size="90px">
          <img src="~assets/logo.png">
        </q-avatar>

        <q-space />

        <q-input
          outlined dense
          type="search"
          label="Search For a Course"
          label-color="secondary"
          v-model="text"
          input-class="text-right"
          color="primary"
          class="q-ml-md search-input"
        >
          <template v-slot:append>
            <q-separator vertical inset color="primary" />
            <q-icon v-if="text === ''" name="search" color="primary" />
            <q-icon v-else name="clear" class="cursor-pointer" @click="text = ''" color="primary" />
          </template>
        </q-input>
      </q-toolbar>
    </div>
</template>

<script>
export default {
  name: 'SearchBar',
  data () {
    return {
      text: ''
    }
  }
}
</script>

<style lang="scss" scoped>
  .search-input {
    background-color: $ground;
  }
</style>
