<?php
// Exit if accessed directly
if (!defined('ABSPATH')) {
    exit;
}


if (!class_exists('WP_Customize_Control')) {
    include_once ABSPATH . 'wp-includes/class-wp-customize-control.php';
}

/**
 * Class Customizer_Repeater.
 */
class WP_Customize_Repeater_Control extends WP_Customize_Control {

    public $id;
    private $boxtitle = array();
    private $add_field_label = array();
    private $customizer_icon_container = '';
    private $allowed_html = array();
    public $customizer_repeater_image_control = true;
    public $customizer_repeater_icon_control = true;
    public $customizer_repeater_color_control = false;
    public $customizer_repeater_color2_control = false;
    public $customizer_repeater_title_control = true;
    public $customizer_repeater_subtitle_control = false;
    public $customizer_repeater_text_control = false;
    public $customizer_repeater_link_control = true;
    public $customizer_repeater_text2_control = false;
    public $customizer_repeater_link2_control = false;
    public $customizer_repeater_shortcode_control = false;
    public $customizer_repeater_repeater_control = false;

    public function __construct($manager, $id, $args = array()) {
        parent::__construct($manager, $id, $args);
        /* Get options from customizer.php */
        $this->add_field_label = esc_html__('Add new social link', 'decorator-woocommerce-email-customizer');
        if (!empty($args['add_field_label'])) {
            $this->add_field_label = $args['add_field_label'];
        }

        $this->boxtitle = esc_html__('Customizer Repeater', 'decorator-woocommerce-email-customizer');
        if (!empty($args['item_name'])) {
            $this->boxtitle = $args['item_name'];
        } elseif (!empty($this->label)) {
            $this->boxtitle = $this->label;
        }

        if (!empty($args['customizer_repeater_image_control'])) {
            $this->customizer_repeater_image_control = $args['customizer_repeater_image_control'];
        }

        if (!empty($args['customizer_repeater_icon_control'])) {
            $this->customizer_repeater_icon_control = $args['customizer_repeater_icon_control'];
        }

        if (!empty($args['customizer_repeater_color_control'])) {
            $this->customizer_repeater_color_control = $args['customizer_repeater_color_control'];
        }

        if (!empty($args['customizer_repeater_color2_control'])) {
            $this->customizer_repeater_color2_control = $args['customizer_repeater_color2_control'];
        }

        if (!empty($args['customizer_repeater_title_control'])) {
            $this->customizer_repeater_title_control = $args['customizer_repeater_title_control'];
        }

        if (!empty($args['customizer_repeater_subtitle_control'])) {
            $this->customizer_repeater_subtitle_control = $args['customizer_repeater_subtitle_control'];
        }

        if (!empty($args['customizer_repeater_text_control'])) {
            $this->customizer_repeater_text_control = $args['customizer_repeater_text_control'];
        }

        if (!empty($args['customizer_repeater_link_control'])) {
            $this->customizer_repeater_link_control = $args['customizer_repeater_link_control'];
        }

        if (!empty($args['customizer_repeater_text2_control'])) {
            $this->customizer_repeater_text2_control = $args['customizer_repeater_text2_control'];
        }

        if (!empty($args['customizer_repeater_link2_control'])) {
            $this->customizer_repeater_link2_control = $args['customizer_repeater_link2_control'];
        }

        if (!empty($args['customizer_repeater_shortcode_control'])) {
            $this->customizer_repeater_shortcode_control = $args['customizer_repeater_shortcode_control'];
        }

        if (!empty($args['customizer_repeater_repeater_control'])) {
            $this->customizer_repeater_repeater_control = $args['customizer_repeater_repeater_control'];
        }

        if (!empty($id)) {
            $this->id = $id;
        }

        $allowed_array1 = wp_kses_allowed_html('post');
        $allowed_array2 = array(
            'input' => array(
                'type' => array(),
                'class' => array(),
                'placeholder' => array(),
            ),
        );

        $this->allowed_html = array_merge($allowed_array1, $allowed_array2);
    }

