//1. 将abcdefg中cde截取出来

function sss(str, start, length){
    //alert(str.charAt(3));
    result = '';
    for(i = start; i < start + length; i++){
        result += str.charAt(i);
    }
    alert(result);
}

sss('wyzsewrrefsdgwer', 5, 2);