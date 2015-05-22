<?php
/* BACKEND */
class MCF_AdminPage
{
    /**
     * Holds the values to be used in the fields callbacks
     */
    private $options;
	
	/**
     * Get options
     */
	public function getOptions(){
		return get_option( 'mcf_option'  );
	}
	 
    /**
     * Start up
     */
    public function __construct()
    {
        add_action( 'admin_menu', array( $this, 'add_plugin_page' ) );
        add_action( 'admin_init', array( $this, 'page_init' ) );
    }

    /**
     * Add options page
     */
    public function add_plugin_page()
    {
        // This page will be under "Settings"
        add_options_page(
            'MCF Settings Admin', 
            'Mobile Contact Footer Settings', 
            'manage_options', 
            'mcf-setting-admin', 
            array( $this, 'create_admin_page' )
        );
    }

    /**
     * Options page callback
     */
    public function create_admin_page()
    {
        // Set class property
        $this->options = get_option( 'mcf_option' );
        ?>
        <div class="wrap">
            <h2>Mobile Contact Footer Settings</h2> 				
            <form method="post" action="options.php">
            <?php
                // This prints out all hidden setting fields
                settings_fields( 'mcf_group' );   
                do_settings_sections( 'mcf-setting-admin' );
                submit_button(); 
            ?>
            </form>
        </div>
        <?php
    }

    /**
     * Register and add settings
     */
    public function page_init()
    {        
        register_setting(
            'mcf_group', // Option group
            'mcf_option', // Option name
            array( $this, 'sanitize' ) // Sanitize
        );

        add_settings_section(
            'mcf_section', // ID
            'Please enter your information below', // Title
            array( $this, 'print_section_info' ), // Callback
            'mcf-setting-admin' // Page
        );  

        add_settings_field(
            'mcf_section_phone', // ID
            'Phone Number', // Title 
            array( $this, 'phone_callback' ), // Callback
            'mcf-setting-admin', // Page
            'mcf_section' // Section           
        );    

		add_settings_field(
            'mcf_section_phone_icon', 
            'Font Awesome Icon Name', 
            array( $this, 'phone_icon_callback' ), 
            'mcf-setting-admin', 
            'mcf_section'
        );  

        add_settings_field(
            'mcf_section_email', 
            'Email Address', 
            array( $this, 'email_callback' ), 
            'mcf-setting-admin', 
            'mcf_section'
        ); 

		add_settings_field(
            'mcf_section_email_icon', 
            'Font Awesome Icon Name', 
            array( $this, 'email_icon_callback' ), 
            'mcf-setting-admin', 
            'mcf_section'
        );  
			
		add_settings_field(
            'mcf_section_maps', 
            'Address for Google Maps', 
            array( $this, 'maps_callback' ), 
            'mcf-setting-admin', 
            'mcf_section'
        ); 
		
		add_settings_field(
            'mcf_section_maps_icon', 
            'Font Awesome Icon Name', 
            array( $this, 'maps_icon_callback' ), 
            'mcf-setting-admin', 
            'mcf_section'
        );  
		
		add_settings_field(
            'mcf_section_social', 
            'Social Media Page', 
            array( $this, 'social_callback' ), 
            'mcf-setting-admin', 
            'mcf_section'
        ); 
		
		add_settings_field(
            'mcf_section_social_icon', 
            'Font Awesome Icon Name', 
            array( $this, 'social_icon_callback' ), 
            'mcf-setting-admin', 
            'mcf_section'
        );  
		
		add_settings_field(
            'mcf_section_bg_color', 
            'Set Background Color', 
            array( $this, 'color_callback' ), 
            'mcf-setting-admin', 
            'mcf_section'
        ); 
		
		add_settings_field(
            'mcf_section_icon_color', 
            'Set Icon Color', 
            array( $this, 'icon_color_callback' ), 
            'mcf-setting-admin', 
            'mcf_section'
        ); 
    }

    /**
     * Sanitize each setting field as needed
     *
     * @param array $input Contains all settings fields as array keys
     */
    public function sanitize( $input )
    {
        $new_input = array();
        if( isset( $input['mcf_section_phone'] ) ){
            $input['mcf_section_phone'] = sanitize_text_field( $input['mcf_section_phone'] );
			$new_input['mcf_section_phone'] = strtr($input['mcf_section_phone'], array('-' => '', '+' => '', '.' => '', '_' => '', ',' => ''));	
			}
		
		if( isset( $input['mcf_section_phone_icon'] ) )
            $new_input['mcf_section_phone_icon'] = sanitize_text_field( $input['mcf_section_phone_icon'] );

        if( isset( $input['mcf_section_email'] ) )
            $new_input['mcf_section_email'] = sanitize_email( $input['mcf_section_email'] );
		
		if( isset( $input['mcf_section_email_icon'] ) )
            $new_input['mcf_section_email_icon'] = sanitize_text_field( $input['mcf_section_email_icon'] );
		
		if( isset( $input['mcf_section_maps'] ) )
            $new_input['mcf_section_maps'] = sanitize_text_field( $input['mcf_section_maps'] );
		
		if( isset( $input['mcf_section_maps_icon'] ) )
            $new_input['mcf_section_maps_icon'] = sanitize_text_field( $input['mcf_section_maps_icon'] );
		
		if( isset( $input['mcf_section_social'] ) )
            $new_input['mcf_section_social'] = sanitize_text_field( $input['mcf_section_social'] );
		
		if( isset( $input['mcf_section_social_icon'] ) )
            $new_input['mcf_section_social_icon'] = sanitize_text_field( $input['mcf_section_social_icon'] );

		if( isset( $input['mcf_section_bg_color'] ) )
            $new_input['mcf_section_bg_color'] = sanitize_text_field( $input['mcf_section_bg_color'] );
		
		if( isset( $input['mcf_section_icon_color'] ) )
            $new_input['mcf_section_icon_color'] = sanitize_text_field( $input['mcf_section_icon_color'] );
		
        return $new_input;
    }
	
