/**
 * Created by wuxin on 15/5/17.
 */

var W = {
    del : function(data,url,callback,type){
        if(confirm('确定要删除或者禁用吗？')){
            W.ajax(data,url,callback,type);
        }
    },
    errFunc : function(){
        alert("出现未知错误");
    },
    ajax : function(data,url,callback,type){
        $.ajax({
            'url': url,
            'type': (type ? type :"post"),
            'dataType': 'json',
            'timeout': 30000,
            'data':data,
            'success': function (msg) {
                !callback ? W.defFunc(msg) : callback(msg);
            },
            'error': function(xhr){
                W.errFunc();
            }
        });
    },
    defFunc : function(msg){
        if(msg.code==1) {
            location.reload();
        }else{
            alert(msg.msg);
        }
    }
}