<?php
/**
 * Boot Score Theme Customizer
 *
 * @package bootscore
 */

 function bootscore_get_google_fonts() {
    $fonts = array(
        'Roboto' => 'Roboto',
        'Open Sans' => 'Open Sans',
        'Lato' => 'Lato',
        'Montserrat' => 'Montserrat',
        'Oswald' => 'Oswald',
        'Source Sans Pro' => 'Source Sans Pro',
        'Raleway' => 'Raleway',
        'Poppins' => 'Poppins',
        'Noto Sans' => 'Noto Sans',
        'Ubuntu' => 'Ubuntu',
        'Nunito' => 'Nunito',
        'IBM Plex Mono' => 'IBM Plex Mono',
        // Add more fonts as needed
    );
    return $fonts;
}

function bootscore_get_font_weights() {
    return array(
        '100' => __('Thin 100', 'bootscore'),
        '200' => __('Extra Light 200', 'bootscore'),
        '300' => __('Light 300', 'bootscore'),
        '400' => __('Normal 400', 'bootscore'),
        '500' => __('Medium 500', 'bootscore'),
        '600' => __('Semi-Bold 600', 'bootscore'),
        '700' => __('Bold 700', 'bootscore'),
        '800' => __('Extra-Bold 800', 'bootscore'),
        '900' => __('Black 900', 'bootscore'),
    );
}

function bootscore_customize_register($wp_customize) {
    // Add a setting for the tagline display option
    $wp_customize->add_setting( 'display_tagline', array(
        'default'           => true,
        'sanitize_callback' => 'wp_validate_boolean',
    ));

    // Add a checkbox control for the tagline display option
    $wp_customize->add_control( 'display_tagline', array(
        'label'    => __( 'Display Tagline', 'mytheme' ),
        'section'  => 'title_tagline', // The section where the control appears
        'settings' => 'display_tagline',
        'type'     => 'checkbox',
    ));

    // Add a setting for enabling the hero widget
    $wp_customize->add_setting('enable_hero_widget_setting', array(
        'default'           => false,
        'sanitize_callback' => 'boot_score_sanitize_checkbox',
    ));

    // Add a control for enabling the hero widget
    $wp_customize->add_control('enable_hero_widget_control', array(
        'label'    => __('Enable Showcase on Homepage', 'boot_score'),
        'section'  => 'static_front_page', // This is the section ID for "Homepage Settings"
        'settings' => 'enable_hero_widget_setting',
        'type'     => 'checkbox',
        'description' => __('Select to enable showcase widget area that will be displayed on the front/home page', 'boot_score'),
    ));    

    // Add a setting for hero widget classes
    $wp_customize->add_setting('hero_widget_classes_setting', array(
        'default'           => 'bg-light text-dark p-5 p-lg-0 pt-lg-5 text-center text-sm-start',
        'sanitize_callback' => 'sanitize_text_field',
    ));

    // Add a control for hero widget classes
    $wp_customize->add_control('hero_widget_classes_control', array(
        'label'    => __('Homepage Showcase Classes', 'boot_score'),
        'section'  => 'static_front_page', // Place it under "Homepage Settings"
        'settings' => 'hero_widget_classes_setting',
        'type'     => 'text',
        'description' => __('Enter the CSS classes for the showcase widget area.', 'boot_score'),
    ));

    // Add a section for Typography
    $wp_customize->add_section('typography_section', array(
        'title'       => __('Typography', 'bootscore'),
        'priority'    => 30,
    ));

        // Add a setting for the Google Font
        $wp_customize->add_setting('google_font_setting', array(
            'default'           => 'Roboto',
            'sanitize_callback' => 'sanitize_text_field',
        ));

        // Add a control for the Google Font
        $wp_customize->add_control('google_font_control', array(
            'label'    => __('Font Family', 'bootscore'),
            'section'  => 'typography_section',
            'settings' => 'google_font_setting',
            'type'     => 'select',
            'choices'  => bootscore_get_google_fonts(),
        ));

        // Add a setting for font weight
        $wp_customize->add_setting('font_weight_setting', array(
            'default'           => '400',
            'sanitize_callback' => 'sanitize_text_field',
        ));

        // Add a control for font weight
        $wp_customize->add_control('font_weight_control', array(
            'label'    => __('Font Weight', 'bootscore'),
            'section'  => 'typography_section',
            'settings' => 'font_weight_setting',
            'type'     => 'select',
            'choices'  => bootscore_get_font_weights(),
        ));

        // Add a setting for font size
        $wp_customize->add_setting('font_size_setting', array(
            'default'           => '16px',
            'sanitize_callback' => 'sanitize_text_field',
        ));

        // Add a control for font size
        $wp_customize->add_control('font_size_control', array(
            'label'    => __('Font Size', 'bootscore'),
            'section'  => 'typography_section',
            'settings' => 'font_size_setting',
            'type'     => 'text',
        ));

    
     // Add a section for Layout Settings if it doesn't exist
    $wp_customize->add_section('layout_settings_section', array(
        'title'       => __('Layout Settings', 'bootscore'),
        'priority'    => 20, // Adjust priority as needed
    ));

        // Add a setting for Container Type
        $wp_customize->add_setting('container_type_setting', array(
            'default'           => 'container',
            'sanitize_callback' => 'sanitize_text_field',
        ));

        // Add a control for Container Type
        $wp_customize->add_control('container_type_control', array(
            'label'    => __('Container Type', 'bootscore'),
            'description' => __(
						'Choose between Bootstrap\'s container and container-fluid. Default is \'container - Fixed container\'',
						'bootscore'
					),
            'section'  => 'layout_settings_section',
            'settings' => 'container_type_setting',
            'type'     => 'select',
            'choices'  => array(
                'container'       => __('Fixed container', 'bootscore'),
                'container-fluid' => __('Fluid container', 'bootscore'),
            ),
        ));

        // Add a setting for Sidebar Position
        $wp_customize->add_setting('sidebar_position_setting', array(
            'default'           => 'none',
            'sanitize_callback' => 'sanitize_text_field',
        ));
    
        // Add a control for Sidebar Position
        $wp_customize->add_control('sidebar_position_control', array(
            'label'    => __('Sidebar Position', 'bootscore'),
            'description' => __(
						'Set sidebar\'s default position. Can either be: right, left, both or none. Note: this can be overridden on individual pages. Default is \'No Sidebar\'',
						'bootscore'
					),
            'section'  => 'layout_settings_section',
            'settings' => 'sidebar_position_setting',
            'type'     => 'select',
            'choices'  => array(
                'right' => __('Right sidebar', 'bootscore'),
                'left'  => __('Left sidebar', 'bootscore'),
                'both'  => __('Left & Right sidebars', 'bootscore'),
                'none'  => __('No sidebar', 'bootscore'),
            ),
        ));
     // Add a section for Footer Settings if it doesn't exist
     $wp_customize->add_section('footer_settings_section', array(
        'title'       => __('Footer Settings', 'boot_score'),
        'priority'    => 120, // Position of the section
    ));

    // Add a setting for Footer Text
    $wp_customize->add_setting('footer_text_setting', array(
        'default'           => 'Copyright © 2024 Bootscore',
        'sanitize_callback' => 'sanitize_text_field',
    ));

    // Add a control for Footer Text
    $wp_customize->add_control('footer_text_control', array(
        'label'    => __('Footer Text', 'boot_score'),
        'section'  => 'footer_settings_section',
        'settings' => 'footer_text_setting',
        'type'     => 'text',
    ));

     // Add a setting for enabling the footer widget
     $wp_customize->add_setting('enable_footer_widget_setting', array(
        'default'           => false,
        'sanitize_callback' => 'boot_score_sanitize_checkbox',
    ));

    // Add a control for enabling the footer widget
    $wp_customize->add_control('enable_footer_widget_control', array(
        'label'    => __('Enable fullwidth widget  on footer', 'boot_score'),
        'section'  => 'footer_settings_section', 
        'settings' => 'enable_footer_widget_setting',
        'type'     => 'checkbox',
        'description' => __('Select to enable fullwidth widget area that will be displayed on the footer', 'boot_score'),
    ));    

    // Add a setting for hero widget classes
    $wp_customize->add_setting('footer_widget_classes_setting', array(
        'default'           => 'row my-3',
        'sanitize_callback' => 'sanitize_text_field',
    ));

    // Add a control for hero widget classes
    $wp_customize->add_control('hero_widget_classes_control', array(
        'label'    => __('Fullwidth footer widget Classes', 'boot_score'),
        'section'  => 'footer_settings_section', 
        'settings' => 'footer_widget_classes_setting',
        'type'     => 'text',
        'description' => __('Enter the CSS classes for the footer fullwidth widget area.', 'boot_score'),
    ));
}
add_action('customize_register', 'bootscore_customize_register');

