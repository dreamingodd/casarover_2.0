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
                // Check whether inputs confine the least requestments.
                var username = $('#username').val();
                var cellphone = $('#cellphone').val();
                let selectedCount = this.selectd().length;
                if (!checkParameters(username, cellphone, selectedCount)) return;
                // Start ajax request to create order.
                $.ajax('/wx/api/cardCasaBuy', {
                    type: 'post',
                    data: {
                        casas : this.goods,
                        username : username,
                        cellphone : cellphone
                    },
                    headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                    success: (data) => {
                        // log response data
                        console.log('order create successfully!');
                        console.log(data);
                        if (data['orderId']) {
                            // Start request to prepare payment and redirect to payment page.
                            location.href = "/wx/pay/wxorder/" + data.orderId;
                        } else {
                            console.log(data);
                            alert('探庐君处理你的请求时晕倒了, 请稍后再试！');
                        }
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

/** 检查 */
function checkParameters(username, cellphone, selectedCount) {
    if (!username) {
        alert("请输入姓名！");
        return false;
    }
    if (!isCellphoneNumber(cellphone)) {
        alert("请输入正确的手机号码！");
        return false;
    }
    if (selectedCount < 3){
        alert("请至少选择三家民宿");
        return false;
    }
    return true;
}
