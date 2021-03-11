<template>
  <q-card class="my-card col-xs-12 col-sm-6 col-md-3 col-lg-3 q-my-md" >
  <div class="container" >
    <slot></slot>
    <div class="overlay"></div>
    <div class="label-container">
      <div >
        <slot name="teacherData"></slot>
      </div>
      <div>
        <slot name="sectionData"></slot>
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
  </div>
</q-card-section>
<q-separator class="separator" />

<div class="duration-view row">
  <div class="col-3">
   <slot name="viewedSection"></slot>
  </div>
  <div class="col-3 text-center">
   <slot name="durationSection"></slot>
  </div>
  <div class="col-3">
    <slot name="joined_student"></slot>
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
//   }
// }
.flip-img{
  transform: scaleX(-1);
}
</style>
