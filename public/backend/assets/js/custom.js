/**
 *
 * You can write your JS code here, DO NOT touch the default style file
 * because it will make it harder for you to update.
 * 
 */

"use strict";


// alert message show hide part js 

setTimeout(function() {
    $('.alertsuccess').slideUp(1000);
 },5000);


setTimeout(function() {
    $('.alerterror').slideUp(1000);
 },10000);


//  onchange image file part
$('.fileimage').change('.changeImage',function(){
    let reader =new FileReader();
    let file =document.querySelector('.fileimage').files[0];
    reader.onload =function(e){
        $(".changeImage").attr('src',e.target.result);
    }
    reader.readAsDataURL(file);
});

