(function(){
    function person(){
        this.name;
        this.age;

        this.sayHi = function(){
            console.log('我叫'+this.name+',今年'+this.age+'岁');
        }
    }

    p = new person();

    //在person.js中增加判断，如果使用模块方式，那么html一定会加载
    //require.js文件，这时可以通过判断define是不是函数，来确定要
    //不要定义模块
    if(typeof define == 'function'){
        define(function(){
            return p;
        });
    }
})()