	public function clean_phone($input){
		$clean = strtr($input, array('-' => '', '+' => '', '.' => '', '_' => '', ',' => ''));	
		return $clean;
	}

    /** 
     * Print the Section text
     */
    public function print_section_info()
    {
        print 'Enter your settings below:';
    }
	
	public $display_icon_pre = '<div style="position: relative; margin-top: 20px;"><i class="fa fa-';
	public $display_icon_post = ' fa-4x"></i></div>';
    /** 
     * Get the settings option array and print one of its values
     */	 
    public function phone_callback()
    {
        printf(
            '<input type="phone" size="40" placeholder="1234567890" id="mcf_section_phone" name="mcf_option[mcf_section_phone]" value="%s" />',
            isset( $this->options['mcf_section_phone'] ) ? esc_attr( $this->options['mcf_section_phone']) : ''
        );
    }
	
    public function phone_icon_callback()
    {
        printf(
            '<input type="text" size="40" placeholder="icon-name" id="mcf_section_phone_icon" name="mcf_option[mcf_section_phone_icon]" value="%s" />
			' . $this->display_icon_pre . $this->options['mcf_section_phone_icon'] . $this->display_icon_post,
            isset( $this->options['mcf_section_phone_icon'] ) ? esc_attr( $this->options['mcf_section_phone_icon']) : ''
        );
    }

    public function email_callback()
    {
        printf(
            '<input type="email" size="40" placeholder="name@email.com" id="mcf_section_email" name="mcf_option[mcf_section_email]" value="%s" />',
            isset( $this->options['mcf_section_email'] ) ? esc_attr( $this->options['mcf_section_email']) : ''
        );
    }
	
	public function email_icon_callback()
    {
        printf(
            '<input type="text" size="40" placeholder="icon-name" id="mcf_section_email_icon" name="mcf_option[mcf_section_email_icon]" value="%s" />
			' . $this->display_icon_pre . $this->options['mcf_section_email_icon'] . $this->display_icon_post,
            isset( $this->options['mcf_section_email_icon'] ) ? esc_attr( $this->options['mcf_section_email_icon']) : ''
        );
    }
	
    public function maps_callback()
    {
        printf(
            '<input type="text" size="40" placeholder="Street, City, State Zip" id="mcf_section_maps" name="mcf_option[mcf_section_maps]" value="%s" />',
            isset( $this->options['mcf_section_maps'] ) ? esc_attr( $this->options['mcf_section_maps']) : ''
        );
    }
	
	public function maps_icon_callback()
    {
        printf(
            '<input type="text" size="40" placeholder="icon-name" id="mcf_section_maps_icon" name="mcf_option[mcf_section_maps_icon]" value="%s" />
			' . $this->display_icon_pre . $this->options['mcf_section_maps_icon'] . $this->display_icon_post,
            isset( $this->options['mcf_section_maps_icon'] ) ? esc_attr( $this->options['mcf_section_maps_icon']) : ''
        );
    }
	
    public function social_callback()
    {
        printf(
            '<input type="url" size="40" placeholder="e.g. https://www.facebook.com/YourName" id="mcf_section_social" name="mcf_option[mcf_section_social]" value="%s" />',
            isset( $this->options['mcf_section_social'] ) ? esc_attr( $this->options['mcf_section_social']) : ''
        );
    }
	
	public function social_icon_callback()
    {
        printf(
            '<input type="text" size="40" placeholder="icon-name" id="mcf_section_social_icon" name="mcf_option[mcf_section_social_icon]" value="%s" />
			' . $this->display_icon_pre . $this->options['mcf_section_social_icon'] . $this->display_icon_post,
            isset( $this->options['mcf_section_social_icon'] ) ? esc_attr( $this->options['mcf_section_social_icon']) : ''
        );
    }
	
    public function color_callback()
    {
        printf(
            '<input class="mcf-color-field1" type="text" size="20" id="mcf_section_bg_color" name="mcf_option[mcf_section_bg_color]" value="%s" />
			<div class="mcf-color-picker1" style="position: relative;">
				<div style="position: absolute;" id="mcf_colorpicker1"></div>
			</div>',
            isset( $this->options['mcf_section_bg_color'] ) ? esc_attr( $this->options['mcf_section_bg_color']) : ''
        );
    }
	
	public function icon_color_callback()
    {
        printf(
            '<input class="mcf-color-field2" type="text" size="20" id="mcf_section_icon_color" name="mcf_option[mcf_section_icon_color]" value="%s" />
			<div class="mcf-color-picker2" style="position: relative;">
				<div style="position: absolute;" id="mcf_colorpicker2"></div>
			</div>',
            isset( $this->options['mcf_section_icon_color'] ) ? esc_attr( $this->options['mcf_section_icon_color']) : ''
        );
    }

}

function mcf_admin_include_style(){
		
	wp_enqueue_style(
			'mcf-fontawesome-style', 
			plugins_url( 'font-awesome-4.3.0/css/font-awesome.min.css', __FILE__)
			);
	
	wp_enqueue_style( 'wp-color-picker' );
	wp_enqueue_script( 'wp-color-picker' );
    wp_enqueue_script( 
			'mcf-script', 
			plugins_url('mcf-script.js', __FILE__ ), 
			array( 'wp-color-picker', 'jquery' )
			);

}

if( is_admin() ){
    $mcf_admin_page = new MCF_AdminPage();
}
add_action( 'admin_enqueue_scripts', 'mcf_admin_include_style' );

