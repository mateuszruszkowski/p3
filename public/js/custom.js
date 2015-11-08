
//------------------------------------------------------------------------
// https://developers.google.com/web/updates/2015/04/cut-and-copy-commands
// This is used in users and lorem ipsum generator
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

/**
* Writed in jQuery to use with generated password
*/
$( document ).on("click", "#copyPass", function(){
	$("#toCopy").select();

	console.log($("#toCopy").val() );
	try {  
		var successful = document.execCommand('copy');  
		var msg = successful ? 'successfully' : 'unsuccessfully';  
		console.log('You ' + msg + ' copied generated text.');  
	} catch(err) {  
		console.log('Oops, unable to copy');  
	} 
});

/**
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

/**
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

//------------------------------------------------------------------------
// http://stackoverflow.com/questions/3024745/cross-browser-bookmark-add-to-favorites-javascript
//------------------------------------------------------------------------
$( document ).ready(function(){
	// if we in password generator page  
	if( window.location.href.indexOf('password-generator')>0 ){
		// change location after new password was generated
		var title = 'Generated password';
		var password = $("#toCopy").val();
		
	 	// add password to link if itisn't exist jet
	 	if( window.location.href.indexOf('passwordg')==-1){
	 		window.history.pushState("Generated password", title, window.location.href+"&passwordg="+password );	
	 	}
	}

});

// click on add to bookmark button
$( document ).on("click", "#addBookmark", function() {
 	var title = 'Generated password';
 	var password = $("#toCopy").val();

 	if( $("#bookmark_name").val().length >0 ) {
 		title = $("#bookmark_name").val();
 	}

 	// add password to link if it isn't exist jet
 	if( window.location.href.indexOf('passwordg')==-1){
 		window.history.pushState("Generated password", title, window.location.href+"&passwordg="+password );	
 	}

 	// generate title
 	document.title = title;

	if (window.sidebar && window.sidebar.addPanel) { // Mozilla Firefox Bookmark
	  window.sidebar.addPanel(document.title,window.location.href,'');
	} else if(window.external && ('AddFavorite' in window.external)) { // IE Favorite
	  window.external.AddFavorite(location.href,document.title);
	} else if(window.opera && window.print) { // Opera Hotlist
	  this.title=document.title;
	  return true;
	} else { // webkit - safari/chrome
	  alert('Press ' + (navigator.userAgent.toLowerCase().indexOf('mac') != - 1 ? 'Command/Cmd' : 'CTRL') + ' + D to bookmark this page.');
	}
});