    /**
     * Enqueue resources for the control
     */
    public function enqueue() {

        wp_enqueue_style('font-awesome', RP_DECORATOR_PLUGIN_URL . '/assets/css/customizer-repeater/font-awesome.min.css', array(), RP_DECORATOR_VERSION);

        wp_enqueue_style('customizer-repeater-admin-stylesheet', RP_DECORATOR_PLUGIN_URL . '/assets/css/customizer-repeater/admin-style.css', array(), RP_DECORATOR_VERSION);

        wp_enqueue_style('wp-color-picker');

        wp_enqueue_script('customizer-repeater-script', RP_DECORATOR_PLUGIN_URL . '/assets/js/customizer-repeater/customizer_repeater.js', array('jquery', 'jquery-ui-draggable', 'wp-color-picker'), RP_DECORATOR_VERSION, true);

        wp_enqueue_script('customizer-repeater-fontawesome-iconpicker', RP_DECORATOR_PLUGIN_URL . '/assets/js/customizer-repeater/fontawesome-iconpicker.min.js', array('jquery'), RP_DECORATOR_VERSION, true);

        wp_enqueue_style('customizer-repeater-fontawesome-iconpicker-script', RP_DECORATOR_PLUGIN_URL . '/assets/css/customizer-repeater/fontawesome-iconpicker.min.css', array(), RP_DECORATOR_VERSION);
    }

    function customizer_repeater_sanitize($input) {
        $input_decoded = json_decode($input, true);
        if (!empty($input_decoded)) {
            foreach ($input_decoded as $boxk => $box) {
                foreach ($box as $key => $value) {

                    $input_decoded[$boxk][$key] = wp_kses_post(force_balance_tags($value));
                }
            }
            return json_encode($input_decoded);
        }
        return $input;
    }

    /**
     * Render display function.
     */
    public function render_content() {

        /* Get default options */
        $this_default = json_decode($this->setting->default);

        /* Get values (json format) */
        $values = $this->value();

        /* Decode values */
        $json = json_decode($values);

        if (!is_array($json)) {
            $json = array($values);
        }
        ?>

        <span class="customize-control-title"><?php echo esc_html($this->label); ?></span>
        <div class="customizer-repeater-general-control-repeater customizer-repeater-general-control-droppable">
            <?php
            if (( count($json) == 1 && '' === $json[0] ) || empty($json)) {
                if (!empty($this_default)) {
                    $this->iterate_array($this_default);
                    ?>
                    <input type="hidden" id="customizer-repeater-<?php echo esc_attr($this->id); ?>-colector" <?php esc_attr($this->link()); ?> class="customizer-repeater-colector" value="<?php echo esc_textarea(json_encode($this_default)); ?>"/>
                    <?php
                } else {
                    $this->iterate_array();
                    ?>
                    <input type="hidden" id="customizer-repeater-<?php echo esc_attr($this->id); ?>-colector" <?php esc_attr($this->link()); ?> class="customizer-repeater-colector"/>
                    <?php
                }
            } else {
                $this->iterate_array($json);
                ?>
                <input type="hidden" id="customizer-repeater-<?php echo esc_attr($this->id); ?>-colector" <?php esc_attr($this->link()); ?> class="customizer-repeater-colector" value="<?php echo esc_textarea($this->value()); ?>"/>
                <?php
            }
            ?>
        </div>
        <button type="button" class="button add_field customizer-repeater-new-field" style="margin: auto;display: block;">
            <?php echo esc_html($this->add_field_label); ?>
        </button>
        <?php
    }

