(function( $ ) {
	'use strict';

	// Create the defaults once
	var pluginName = "quickView",
		defaults = {
			'btnText' : 'Quick View',
			'modalHeightAuto' : '1',
			'loadingSVG' : '<svg width="40" height="10" viewBox="0 0 120 30" xmlns="http://www.w3.org/2000/svg" fill="#fff"> <circle cx="15" cy="15" r="15"> <animate attributeName="r" from="15" to="15" begin="0s" dur="0.8s" values="15;9;15" calcMode="linear" repeatCount="indefinite" /> <animate attributeName="fill-opacity" from="1" to="1" begin="0s" dur="0.8s" values="1;.5;1" calcMode="linear" repeatCount="indefinite" /> </circle> <circle cx="60" cy="15" r="9" fill-opacity="0.3"> <animate attributeName="r" from="9" to="9" begin="0s" dur="0.8s" values="9;15;9" calcMode="linear" repeatCount="indefinite" /> <animate attributeName="fill-opacity" from="0.5" to="0.5" begin="0s" dur="0.8s" values=".5;1;.5" calcMode="linear" repeatCount="indefinite" /> </circle> <circle cx="105" cy="15" r="15"> <animate attributeName="r" from="15" to="15" begin="0s" dur="0.8s" values="15;9;15" calcMode="linear" repeatCount="indefinite" /> <animate attributeName="fill-opacity" from="1" to="1" begin="0s" dur="0.8s" values="1;.5;1" calcMode="linear" repeatCount="indefinite" /> </circle></svg>',
		};

	// The actual plugin constructor
	function Plugin ( element, options ) {
		this.element = element;
		
		this.settings = $.extend( {}, defaults, options );
		this._defaults = defaults;
		this.trans = this.settings.trans;
		this._name = pluginName;
		this.init();
	}

	// Avoid Plugin.prototype conflicts
	$.extend( Plugin.prototype, {
		init: function() {
			this.window = $(window);
			this.documentHeight = $( document ).height();
			this.windowHeight = this.window.height();
			this.product = {};

			this.settings.quickViewButton = $('.quick-view-button');
			this.settings.quickViewModal = $('.quick-view-modal');
			this.settings.quickViewPopupInputField = $('.woocommerce-quick-view-popup-input-field');
			this.settings.quickViewPopupIcon = $('.woocommerce-quick-view-popup-icon').find('.fa');
			this.settings.quickViewPopupMessage = $('.woocommerce-quick-view-popup-message');


			this.quickViewButton();
			this.quickViewPopup();
			this.ajaxAddToCart();
		},
		quickViewButton : function() {

			var that = this;
			var product_id;

			$(document).on('click', '.quick-view-button', function(e) {
				e.preventDefault();

				var $this = $(this);

				$this.html(that.settings.loadingSVG);
				that.settings.quickViewModal.html('');

				product_id = $this.data('product-id');

				if(product_id == "") {
					$this.html(that.trans.btnText);
					return;
				}

				if(that.settings.openEffect == "inline") {
					that.getSingleProduct(product_id, that.openInline, that);
					that.closeInline();
				} else {
					that.getSingleProduct(product_id, that.openModal, that);	
				}
			});
		},
		quickViewPopup : function() {

			var that = this;

			if(that.settings.quickViewPopupInputField.length < 1) {
				return false;
			}

			that.settings.quickViewPopupInputField.on('keypress', function (e) {
		  		if (e.which != 13) {
			    	return true;
			  	}

			  	var $this = $(this);
			  	var skuOrProduct = $this.val();

			  	if(skuOrProduct == "") {
			  		return false;
			  	}

			  	that.settings.quickViewPopupIcon.removeClass('fa-eye').addClass('fa-spin fa-circle-o-notch');

  				jQuery.ajax({
					url: that.settings.ajax_url,
					type: 'post',
					dataType: 'json',
					data: {
						action: 'quick_view_check_product',
						skuOrProduct: skuOrProduct
					},
					success : function( response ) {
						that.settings.quickViewPopupMessage.text(response.message);
						that.settings.quickViewPopupIcon.removeClass('fa-spin fa-circle-o-notch').addClass('fa-eye');
						if(response.product != "") {
							$this.val('');
							that.getSingleProduct(response.product, that.openModal, that);	
						}
					},
					error: function(jqXHR, textStatus, errorThrown) {
					    console.log('An Error Occured: ' + jqXHR.status + ' ' + errorThrown + '! Please contact System Administrator!');
					}
				});

			  	return false;
			});
		},
		getSingleProduct: function(product_id, callback, that) {

			var that = this;

			that.product = product_id;

			jQuery.ajax({
				url: that.settings.ajax_url,
				type: 'post',
				dataType: 'html',
				data: {
					action: 'quick_view_get_product',
					product: product_id
				},
				success : function( response ) {
					that.settings.quickViewButton.html(that.trans.btnText);
					callback(response, that);
				},
				error: function(jqXHR, textStatus, errorThrown) {
					that.settings.quickViewButton.html(that.trans.btnText);
				    console.log('An Error Occured: ' + jqXHR.status + ' ' + errorThrown + '! Please contact System Administrator!');
				}
			});
		},
		openModal : function(html, that) {
			that.settings.quickViewModal.html(html).quickviewmodal();

			var arrowNext = that.settings.quickViewModal.find('.quick-view-arrow-next');
			if(arrowNext.length > 0) {
				
				var currentNextProductElement = $('.products .post-' + that.product).next();
				if(currentNextProductElement.length > 0) {

					var classes = currentNextProductElement.attr('class');
  				    var next_product_id = classes.match(/post-\d+/);

  					next_product_id = next_product_id[0].substring(5);
					arrowNext.on('click', function(e) {
						$('.quick-view-button[data-product-id="' + next_product_id + '"]').trigger('click');
					});
				} else {
					arrowNext.hide();
				}
			}

			var arrowPrevious = that.settings.quickViewModal.find('.quick-view-arrow-previous');
			if(arrowPrevious.length > 0) {
				
				var currentPreviousProductElement = $('.products .post-' + that.product).prev();
				if(currentPreviousProductElement.length > 0) {

					var classes = currentPreviousProductElement.attr('class');
  				    var prev_product_id = classes.match(/post-\d+/);

  					prev_product_id = prev_product_id[0].substring(5);
					arrowPrevious.on('click', function(e) {
						$('.quick-view-button[data-product-id="' + prev_product_id + '"]').trigger('click');
					});
				} else {
					arrowPrevious.hide();
				}
			}

            // Variation Form
            var form_variation = that.settings.quickViewModal.find('.variations_form');
            form_variation.each( function() {
                $(this).wc_variation_form();
            });
            form_variation.trigger( 'check_variations' );
            form_variation.trigger( 'reset_image' );


        	$( '.woocommerce-product-gallery__image a' ).on('click', function(e) {
        		e.preventDefault();
				var originalImage = $(this).prop('href');
				var currentImage = $('.woocommerce-quick-view-image-src').prop('src');

				if(currentImage !== originalImage) {
					$('.woocommerce-quick-view-image-src').prop('src', originalImage);
				}
			} );

            if(that.settings.modalHeightAuto == "1") {
            	that.setAutoheight();
            }
		},
		openInline : function(html, that) {

			var productContainer = $('.post-' + that.product);

			// Theme support
			if(productContainer.length < 1) {
				productContainer = $('.product-' + that.product);
			}
			
			if(productContainer.hasClass('last')) {
				var lastProductContainer = productContainer
			} else {
				var lastProductContainer = productContainer.nextAll('.last').first();
			}

			if(lastProductContainer.length < 1) {
				lastProductContainer = productContainer
			}

			$('.quick-view-inline').remove();
			$('<div class="quick-view-inline" style="display: none;"><a href="#" class="quick-view-inline-close">X</a>' + html + '</div>').insertAfter(lastProductContainer).slideDown(1000);
			if(that.settings.inlineScrollTo == "1") {
				$('html, body').animate({
	        		scrollTop: $(".quick-view-inline").offset().top
				}, 2000);
			}
		},
		closeInline : function() {
			$(document.body).on('click', '.quick-view-inline-close',function(e) {
				e.preventDefault();
				var $this = $(this);
				var inlineContainer = $this.parent('.quick-view-inline');
				inlineContainer.slideUp(1000, function() {
					$(this).remove();
				});
			});
		},
		setAutoheight : function() {
			var that = this;

			var image = that.settings.quickViewModal.find('.woocommerce-quick-view-image-src');
			var content = that.settings.quickViewModal.find('.woocommerce-quick-view-content');

			image.on('load', function() {
				var imageHeight = $(this).height();	
				content.css('max-height', imageHeight);
			});
		},
		ajaxAddToCart : function() {

			var that = this;
			if(that.settings.dataAJAXAddToCart !== "1") {
				return;
			}

			$(document).on('click', '.woocommerce-quick-view-add-to-cart button', function(e) {
				e.preventDefault();

				var $thisbutton = $(this);

				if($thisbutton.hasClass('disabled')) {
					return;
				}

				var oldButtonHTML = $thisbutton.html();
				$thisbutton.html(that.settings.loadingSVG);

				var product_id = 0;
				var variation_id = 0;
				var variation = 0;
				var quantity = 0;

				if($thisbutton.parent().find('input[name="variation_id"]').length > 0) {
					product_id = $thisbutton.parent().find('input[name="product_id"]').val();
					variation_id = $thisbutton.parent().find('input[name="variation_id"]').val();
					variation = $thisbutton.parent().find('input[name="variation"]').val();
					quantity = $thisbutton.parent().find('input[name="quantity"]').val();
				} else {
					product_id = $thisbutton.val();
					quantity = $thisbutton.parent().find('input[name="quantity"]').val();
				}

				var data = $('.woocommerce-quick-view-add-to-cart form').serialize();
				data += '&action=quick_view_add_to_cart';
				data += '&product_id=' + product_id;
				data += '&quantity=' + quantity;

				$.post( woocommerce_params.ajax_url, data, function( response ) {
					
					if ( ! response ) {
						alert('Error while adding to cart!');
						return;
					}

					$( document.body ).trigger( 'added_to_cart', [ response.fragments, response.cart_hash, $thisbutton ] );
					$thisbutton.html(oldButtonHTML);

					if(that.settings.closeQuickViewAfterAddToCart == "1") {
	                    setTimeout(function(){ 
	                        $('.jquery-quickviewmodal').trigger('click');
	                    }, 1000);
                    }

				});

			});
		},
		//////////////////////
		///Helper Functions///
		//////////////////////
		isEmpty: function(obj) {

		    if (obj == null)		return true;
		    if (obj.length > 0)		return false;
		    if (obj.length === 0)	return true;

		    for (var key in obj) {
		        if (hasOwnProperty.call(obj, key)) return false;
		    }

		    return true;
		},
		saveCookie: function(name, value) {
			var cookie = [name, '=', JSON.stringify(value), '; domain=.', window.location.host.toString(), '; path=/;'].join('');
			document.cookie = cookie;
		},
		readCookie: function(name) {
			var result = document.cookie.match(new RegExp(name + '=([^;]+)'));
			result && (result = JSON.parse(result[1]));
			return result;
		},
		deleteCookie: function(name) {
			document.cookie = [name, '=; expires=Thu, 01-Jan-1970 00:00:01 GMT; path=/; domain=.', window.location.host.toString()].join('');
		},
		getObjectSize : function(obj) {
		    var size = 0, key;
		    for (key in obj) {
		        if (obj.hasOwnProperty(key)) size++;
		    }
		    return size;
		},
	} );

	// Constructor wrapper
	$.fn[ pluginName ] = function( options ) {
		return this.each( function() {
			if ( !$.data( this, "plugin_" + pluginName ) ) {
				$.data( this, "plugin_" +
					pluginName, new Plugin( this, options ) );
			}
		} );
	};

	$.fn.emulateTransitionEnd = function (duration) {
		var called = false
		var $el = this
		$(this).one('bsTransitionEnd', function () { called = true })
		var callback = function () { if (!called) $($el).trigger($.support.transition.end) }
		setTimeout(callback, duration)
		return this
	}

	$(document).ready(function() {

		$( "body" ).quickView( 
			woocommerce_quick_view_options
		);

	} );

})( jQuery );