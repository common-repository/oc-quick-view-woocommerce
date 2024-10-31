jQuery(document).ready(function(){
	jQuery('body').on('click','.form_option',function(){
		jQuery('body').addClass("quickview_popup_body");
		jQuery('body').append('<div class="ocwqv_loading"><img src="'+ object_name +'/images/loader.gif" class="ocwqv_loader"></div>');
		var loading = jQuery('.ocwqv_loading');
		loading.show();

		var id = jQuery(this).data("id");
		var current = jQuery(this);
		jQuery.ajax({
			url:ajax_url,
			type:'POST',
			data:'action=productscomments&popup_id_pro='+id,
			success : function(response) {
				var loading = jQuery('.ocwqv_loading');
				loading.remove(); 
				jQuery("#quickview_popup").css("display","block");
				jQuery("#quickview_popup").html(response);

			},
			error: function() {
				alert('Error occured');
			}
		});
	   return false; 
   });
	var modal = document.getElementById("quickview_popup");
	var span = document.getElementsByClassName("quickview_close")[0];
	jQuery(document).on('click','.quickview_close',function(){
		jQuery("#quickview_popup").css("display","none");
		jQuery('body').removeClass("quickview_popup_body");
	});
	window.onclick = function(event) {
	  if (event.target == modal) {
		modal.style.display = "none";
		jQuery('body').removeClass("quickview_popup_body");
	  }
	}
});