    /**
     * Iterate through array and show repeater items.
     *
     * @param array $array Options.
     */
    private function iterate_array($array = array()) {
        /* Counter that helps checking if the box is first and should have the delete button disabled */
        $it = 0;
        $social_icons = array(
            '--Please select--' => 'wt_default',
            'Facebook' => 'fa-facebook',
            'Twitter' => 'fa-twitter',
            'Instagram' => 'fa-instagram',
            'YouTube' => 'fa-youtube',
            'LinkedIn' => 'fa-linkedin',
            'Vimeo' => 'fa-vimeo'
        );
        $social_icons = apply_filters('wt_decorator_social_icon_type', $social_icons);

        if (!empty($array)) {
            foreach ($array as $icon) {
                if (in_array($icon->choice, $social_icons)) {
                    $key = array_search($icon->choice, $social_icons);
                }
                ?>
                <div class="customizer-repeater-general-control-repeater-container customizer-repeater-draggable">
                    <div class="customizer-repeater-customize-control-title">
                        <label style="padding: 0px 6px;"><?php echo $icon->choice ? $key . ' icon settings' : esc_html_e('Social icon settings', 'decorator-woocommerce-email-customizer'); ?></label>
                        <button type="button" style="border:none !important;"class="social-repeater-general-control-remove-field" >
                            <span class="dashicons dashicons-trash"></span>
                        </button>
                    </div>
                    <div class="customizer-repeater-box-content-hidden">
                <?php
                $choice = '';
                $image_url = '';
                $icon_value = '';
                $title = '';
                $subtitle = '';
                $text = '';
                $text2 = '';
                $link2 = '';
                $link = '';
                $shortcode = '';
                $repeater = '';
                $color = '';
                $color2 = '';
                if (!empty($icon->id)) {
                    $id = $icon->id;
                }
                if (!empty($icon->choice)) {
                    $choice = $icon->choice;
                }
                if (!empty($icon->image_url)) {
                    $image_url = $icon->image_url;
                }
                if (!empty($icon->icon_value)) {
                    $icon_value = $icon->icon_value;
                }
                if (!empty($icon->color)) {
                    $color = $icon->color;
                }
                if (!empty($icon->color2)) {
                    $color2 = $icon->color2;
                }
                if (!empty($icon->title)) {
                    $title = $icon->title;
                }
                if (!empty($icon->subtitle)) {
                    $subtitle = $icon->subtitle;
                }
                if (!empty($icon->text)) {
                    $text = $icon->text;
                }
                if (!empty($icon->link)) {
                    $link = $icon->link;
                }
                if (!empty($icon->text2)) {
                    $text2 = $icon->text2;
                }
                if (!empty($icon->link2)) {
                    $link2 = $icon->link2;
                }
                if (!empty($icon->shortcode)) {
                    $shortcode = $icon->shortcode;
                }

                if (!empty($icon->social_repeater)) {
                    $repeater = $icon->social_repeater;
                }

                if ($this->customizer_repeater_image_control == true && $this->customizer_repeater_icon_control == true) {
                    $this->icon_type_choice($choice);
                }
                if ($this->customizer_repeater_color_control == true) {
                    $this->input_control(
                            array(
                                'label' => apply_filters('repeater_input_labels_filter', esc_html__('Color', 'decorator-woocommerce-email-customizer'), $this->id, 'customizer_repeater_color_control'),
                                'class' => 'customizer-repeater-color-control',
                                'type' => apply_filters('customizer_repeater_input_types_filter', 'color', $this->id, 'customizer_repeater_color_control'),
                                'sanitize_callback' => 'sanitize_hex_color',
                                'choice' => $choice,
                            ), $color
                    );
                }
                if ($this->customizer_repeater_color2_control == true) {
                    $this->input_control(
                            array(
                                'label' => apply_filters('repeater_input_labels_filter', esc_html__('Color', 'decorator-woocommerce-email-customizer'), $this->id, 'customizer_repeater_color2_control'),
                                'class' => 'customizer-repeater-color2-control',
                                'type' => apply_filters('customizer_repeater_input_types_filter', 'color', $this->id, 'customizer_repeater_color2_control'),
                                'sanitize_callback' => 'sanitize_hex_color',
                            ), $color2
                    );
                }
                if ($this->customizer_repeater_title_control == true) {
                    $this->input_control(
                            array(
                                'label' => apply_filters('repeater_input_labels_filter', esc_html__('Title', 'decorator-woocommerce-email-customizer'), $this->id, 'customizer_repeater_title_control'),
                                'class' => 'customizer-repeater-title-control',
                                'type' => apply_filters('customizer_repeater_input_types_filter', '', $this->id, 'customizer_repeater_title_control'),
                            ), $title
                    );
                }
                if ($this->customizer_repeater_subtitle_control == true) {
                    $this->input_control(
                            array(
                                'label' => apply_filters('repeater_input_labels_filter', esc_html__('Subtitle', 'decorator-woocommerce-email-customizer'), $this->id, 'customizer_repeater_subtitle_control'),
                                'class' => 'customizer-repeater-subtitle-control',
                                'type' => apply_filters('customizer_repeater_input_types_filter', '', $this->id, 'customizer_repeater_subtitle_control'),
                            ), $subtitle
                    );
                }
                if ($this->customizer_repeater_text_control == true) {
                    $this->input_control(
                            array(
                                'label' => apply_filters('repeater_input_labels_filter', esc_html__('Text', 'decorator-woocommerce-email-customizer'), $this->id, 'customizer_repeater_text_control'),
                                'class' => 'customizer-repeater-text-control',
                                'type' => apply_filters('customizer_repeater_input_types_filter', 'textarea', $this->id, 'customizer_repeater_text_control'),
                            ), $text
                    );
                }
                if ($this->customizer_repeater_link_control) {
                    $this->input_control(
                            array(
                                'label' => apply_filters('repeater_input_labels_filter', esc_html__('Link', 'decorator-woocommerce-email-customizer'), $this->id, 'customizer_repeater_link_control'),
                                'class' => 'customizer-repeater-link-control',
                                'sanitize_callback' => 'esc_url_raw',
                                'type' => apply_filters('customizer_repeater_input_types_filter', '', $this->id, 'customizer_repeater_link_control'),
                            ), $link
                    );
                }
                if ($this->customizer_repeater_text2_control == true) {
                    $this->input_control(
                            array(
                                'label' => apply_filters('repeater_input_labels_filter', esc_html__('Text', 'decorator-woocommerce-email-customizer'), $this->id, 'customizer_repeater_text2_control'),
                                'class' => 'customizer-repeater-text2-control',
                                'type' => apply_filters('customizer_repeater_input_types_filter', 'textarea', $this->id, 'customizer_repeater_text2_control'),
                            ), $text2
                    );
                }
                if ($this->customizer_repeater_link2_control) {
                    $this->input_control(
                            array(
                                'label' => apply_filters('repeater_input_labels_filter', esc_html__('Link', 'decorator-woocommerce-email-customizer'), $this->id, 'customizer_repeater_link2_control'),
                                'class' => 'customizer-repeater-link2-control',
                                'sanitize_callback' => 'esc_url_raw',
                                'type' => apply_filters('customizer_repeater_input_types_filter', '', $this->id, 'customizer_repeater_link2_control'),
                            ), $link2
                    );
                }
                if ($this->customizer_repeater_shortcode_control == true) {
                    $this->input_control(
                            array(
                                'label' => apply_filters('repeater_input_labels_filter', esc_html__('Shortcode', 'decorator-woocommerce-email-customizer'), $this->id, 'customizer_repeater_shortcode_control'),
                                'class' => 'customizer-repeater-shortcode-control',
                                'type' => apply_filters('customizer_repeater_input_types_filter', '', $this->id, 'customizer_repeater_shortcode_control'),
                            ), $shortcode
                    );
                }
                if ($this->customizer_repeater_repeater_control == true) {
                    $this->repeater_control($repeater);
                }
                ?>

                        <input type="hidden" class="social-repeater-box-id" value="
                <?php
                if (!empty($id)) {
                    echo esc_attr($id);
                }
                ?>
                               ">


                    </div>
                </div>

                <?php
                $it++;
            }
        } else {
            ?>
            <div class="customizer-repeater-general-control-repeater-container">
                <div class="customizer-repeater-customize-control-title">
                    <label style="padding: 0px 6px;"><?php echo esc_html_e('Social icon settings', 'decorator-woocommerce-email-customizer'); ?></label>
                    <button type="button" class="social-repeater-general-control-remove-field" style="display:none;border:none !important;" >
                        <span class="dashicons dashicons-trash"></span>
                    </button>
                </div>
                <div class="customizer-repeater-box-content-hidden">
            <?php
            if ($this->customizer_repeater_image_control == true && $this->customizer_repeater_icon_control == true) {
                $this->icon_type_choice();
            }
            if ($this->customizer_repeater_color_control == true) {
                $this->input_control(
                        array(
                            'label' => apply_filters('repeater_input_labels_filter', esc_html__('Color', 'decorator-woocommerce-email-customizer'), $this->id, 'customizer_repeater_color_control'),
                            'class' => 'customizer-repeater-color-control',
                            'type' => apply_filters('customizer_repeater_input_types_filter', 'color', $this->id, 'customizer_repeater_color_control'),
                            'sanitize_callback' => 'sanitize_hex_color',
                        )
                );
            }
            if ($this->customizer_repeater_color2_control == true) {
                $this->input_control(
                        array(
                            'label' => apply_filters('repeater_input_labels_filter', esc_html__('Color', 'decorator-woocommerce-email-customizer'), $this->id, 'customizer_repeater_color2_control'),
                            'class' => 'customizer-repeater-color2-control',
                            'type' => apply_filters('customizer_repeater_input_types_filter', 'color', $this->id, 'customizer_repeater_color2_control'),
                            'sanitize_callback' => 'sanitize_hex_color',
                        )
                );
            }
            if ($this->customizer_repeater_title_control == true) {
                $this->input_control(
                        array(
                            'label' => apply_filters('repeater_input_labels_filter', esc_html__('Title', 'decorator-woocommerce-email-customizer'), $this->id, 'customizer_repeater_title_control'),
                            'class' => 'customizer-repeater-title-control',
                            'type' => apply_filters('customizer_repeater_input_types_filter', '', $this->id, 'customizer_repeater_title_control'),
                        )
                );
            }
            if ($this->customizer_repeater_subtitle_control == true) {
                $this->input_control(
                        array(
                            'label' => apply_filters('repeater_input_labels_filter', esc_html__('Subtitle', 'decorator-woocommerce-email-customizer'), $this->id, 'customizer_repeater_subtitle_control'),
                            'class' => 'customizer-repeater-subtitle-control',
                            'type' => apply_filters('customizer_repeater_input_types_filter', '', $this->id, 'customizer_repeater_subtitle_control'),
                        )
                );
            }
            if ($this->customizer_repeater_text_control == true) {
                $this->input_control(
                        array(
                            'label' => apply_filters('repeater_input_labels_filter', esc_html__('Text', 'decorator-woocommerce-email-customizer'), $this->id, 'customizer_repeater_text_control'),
                            'class' => 'customizer-repeater-text-control',
                            'type' => apply_filters('customizer_repeater_input_types_filter', 'textarea', $this->id, 'customizer_repeater_text_control'),
                        )
                );
            }
            if ($this->customizer_repeater_link_control == true) {
                $this->input_control(
                        array(
                            'label' => apply_filters('repeater_input_labels_filter', esc_html__('Link', 'decorator-woocommerce-email-customizer'), $this->id, 'customizer_repeater_link_control'),
                            'class' => 'customizer-repeater-link-control',
                            'type' => apply_filters('customizer_repeater_input_types_filter', '', $this->id, 'customizer_repeater_link_control'),
                        )
                );
            }
            if ($this->customizer_repeater_text2_control == true) {
                $this->input_control(
                        array(
                            'label' => apply_filters('repeater_input_labels_filter', esc_html__('Text', 'decorator-woocommerce-email-customizer'), $this->id, 'customizer_repeater_text2_control'),
                            'class' => 'customizer-repeater-text2-control',
                            'type' => apply_filters('customizer_repeater_input_types_filter', 'textarea', $this->id, 'customizer_repeater_text2_control'),
                        )
                );
            }
            if ($this->customizer_repeater_link2_control == true) {
                $this->input_control(
                        array(
                            'label' => apply_filters('repeater_input_labels_filter', esc_html__('Link', 'decorator-woocommerce-email-customizer'), $this->id, 'customizer_repeater_link2_control'),
                            'class' => 'customizer-repeater-link2-control',
                            'type' => apply_filters('customizer_repeater_input_types_filter', '', $this->id, 'customizer_repeater_link2_control'),
                        )
                );
            }
            if ($this->customizer_repeater_shortcode_control == true) {
                $this->input_control(
                        array(
                            'label' => apply_filters('repeater_input_labels_filter', esc_html__('Shortcode', 'decorator-woocommerce-email-customizer'), $this->id, 'customizer_repeater_shortcode_control'),
                            'class' => 'customizer-repeater-shortcode-control',
                            'type' => apply_filters('customizer_repeater_input_types_filter', '', $this->id, 'customizer_repeater_shortcode_control'),
                        )
                );
            }
            if ($this->customizer_repeater_repeater_control == true) {
                $this->repeater_control();
            }
            ?>
                    <input type="hidden" class="social-repeater-box-id">
                </div>
            </div>
            <?php
        }
    }

