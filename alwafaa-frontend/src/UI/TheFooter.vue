<template>
  <div class="column footer">
    <!-- <q-avatar size="90px" class="self-center logo"> -->
    <!-- eslint-disable-next-line prettier/prettier -->
      <!-- <img src="~assets/logo.png">
    </q-avatar> -->

    <p class="q-mt-sm self-center copy-rights">
      © 2021 Iqraaelearning.com, All Rights Reserved.
    </p>

    <div class="row self-center">
      <q-btn flat round icon="fab fa-google" color="red" />
      <q-btn flat round icon="fab fa-facebook" color="secondary" />
      <q-btn flat round icon="fab fa-linkedin" color="blue" />
      <q-btn flat round icon="fab fa-twitter" color="blue" />
      <q-btn flat round icon="fab fa-instagram" color="orange" />
    </div>
  </div>
</template>

<style lang="scss" scoped>
.footer {
  background-color: $gray;
  margin-top: 50px;

  .copy-rights {
    color: #fff;
    text-align: center;
  }
}
</style>
