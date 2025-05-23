jQuery(document).ready(function($){
    const total = $('input#inline-share-data');
	total.val(parseInt(ajax.total_share));

	const sendForm = $( 'form#send_data' );
	const ajaxUrl = ajax.url;

	//const ipCall = getIP();

	function getIP(){
		var result = null;
		$.ajax( {
			async: false,
			url: "https://api.db-ip.com/v2/free/self",
			type: "get",
			dataType: "json",
			success: function(data){
				result = data;
			}
		});
		return result;
	}

	//clearing dynamic feedbacks
	function clearDynFeeds(){
		$('p#success_message').empty()
		$('h4#duplicate_data').empty();
		$('ul#no_values').empty();
	}

	sendForm.on( 'submit', function( e ) {
		e.preventDefault();

//		const form = sendForm.serialize() + '&ip=' + encodeURIComponent(ipCall.ipAddress) + '&country=' + encodeURIComponent(ipCall.countryName);
		const form = sendForm.serialize() + '&ip=' + encodeURIComponent("NULL") + '&country=' + encodeURIComponent("NULL");
		const formData = new FormData;
		formData.append( 'action', 'kdb_add_member' );
		formData.append( 'add_member', form );

		$.ajax( { 
			url: ajaxUrl,
			data: formData,
			type: 'post', 
			dataType: 'json',
			processData: false,
			contentType: false,
			success( result ) {
				if ( result.success === true ) {

					clearDynFeeds();

					if($('p#success_message').hasClass('hidden')){
						$('p#success_message').append( result.data ).removeClass('hidden');
					}else{
						$('p#success_message').append( result.data );
					}

					sendForm[ 0 ].reset();

				} else if ( result.data.message ) {

					clearDynFeeds();

					if($('h4#duplicate_data').hasClass('hidden')){
						$('h4#duplicate_data').append( result.data.message ).removeClass('hidden');
					} else{
						$('h4#duplicate_data').append( result.data.message );
					}
				} else {

					clearDynFeeds();

					if($('h4#duplicate_data').hasClass('hidden')){
						$('h4#duplicate_data').append( 'Please fill out the following fields:' ).removeClass('hidden');
					} else{
						$('h4#duplicate_data').append( 'Please fill out the following fields:' );
					}
					$.each( result.data, function( key, value ) {
						$('ul#no_values').append( '<li class="red-500">' + value + '</li>' );
					} );
				}
			}
		} );
		
	});


});