    /**
     * Display repeater input.
     *
     * @param array  $options Input options.
     * @param string $value Input value.
     */
    private function input_control($options, $value = '') {
        ?>

        <?php
        if (!empty($options['type'])) {
            switch ($options['type']) {
                case 'textarea':
                    ?>
                    <span class="customize-control-title"><?php echo esc_html($options['label']); ?></span>
                    <textarea class="<?php echo esc_attr($options['class']); ?>" placeholder="<?php echo esc_attr($options['label']); ?>"><?php echo (!empty($options['sanitize_callback']) ? call_user_func_array($options['sanitize_callback'], array($value)) : esc_attr($value) ); ?></textarea>
                    <?php
                    break;
                case 'color':
                    $style_to_add = '';
                    if ($options['choice'] !== 'customizer_repeater_icon') {
                        $style_to_add = 'display:none';
                    }
                    ?>
                    <span class="customize-control-title" 
                    <?php
                    if (!empty($style_to_add)) {
                        echo 'style="' . esc_attr($style_to_add) . '"';
                    }
                    ?>
                          ><?php echo esc_html($options['label']); ?></span>
                    <div class="<?php echo esc_attr($options['class']); ?>" 
                    <?php
                    if (!empty($style_to_add)) {
                        echo 'style="' . esc_attr($style_to_add) . '"';
                    }
                    ?>
                         >
                        <input type="text" value="<?php echo (!empty($options['sanitize_callback']) ? call_user_func_array($options['sanitize_callback'], array($value)) : esc_attr($value) ); ?>" class="<?php echo esc_attr($options['class']); ?>" />
                    </div>
                    <?php
                    break;
            }
        } else {
            ?>
            <span class="customize-control-title"><?php echo esc_html($options['label']); ?></span>
            <input type="text" value="<?php echo (!empty($options['sanitize_callback']) ? call_user_func_array($options['sanitize_callback'], array($value)) : esc_attr($value) ); ?>" class="<?php echo esc_attr($options['class']); ?>" placeholder="<?php echo esc_attr($options['label']); ?>"/>
            <?php
        }
    }

