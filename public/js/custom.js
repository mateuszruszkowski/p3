
//------------------------------------------------------------------------
// https://developers.google.com/web/updates/2015/04/cut-and-copy-commands
// This is used in user and lorem ipsum generator
//------------------------------------------------------------------------
var cutTextareaBtn = document.querySelector('#copy');

if(cutTextareaBtn != null){
	cutTextareaBtn.addEventListener('click', function(event) {  
	  var cutTextarea = document.querySelector('#generated_text');  
	  cutTextarea.select();

	  try {  
	    var successful = document.execCommand('copy');  
	    var msg = successful ? 'successfully' : 'unsuccessfully';  
	    cutTextarea.value = ('You ' + msg + ' copied generated text.');  
	  } catch(err) {  
	    cutTextarea.value = ('Oops, unable to copy');  
	  }  
	});
}

/*
 * Users generator
 */

//similar action to target download button, now targettet by jQuery
$( document ).on("click", '#download', function(){
	$("Form").attr("action","/user-generator/download").submit();
});
//similar action to target generate button, also by jQuery
$( document ).on("click", '#generate', function(){
	$("Form").attr("action","/user-generator").submit();
});

/*
 * Lorem ipsum generator
 */

//similar action to target download button, now targettet by jQuery
$( document ).on("click", '#download_lorem', function(){
	$("Form").attr("action","/lorem-ipsum-generator/download").submit();
});
//similar action to target generate button, also by jQuery
$( document ).on("click", '#generate_lorem', function(){
	$("Form").attr("action","/lorem-ipsum-generator").submit();
});