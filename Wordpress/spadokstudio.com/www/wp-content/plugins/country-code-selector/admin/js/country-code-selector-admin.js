(function( $ ) {
	'use strict';

	/**
	 * All of the code for your admin-facing JavaScript source
	 * should reside in this file.
	 *
	 * Note: It has been assumed you will write jQuery code here, so the
	 * $ function reference has been prepared for usage within the scope
	 * of this function.
	 *
	 * This enables you to define handlers, for when the DOM is ready:
	 *
	 * $(function() {
	 *
	 * });
	 *
	 * When the window is loaded:
	 *
	 * $( window ).load(function() {
	 *
	 * });
	 *
	 * ...and/or other possibilities.
	 *
	 * Ideally, it is not considered best practise to attach more than a
	 * single DOM-ready or window-load handler for a particular page.
	 * Although scripts in the WordPress core, Plugins and Themes may be
	 * practising this, we should strive to set a better example in our own work.
	 */

	$(function() {
		$('input[type="checkbox"]').click(function(){
			if($(this).prop("checked") == true){
				if(
					$(this).attr('id') !== 'show_selected' &&
					$(this).attr('id') !== 'js_validation' &&
					$(this).attr('class') !== 'country'
				){
					alert('Make sure the '+$(this).attr('data-plugin-name')+' plugin is installed and activated.');
				}
							
				if($(this).attr('id') == 'enable_on_gform'){
					$('.gform-panel').css('display','block');
				}else if($(this).attr('id') == 'enable_on_cform7'){
					$('.cform7-panel').css('display','block');
				}
			}else{
				if($(this).attr('id') == 'enable_on_gform'){
					$('.gform-panel').css('display','none');
				}else if($(this).attr('id') == 'enable_on_cform7'){
					$('.cform7-panel').css('display','none');
				}
			}
		});

		$('[data-toggle="tooltip"]').tooltip();

		$(document).ready(function(){
			function formatState (state) {
			  if (!state.id) {
			    return state.text;
			  }
			  var baseUrl = "https://flagcdn.com/16x12";
			  var $state = $(
			    '<span><img src="' + baseUrl + '/' + state.element.value.toLowerCase() + '.png" class="img-flag" /> ' + state.text + '</span>'
			  );
			  return $state;
			};

			$(".select2").select2({
			  templateResult: formatState,
			  templateSelection: formatState,
			  placeholder: "Select a country",
			  width: '100%'
			  // allowClear: true
			});

			$('#select_all').click(function(){
				$(".select2 > option").prop("selected","selected");
	            $(".select2").trigger("change");
			});

			$('#clear_all').click(function(){
				$(".select2 > option").prop("selected",false);
	            $(".select2").trigger("change");
			});
		});

	});

})( jQuery );