    /**
     * Display image upload input.
     *
     * @param string $value Input value.
     * @param string $show Flag show/hide input if image is selected.
     */
    private function image_control($value = '', $show = '') {
        ?>
        <div class="customizer-repeater-image-control" 
        <?php
        if ($show === 'customizer_repeater_icon' || $show === 'customizer_repeater_none' || empty($show)) {
            echo 'style="display:none;"';
        }
        ?>
             >
            <span class="customize-control-title">
        <?php esc_html_e('Image', 'decorator-woocommerce-email-customizer'); ?>
            </span>
            <input type="text" class="widefat custom-media-url" value="<?php echo esc_attr($value); ?>">
            <input type="button" class="button button-secondary customizer-repeater-custom-media-button" value="<?php esc_attr_e('Upload Image', 'decorator-woocommerce-email-customizer'); ?>" />
        </div>
        <?php
    }

    /**
     * Choose between icon or image if both inputs are active.
     *
     * @param string $value Choice value.
     */
    private function icon_type_choice($value = '') {
        $social_icons = array(
            '--Please select--' => 'wt_default',
            'Facebook' => 'fa-facebook',
            'Twitter' => 'fa-twitter',
            'Instagram' => 'fa-instagram',
            'YouTube' => 'fa-youtube',
            'LinkedIn' => 'fa-linkedin',
            'Vimeo' => 'fa-vimeo'
        );
        $social_icons = apply_filters('wt_decorator_social_icon_type', $social_icons);
        ?>
        <span class="customize-control-title">
        <?php esc_html_e('Social icon type', 'decorator-woocommerce-email-customizer'); ?>
        </span>
        <select class="customizer-repeater-image-choice">
            <?php
            foreach ($social_icons as $skey => $svalue) {
                if ($value == $svalue) {
                    echo '<option value=' . $svalue . ' selected>' . $skey . '</option>';
                } else {
                    echo '<option value=' . $svalue . '>' . $skey . '</option>';
                }
            }
            ?>
        </select>
        <?php
    }

