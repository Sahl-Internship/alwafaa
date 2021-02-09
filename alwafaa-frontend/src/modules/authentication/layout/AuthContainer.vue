<template>
  <div class="q-pa-md">
    <div class="row justify-around">

      <div class="col">
        <div class="row justify-center">
          <slot></slot>
        </div>
      </div>

      <div class="col right-section">
        <div class="row justify-center">
          <img
            alt="elearning-icon"
            src="~assets/elearning-icon-3.jpeg"
            class="fixed auth-page-img"
          />
        </div>
      </div>
    </div>
  </div>
</template>

<style lang="scss" scoped>
  .auth-page-img {
    width: 35%;
    height: 70%;
    margin-top: 60px;
  }

  @media (max-width: 700px) {
    .right-section {
      display: none;
    }
  }
</style>
