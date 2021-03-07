<template>
  <div class="row justify-center bg-grey-4">
    <q-avatar square size="150px" class="q-mt-xl">
      <q-img src="/images/auth-logo.png" />
    </q-avatar>

    <div class="col-12 row justify-center q-mt-lg q-gutter-x-lg">
      <div
        class="text-h6 col-xs-12 col-sm-5 text-white"
        :class="{
          'text-right': !$q.screen.lt.sm,
          'text-center': $q.screen.lt.sm
        }"
      >
        <q-icon name="mdi-phone" class="q-mr-xs" />
        966-9542523+
      </div>

      <div
        class="text-h6 col-xs-12 col-sm-5 text-white"
        :class="{
          'text-center': $q.screen.lt.sm
        }"
      >
        <q-icon name="mdi-email" class="q-mr-sm" />
        info@iqraa.com
      </div>
    </div>

    <q-separator class="col-9" spaced="lg" size="1px" color="grey-5" />

    <div
      class="col-12 row justify-center text-grey-1"
      :class="{
        'q-gutter-x-md': !$q.screen.lt.sm,
      }"
    >
      <q-btn
        flat no-caps type="button" :label="$t('student.footer.aboutIqraa')"
        :class="{
          'col-xs-6': $q.screen.lt.sm && checkDirection,
          'col-xs-12': $q.screen.lt.sm && !checkDirection,
          'order-last': $q.screen.lt.sm
        }"
      />
      <q-btn
        flat no-caps type="button" :label="$t('student.footer.withTeam')"
        :class="{
          'col-xs-6': $q.screen.lt.sm && checkDirection,
          'col-xs-12': $q.screen.lt.sm && !checkDirection
        }"
      />
      <q-btn
        flat no-caps type="button" :label="$t('student.footer.scholarship')"
        :class="{
          'col-xs-6': $q.screen.lt.sm && checkDirection,
          'col-xs-12': $q.screen.lt.sm && !checkDirection,
          'order-first': $q.screen.lt.sm && !checkDirection
        }"
      />
      <q-btn
        flat no-caps type="button" :label="$t('student.footer.recommendCourse')"
        :class="{
          'col-xs-6': $q.screen.lt.sm && checkDirection,
          'col-xs-12': $q.screen.lt.sm && !checkDirection
        }"
      />
      <q-btn
        flat no-caps type="button" :label="$t('student.footer.terms')"
        :class="{
          'col-xs-6': $q.screen.lt.sm && checkDirection,
          'col-xs-12': $q.screen.lt.sm && !checkDirection
        }"
      />
    </div>

    <div class="row q-my-lg text-grey-1">
      <q-btn type="button" flat rounded>
        <img src="/images/social media 1.png" width="30px" />
      </q-btn>
      <q-btn type="button" flat rounded>
        <img src="/images/social media 2.png" width="30px" />
      </q-btn>
      <q-btn type="button" flat rounded>
        <img src="/images/social media 3.png" width="30px" />
      </q-btn>
      <q-btn type="button" flat rounded>
        <img src="/images/social media 4.png" width="30px" />
      </q-btn>
    </div>
  </div>
</template>

<script>
export default {
  computed: {
    checkDirection () {
      return this.$q.lang.rtl
    }
  }
}
</script>
