function person(){
    this.name;
    this.age;

    this.sayHi = function(){
        console.log(this.name+"==>"+this.age);
    }
}

p = new person();

$('h1').css('background', 'blue');