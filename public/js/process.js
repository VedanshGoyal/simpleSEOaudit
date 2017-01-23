function removeAnnouncement(id){

		var ajax_load = '<div style="margin: 30px 90px;" class="progress progress-striped active"><div class="progress-bar"  role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%"></div></div>';
		var remove = "delete";
		
		
		$.ajax({

			type: "POST",

			url: "dashboard/post",

			data: {process:remove,id:id},

			

			beforeSend:function(){

			// this is where we append a loading image

				$('#chatbox').html(ajax_load);

			},

			

			success:function(result){

				$('#chatbox').html(result);
				
			},

			

			error:function(){

				$('#chatbox').html('<p><strong>Oops!</strong> Try that again in a few moments.</p>');

			 }



		});



}

function getAnnouncementResult(){

	if($("#announce").val() == "" || $("#user").val() == ""){

		alert("Input areas must not be empty.");

		return false;

	}else{
	
		$(':input[data-loading-text]').click(function () {
			var btn = $(this)
			btn.button('loading')
			setTimeout(function () {
				btn.button('reset')
			}, 1000)
		});

		var ajax_load = '<div style="margin: 30px 90px;" class="progress progress-striped active"><div class="progress-bar"  role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%"></div></div>';

		var announce = $('#announce').val();
		var user = $('#user').val();
		var insert = "add";

		

		$.ajax({

			type: "POST",

			url: "dashboard/post",

			data: {process:insert,user:user,announce:announce},

			

			beforeSend:function(){

			// this is where we append a loading image

				$('#chatbox').html(ajax_load);

			},

			

			success:function(result){

				$('#chatbox').html(result);
				$('#announce').val("");
				$('#user').val("");

			},

			

			error:function(){

				$('#chatbox').html('<p><strong>Oops!</strong> Try that again in a few moments.</p>');

			 }



		});

	}	

}

function getURLResult(){

	

	if($("#url-check").val() == ""){

		alert("Input must not be empty.");

		return false;

	}else{

		var ajax_load = '<div style="margin: 30px 90px;" class="progress progress-striped active"><div class="progress-bar"  role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%"></div></div>';

		var urlcheck = $('#url-check').val();

		

		$.ajax({

			type: "POST",

			url: "urlanalysis/check",

			data: {url:urlcheck},

			

			beforeSend:function(){

			// this is where we append a loading image

				$('#url-result-data').html(ajax_load);

			},

			

			success:function(result){

				$('#url-result-data').html(result);

			},

			

			error:function(){

				$('#url-result-data').html('<p><strong>Oops!</strong> Try that again in a few moments.</p>');

			 }



		});

		
		$.ajax({

			type: "POST",

			url: "urlanalysis/report",

			data: {url:urlcheck},

			

			// beforeSend:function(){

			// this is where we append a loading image

				// $('#url-data').html(ajax_load);

			// },

			

			success:function(result){

				$('#url-data').html(result);

			},

			

			error:function(){

				$('#url-data').html('<p><strong>Oops!</strong> Try that again in a few moments.</p>');

			 }



		});
		
	}	

}

function getMetaResult(){

	if($("#meta-check").val() == ""){

		alert("Input must not be empty.");

		return false;

	}else{

	

		var ajax_load = '<div style="margin: 30px 90px;" class="progress progress-striped active"><div class="progress-bar"  role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%"></div></div>';

		var urlcheck = $('#meta-check').val();

		

		// $('#meta-result-data').html(ajax_load);

			

		if($("#ga-check").is(":checked")){

			var ga = $('#ga-check').val();

		}else{

			var ga = 0;

		}

		

		if($("#webmaster-check").is(":checked")){

			var web = $('#webmaster-check').val();

		}else{

			var web = 0;

		}

		

		if($("#pdk-check").is(":checked")){

			var pdk = $('#pdk-check').val();

		}else{

			var pdk = 0;

		}

		

		if($("#header-check").is(":checked")){

			var header = $('#header-check').val();

		}else{

			var header = 0;

		}	

		

		

		$.ajax({

			type: "POST",

			url: "metaanalysis/check",

			data: {url:urlcheck,ga_check:ga,web_check:web,pdk_check:pdk,header_check:header},

			

			beforeSend:function(){

			// this is where we append a loading image

				$('#meta-result-data').html(ajax_load);

			},

			

			success:function(result){

				$('#meta-result-data').html(result);

			},

			

			error:function(){

				$('#meta-result-data').html('<p><strong>Oops!</strong> Try that again in a few moments.</p>');

			 }



		});

		
		$.ajax({

			type: "POST",

			url: "metaanalysis/report",

			data: {url:urlcheck},

			

			// beforeSend:function(){

			// this is where we append a loading image

				// $('#meta-data').html(ajax_load);

			// },

			

			success:function(result){

				$('#meta-data').html(result);

			},

			

			error:function(){

				$('#meta-data').html('<p><strong>Oops!</strong> Try that again in a few moments.</p>');

			 }



		});
		

		

		

	}

}