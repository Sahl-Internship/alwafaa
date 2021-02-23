<template>
  <div class="q-pa-none">
    <q-carousel
      animated
      v-model="slide"
      navigation
      infinite
      :autoplay="autoplay"
      arrows
      transition-prev="slide-right"
      transition-next="slide-left"
      control-text-color="green"
      @mouseenter="autoplay = false"
      @mouseleave="autoplay = true"
    >
      <q-carousel-slide :name="1" img-src="~assets/slider-img.jpg" />
      <q-carousel-slide :name="2" img-src="~assets/slider-img.jpg" />
      <q-carousel-slide :name="3" img-src="~assets/slider-img.jpg" />
    </q-carousel>
  </div>
</template>

<script>
export default {
  data () {
    return {
      slide: 1,
      autoplay: true
    }
  }
}
</script>
