<template>
    <div>
        <div class="left">
          <h3>
            <span>{{ city.value }}</span>
            <span>{{ area.value }}</span>
            已选
          </h3>
        </div>
        <h3>选择城市</h3>
        <ul class="city">
            <template v-for="city in citys">
                <li >
                <a @click="changeCity($index)">{{ city.value }}</a>
                </li>
            </template>
        </ul>
        <h3>选择区域</h3>
        <div class="line"></div>
        <div class="area">
          <ul>
            <template v-for="area in areas">
                <li  @click="changeArea($index)">
                  <a>{{ area.value }}</a>
                </li>
            </template>
          </ul>
        </div>
    </div>
</template>
<script>
export default{
    data () {
      return {
        'data': [],
        'citys': [],
        'areas': []
      }
    },
    created () {
      this.getData();
    },
    props: ['city','area'],
    methods: {
      getData() {
        this.$http.get('/m/areas').then((response) => {
          if (response.json().code === 0){
            this.$set('data', response.json().result);
            this.getCitys();
          } else {
            console.log(response);
          }
        })
      },
      getCitys(){
        for (var i = 0; i < this.data.length; i++) {
            if(this.data[i].level === 3){
              this.$set('citys', this.citys.concat(this.data[i]));
            }
        }
        this.getAreas();
      },
      getAreas(){
        this.areas = [];
        for (var i = 0; i < this.data.length; i++) {
            if(this.data[i].parentid === this.city.id){
              this.$set('areas', this.areas.concat(this.data[i]));
            }
        }
      },
      changeCity(index){
        this.city = this.citys[index];
        this.area = {};
        this.getAreas();
      },
      changeArea(index){
        this.area = this.areas[index];
        this.$dispatch('set-area', this.city,this.area)
      }
    }
}
</script>
<style lang="less" scoped>
  h3{
    margin: .8rem 3rem;
    font-size: 1.5rem;
    line-height: 2rem;
    color: #666;
  }
  .city{
    li{
      width: 25%;
      text-align: center;
      display: inline-block;
      font-size: 18px;
      line-height: 36px;
      color: #333;
      margin: .2rem 0;
      a{
        display: block;
        margin:  0 .5rem;
        border: 1px solid #ff8c00;
      }
    }
  }
  .area{
    ul{
      li{
        width: inherit;
        text-align: center;
        display: inline-block;
        font-size: 18px;
        line-height: 26px;
        color: #333;
        a{
          display: block;
          margin:  0 .5rem;
          padding: .6rem;
          border: 1px solid #ff8c00;
        }
      }  
    }
  }
</style>