// Sanitize checkbox input
function boot_score_sanitize_checkbox($checked) {
    return ((isset($checked) && true == $checked) ? true : false);
}


function bootscore_enqueue_google_fonts() {
    $font = get_theme_mod('google_font_setting', 'Roboto');
    $weight = get_theme_mod('font_weight_setting', '400');
    
    if ($font) {
        wp_enqueue_style('bootscore-google-fonts', 'https://fonts.googleapis.com/css2?family=' . urlencode($font) . ':wght@' . $weight . '&display=swap', false);
    }
}
add_action('wp_enqueue_scripts', 'bootscore_enqueue_google_fonts');

function bootscore_settings_css() {
    $font = get_theme_mod('google_font_setting', 'Roboto');
    $weight = get_theme_mod('font_weight_setting', '400');
    $size = get_theme_mod('font_size_setting', '16px');
    ?>
    <style type="text/css">
		:root {
            --bs-primary: <?php echo esc_attr( get_theme_mod( 'bootscore_primary_color', '#0d6efd' ) ); ?>;
        }
        body {
            font-family: '<?php echo esc_html($font); ?>', sans-serif;
            font-weight: <?php echo esc_html($weight); ?>;
            font-size: <?php echo esc_html($size); ?>;
        }
    </style>
    <?php
}
add_action('wp_head', 'bootscore_settings_css');

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function bootscore_customize_preview_js() {
	wp_enqueue_script( 'bootscore-customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), _BOOTSCORE_VERSION, true );
}
add_action( 'customize_preview_init', 'bootscore_customize_preview_js' );
