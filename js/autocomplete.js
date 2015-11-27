$(function() {
	$( "#search" ).autocomplete({
		source: config.autocomplete_api_url,
		minLength: 3,
		select: function( event, ui ) {
			window.location.assign('#/places/' + ui.item.value.replace(", ", "-") );
		}
	});
});