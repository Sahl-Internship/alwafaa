<template>
  <q-card class="my-card col-xs-12 col-sm-6 col-md-3 col-lg-3 q-my-md" >
  <div class="container" >
    <slot></slot>
    <div class="overlay"></div>
    <div class="label-container">
      <div >
        <slot name="teacherData"></slot>
        <!-- <p class="label-1">
          <img src="~public/images/home-imgs/person.png" class="img-icon">
          د / محمد العريفي
        </p> -->
      </div>
      <div>
        <slot name="sectionData"></slot>
        <!-- <p class="label-2">
         <img src="~public/images/home-imgs/quran-icon2.png" class="img-icon2">
         القرآن الكريم
       </p> -->
      </div>
      <div>
        <slot name='courseState'></slot>
      </div>
  </div>
</div>
<q-card-section>
  <div class="row no-wrap items-center text-center">
    <slot name="text"></slot>
  </div>
  <div class="rating-section justify-center row">
    <slot name='rating'></slot>
    <!-- <p class="rating-no">4.5</p>
    <img src="/images/home-imgs/full-star.png" alt="" class="star-icon q-mr-xs" :class="{'flip-img':!checkDirection}">
    <img src="/images/home-imgs/full-star.png" alt="" class="star-icon q-mr-xs" :class="{'flip-img':!checkDirection}">
    <img src="/images/home-imgs/full-star.png" alt="" class="star-icon q-mr-xs" :class="{'flip-img':!checkDirection}">
    <img src="/images/home-imgs/full-star.png" alt="" class="star-icon q-mr-xs" :class="{'flip-img':!checkDirection}">
    <img src="/images/home-imgs/half-star.png" alt="" class="star-icon q-mr-xs" :class="{'flip-img':!checkDirection}">
    <p class="rating-no2">(455)</p> -->
  </div>
</q-card-section>
<q-separator class="separator" />

<div class="duration-view row">
  <div class="col-6">
   <slot name="viewedSection"></slot>
  </div>
  <div class="col-6 text-right">
   <slot name="durationSection"></slot>
  </div>
</div>
</q-card>
</template>

<script>
export default {
  name: 'BasicCard',
  props: ['borderPrimary', 'borderSecondary'],
  computed: {
    checkDirection () {
      return this.$q.lang.rtl
    }
  }
}
</script>

<style lang='scss' scoped>
title{
  @media (max-width: 480px){
    font-size: 22px;
  }
}
.highest-rate{
  @media(max-width: 480px){
    text-align: center;
    margin-bottom: 15px;
  }
}
.register-section {
  background-color: $grey-1;
  .ready-text {
    color: $secondary;
  }

  .exp-text {
    color: $grey-4;
  }
}
.arrow{
    @media(max-width: 480px),(max-width: 340px){
        text-align: center;
    }
}
.slider-container{
  height: 550px;
  overflow: hidden;
  position: relative;
    .slider{
        height: 100%;
        padding: 18px 0px;
        .slick{
          height: 100%;
          margin: 0;
          padding: 0;
          right: 0;
          left: 0;
          width: 100%;
        }
        .slick-slide{
          outline: none;
        }
        .my-card{
            // margin-left: -410px;
            display: inline-block;
            width:400px !important;
            height: 420px !important;
             @media(max-width: 1170px ){
              width:365px !important;
              height: 420px !important;
            }
            @media(max-width: 340px ),(max-width: 480px){
              width:300px !important;
              height: 420px !important;
              display: inline-block !important;
            }
            .rating-section{
              margin-top: 20px;
              margin-bottom: 30px;
              .rating-no,.rating-no2{
              display: inline;
              margin: 0px 8px;
              }
              .star-icon{
                width: 15px;
                height: 15px;
                display: inline;
              }
              .rating-star{
                // float: right;
                // transform: scaleX(-1)
                display: inline;
              }
            }
            .separator{
              position: absolute;
              bottom: 55px;
              margin-top: 0px;
              width: 100%;
            }
        .duration-view{
          margin-top: 20px;
          .duration{
            font-size: 15px;
            margin-right: 27px;
            margin-top: 3px;
            // padding-left: 10px;
          }
          .duration-icon{
            width: 15px !important;
            height: 15px !important;
            display: inline;
            position: absolute;
            bottom: 21px;
            right: 85px;
          }
          .viewed-icon{
              width: 15px;
              height: 15px;
              display: inline;
              position: absolute;
              bottom: 21px;
              left: 25px;
          }
          .viewed-no{
              font-size: 15px;
              margin-left: 50px;
              margin-top: 3px;
          }
          // Flip in English
          .duration-flip{
            margin-left: 27px;
          }
          .duration-icon-flip{
            left: 85px;
          }
          .viewed-icon-flip{
              right: 25px;
          }
          .viewed-no-flip{
              margin-right: 50px;
          }
        }
    img{
    border-radius: 5px 5px 0px 0px;
    height: 220px;
    width: 100%;
    }
    .course-name{
      padding: 0px 50px;
      @media (max-width: 340px),(max-width: 480px){
        padding: 0px 10px
      }
    }
    .container{
        border-radius: 5px 5px 0px 0px;
        position: relative;
        height: 220px;
        top: 0;
        left: 0;
        right: 0;
        .label-1{
            position: absolute;
            top: 0;
            left: 0;
            margin-top: 20px;
            margin-left: 25px;
            left: 20px;
            color: #fff;
            font-size: 12px;
        }
        .label-2{
            position: absolute;
            top: 0;
            left: 0;
            margin-top: 50px;
            margin-left: 25px;
            left: 20px;
            color: #fff;
            font-size: 12px;
        }
        .img-icon{
            width: 17px;
            height: 15px;
            position: absolute;
            padding-right: 0px;
            margin-left: -27px;
            left: 0;
            margin-top: -1px;
        }
        .img-icon2{
            width: 20px;
            height: 17px;
            position: absolute;
            padding-right: 0px;
            margin-left: -27px;
            left: 0;
            margin-top: -1px;
        }
        .overlay {
            border-radius: 5px 5px 0px 0px;
            position: absolute;
            bottom: 0;
            background: rgb(0, 0, 0);
            background: rgba(0, 0, 0, 0.5); /* Black see-through */
            color: #f1f1f1;
            width: 100%;
            transition: .5s ease;
            opacity:1;
            color: white;
            height: 100%;
            padding: 20px;
            text-align: center;
        }
    }
    }
  }
}
.flip-img{
  transform: scaleX(-1);
}
</style>
