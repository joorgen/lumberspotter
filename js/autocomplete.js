$(function() {
	$( "#search" ).autocomplete({
		source: 'api/autocomplete_places.php',
		minLength: 3,
		select: function( event, ui ) {
			window.location.assign('#/places/' + ui.item.value.replace(", ", "-") );
		}
	});
});