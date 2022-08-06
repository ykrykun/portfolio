<?php

/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       http://www.intolap.com
 * @since      1.2
 *
 * @package    Country_Code_Selector
 * @subpackage Country_Code_Selector/admin/partials
 */

if( get_option('selected_gform') == '' || get_option('gform_phone_field_id') == '' ){
	update_option('enable_on_gform','');
}
if( get_option('selected_cform7') == '' || get_option('cform7_phone_field_id') == '' ){
	update_option('enable_on_cform7','');
}
if( empty(get_option('selected_countries')) ){
	update_option('show_selected','');
}
if( !is_plugin_active('woocommerce/woocommerce.php') ){
	update_option('enable_on_woocommerce', '');
}
if( !is_plugin_active('shopp/Shopp.php') ){
	update_option('enable_on_shopp', '');
}
if( !is_plugin_active('gravityforms/gravityforms.php') ){
	update_option('enable_on_gform', '');
	update_option('gform_phone_field_id', '');
}
if( !is_plugin_active('contact-form-7/wp-contact-form-7.php') ){
	update_option('enable_on_cform7', '');
	update_option('cform7_phone_field_id', '');
}

$display_cform7 = (get_option('enable_on_cform7') == 'on')?'block':'none';
$display_gform = (get_option('enable_on_gform') == 'on')?'block':'none';
?>
<div id="pluginwrap" class="container">
	<h2><?php _e( 'Country Code Selector Settings', 'country-code-selector' );?></h2>
	<form method="post" action="options.php" class="form-horizontal" autocomplete="off">
		<?php settings_fields( 'country_code_selector_group' ); ?>

		<ul>
		  <li>
		  	<center><?php _e('Enable On', 'country-code-selector' );?></center>
		    <input type="checkbox" name="enable_on_woocommerce" id="enable_on_woocommerce" data-plugin-name="<?php _e('WooCommerce', 'country-code-selector' );?>" <?php if(get_option('enable_on_woocommerce') == 'on'){ echo 'checked'; }?>/>
		    <label data-toggle="tooltip" title="<?php _e('WooCommerce Checkout Page', 'country-code-selector' );?> <?php if(!is_plugin_active('woocommerce/woocommerce.php')){_e('(WooCommerce plugin is not active.)', 'country-code-selector');}?>" for="enable_on_woocommerce"><img src="<?php echo get_site_url().'/wp-content/plugins/country-code-selector/admin/images/woo.png';?>" /></label>
		  </li>
		  <li>
		  	<center><?php _e('Enable On', 'country-code-selector' );?></center>
		    <input type="checkbox" name="enable_on_shopp" id="enable_on_shopp" data-plugin-name="<?php _e('Shopp', 'country-code-selector' );?>" <?php if(get_option('enable_on_shopp') == 'on'){ echo 'checked'; }?> />
		    <label data-toggle="tooltip" title="<?php _e('Shopp Checkout Page', 'country-code-selector' );?> <?php if(!is_plugin_active('shopp/Shopp.php')){echo _e('(Shopp plugin is not active.)', 'country-code-selector' );}?>" for="enable_on_shopp"><img src="<?php echo get_site_url().'/wp-content/plugins/country-code-selector/admin/images/shopp.png';?>" /></label>
		  </li>
		  <li>
		  	<center><?php _e('Enable On', 'country-code-selector' );?></center>
		    <input type="checkbox" name="enable_on_gform" id="enable_on_gform" data-plugin-name="<?php _e('Gravity Forms', 'country-code-selector' );?>" <?php if(get_option('enable_on_gform') == 'on'){ echo 'checked'; }?> />
		    <label data-toggle="tooltip" title="<?php _e('Gravity Forms', 'country-code-selector' );?> <?php if(!is_plugin_active('gravityforms/gravityforms.php')){echo _e('(Gravity Forms plugin is not active.)', 'country-code-selector' );}?>" for="enable_on_gform"><img src="<?php echo get_site_url().'/wp-content/plugins/country-code-selector/admin/images/gravityforms.png';?>" /></label>
		  </li>
		  <li>
		  	<center><?php _e('Enable On', 'country-code-selector' );?></center>
		    <input type="checkbox" name="enable_on_cform7" id="enable_on_cform7" data-plugin-name="<?php _e('Contact Form 7', 'country-code-selector' );?>" <?php if(get_option('enable_on_cform7') == 'on'){ echo 'checked'; }?>/>
		    <label data-toggle="tooltip" title="<?php _e('Contact Form 7', 'country-code-selector' );?> <?php if(!is_plugin_active('contact-form-7/wp-contact-form-7.php')){echo _e('(Contact Form 7 plugin is not active.)', 'country-code-selector' );}?>" for="enable_on_cform7"><img src="<?php echo get_site_url().'/wp-content/plugins/country-code-selector/admin/images/cf7.png';?>" /></label>
		  </li>
		</ul>

		<div class="panel panel-default gform-panel" style="display: <?php echo $display_gform;?>">
		    <div class="panel-heading"><?php _e('Gravity Forms Settings', 'country-code-selector' );?></div>
		    <div class="panel-body">
		    	<div class="form-group col-md-4">
					<?php
					if(class_exists('GFAPI')){
				  		$forms = GFAPI::get_forms();
				  	}
			  		?>
			  		<label for="selected_gform"><?php _e('Select a form', 'country-code-selector' );?></label>
			        <select name="selected_gform">
					    <option value=""><?php _e('Select a form', 'country-code-selector' );?></option>
					    <?php
					    if(class_exists('GFAPI')){
						    if(!empty($forms)){
						    	$selected_form = get_option('selected_gform');
					            foreach ($forms as $form) {
									echo '<option value="'.$form['id'].'" '.selected($form['id'],$selected_form,false).'>'.$form['title'].' (Form ID:'.$form['id'].')</option>';
								}	
						    }else{
						    	echo '<option value="">'._e('Please create a form first.', 'country-code-selector' ).'</option>';
						    }
						}
			            ?>
					</select>
				</div>
				<div class="form-group col-md-4">
					<label for="gform_phone_field_id"><?php _e('Phone field ID', 'country-code-selector' );?></label>
					<input class="form-control" id="gform_phone_field_id" name="gform_phone_field_id" type="text" value="<?php echo get_option('gform_phone_field_id');?>" <?php (get_option('enable_on_gform') == 'on')?'':'disabled';?> placeholder="<?php _e('Field ID', 'country-code-selector' );?>">
		            <small class="description"><span style="color: red;"><?php if(!is_plugin_active('gravityforms/gravityforms.php')){_e('Note: Gravity Forms plugin is not active.', 'country-code-selector' );}?></span></small>
		        </div>
		    </div>
		</div>

		<div class="panel panel-default cform7-panel" style="display: <?php echo $display_cform7;?>">
		    <div class="panel-heading"><?php _e('Contact Form 7 Settings', 'country-code-selector' );?></div>
		    <div class="panel-body">
		    	<div class="form-group col-md-4">
			    	<?php
		  			$dbValue = get_option('selected_cform7'); //example!
				    $posts = get_posts(array(
				        'post_type'     => 'wpcf7_contact_form',
				        'numberposts'   => -1
				    ));
			  		?>
			  		<label for="selected_cform7"><?php _e('Select a form', 'country-code-selector' );?></label>
			  		<select class="form-control" name="selected_cform7" id="selected_cform7"> 
					    <option value=""><?php _e('Select a form', 'country-code-selector' );?></option>
					    <?php
					    if(!empty($posts)){
					    	foreach ( $posts as $p ) {
						        echo '<option value="'.$p->ID.'"'.selected($p->ID,$dbValue,false).'>'.$p->post_title.' (Form ID:'.$p->ID.')</option>';
						    }	
					    }else{
					    	echo '<option value="">'._e('Please create a form first.', 'country-code-selector' ).'</option>';
					    }
					    ?>
					</select>
				</div>
				<div class="form-group col-md-4">
					<label for="cform7_phone_field_id"><?php _e('Phone field ID', 'country-code-selector' );?></label>
					<input class="form-control" id="cform7_phone_field_id" name="cform7_phone_field_id" type="text" value="<?php echo get_option('cform7_phone_field_id');?>" <?php (get_option('enable_on_gform') == 'on')?'':'disabled';?> placeholder="<?php _e('Field ID', 'country-code-selector' );?>">
                	<small class="description"><span style="color: red;"><?php if(!is_plugin_active('contact-form-7/wp-contact-form-7.php')){_e('Note: Contact Form 7 plugin is not active.', 'country-code-selector' );}?></span></small>
            	</div>
		    </div>
		</div>

		<div class="panel panel-default">
		    <div class="panel-heading"><?php _e('Country Settings', 'country-code-selector' );?></div>
		    <div class="panel-body">
		  		<div class="form-group col-md-12">
		  			<?php
			        $allCountries = Country_Code_Selector_Admin::country_code_selector_get_countries();
			  		// echo "<pre>"; print_r($allCountries); echo "</pre>";
			        // echo "<pre>"; print_r(get_option('selected_countries')); echo "</pre>";
			  		?>
			  		<label for="initial_country"><?php _e('Select default country', 'country-code-selector' );?></label>
					<select class="form-control" name="initial_country" id="initial_country">
						<option><?php _e('Select a country', 'country-code-selector' );?></option>
					    <?php
			            foreach ($allCountries as $allCountry) {
							if(strtolower($allCountry['code']) == get_option('initial_country')){
								$selected = 'selected';
							}else{
								$selected = '';
							}

							echo '<option value="'.strtolower($allCountry['code']).'" '.$selected.'>'.$allCountry['name'].'</option>';
						}
			            ?>
					</select>
				</div>
				<div class="form-group col-md-12">	
			  		<label for="selected_countries"><?php _e('Select countries', 'country-code-selector' );?></label><button type="button" class="btn btn-link" id="select_all">Select All</button> | <button type="button" class="btn btn-link" id="clear_all">Clear All</button><br/>
			        <select class="form-control select2" name="selected_countries[]" id="selected_countries" multiple>
			        	<!-- <option value="all">Select all</option> -->
				    <?php
						foreach ($allCountries as $allCountry) {
							if(get_option('selected_countries')!=='' && in_array(strtolower($allCountry['code']), get_option('selected_countries'))){
								$selected = 'selected';
							}else{
								$selected = '';
							}

							echo '<option value="'.strtolower($allCountry['code']).'" '.$selected.'>'.$allCountry['name'].'</option>';
						}
		            ?>
					</select>
				</div>
		    </div>
		</div>
		<?php submit_button(); ?>
	</form>
</div>