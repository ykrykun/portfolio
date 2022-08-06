<?php

class Wcipi_Admin {

	function __construct() {
		add_action( 'admin_menu', array( $this, 'init_admin_menu' ) );
	}

	function init_admin_menu() {
		add_options_page(
			esc_attr__('Int. phone input options', WCIPI_TD),
			esc_attr__('Int. phone input', WCIPI_TD),
			'manage_options',
			'wcipi.php',
			array($this, 'init_options_page')
		);
	}

	function init_options_page() {

		$countries_array = $this->get_countries_array();

		if ( isset($_POST['wcipi_nonce_field'])
		     && wp_verify_nonce( $_POST['wcipi_nonce_field'], 'settings_update' ) ) :

      $settings_saved = true;

			if ( isset( $_POST['default_country'] ) ) {
				update_option(WCIPI_SETTINGS_PREFIX.'default_country', $_POST['default_country']);
			} else {
				update_option(WCIPI_SETTINGS_PREFIX.'default_country','');
			}

			if ( isset( $_POST['autoset'] ) ) {
				update_option(WCIPI_SETTINGS_PREFIX.'autoset','yes');
			} else {
				update_option(WCIPI_SETTINGS_PREFIX.'autoset','no');
			}

			if ( isset( $_POST['validation'] ) ) {
				update_option(WCIPI_SETTINGS_PREFIX.'validation','yes');
			} else {
				update_option(WCIPI_SETTINGS_PREFIX.'validation','no');
			}

			if ( isset( $_POST['only_selected_countries'] ) ) {
				update_option(WCIPI_SETTINGS_PREFIX.'only_selected_countries','yes');
			} else {
				update_option(WCIPI_SETTINGS_PREFIX.'only_selected_countries','no');
			}

			if ( isset( $_POST['countries'] ) ) {
				update_option(WCIPI_SETTINGS_PREFIX.'selected_countries_array', $_POST['countries']);
			}

			if ( isset( $_POST['validation_success_msg'] ) ) {

				$validation_success_msg = sanitize_text_field( $_POST['validation_success_msg'] );
				update_option(WCIPI_SETTINGS_PREFIX.'validation_success_msg',$validation_success_msg);
			}

			if ( isset( $_POST['validation_fail_msg'] ) ) {

				$validation_fail_msg = sanitize_text_field( $_POST['validation_fail_msg'] );
				update_option(WCIPI_SETTINGS_PREFIX.'validation_fail_msg',$validation_fail_msg);
			}

      if ( isset( $_POST['ipinfo_token'] ) ) {

				$ipinfo_token = sanitize_text_field( $_POST['ipinfo_token'] );
				update_option(WCIPI_SETTINGS_PREFIX.'ipinfo_token', $ipinfo_token);
			}

		endif;

		?>

		<div class="wrap"><h2><?php esc_attr_e(WCIPI_PLUGIN_NAME.' - settings', WCIPI_TD) ?></h2></div>

		<form action="" method="post">
			<table class="form-table">
				<tbody>
				<tr valign="top">
					<th scope="row">
						<label><?php esc_attr_e('Set country automatically', WCIPI_TD) ?>:</label>
						<br><small><?php esc_attr_e('(using client IP)', WCIPI_TD) ?></small>
					</th>
					<td>
						<input type="checkbox" name="autoset" value="<?php echo get_option(WCIPI_SETTINGS_PREFIX.'autoset'); ?>" <?php checked( get_option(WCIPI_SETTINGS_PREFIX.'autoset'), 'yes', true ); ?> />
					</td>
				</tr>
				<tr valign="top" >
					<th scope="row">
						<label><?php esc_attr_e('Select default country', WCIPI_TD) ?>:</label>
						<br><small><?php esc_attr_e('This will override "Set country automatically" option', WCIPI_TD) ?></small>
					</th>
					<td>
						<select name="default_country" >
							<option value="" ><?php esc_attr_e('- Nothing selected -', WCIPI_TD) ?></option>
							<?php
								$default_country = get_option(WCIPI_SETTINGS_PREFIX.'default_country');
								foreach ($countries_array as $country) {
									echo '<option '. ($country['iso2'] === $default_country ? 'selected' : '') .' value="'.$country['iso2'].'">'.$country['name'].'</option>';
								}
							?>
						</select>
					</td>
				</tr>
				<tr valign="top">
					<th scope="row">
						<label><?php esc_attr_e('Billing phone number format validation on WooCommerce checkout', WCIPI_TD) ?>:</label>
						<br><small><?php esc_attr_e('(please be aware that this feature is not a guarantee that phone number is really exist)', WCIPI_TD) ?></small>
					</th>
					<td>
						<input type="checkbox" name="validation" value="<?php echo get_option(WCIPI_SETTINGS_PREFIX.'validation'); ?>" <?php checked( get_option(WCIPI_SETTINGS_PREFIX.'validation'), 'yes', true ); ?> />
					</td>
				</tr>
				<tr valign="top" >
					<th scope="row">
						<label><?php esc_attr_e('Show only selected countries', WCIPI_TD) ?>:</label>
						<br><small><?php esc_attr_e('(it will show only selected countries for users)', WCIPI_TD) ?></small>
					</th>
					<td>
						<input type="checkbox" name="only_selected_countries" value="<?php echo get_option(WCIPI_SETTINGS_PREFIX.'only_selected_countries'); ?>" <?php checked( get_option(WCIPI_SETTINGS_PREFIX.'only_selected_countries'), 'yes', true ); ?> />
					</td>
				</tr>
				<tr valign="top" >
					<th scope="row">
						<label><?php esc_attr_e('Select countries here', WCIPI_TD) ?>:</label>
						<br><small><?php esc_attr_e('(hold CTRL on Windows or CMD button on Mac to select multiple)', WCIPI_TD) ?></small>
					</th>
					<td>
						<select style="height: 300px;" name="countries[]" multiple >
							<?php
								$selected_countries = get_option(WCIPI_SETTINGS_PREFIX.'selected_countries_array', []);

								foreach ($countries_array as $country) {
									echo '<option '. ( in_array($country['iso2'], $selected_countries) ? 'selected' : '') .' value="'.$country['iso2'].'">'.$country['name'].'</option>';
								}
							?>
						</select>
					</td>
				</tr>
				<tr valign="top" >
						<th scope="row">
								<label><?php esc_attr_e('Custom validation success message', WCIPI_TD) ?>:</label>
						</th>
						<td>
								<input type="text" name="validation_success_msg" value="<?php echo get_option(WCIPI_SETTINGS_PREFIX.'validation_success_msg'); ?>" />
						</td>
				</tr>
				<tr valign="top" >
						<th scope="row">
								<label><?php esc_attr_e('Custom validation fail message', WCIPI_TD) ?>:</label>
						</th>
						<td>
								<input type="text" name="validation_fail_msg" value="<?php echo get_option(WCIPI_SETTINGS_PREFIX.'validation_fail_msg'); ?>" />
						</td>
        </tr>
				<tr valign="top" >
						<th scope="row">
								<label><?php esc_attr_e('ipinfo.io Token (Optional)', WCIPI_TD) ?>:</label>
                <br><small><?php esc_attr_e('(Use to increase ip lookup limit. Even free account can increase a limit to 50,000 API requests per month for a single client)', WCIPI_TD) ?></small>
						</th>
						<td>
								<input type="text" name="ipinfo_token" value="<?php echo get_option(WCIPI_SETTINGS_PREFIX.'ipinfo_token'); ?>" />
						</td>
        </tr>

				<?php
				if ( $_SERVER['REQUEST_METHOD'] === 'POST' && $settings_saved ) :
        ?>
          <tr valign="top">
            <th scope="row">
              <label><?php esc_attr_e('Settings saved', WCIPI_TD) ?></label>
            </th>
            <td>
            </td>
          </tr>
					<?php
				endif;
				?>
				<?php wp_nonce_field( 'settings_update', 'wcipi_nonce_field' ); ?>
				<tr valign="top">
					<th scope="row">
						<input type="submit" class="button button-primary button-large" value="<?php esc_attr_e('Save Settings', WCIPI_TD) ?>" />
					</th>
				</tr>
				</tbody>
			</table>
		</form>

		<br>
		<br>
		<p><?php esc_attr_e('Plugin version', WCIPI_TD) ?>: <?php echo WCIPI_VERSION_NUM; ?></p>

		<p>
			<?php
        printf(
          esc_html__( 'Check new version %1$s', 'text-domain' ),
          sprintf(
            '<a href="%s">%s</a>',
            WCIPI_CODECANYON_PLUGIN_URL,
            esc_html__( 'here', WCIPI_TD )
            )
          );
			?>
		</p>

		<?php

	}

