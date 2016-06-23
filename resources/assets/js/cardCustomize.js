$(document).ready(function(){
    window.onhashchange = function(){
        let urlhash = window.location.hash;
        if(urlhash == "show"){
            return null;
        }else{
            vm.casa = null;
        }
    }
    $("#navleft").click(function(){
        if(vm.casa){
            $("#navleft").attr("href","#");
            vm.casa = null;
        }else{
            $("#navleft").attr("href","/wx/user");
        }
    })
    var vm = new Vue({
        el: '#app',
        data: {
            casas: null,
            casa:null,
            total:0,
            goods:[]
        },
        created: function () {
            this.getcasas();
        },
        methods:{
            getcasas(){
                $.getJSON('/wx/api/cardCasaList', (data) => {
                    this.casas = data;
                });
            },
            getcasa(id){
                $.getJSON('/wx/api/cardCasa/' + id, (data) => {
                    this.casa = data;
                });
                let seltext = 'show';
                window.location.hash = seltext;
            },
            buy(){
                this.goods = [];
                let num = this.selectd();
                if(num.length < 3){
                    alert("选择民宿必须大于三家");
                    return false;
                }
                $.ajax('/wx/api/cardCasaBuy', {
                    type: 'post',
                    data: {
                        casas:this.goods
                    },
                    headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                    success: (data)=>{
                        $("body").append(data);
                    }
                });
            },
            plus(index){
                this.total += this.casas[index].price;
                this.casas[index].room ++;
            },
            minus(index){
                if(this.casas[index].room <=0 ){
                    return;
                }
                this.casas[index].room --;
                this.total -= this.casas[index].price;
            },
            sel(index){
                if(this.casas[index].room > 0){
                    this.total = this.total-(this.casas[index].price * this.casas[index].room);
                    this.casas[index].room =0;
                }else{
                    this.total += this.casas[index].price;
                    this.casas[index].room ++;
                };
            },
            calculateTotal(){
                let total = 0;
                for (let i = 0; i < this.casas.length; i++) {
                    total += this.casas[i].price * this.casas[i].room;
                }
                this.total = total;
            },
            selectd(){
                for(let x in this.casas){
                    if(this.casas[x].room > 0){
                        let newRoom = {id:this.casas[x].id, headImg:this.casas[x].headImg, 'room':this.casas[x].room};
                        this.goods.push(newRoom);
                    }
                }
                return this.goods;
            }
        }
    })
})
