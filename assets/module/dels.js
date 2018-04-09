define(['jq', 'layer'], function(){
    return function(title, url, classname){
        //获取删除按钮对象（页面上有几个删除按钮就获取几个对象）
          //在每一个删除按钮上都绑定了点击事件
          $('.'+classname).click(function(){
            //将按钮对象转存，才能在$.get方法中继续使用
            _this = $(this);

            //将layer也模块化时，需要调用config方法来配置路径
            layer.config({
                path: '/assets/layer/' //layer.js所在的目录，可以是绝对目录，也可以是相对目录
            });

            //参数1: 选择框上的提示文字
            //参数2: 回调函数，当点击“确定”时，执行回调函数中的程序
            layer.confirm(title, function(){
              //获取当前点击的删除按钮的 data属性值，也就是当前行的admin_id
              var id = _this.attr('data');

              //发送ajax请求
              $.get(url, {id:id}, function(msg){
                console.log(msg);
                //msg = {"code": 200, "msg": "删除用户成功"};
                //判断后台程序的返回值
                if(msg.code == 200){
                  layer.alert(msg.msg);
                  //通过当前行的删除按钮，找到父级的td对象
                  //在通过td对象，找到父级的tr对象，再自杀
                  _this.parent().parent().remove();
                } else {
                  layer.alert(msg.msg);
                }
              }, 'json');
            });
          });
    }
  
})