<template>
  <div class="row justify-center bg-grey-1 q-gutter-y-lg q-pb-xl">
    <div class="col-11 row q-px-md">
      <div class="text-h6 text-grey-3 q-my-sm"> مشترك بها </div>
      <div class="col-12 row q-gutter-y-sm">
        <search-result-card class="col-12"></search-result-card>
      </div>
    </div>

    <div class="col-11 row q-px-md">
      <div class="text-h6 text-grey-3 q-my-sm"> الكل </div>
      <div class="col-12 row q-gutter-y-sm">
        <search-result-card
          class="col-12"
          v-for="x in 5"
          :key="x"
        ></search-result-card>
      </div>
    </div>
  </div>
</template>

<script>
import SearchResultCard from './SearchResultCard.vue'

export default {
  name: 'SearchResult',
  components: { SearchResultCard },
  props: ['searchText', 'selectedSection', 'selectedStatus'],
  mounted () {
    console.log(this.searchText)
    console.log(this.selectedSection)
    console.log(this.selectedStatus)
  }
}
</script>
