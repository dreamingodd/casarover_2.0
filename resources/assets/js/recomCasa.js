$(document).ready(function(){
    new Vue({
        el: '#main',
        data: {
            casas: null,
            checkedNames: [],
            selected:2
        },
        created: function () {
            this.getcasa(2);
        },
        methods:{
            getcasa(){
                $.getJSON('/api/casa/recom/'+this.selected, (data) => {
                    this.casas = data;
                    this.sel();
                });
            },
            save(){
                $.ajax('/back/api/recom/save', {
                    type: 'post',
                    data: {
                        city:this.selected,
                        casa:this.checkedNames
                    },
                    headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                    success: (data)=>{
                        if(data.msg){
                            $('.alert').css('display','block');
                            $('.alert').delay("slow").slideUp(500);
                            this.sel();
                        }
                    }
                });
                this.checkedNames=[];
            },
            sel(){
                $.getJSON('/api/home/recom/'+this.selected, (data) =>{
                    for(var k=0; k < data.length; k++){
                        this.checkedNames.push(data[k].id.toString());
                    }
                });
            }
        }
    })
})
