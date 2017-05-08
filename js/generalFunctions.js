
function init(){
	
	$( document ).ready(function() {
		
		$('#image_1').click(function () {
			showWindow ();
		});
	});
	
} 



function showWindow (){
	
	$(".content").css("z-index","1");
	$(".content").css("opacity","0.2");
	$( "<div class='overlay'>"+ buildPhotoDisplay() +"</div>" ).insertAfter( ".menu" );
	$('#closingButton').click(function () {
		removeWindow ();
	});
}


function removeWindow (){
	
	$( ".overlay" ).remove();
	$(".content").css("z-index","999");
	$(".content").css("opacity","1");
	
}



function buildPhotoDisplay(){
	var html = "<div id='gallery'> \
	<div id='img1'> \
		<img src='image/bld.jpg'> \
		<span>Image 1 caption</span> \
	</div>	\
	<div id='img2'> \
		<img src='image/bld.jpg'> \
		<span>Image 2 caption</span> \
	</div>	\
	<div id='img3'> \
		<img src='image/bld.jpg'> \
		<span>Image 3 caption</span> \
	</div>	\
	<div id='img4'> \
		<img src='image/bld.jpg'> \
		<span>Image 4 caption</span> \
	</div>	\
	<div id='img5'> \
		<img src='image/bld.jpg'> \
		<span>Image 5 caption</span> \
	</div>	\
	<div id='img6'> \
		<img src='image/bld.jpg'> \
		<span>Image 6 caption</span> \
	</div>	\
	<secton id='description'><p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p> \
	<input id='closingButton' type='image' src='image/closingButton.png'  /></section> \
	</div>";
	
	
	
	return html;
}