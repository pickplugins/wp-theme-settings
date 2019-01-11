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
                    'id'		=> 'switch_icon_field',
                    'title'		=> __('Switch icon Field','text-domain'),
                    'details'	=> __('Description of switch icon field','text-domain'),
                    'type'		=> 'switch',
                    'args'		=> array(
                        'option_1'	=> __('<i class="fas fa-align-left"></i>','text-domain'),
                        'option_2'	=> __('<i class="fas fa-align-center"></i>','text-domain'),
                        'option_3'	=> __('<i class="fas fa-align-right"></i>','text-domain'),
                    ),
                ),


                array(
                    'id'		=> 'switch_multi_field',
                    'title'		=> __('Switch multi Field','text-domain'),
                    'details'	=> __('Description of switch multi field','text-domain'),
                    'type'		=> 'switch_multi',
                    'args'		=> array(
                        'option_1'	=> __('Option 1','text-domain'),
                        'option_2'	=> __('Option 2','text-domain'),
                        'option_3'	=> __('Option 3','text-domain'),
                        'option_4'	=> __('Option 4','text-domain'),
                    ),
                ),




                array(
                    'id'		=> 'switch_field',
                    'title'		=> __('Switch Field','text-domain'),
                    'details'	=> __('Description of switch field','text-domain'),
                    'type'		=> 'switch',
                    'args'		=> array(
                        'option_1'	=> __('Option 1','text-domain'),
                        'option_2'	=> __('Option 2','text-domain'),
                        'option_3'	=> __('Option 3','text-domain'),
                        'option_4'	=> __('Option 4','text-domain'),
                    ),
                ),

                array(
                    'id'		=> 'range_input_field',
                    'title'		=> __('Range input field','text-domain'),
                    'details'	=> __('Description of Range input field','text-domain'),
                    'type'		=> 'range_input',
                    'default'		=> '75',
                    'args'		=> array('min' => '0','max' => '100','step' => '1'),
                ),

                array(
                    'id'		=> 'range_field',
                    'title'		=> __('Range field','text-domain'),
                    'details'	=> __('Description of Range field','text-domain'),
                    'type'		=> 'range',
                    'default'		=> '75',
                    'args'		=> array('min' => '0','max' => '100','step' => '10'),
                ),

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
                        array('title'=>'What is Lorem Ipsum?','link'=>'#', 'content'=>'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.'),
                        array('title'=>'Why do we use it?','link'=>'#', 'content'=>'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using \'Content here, content here\', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).'),
                        array('title'=>'Where does it come from?','link'=>'#', 'content'=>'Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of "de Finibus Bonorum et Malorum" (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, "Lorem ipsum dolor sit amet..", comes from a line in section 1.10.32.'),



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

                array(
                    'id'		=> 'wp_editor_field',
                    'title'		=> __('wp_editor Field','user-profile'),
                    'details'	=> __('Description of wp_editor field, please see detail here https://codex.wordpress.org/Function_Reference/wp_editor','user-profile'),
                    'type'		=> 'wp_editor',
                    'editor_settings'=>array('textarea_name'=>'wp_editor_field', 'editor_height'=>'150px'),
                    'placeholder' => __('wp_editor value','text-domain'),
                    'default'		=> 'wp editor content',

                ),


                array(
                    'id'		=> 'link_color_field2',
                    'title'		=> __('Link Color picker field','text-domain'),
                    'details'	=> __('Description of Link Color field','text-domain'),
                    'type'		=> 'link_color',
                    'args'		=> array('link'	=> '#1B2A41','hover' => '#3F3244','active' => '#60495A','visited' => '#7D8CA3' ),
                ),








                array(
                    'id'		=> 'field_media_multi',
                    'title'		=> __('Site Logo','pickthemes'),
                    'details'	=> __('Logo are unique identification of your site, upload logo wisely.','pickthemes'),
                    'type'		=> 'media_multi',
                    'placeholder' => __('Text value','pickthemes'),
                ),


                array(
                    'id'		=> 'site_logo_attach_id',
                    'title'		=> __('Site Logo','pickthemes'),
                    'details'	=> __('Logo are unique identification of your site, upload logo wisely.','pickthemes'),
                    'type'		=> 'media',
                    'placeholder' => __('Text value','pickthemes'),
                ),



				
			)
		),
		
	),
);




$page_2_options = array(

    'page_nav' 	=> __( 'Nav Title 2', 'user-profile' ),
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
    'item_name'         => "PickPlugins",
    'item_version'         => "1.0.2",
    'pages' 	        => array(
		'page-1'    => $page_1_options,
		'page-2'  => $page_2_options,

	),
);

$wpThemeSettings = new wpThemeSettings( $args );






























