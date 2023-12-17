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
 },5000);


//  onchange image file part
$('.fileimage').change('.changeImage',function(){
    let reader =new FileReader();
    let file =document.querySelector('.fileimage').files[0];
    reader.onload =function(e){
        $(".changeImage").attr('src',e.target.result);
    }
    reader.readAsDataURL(file);
});
//  onchange group image file part
$('.g_fileimage').change('.g_changeImage',function(){
    let reader =new FileReader();
    let file =document.querySelector('.g_fileimage').files[0];
    reader.onload =function(e){
        $(".g_changeImage").attr('src',e.target.result);
    }
    reader.readAsDataURL(file);
});



// jquery tagsinput plugin part 
$(document).ready(function(){

// jQuery
$('#tagsinput').tagify();
$('#tagsinput_kg').tagify();

// Vanilla JavaScript
// var input = document.querySelector('#tagsinput'),
// tagify = new Tagify( input );



});


// size disable part 

$(document).ready(function(){

$("#size_d_1").hide();
$("#size_d_2").hide();
$("#product-sizes-disable").prop( "disabled", true );
$("#size_d_2_btn").prop( "checked", false ) ;
$("#size_d_1_btn").prop( "checked", false ) ;

$("#size_d_1_btn").on("click", function () {
  $("#size_d_2").hide();
  $("#size_d_2 > input").prop( "disabled", true ).prop( "checked", false );
  $("#size_d_1").show();
  $("#size_d_2_btn").prop( "checked", false ) ;
  $("#size_d_1_btn").prop( "checked", true ) ;
  $("#product-sizes-disable").hide();
  $("#size_d_2").prop( "disabled", true );
  $("#size_d_1").prop( "disabled", false );



});

$("#size_d_2_btn").on("click", function () {
  $("#size_d_2").show();
  $("#size_d_1").hide();
  $("#size_d_1 > input").prop( "disabled", true ).prop( "checked", false );
  $("#size_d_1_btn").prop( "checked", false ) ;
  $("#size_d_2_btn").prop( "checked", true ) ;
  $("#product-sizes-disable").hide();
  $("#size_d_1").prop( "disabled", true );
  $("#size_d_2").prop( "disabled", false );

});



});




// pdf code 




