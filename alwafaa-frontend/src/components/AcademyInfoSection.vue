<template>
  <!-- <div class="q-pt-xl q-px-xl academy-info"> -->
  <div
    class="row justify-around items-center q-py-xl q-px-sm wrap academy-info"
    :class="!$q.screen.lt.xl ? 'section-height' : ''"
  >
    <div
      :class="{
        'col-3': !$q.screen.lt.xl,
        'col-12': $q.screen.lt.xl,
        'q-ml-sm': !$q.screen.lt.xl,
      }"
    >
      <h3 class="info-title">Who We Are?</h3>
      <p class="academy-desc">
        Iqraa academy is an academy for Teaching Arabic and Quran.
      </p>
    </div>
    <div class="col-1">
      <q-icon
        :name="$q.screen.lt.xl ? 'fas fa-chevron-down' : 'fas fa-chevron-right'"
        color="orange-1"
        size="50px"
        class="arrow-icon"
        :class="$q.screen.lt.xl ? 'arrow-icon-down' : 'arrow-icon-right'"
      />
    </div>

    <div
      :class="{
        'col-7': !$q.screen.lt.xl,
        'col-12': $q.screen.lt.xl,
      }"
    >
      <div class="row justify-around items-center">
        <basic-card
          borderPrimary="true"
          :class="{
            'col-3': !$q.screen.lt.xl,
            'col-4': $q.screen.lt.xl && $q.screen.gt.sm,
            'col-6': $q.screen.lt.sm,
            'q-ma-xs': $q.screen.lt.xl,
          }"
        >
          <template #cardDescription>
            <q-icon
              name="fas fa-user-graduate"
              color="primary"
              class="self-center"
              size="50px"
            ></q-icon>
            <div class="text-h4 self-center">1000+</div>
            <div class="text-subtitle2 self-center">Students</div>
          </template>
        </basic-card>

        <basic-card
          borderPrimary="true"
          :class="{
            'col-3': !$q.screen.lt.xl,
            'col-4': $q.screen.lt.xl && $q.screen.gt.sm,
            'col-6': $q.screen.lt.sm,
            'q-ma-xs': $q.screen.lt.xl,
          }"
        >
          <template #cardDescription>
            <q-icon
              name="fas fa-chalkboard-teacher"
              color="primary"
              class="self-center"
              size="50px"
            ></q-icon>
            <div class="text-h4 self-center">300+</div>
            <div class="text-subtitle2 self-center">Teachers</div>
          </template>
        </basic-card>

        <basic-card
          borderPrimary="true"
          :class="{
            'col-3': !$q.screen.lt.xl,
            'col-4': $q.screen.lt.xl && $q.screen.gt.sm,
            'col-6': $q.screen.lt.sm,
            'q-ma-xs': $q.screen.lt.xl,
          }"
        >
          <template #cardDescription>
            <q-icon
              name="fas fa-play-circle"
              color="primary"
              class="self-center"
              size="50px"
            ></q-icon>
            <div class="text-h4 self-center">100+</div>
            <div class="text-subtitle2 self-center">Courses</div>
          </template>
        </basic-card>
      </div>
    </div>
  </div>
  <!-- </div> -->
</template>

<script>
import BasicCard from "src/UI/BasicCard";

export default {
  name: "AcademyInfoSection",
  components: { BasicCard },
};
</script>

<style lang="scss" scoped>
.academy-info {
  background-color: $secondary;
  &.section-height {
    height: 350px;
  }
  .info-title {
    color: $orange-1;
    margin: 20px 0 10px;
    text-align: center;
  }
  .academy-desc {
    font-size: 20px;
    color: #fff;
    text-align: center;
  }

  .arrow-icon {
    position: relative;
    animation-delay: 0s;
  }

  .arrow-icon-right {
    animation: arrowMoveRight 2s infinite;
  }
  .arrow-icon-down {
    animation: arrowMoveDown 2s infinite;
  }
}
@keyframes arrowMoveRight {
  from {
    left: 0px;
  }
  to {
    left: 40px;
  }
}

@keyframes arrowMoveDown {
  from {
    top: 0px;
  }
  to {
    top: 30px;
  }
}
</style>
