<template>
  <div>
    <h1>My courses</h1>
    <div class="q-gutter-y-md form" style="width: 300px">
      <q-toolbar class="bg-primary text-white rounded-borders">
        <q-space />

        <q-input dark borderless v-model="enteredText" class="input-field">
          <template v-slot:append>
            <q-icon v-if="enteredText === ''" name="search" />
            <q-icon
              v-else
              name="clear"
              class="cursor-pointer"
              @click="enteredText = ''"
            />
          </template>
        </q-input>
      </q-toolbar>
    </div>
    <q-separator color="secondary" inset />
  </div>
</template>
<script>
export default {
  data() {
    return {
      enteredText: "",
    };
  },
};
</script>
<style lang="scss" scoped>
h1 {
  margin: 0 20px;
  width: 300px;
  font-size: 80px;
  display: inline;
}
.form {
  float: right;
  margin: 10px;
  .input-field {
    width: 300px;
  }
}
</style>