    /**
     * Repeater input.
     *
     * @param string $value Repeater value.
     */
    private function repeater_control($value = '') {
        $social_repeater = array();
        $show_del = 0;
        ?>
        <span class="customize-control-title"><?php esc_html_e('Social icons', 'decorator-woocommerce-email-customizer'); ?></span>
        <?php
        echo '<span class="description customize-control-description">';
        echo sprintf(
                /* translators: %1$s is Fontawesome link. */
                esc_html__('Note: Some icons may not be displayed here. You can see the full list of icons at %1$s.', 'decorator-woocommerce-email-customizer'),
                sprintf('<a href="http://fontawesome.io/icons/" rel="nofollow">%s</a>', esc_html__('http://fontawesome.io/icons/', 'decorator-woocommerce-email-customizer'))
        );
        echo '</span>';
        if (!empty($value)) {
            $social_repeater = json_decode(html_entity_decode($value), true);
        }
        if (( count($social_repeater) == 1 && '' === $social_repeater[0] ) || empty($social_repeater)) {
            ?>
            <div class="customizer-repeater-social-repeater">
                <div class="customizer-repeater-social-repeater-container">
                    <div class="customizer-repeater-rc input-group icp-container">
                        <input data-placement="bottomRight" class="icp icp-auto" value="
                        <?php
                        if (!empty($value)) {
                            echo esc_attr($value);
                        }
                        ?>
                               " type="text" style="padding: 0 25px !important;">
                        <span class="input-group-addon"></span>
                    </div>
                    <input type="text" class="customizer-repeater-social-repeater-link" placeholder="<?php esc_attr_e('Link', 'decorator-woocommerce-email-customizer'); ?>">
                    <input type="hidden" class="customizer-repeater-social-repeater-id" value="">
                    <button class="social-repeater-remove-social-item" style="display:none">
            <?php esc_html_e('Remove Icon', 'decorator-woocommerce-email-customizer'); ?>
                    </button>
                </div>
                <input type="hidden" id="social-repeater-socials-repeater-colector" class="social-repeater-socials-repeater-colector" value=""/>
            </div>
            <button class="social-repeater-add-social-item button-secondary"><?php esc_html_e('Add Icon', 'decorator-woocommerce-email-customizer'); ?></button>
            <?php
        } else {
            ?>
            <div class="customizer-repeater-social-repeater">
                <?php
                foreach ($social_repeater as $social_icon) {
                    $show_del++;
                    ?>
                    <div class="customizer-repeater-social-repeater-container">
                        <div class="customizer-repeater-rc input-group icp-container">
                            <input data-placement="bottomRight" class="icp icp-auto" value="
                            <?php
                            if (!empty($social_icon['icon'])) {
                                echo esc_attr($social_icon['icon']);
                            }
                            ?>
                                   " type="text" style="padding: 0 25px !important;">
                            <span class="input-group-addon"><i class="fa <?php echo esc_attr($social_icon['icon']); ?>"></i></span>
                        </div>
                        <?php include RP_DECORATOR_PLUGIN_PATH . 'assets/inc/icons.php'; //get_template_part( $this->customizer_icon_container ); ?>
                        <input type="text" class="customizer-repeater-social-repeater-link" placeholder="<?php esc_attr_e('Link', 'decorator-woocommerce-email-customizer'); ?>" value="
                        <?php
                        if (!empty($social_icon['link'])) {
                            echo esc_url($social_icon['link']);
                        }
                        ?>
                               ">
                        <input type="hidden" class="customizer-repeater-social-repeater-id" value="
                <?php
                if (!empty($social_icon['id'])) {
                    echo esc_attr($social_icon['id']);
                }
                ?>
                               ">
                        <button class="social-repeater-remove-social-item" style="
                    <?php
                    if ($show_del == 1) {
                        echo 'display:none';
                    }
                    ?>
                                "><?php esc_html_e('Remove Icon', 'decorator-woocommerce-email-customizer'); ?></button>
                    </div>
                <?php
            }
            ?>
                <input type="hidden" id="social-repeater-socials-repeater-colector" class="social-repeater-socials-repeater-colector" value="<?php echo esc_textarea(html_entity_decode($value)); ?>" />
            </div>
            <button class="social-repeater-add-social-item button-secondary"><?php esc_html_e('Add Icon', 'decorator-woocommerce-email-customizer'); ?></button>
            <?php
        }
    }

}