	function get_countries_array() {

    $allCountries = array(
      [
        "Afghanistan (‫افغانستان‬‎)",
        "af",
        "93"
      ],
      [
        "Albania (Shqipëri)",
        "al",
        "355"
      ],
      [
        "Algeria (‫الجزائر‬‎)",
        "dz",
        "213"
      ],
      [
        "American Samoa",
        "as",
        "1684"
      ],
      [
        "Andorra",
        "ad",
        "376"
      ],
      [
        "Angola",
        "ao",
        "244"
      ],
      [
        "Anguilla",
        "ai",
        "1264"
      ],
      [
        "Antigua and Barbuda",
        "ag",
        "1268"
      ],
      [
        "Argentina",
        "ar",
        "54"
      ],
      [
        "Armenia (Հայաստան)",
        "am",
        "374"
      ],
      [
        "Aruba",
        "aw",
        "297"
      ],
      [
        "Australia",
        "au",
        "61",
        0
      ],
      [
        "Austria (Österreich)",
        "at",
        "43"
      ],
      [
        "Azerbaijan (Azərbaycan)",
        "az",
        "994"
      ],
      [
        "Bahamas",
        "bs",
        "1242"
      ],
      [
        "Bahrain (‫البحرين‬‎)",
        "bh",
        "973"
      ],
      [
        "Bangladesh (বাংলাদেশ)",
        "bd",
        "880"
      ],
      [
        "Barbados",
        "bb",
        "1246"
      ],
      [
        "Belarus (Беларусь)",
        "by",
        "375"
      ],
      [
        "Belgium (België)",
        "be",
        "32"
      ],
      [
        "Belize",
        "bz",
        "501"
      ],
      [
        "Benin (Bénin)",
        "bj",
        "229"
      ],
      [
        "Bermuda",
        "bm",
        "1441"
      ],
      [
        "Bhutan (འབྲུག)",
        "bt",
        "975"
      ],
      [
        "Bolivia",
        "bo",
        "591"
      ],
      [
        "Bosnia and Herzegovina (Босна и Херцеговина)",
        "ba",
        "387"
      ],
      [
        "Botswana",
        "bw",
        "267"
      ],
      [
        "Brazil (Brasil)",
        "br",
        "55"
      ],
      [
        "British Indian Ocean Territory",
        "io",
        "246"
      ],
      [
        "British Virgin Islands",
        "vg",
        "1284"
      ],
      [
        "Brunei",
        "bn",
        "673"
      ],
      [
        "Bulgaria (България)",
        "bg",
        "359"
      ],
      [
        "Burkina Faso",
        "bf",
        "226"
      ],
      [
        "Burundi (Uburundi)",
        "bi",
        "257"
      ],
      [
        "Cambodia (កម្ពុជា)",
        "kh",
        "855"
      ],
      [
        "Cameroon (Cameroun)",
        "cm",
        "237"
      ],
      [
        "Canada",
        "ca",
        "1",
        1,
        ["204", "226", "236", "249", "250", "289", "306", "343", "365", "387", "403", "416", "418", "431", "437", "438", "450", "506", "514", "519", "548", "579", "581", "587", "604", "613", "639", "647", "672", "705", "709", "742", "778", "780", "782", "807", "819", "825", "867", "873", "902", "905"]
      ],
      [
        "Cape Verde (Kabu Verdi)",
        "cv",
        "238"
      ],
      [
        "Caribbean Netherlands",
        "bq",
        "599",
        1
      ],
      [
        "Cayman Islands",
        "ky",
        "1345"
      ],
      [
        "Central African Republic (République centrafricaine)",
        "cf",
        "236"
      ],
      [
        "Chad (Tchad)",
        "td",
        "235"
      ],
      [
        "Chile",
        "cl",
        "56"
      ],
      [
        "China (中国)",
        "cn",
        "86"
      ],
      [
        "Christmas Island",
        "cx",
        "61",
        2
      ],
      [
        "Cocos (Keeling) Islands",
        "cc",
        "61",
        1
      ],
      [
        "Colombia",
        "co",
        "57"
      ],
      [
        "Comoros (‫جزر القمر‬‎)",
        "km",
        "269"
      ],
      [
        "Congo (DRC) (Jamhuri ya Kidemokrasia ya Kongo)",
        "cd",
        "243"
      ],
      [
        "Congo (Republic) (Congo-Brazzaville)",
        "cg",
        "242"
      ],
      [
        "Cook Islands",
        "ck",
        "682"
      ],
      [
        "Costa Rica",
        "cr",
        "506"
      ],
      [
        "Côte d’Ivoire",
        "ci",
        "225"
      ],
      [
        "Croatia (Hrvatska)",
        "hr",
        "385"
      ],
      [
        "Cuba",
        "cu",
        "53"
      ],
      [
        "Curaçao",
        "cw",
        "599",
        0
      ],
      [
        "Cyprus (Κύπρος)",
        "cy",
        "357"
      ],
      [
        "Czech Republic (Česká republika)",
        "cz",
        "420"
      ],
      [
        "Denmark (Danmark)",
        "dk",
        "45"
      ],
      [
        "Djibouti",
        "dj",
        "253"
      ],
      [
        "Dominica",
        "dm",
        "1767"
      ],
      [
        "Dominican Republic (República Dominicana)",
        "do",
        "1",
        2,
        ["809", "829", "849"]
      ],
      [
        "Ecuador",
        "ec",
        "593"
      ],
      [
        "Egypt (‫مصر‬‎)",
        "eg",
        "20"
      ],
      [
        "El Salvador",
        "sv",
        "503"
      ],
      [
        "Equatorial Guinea (Guinea Ecuatorial)",
        "gq",
        "240"
      ],
      [
        "Eritrea",
        "er",
        "291"
      ],
      [
        "Estonia (Eesti)",
        "ee",
        "372"
      ],
      [
        "Ethiopia",
        "et",
        "251"
      ],
      [
        "Falkland Islands (Islas Malvinas)",
        "fk",
        "500"
      ],
      [
        "Faroe Islands (Føroyar)",
        "fo",
        "298"
      ],
      [
        "Fiji",
        "fj",
        "679"
      ],
      [
        "Finland (Suomi)",
        "fi",
        "358",
        0
      ],
      [
        "France",
        "fr",
        "33"
      ],
      [
        "French Guiana (Guyane française)",
        "gf",
        "594"
      ],
      [
        "French Polynesia (Polynésie française)",
        "pf",
        "689"
      ],
      [
        "Gabon",
        "ga",
        "241"
      ],
      [
        "Gambia",
        "gm",
        "220"
      ],
      [
        "Georgia (საქართველო)",
        "ge",
        "995"
      ],
      [
        "Germany (Deutschland)",
        "de",
        "49"
      ],
      [
        "Ghana (Gaana)",
        "gh",
        "233"
      ],
      [
        "Gibraltar",
        "gi",
        "350"
      ],
      [
        "Greece (Ελλάδα)",
        "gr",
        "30"
      ],
      [
        "Greenland (Kalaallit Nunaat)",
        "gl",
        "299"
      ],
      [
        "Grenada",
        "gd",
        "1473"
      ],
      [
        "Guadeloupe",
        "gp",
        "590",
        0
      ],
      [
        "Guam",
        "gu",
        "1671"
      ],
      [
        "Guatemala",
        "gt",
        "502"
      ],
      [
        "Guernsey",
        "gg",
        "44",
        1
      ],
      [
        "Guinea (Guinée)",
        "gn",
        "224"
      ],
      [
        "Guinea-Bissau (Guiné Bissau)",
        "gw",
        "245"
      ],
      [
        "Guyana",
        "gy",
        "592"
      ],
      [
        "Haiti",
        "ht",
        "509"
      ],
      [
        "Honduras",
        "hn",
        "504"
      ],
      [
        "Hong Kong (香港)",
        "hk",
        "852"
      ],
      [
        "Hungary (Magyarország)",
        "hu",
        "36"
      ],
      [
        "Iceland (Ísland)",
        "is",
        "354"
      ],
      [
        "India (भारत)",
        "in",
        "91"
      ],
      [
        "Indonesia",
        "id",
        "62"
      ],
      [
        "Iran (‫ایران‬‎)",
        "ir",
        "98"
      ],
      [
        "Iraq (‫العراق‬‎)",
        "iq",
        "964"
      ],
      [
        "Ireland",
        "ie",
        "353"
      ],
      [
        "Isle of Man",
        "im",
        "44",
        2
      ],
      [
        "Israel (‫ישראל‬‎)",
        "il",
        "972"
      ],
      [
        "Italy (Italia)",
        "it",
        "39",
        0
      ],
      [
        "Jamaica",
        "jm",
        "1876"
      ],
      [
        "Japan (日本)",
        "jp",
        "81"
      ],
      [
        "Jersey",
        "je",
        "44",
        3
      ],
      [
        "Jordan (‫الأردن‬‎)",
        "jo",
        "962"
      ],
      [
        "Kazakhstan (Казахстан)",
        "kz",
        "7",
        1
      ],
      [
        "Kenya",
        "ke",
        "254"
      ],
      [
        "Kiribati",
        "ki",
        "686"
      ],
      [
        "Kuwait (‫الكويت‬‎)",
        "kw",
        "965"
      ],
      [
        "Kyrgyzstan (Кыргызстан)",
        "kg",
        "996"
      ],
      [
        "Laos (ລາວ)",
        "la",
        "856"
      ],
      [
        "Latvia (Latvija)",
        "lv",
        "371"
      ],
      [
        "Lebanon (‫لبنان‬‎)",
        "lb",
        "961"
      ],
      [
        "Lesotho",
        "ls",
        "266"
      ],
      [
        "Liberia",
        "lr",
        "231"
      ],
      [
        "Libya (‫ليبيا‬‎)",
        "ly",
        "218"
      ],
      [
        "Liechtenstein",
        "li",
        "423"
      ],
      [
        "Lithuania (Lietuva)",
        "lt",
        "370"
      ],
      [
        "Luxembourg",
        "lu",
        "352"
      ],
      [
        "Macau (澳門)",
        "mo",
        "853"
      ],
      [
        "Macedonia (FYROM) (Македонија)",
        "mk",
        "389"
      ],
      [
        "Madagascar (Madagasikara)",
        "mg",
        "261"
      ],
      [
        "Malawi",
        "mw",
        "265"
      ],
      [
        "Malaysia",
        "my",
        "60"
      ],
      [
        "Maldives",
        "mv",
        "960"
      ],
      [
        "Mali",
        "ml",
        "223"
      ],
      [
        "Malta",
        "mt",
        "356"
      ],
      [
        "Marshall Islands",
        "mh",
        "692"
      ],
      [
        "Martinique",
        "mq",
        "596"
      ],
      [
        "Mauritania (‫موريتانيا‬‎)",
        "mr",
        "222"
      ],
      [
        "Mauritius (Moris)",
        "mu",
        "230"
      ],
      [
        "Mayotte",
        "yt",
        "262",
        1
      ],
      [
        "Mexico (México)",
        "mx",
        "52"
      ],
      [
        "Micronesia",
        "fm",
        "691"
      ],
      [
        "Moldova (Republica Moldova)",
        "md",
        "373"
      ],
      [
        "Monaco",
        "mc",
        "377"
      ],
      [
        "Mongolia (Монгол)",
        "mn",
        "976"
      ],
      [
        "Montenegro (Crna Gora)",
        "me",
        "382"
      ],
      [
        "Montserrat",
        "ms",
        "1664"
      ],
      [
        "Morocco (‫المغرب‬‎)",
        "ma",
        "212",
        0
      ],
      [
        "Mozambique (Moçambique)",
        "mz",
        "258"
      ],
      [
        "Myanmar (Burma) (မြန်မာ)",
        "mm",
        "95"
      ],
      [
        "Namibia (Namibië)",
        "na",
        "264"
      ],
      [
        "Nauru",
        "nr",
        "674"
      ],
      [
        "Nepal (नेपाल)",
        "np",
        "977"
      ],
      [
        "Netherlands (Nederland)",
        "nl",
        "31"
      ],
      [
        "New Caledonia (Nouvelle-Calédonie)",
        "nc",
        "687"
      ],
      [
        "New Zealand",
        "nz",
        "64"
      ],
      [
        "Nicaragua",
        "ni",
        "505"
      ],
      [
        "Niger (Nijar)",
        "ne",
        "227"
      ],
      [
        "Nigeria",
        "ng",
        "234"
      ],
      [
        "Niue",
        "nu",
        "683"
      ],
      [
        "Norfolk Island",
        "nf",
        "672"
      ],
      [
        "North Korea (조선 민주주의 인민 공화국)",
        "kp",
        "850"
      ],
      [
        "Northern Mariana Islands",
        "mp",
        "1670"
      ],
      [
        "Norway (Norge)",
        "no",
        "47",
        0
      ],
      [
        "Oman (‫عُمان‬‎)",
        "om",
        "968"
      ],
      [
        "Pakistan (‫پاکستان‬‎)",
        "pk",
        "92"
      ],
      [
        "Palau",
        "pw",
        "680"
      ],
      [
        "Palestine (‫فلسطين‬‎)",
        "ps",
        "970"
      ],
      [
        "Panama (Panamá)",
        "pa",
        "507"
      ],
      [
        "Papua New Guinea",
        "pg",
        "675"
      ],
      [
        "Paraguay",
        "py",
        "595"
      ],
      [
        "Peru (Perú)",
        "pe",
        "51"
      ],
      [
        "Philippines",
        "ph",
        "63"
      ],
      [
        "Poland (Polska)",
        "pl",
        "48"
      ],
      [
        "Portugal",
        "pt",
        "351"
      ],
      [
        "Puerto Rico",
        "pr",
        "1",
        3,
        ["787", "939"]
      ],
      [
        "Qatar (‫قطر‬‎)",
        "qa",
        "974"
      ],
      [
        "Réunion (La Réunion)",
        "re",
        "262",
        0
      ],
      [
        "Romania (România)",
        "ro",
        "40"
      ],
      [
        "Russia (Россия)",
        "ru",
        "7",
        0
      ],
      [
        "Rwanda",
        "rw",
        "250"
      ],
      [
        "Saint Barthélemy (Saint-Barthélemy)",
        "bl",
        "590",
        1
      ],
      [
        "Saint Helena",
        "sh",
        "290"
      ],
      [
        "Saint Kitts and Nevis",
        "kn",
        "1869"
      ],
      [
        "Saint Lucia",
        "lc",
        "1758"
      ],
      [
        "Saint Martin (Saint-Martin (partie française))",
        "mf",
        "590",
        2
      ],
      [
        "Saint Pierre and Miquelon (Saint-Pierre-et-Miquelon)",
        "pm",
        "508"
      ],
      [
        "Saint Vincent and the Grenadines",
        "vc",
        "1784"
      ],
      [
        "Samoa",
        "ws",
        "685"
      ],
      [
        "San Marino",
        "sm",
        "378"
      ],
      [
        "São Tomé and Príncipe (São Tomé e Príncipe)",
        "st",
        "239"
      ],
      [
        "Saudi Arabia (‫المملكة العربية السعودية‬‎)",
        "sa",
        "966"
      ],
      [
        "Senegal (Sénégal)",
        "sn",
        "221"
      ],
      [
        "Serbia (Србија)",
        "rs",
        "381"
      ],
      [
        "Seychelles",
        "sc",
        "248"
      ],
      [
        "Sierra Leone",
        "sl",
        "232"
      ],
      [
        "Singapore",
        "sg",
        "65"
      ],
      [
        "Sint Maarten",
        "sx",
        "1721"
      ],
      [
        "Slovakia (Slovensko)",
        "sk",
        "421"
      ],
      [
        "Slovenia (Slovenija)",
        "si",
        "386"
      ],
      [
        "Solomon Islands",
        "sb",
        "677"
      ],
      [
        "Somalia (Soomaaliya)",
        "so",
        "252"
      ],
      [
        "South Africa",
        "za",
        "27"
      ],
      [
        "South Korea (대한민국)",
        "kr",
        "82"
      ],
      [
        "South Sudan (‫جنوب السودان‬‎)",
        "ss",
        "211"
      ],
      [
        "Spain (España)",
        "es",
        "34"
      ],
      [
        "Sri Lanka (ශ්‍රී ලංකාව)",
        "lk",
        "94"
      ],
      [
        "Sudan (‫السودان‬‎)",
        "sd",
        "249"
      ],
      [
        "Suriname",
        "sr",
        "597"
      ],
      [
        "Svalbard and Jan Mayen",
        "sj",
        "47",
        1
      ],
      [
        "Swaziland",
        "sz",
        "268"
      ],
      [
        "Sweden (Sverige)",
        "se",
        "46"
      ],
      [
        "Switzerland (Schweiz)",
        "ch",
        "41"
      ],
      [
        "Syria (‫سوريا‬‎)",
        "sy",
        "963"
      ],
      [
        "Taiwan (台灣)",
        "tw",
        "886"
      ],
      [
        "Tajikistan",
        "tj",
        "992"
      ],
      [
        "Tanzania",
        "tz",
        "255"
      ],
      [
        "Thailand (ไทย)",
        "th",
        "66"
      ],
      [
        "Timor-Leste",
        "tl",
        "670"
      ],
      [
        "Togo",
        "tg",
        "228"
      ],
      [
        "Tokelau",
        "tk",
        "690"
      ],
      [
        "Tonga",
        "to",
        "676"
      ],
      [
        "Trinidad and Tobago",
        "tt",
        "1868"
      ],
      [
        "Tunisia (‫تونس‬‎)",
        "tn",
        "216"
      ],
      [
        "Turkey (Türkiye)",
        "tr",
        "90"
      ],
      [
        "Turkmenistan",
        "tm",
        "993"
      ],
      [
        "Turks and Caicos Islands",
        "tc",
        "1649"
      ],
      [
        "Tuvalu",
        "tv",
        "688"
      ],
      [
        "U.S. Virgin Islands",
        "vi",
        "1340"
      ],
      [
        "Uganda",
        "ug",
        "256"
      ],
      [
        "Ukraine (Україна)",
        "ua",
        "380"
      ],
      [
        "United Arab Emirates (‫الإمارات العربية المتحدة‬‎)",
        "ae",
        "971"
      ],
      [
        "United Kingdom",
        "gb",
        "44",
        0
      ],
      [
        "United States",
        "us",
        "1",
        0
      ],
      [
        "Uruguay",
        "uy",
        "598"
      ],
      [
        "Uzbekistan (Oʻzbekiston)",
        "uz",
        "998"
      ],
      [
        "Vanuatu",
        "vu",
        "678"
      ],
      [
        "Vatican City (Città del Vaticano)",
        "va",
        "39",
        1
      ],
      [
        "Venezuela",
        "ve",
        "58"
      ],
      [
        "Vietnam (Việt Nam)",
        "vn",
        "84"
      ],
      [
        "Wallis and Futuna",
        "wf",
        "681"
      ],
      [
        "Western Sahara (‫الصحراء الغربية‬‎)",
        "eh",
        "212",
        1
      ],
      [
        "Yemen (‫اليمن‬‎)",
        "ye",
        "967"
      ],
      [
        "Zambia",
        "zm",
        "260"
      ],
      [
        "Zimbabwe",
        "zw",
        "263"
      ],
      [
        "Åland Islands",
        "ax",
        "358",
        1
      ]
    );

    // loop over all of the countries above
    for ( $i = 0; $i < count($allCountries); $i++) {
        $c = $allCountries[$i];
        $allCountries[$i] = array(
          'name' => $c[0],
          'iso2' => $c[1],
					'dialCode' => $c[2],
					'priority' => isset($c[3]) ? $c[3] : 0,
					'areaCodes' => isset($c[4]) ? $c[4] : null
				);
    }

    return $allCountries;
}

}

new Wcipi_Admin();