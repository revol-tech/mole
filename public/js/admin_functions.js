$(function(){
	var $img;
	$('.change_img').live('click',function(e){
		e.preventDefault();
		
		var str = '<label><input class="img_nu" type="file" name="file" /><a class="cancel_change_img" href="#">cancel</a></label>';
		$('.img').after(str);
		$img = $('.img').detach();
		$('.change_img').remove();
	})
	
	$('.cancel_change_img').live('click',function(e){
		e.preventDefault();
		
		$(this)
			.after('<a href="#" class="change_img">change</a>')
			.after($img)
		$('.img_nu').remove();
		$(this).remove();
	})
})
