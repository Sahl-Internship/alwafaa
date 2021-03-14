<template>
  <q-card class="search-card" flat>
    <q-card-section horizontal class="justify-between">
      <img
        class="card-img"
        src="/images/home-imgs/alorefy.jpg"
      />

      <q-card-section class="col-10 row self-center q-pa-none q-mr-xl">

        <div class="col-4 row q-gutter-y-md">
          <div class="col-12 text-h6 text-grey-3 ellipsis text-weight-bold">
            دورة حفظ القرآن الكريم 2021
          </div>

          <div class="col-9 row justify-between">
            <div class="row items-center q-gutter-x-sm">
              <img src="/images/Group 5796.png" width="20px" />
              <div class="text-subtitle1 text-grey-4">القرآن الكريم</div>
            </div>

            <div class="row items-center q-gutter-x-sm">
              <img src="/images/Path 9266.png" width="15px" />
              <div class="text-subtitle1 text-grey-4">12 يناير 2021</div>
            </div>
          </div>
        </div>

        <div class="col-4 row items-center justify-center">
          <q-avatar size="md">
            <q-img src="https://cdn.quasar.dev/img/boy-avatar.png" />
          </q-avatar>
          <div class="text-subtitle1 text-grey-4 q-ml-sm">د/محمد العريفي</div>
        </div>

        <div class="col-4 row items-center justify-end">
          <div class="
            text-red
            text-center
            text-subtitle2
            q-px-md q-py-xs
            rounded-borders
            course-finished
            status-box
          ">
            انتهت
          </div>

          <q-btn
            flat
            icon="mdi-chevron-left"
            to=""
          />
        </div>

      </q-card-section>
    </q-card-section>
  </q-card>
</template>

<style lang="scss" scoped>
.search-card {
  height: 140px;

  .card-img {
    width: 130px;
    height: 140px;
  }

  .course-start {
    background: rgb(80, 148, 236);
    background: rgba(80, 148, 236, 0.1);
  }

  .course-finished {
    background: rgb(240, 64, 64);
    background: rgba(240, 64, 64, 0.1);
  }

  .status-box {
    min-width: 135px;
  }
}
</style>
