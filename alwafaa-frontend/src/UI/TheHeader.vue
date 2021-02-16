<template>
  <q-header elevated>
    <q-toolbar>
      <q-btn
        flat
        dense
        round
        icon="menu"
        aria-label="Menu"
        @click="leftDrawerOpen = !leftDrawerOpen"
        v-if="false"
      />

      <q-avatar>
        <img src="~/assets/logo.png" />
      </q-avatar>

      <q-space />

      <!-- <q-toolbar-title>
        {{ $t("brand") }}
      </q-toolbar-title> -->

      <!-- <q-input
        outlined
        dense
        type="search"
        label="Search For a Course"
        label-color="secondary"
        bg-color="gray"
        color="white"
        v-model="text"
        input-class="text-right"
        class="q-ml-md search-input"
      >
        <template v-slot:append>
          <q-separator vertical inset color="white" />
          <q-icon v-if="text === ''" name="search" color="white" />
          <q-icon
            v-else
            name="clear"
            class="cursor-pointer"
            @click="text = ''"
          />
        </template>
      </q-input> -->

      <q-btn flat round dense label="En" @click="changeToEnglish" />
      <q-btn flat round dense label="Ar" @click="changeToArabic" />
    </q-toolbar>
  </q-header>
</template>

<script>
export default {
  name: "TheHeader",
  data() {
    return {
      text: "",
    };
  },
  methods: {
    async changeToEnglish() {
      this.$i18n.locale = "en-us";
      this.$i18n.fallbackLocale = "ar";
      // set quasar's language too!!
      await import("quasar/lang/en-us").then((lang) => {
        this.$q.lang.set(lang.default);
      });
    },
    async changeToArabic() {
      this.$i18n.locale = "ar";
      this.$i18n.fallbackLocale = "en-us";
      await import("quasar/lang/ar").then((lang) => {
        this.$q.lang.set(lang.default);
      });
    },
  },
};
</script>

<style lang="scss" scoped>
// .search-input {
//   background-color: $ground;
// }
</style>
