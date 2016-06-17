$(document).ready(function(){
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
            total:0
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
                $.getJSON('/wx/api/cardCasa/'+id, (data) => {
                    this.casa = data;
                });
            },
            buy(){
                const num = this.chechk();
                if(num < 3){
                    alert("选择民宿必须大于三家");
                    return false;
                }
                $.ajax('/wx/api/cardCasaBuy', {
                    type: 'post',
                    data: {
                        casas:this.casas
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
                if(this.casas[index].room >0){
                    this.total = this.total-(this.casas[index].price*this.casas[index].room);
                    this.casas[index].room =0;
                }else{
                    this.total += this.casas[index].price;
                    this.casas[index].room ++;
                };
            },
            chechk(){
                var num = 0;
                var x;
                for(x in this.casas){
                    if(this.casas[x].room > 0){
                        num++;
                    }
                }
                return num;
            }
        }
    })
})