<?php
/*
* @Author 		pickplugins
* Copyright: 	pickplugins.com
*/

if ( ! defined('ABSPATH')) exit;  // if direct access 



$page_1_options = array(

    'page_nav' 	=> __( 'Nav Title 1', 'user-profile' ),
    'priority' => 10,
	'page_settings' => array(
		
		'section_1' => array(
			'title' 	=> 	__('This is Section Title','user-profile'),
			'description' 	=> __('This is section details','user-profile'),
			'options' 	=> array(

                array(
                    'id'		=> 'select_field',
                    'title'		=> __('Select Field','text-domain'),
                    'details'	=> __('Description of select field','text-domain'),
                    'type'		=> 'select',
                    'args'		=> array(
                        'option_1'	=> __('Option 1','text-domain'),
                        'option_2'	=> __('Option 2','text-domain'),
                    ),
                ),

                array(
                    'id'		=> 'select_multi_field',
                    'title'		=> __('Multi Select  Field','text-domain'),
                    'details'	=> __('Description of multi select field','text-domain'),
                    'type'		=> 'select_multi',
                    'args'		=> array(
                        'option_1'	=> __('Option 1','text-domain'),
                        'option_2'	=> __('Option 2','text-domain'),
                        'option_3'	=> __('Option 3','text-domain'),
                        'option_4'	=> __('Option 4','text-domain'),
                    ),
                ),

                array(
                    'id'		=> 'select2_field',
                    'title'		=> __('Select2  Field','text-domain'),
                    'details'	=> __('Description of select2 field','text-domain'),
                    'type'		=> 'select2',
                    'args'		=> array(
                        'option_1'	=> __('Option 1','text-domain'),
                        'option_2'	=> __('Option 2','text-domain'),
                        'option_3'	=> __('Option 3','text-domain'),
                        'option_4'	=> __('Option 4','text-domain'),
                    ),
                ),

                array(
                    'id'		=> 'select2_multi_field',
                    'title'		=> __('Select2 multi Field','text-domain'),
                    'details'	=> __('Description of select2 field','text-domain'),
                    'type'		=> 'select2',
                    'multiple'		=> true,
                    'args'		=> array(
                        'option_1'	=> __('Option 1','text-domain'),
                        'option_2'	=> __('Option 2','text-domain'),
                        'option_3'	=> __('Option 3','text-domain'),
                        'option_4'	=> __('Option 4','text-domain'),
                    ),
                ),



                array(
                    'id'		=> 'thumb_sizes_field',
                    'title'		=> __('Thumbnail sizes Field','text-domain'),
                    'details'	=> __('Description of select Thumbnail sizes field','text-domain'),
                    'type'		=> 'thumb_sizes',

                ),

                array(
                    'id'		=> 'checkbox_field',
                    'title'		=> __('Checkbox  Field','text-domain'),
                    'details'	=> __('Description of checkbox field','text-domain'),
                    'type'		=> 'checkbox',
                    'args'		=> array(
                        'option_1'	=> __('Option 1','text-domain'),
                        'option_2'	=> __('Option 2','text-domain'),
                        'option_3'	=> __('Option 3','text-domain'),
                        'option_4'	=> __('Option 4','text-domain'),
                    ),
                ),

                array(
                    'id'		=> 'radio_field',
                    'title'		=> __('Radio  Field','text-domain'),
                    'details'	=> __('Description of radio field','text-domain'),
                    'type'		=> 'radio',
                    'args'		=> array(
                        'option_1'	=> __('Option 1','text-domain'),
                        'option_2'	=> __('Option 2','text-domain'),
                        'option_3'	=> __('Option 3','text-domain'),
                        'option_4'	=> __('Option 4','text-domain'),
                    ),
                ),

                array(
                    'id'		=> 'textarea_field',
                    'title'		=> __('Txtarea Field','user-profile'),
                    'details'	=> __('Description of textarea field','user-profile'),
                    'type'		=> 'textarea',
                    'placeholder' => __('Textarea value','text-domain'),

                ),

                array(
                    'id'		=> 'number_field',
                    'title'		=> __('Text Field','user-profile'),
                    'details'	=> __('Description of number field','user-profile'),
                    'type'		=> 'number',
                    'placeholder' => __('123456','text-domain'),
                ),

                array(
                    'id'		=> 'text_field',
                    'title'		=> __('Text Field','user-profile'),
                    'details'	=> __('Description of text field','user-profile'),
                    'type'		=> 'text',
                    'placeholder' => __('Text value','text-domain'),
                ),

                array(
                    'id'		=> 'text_multi_field',
                    'title'		=> __('Multi Text Field','user-profile'),
                    'details'	=> __('Description of multi text field','user-profile'),
                    'type'		=> 'text_multi',
                    'placeholder' => __('Text value','text-domain'),


                ),

                array(
                    'id'		=> 'colorpicker_field',
                    'title'		=> __('Color picker field','text-domain'),
                    'details'	=> __('Description of colorpicker field','text-domain'),
                    'type'		=> 'colorpicker',
                ),

                array(
                    'id'		=> 'datepicker_field',
                    'title'		=> __('Date picker field','text-domain'),
                    'details'	=> __('Description of datepicker field','text-domain'),
                    'type'		=> 'datepicker',
                ),

                array(
                    'id'		=> 'faq_field',
                    'title'		=> __('FAQ field','text-domain'),
                    'details'	=> __('Description of faq field','text-domain'),
                    'type'		=> 'faq',
                    'args'		=> array(
                        array('title'=>'How to setup plugin?','link'=>'https://www.pickplugins.com/documentation/user-verification/faq/how-to-setup-plugin/', 'content'=>'Please see the documentation here <a href="https://www.pickplugins.com/documentation/user-verification/faq/how-to-setup-plugin/">https://www.pickplugins.com/documentation/user-verification/faq/how-to-setup-plugin/</a>'),
                        array('title'=>'How to check user verification status?
','link'=>'#', 'content'=>'Please see the documentation here <a href="https://www.pickplugins.com/documentation/user-verification/faq/how-to-check-user-verification-status/">https://www.pickplugins.com/documentation/user-verification/faq/how-to-check-user-verification-status/</a>'),
                        array('title'=>'How to stop auto login on WooCommerce registration?
','link'=>'#', 'content'=>'Please see the documentation here <a href="https://www.pickplugins.com/documentation/user-verification/faq/how-to-stop-auto-login-on-woocommerce-registration/">https://www.pickplugins.com/documentation/user-verification/faq/how-to-stop-auto-login-on-woocommerce-registration/</a>'),
                        array('title'=>'How to Automatically login after verification?
','link'=>'#', 'content'=>'Please see the documentation here <a href="https://www.pickplugins.com/documentation/user-verification/faq/automatically-login-after-verification/">https://www.pickplugins.com/documentation/user-verification/faq/automatically-login-after-verification/</a>'),


                    ),
                ),

                array(
                    'id'		=> 'addon_grid',
                    'title'		=> __('Popular Plugins','user-verification'),
                    'details'	=> __('See our all plugins here <a href="https://www.pickplugins.com/plugins/">https://www.pickplugins.com/plugins/</a>','user-verification'),
                    'type'		=> 'grid',
                    'args'		=> array(
                        array('title'=>'Post Grid','link'=>'https://www.pickplugins.com/item/post-grid-create-awesome-grid-from-any-post-type-for-wordpress/', 'content'=>'', 'thumb'=>'https://www.pickplugins.com/wp-content/uploads/2015/12/3814-post-grid-thumb-500x262.jpg'),
                        array('title'=>'Accordion','link'=>'https://www.pickplugins.com/item/accordions-html-css3-responsive-accordion-grid-for-wordpress/', 'content'=>'','thumb'=>'https://www.pickplugins.com/wp-content/uploads/2016/01/3932-product-thumb-500x250.png' ),
                        array('title'=>'Woocommerce Product Slider','link'=>'https://www.pickplugins.com/item/woocommerce-products-slider-for-wordpress/', 'content'=>'','thumb'=>'https://www.pickplugins.com/wp-content/uploads/2016/03/4357-woocommerce-products-slider-thumb-500x250.jpg'),
                        array('title'=>'Team Showcase','link'=>'https://www.pickplugins.com/item/team-responsive-meet-the-team-grid-for-wordpress/', 'content'=>'','thumb'=>'https://www.pickplugins.com/wp-content/uploads/2016/06/5145-team-thumb-500x250.jpg'),

                        array('title'=>'Breadcrumb','link'=>'https://www.pickplugins.com/item/breadcrumb-awesome-breadcrumbs-style-navigation-for-wordpress/', 'content'=>'','thumb'=>'https://www.pickplugins.com/wp-content/uploads/2016/03/4242-breadcrumb-500x252.png'),

                        array('title'=>'Wishlist for WooCommerce','link'=>'https://www.pickplugins.com/item/woocommerce-wishlist/', 'content'=>'','thumb'=>'https://www.pickplugins.com/wp-content/uploads/2017/10/12047-woocommerce-wishlist-500x250.png'),

                        array('title'=>'Job Board Manager','link'=>'https://www.pickplugins.com/item/job-board-manager-create-job-site-for-wordpress/', 'content'=>'','thumb'=>'https://www.pickplugins.com/wp-content/uploads/2015/08/3466-job-board-manager-thumb-500x250.png'),

                    ),
                ),




                array(
                    'id'		=> 'select2_page_list_field',
                    'title'		=> __('Multi Select2 for Page list  Field','text-domain'),
                    'details'	=> __('Description of multi select2 for Page list field','text-domain'),
                    'type'		=> 'select2',
                    'args'		=> 'WPADMINSETTINGS_PAGES_ARRAY',
                ),

                array(
                    'id'		=> 'select2_tax_list_field',
                    'title'		=> __('Multi Select2 for Taxonomy(category) list  Field','text-domain'),
                    'details'	=> __('Description of multi select2 for Taxonomy(category) list field','text-domain'),
                    'type'		=> 'select2',
                    'args'		=> 'WPADMINSETTINGS_TAX_%category%',
                ),



                array(
                    'id'		=> 'repeatable_field',
                    'title'		=> __('Repeatable Field','pickthemes'),
                    'details'	=> __('Repeatable Description','pickthemes'),
                    'type'		=> 'repeatable',
                    'default'		=> '',
                    'collapsible'=>true,
                    'fields'    => array(
                        array('type'=>'text', 'item_id'=>'text_field', 'name'=>'Text Field'),

                    ),
                ),










				
			)
		),
		
	),
);























$args = array(
	'add_in_menu'       => true,
	'menu_type'         => 'main',
	'menu_title'        => __( 'Admin Settings', 'user-profile' ),
	'page_title'        => __( 'Admin Settings', 'user-profile' ),
	'menu_page_title'   => __( 'Admin Settings', 'user-profile' ),
	'capability'        => "manage_options",
	'menu_slug'         => "admin-settings",
    'menu_icon'         => "dashicons-image-filter",
    'pages' 	        => array(
		'page-1'    => $page_1_options,
		//'page-2'  => $page_2_options,

	),
);

$wpThemeSettings = new wpThemeSettings( $args );






























