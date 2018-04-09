//因为该模块依赖了jquery，所以先设置依赖
define(['jq'], function(){
    $('#d').css('color', 'red');
    return 100;
})