<?php
/*
* @Author 		pickplugins
* Copyright: 	pickplugins.com
*/

if ( ! defined('ABSPATH')) exit;  // if direct access 


add_action('wp_theme_settings_field_hello_world','wp_theme_settings_field_hello');

function wp_theme_settings_field_hello($option){

    $id			= isset( $option['id'] ) ? $option['id'] : "";
    $args 	= isset( $option['args'] ) ? $option['args'] : "";
    ?>
    <div class="">Hello World!</div>

    <?php

    var_dump($args);

}



add_action('repeatable_custom_input_field_hello_world','repeatable_custom_input_field_hello_world');

function repeatable_custom_input_field_hello_world($field){

    $id			= isset( $field['id'] ) ? $field['id'] : "";
    $args 	= isset( $field['args'] ) ? $field['args'] : "";
    ?>
    <div class="">Hello World!</div>

    <?php

    //var_dump($args);

}












$page_1_options = array(

    'page_nav' 	=> __( 'Nav Title 1', 'text-domain' ),
    'priority' => 10,
	'page_settings' => array(
		
		'section_1' => array(
			'title' 	=> 	__('This is Section Title','text-domain'),
			'description' 	=> __('This is section details','text-domain'),
			'options' 	=> array(


array(
    'id'		=> 'custom_field_hello',
    'title'		=> __('Custom field hello world','text-domain'),
    'details'	=> __('Description of custom input field hello world','text-domain'),
    'type'		=> 'hello_world',
    'args'		=> array(
        'option_1'	=> __('Option 1','text-domain'),
        'option_2'	=> __('Option 2','text-domain'),
        'option_3'	=> __('Option 3','text-domain'),
        'option_4'	=> __('Option 4','text-domain'),
    ),
),



array(
    'id'		=> 'sidebars_field',
    'title'		=> __('Sidebar select Field','text-domain'),
    'details'	=> __('Description of sidebars select field','text-domain'),
    'type'		=> 'select2',
    //'multiple'=> true,
    'args'		=> 'WPADMINSETTINGS_SIDEBARS_ARRAY',
),


array(
   'id'		=> 'menu_select_field',
   'title'		=> __('Menu select Field','text-domain'),
   'details'	=> __('Description of menu select field','text-domain'),
   'type'		=> 'select2',
    //'multiple'=> true,
   'args'		=> 'WPADMINSETTINGS_MENUS_ARRAY',
),

array(
    'id'		=> 'user_roles_field',
    'title'		=> __('User roles select Field','text-domain'),
    'details'	=> __('Description of user roles select field','text-domain'),
    'type'		=> 'select2',
    'multiple'=> true,
    'args'		=> 'WPADMINSETTINGS_USER_ROLES',
),


array(
    'id'		=> 'time_format_field',
    'title'		=> __('Time format Field','text-domain'),
    'details'	=> __('Description of time format field','text-domain'),
    'type'		=> 'time_format',
    'args'		=> array('g:i a' ,'g:i A', 'H:i'),
    'default'	=> 'H:i',
),

array(
    'id'		=> 'date_format_field',
    'title'		=> __('Date format Field','text-domain'),
    'details'	=> __('Description of date format field','text-domain'),
    'type'		=> 'date_format',
    'args'		=> array('F j, Y' ,'Y-m-d', 'm/d/Y' ,'d/m/Y' ),
    'default'	=> 'F j, Y',
),

array(
    'id'		=> 'icon_multi_field',
    'title'		=> __('Icon multi Field','text-domain'),
    'details'	=> __('Description of multi icon field','text-domain'),
    'type'		=> 'icon_multi',
    'default'	=> array('fas fa-bomb','fas fa-address-book'),
    'args'		=> 'WPADMINSETTINGS_FONTAWESOME_ARRAY',
),

array(
    'id'		=> 'icon_field',
    'title'		=> __('Icon Field','text-domain'),
    'details'	=> __('Description of icon field','text-domain'),
    'type'		=> 'icon',
    'default'	=> 'fas fa-bomb',
    'args'		=> 'WPADMINSETTINGS_FONTAWESOME_ARRAY',
),



array(
    'id'		=> 'color_palette_field',
    'title'		=> __('Color palette Field','text-domain'),
    'details'	=> __('Description of color palette field','text-domain'),
    'type'		=> 'color_palette',
    'colors'		=> array('#dd3333','#1e73be','#8224e3','#e07000','#1e73be','#8224e3'),
    'args'		=> array(
        'width'	    => '30px',
        'height'	=> '30px',
        'style'	    => '',
    ),
),


array(
    'id'		=> 'color_palette_multi_field',
    'title'		=> __('Color palette multi Field','text-domain'),
    'details'	=> __('Description of color palette multi field','text-domain'),
    'type'		=> 'color_palette_multi',
    'colors'		=> array('#dd3333','#1e73be','#8224e3','#e07000','#1e73be','#8224e3'),
    'args'		=> array(
        'width'	    => '30px',
        'height'	=> '30px',
        'style'	=> '',
    ),

),



array(
    'id'		=> 'switch_img_field15',
    'title'		=> __('Switch image Field','text-domain'),
    'details'	=> __('Description of switch image field','text-domain'),
    'type'		=> 'switch_img',
    'default'	=> 'option_2',
    'width'     =>'100px',
    'height'    =>'auto',
    'args'		=> array(
        'option_1'	=> array('src'=>'https://i.imgur.com/YiUyAgA.png', 'width'=>'100px', 'height'=>'auto'),
        'option_2'	=> array('src'=>'https://i.imgur.com/tWGz0EU.png', 'width'=>'100px', 'height'=>'auto'),
        'option_3'	=> array('src'=>'https://i.imgur.com/GT3VkYX.png', 'width'=>'100px', 'height'=>'auto'),
    ),
),




				
			)
		),
		
	),
);




$page_2_options = array(

    'page_nav' 	=> __( 'Nav Title 2', 'text-domain' ),
    'priority' => 10,
    'page_settings' => array(

        'section_1' => array(
            'title' 	=> 	__('This is Section Title','text-domain'),
            'description' 	=> __('This is section details','text-domain'),
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
    'id'		=> 'switch_multi_field6',
    'title'		=> __('Switch multi Field','text-domain'),
    'details'	=> __('Description of switch multi field','text-domain'),
    'type'		=> 'switch_multi',
    'default'		=> array('option_2','option_4'),
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
    'default'		=> 'option_2',
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
    'default'		=> 'option_2',
    'args'		=> array(
        'option_1'	=> __('Option 1','text-domain'),
        'option_2'	=> __('Option 2','text-domain'),
        'option_3'	=> __('Option 3','text-domain'),
    ),
),

array(
    'id'		=> 'select_multi_field',
    'title'		=> __('Multi Select  Field','text-domain'),
    'details'	=> __('Description of multi select field','text-domain'),
    'type'		=> 'select_multi',
    'default'		=> array('option_2'),
    'args'		=> array(
        'option_1'	=> __('Option 1','text-domain'),
        'option_2'	=> __('Option 2','text-domain'),
        'option_3'	=> __('Option 3','text-domain'),
        'option_4'	=> __('Option 4','text-domain'),
    ),
),

                array(
                    'id'		=> 'select2_field5',
                    'title'		=> __('Select2 Single Field','text-domain'),
                    'details'	=> __('Description of select2 single field','text-domain'),
                    'type'		=> 'select2',
                    'default'		=> 'option_3',
                    'multiple'		=> false,
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
                    'default'		=> array('option_3','option_2'),
                    'multiple'		=> true,
                    'args'		=> array(
                        'option_1'	=> __('Option 1','text-domain'),
                        'option_2'	=> __('Option 2','text-domain'),
                        'option_3'	=> __('Option 3','text-domain'),
                        'option_4'	=> __('Option 4','text-domain'),
                    ),
                ),


                array(
                    'id'		=> 'checkbox_field',
                    'title'		=> __('Checkbox  Field','text-domain'),
                    'details'	=> __('Description of checkbox field','text-domain'),
                    'type'		=> 'checkbox',
                    'default'		=> array('option_3','option_2'),
                    'args'		=> array(
                        'option_1'	=> __('Option 1','text-domain'),
                        'option_2'	=> __('Option 2','text-domain'),
                        'option_3'	=> __('Option 3','text-domain'),
                        'option_4'	=> __('Option 4','text-domain'),
                    ),
                ),



            )
        ),

    ),
);



$page_3_options = array(

    'page_nav' 	=> __( 'Nav Title 3', 'text-domain' ),
    'priority' => 10,
    'page_settings' => array(

        'section_1' => array(
            'title' 	=> 	__('This is Section Title','text-domain'),
            'description' 	=> __('This is section details','text-domain'),
            'options' 	=> array(




array(
    'id'		=> 'radio_field5',
    'title'		=> __('Radio Field','text-domain'),
    'details'	=> __('Description of radio field','text-domain'),
    'type'		=> 'radio',
    'default'		=> 'option_3',
    'args'		=> array(
        'option_1'	=> __('Option 1','text-domain'),
        'option_2'	=> __('Option 2','text-domain'),
        'option_3'	=> __('Option 3','text-domain'),
        'option_4'	=> __('Option 4','text-domain'),
    ),
),

                array(
                    'id'		=> 'textarea_field',
                    'title'		=> __('Txtarea Field','text-domain'),
                    'details'	=> __('Description of textarea field','text-domain'),
                    'type'		=> 'textarea',
                    'placeholder' => __('Textarea value','text-domain'),

                ),




array(
    'id'		=> 'number_field',
    'title'		=> __('Number Field','text-domain'),
    'details'	=> __('Description of number field','text-domain'),
    'type'		=> 'number',
    'default'		=> '987',
    'placeholder' => __('123456','text-domain'),
),

array(
    'id'		    => 'some_id_text_field',
    'title'		    => __('Text Field','text-domain'),
    'details'	    => __('Description of text field','text-domain'),
    'type'		    => 'text',
    'default'		=> 'Default Text',
    'placeholder'   => __('Text value','text-domain'),
),

array(
    'id'		    => 'text_multi_field',
    'title'		    => __('Multi Text Field','text-domain'),
    'details'	    => __('Description of multi text field','text-domain'),
    'type'		    => 'text_multi',
    'default'		=> array('Default Text #1', 'Default Text #2', 'Default Text #3'),
    'placeholder'   => __('Text value','text-domain'),
),

array(
    'id'		    => 'dimensions_field5',
    'title'		    => __('Dimensions Field','text-domain'),
    'details'	    => __('Description of Dimensions field','text-domain'),
    'type'		    => 'dimensions',
    'placeholder'   => __('Text value','text-domain'),
    'default'		=> array(
        'width'	    => '45',
        'height'	=> '45',
    ),
    'args'		=> array(
        'width'	=> __('Width','text-domain'),
        'height'	=> __('Height','text-domain'),
    ),
),

array(
    'id'		    => 'datepicker_field',
    'title'		    => __('Date picker field','text-domain'),
    'details'	    => __('Description of date picker field','text-domain'),
    'date_format'	=> 'dd-mm-yy',
    'placeholder'	=> 'dd-mm-yy',
    'default'		=> date('d-m-Y'), // today date
    'type'		    => 'datepicker',
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
    'id'		=> 'field_grid',
    'title'		=> __('Field Grid','user-verification'),
    'details'	=> __('Description of grid field','user-verification'),
    'type'		=> 'grid',
    'width'		=> array('768px'=>'100%','992px'=>'50%', '1200px'=>'30%', ),
    'height'		=> array('768px'=>'auto','992px'=>'150px', '1200px'=>'150px', ),
    'args'		=> array(
        array('title'=>'Post Grid','link'=>'https://www.pickplugins.com/', 'content'=>'', 'thumb'=>'https://i.imgur.com/or7wFbn.jpg'),
        array('title'=>'Accordion','link'=>'https://www.pickplugins.com/', 'content'=>'','thumb'=>'https://i.imgur.com/qCXd3nZ.jpg' ),
        array('title'=>'Woocommerce Product Slider','link'=>'https://www.pickplugins.com/', 'content'=>'','thumb'=>'https://i.imgur.com/CkhKEkY.jpg'),
        array('title'=>'Team Showcase','link'=>'https://www.pickplugins.com/', 'content'=>'','thumb'=>'https://i.imgur.com/0fhJlpr.jpg'),
        array('title'=>'Breadcrumb','link'=>'https://www.pickplugins.com/', 'content'=>'','thumb'=>'https://i.imgur.com/oE7nhsI.jpg'),
        array('title'=>'Wishlist for WooCommerce','link'=>'https://www.pickplugins.com/', 'content'=>'','thumb'=>'https://i.imgur.com/8aAJwsg.jpg'),

    ),
),




array(
    'id'		=> 'page_select_field',
    'title'		=> __('Page select  Field','text-domain'),
    'details'	=> __('Description of multi select2 for Page list field','text-domain'),
    'type'		=> 'select2',
    //'multiple'		=> true,
    'args'		=> 'WPADMINSETTINGS_PAGES_ARRAY',
),





            )
        ),

    ),
);



$page_4_options = array(

    'page_nav' 	=> __( 'Nav Title 4', 'text-domain' ),
    'priority' => 10,
    'page_settings' => array(

        'section_1' => array(
            'title' 	=> 	__('This is Section Title','text-domain'),
            'description' 	=> __('This is section details','text-domain'),
            'options' 	=> array(




array(
    'id'		=> 'select2_posts_list_field',
    'title'		=> __('Post select field','text-domain'),
    'details'	=> __('Description of multi select2 for Page list field','text-domain'),
    'type'		=> 'select',
    'multiple'		=> true,

    'args'		=> 'WPADMINSETTINGS_POSTS_ARRAY',
),



array(
    'id'		=> 'post_types_field',
    'title'		=> __('Post types select Field','text-domain'),
    'details'	=> __('Description ofPost types select field','text-domain'),
    'type'		=> 'select2',
    'multiple'		=> true,
    'args'		=> 'WPADMINSETTINGS_POST_TYPES_ARRAY',
),


array(
    'id'		=> 'thumb_sizes_field2',
    'title'		=> __('Thumbnail sizes Field 2','text-domain'),
    'details'	=> __('Description of select Thumbnail sizes field','text-domain'),
    'type'		=> 'checkbox',
    'multiple'		=> true,
    'args'		=> 'WPADMINSETTINGS_THUMB_SIEZS_ARRAY',
),



array(
    'id'		=> 'terms_select8',
    'title'		=> __('Terms select Field','text-domain'),
    'details'	=> __('Description of Taxonomy(category) list field','text-domain'),
    'type'		=> 'select',
    'multiple'  => true,
    'args'		=> 'WPADMINSETTINGS_TAX_%category%',
),



array(
    'id'		=> 'repeatable_field5',
    'title'		=> __('Repeatable Field','text-domain'),
    'details'	=> __('Repeatable Description','text-domain'),
    'type'		=> 'repeatable',
    'collapsible'=>true,
    'fields'    => array(

        array('type'=>'hello_world', 'default'=>'Hello 3', 'item_id'=>'hello_world_field', 'name'=>'Hello world Field'),
        array('type'=>'text', 'default'=>'Hello 3', 'item_id'=>'text_field', 'name'=>'Text Field'),
        array('type'=>'number', 'default'=>'123456', 'item_id'=>'number_field', 'name'=>'Number Field'),
        array('type'=>'tel', 'default'=>'', 'item_id'=>'tel_field', 'name'=>'Tel Field'),
        array('type'=>'time', 'default'=>'', 'item_id'=>'time_field', 'name'=>'Time Field'),
        array('type'=>'url', 'default'=>'', 'item_id'=>'url_field', 'name'=>'URL Field'),

        array('type'=>'date', 'default'=>'', 'item_id'=>'date_field', 'name'=>'Date Field'),
        array('type'=>'month', 'default'=>'', 'item_id'=>'month_field', 'name'=>'Month Field'),
        array('type'=>'search', 'default'=>'', 'item_id'=>'search_field', 'name'=>'Search Field'),


        array('type'=>'color', 'default'=>'', 'item_id'=>'color_field', 'name'=>'Color Field'),
        array('type'=>'email', 'default'=>'support@hello.com', 'item_id'=>'email_field', 'name'=>'Email Field'),
        array('type'=>'textarea', 'default'=>'Textarea content', 'item_id'=>'textarea_field', 'name'=>'Textarea Field'),
        array('type'=>'select', 'default'=>'option_1', 'item_id'=>'select_field', 'name'=>'Select Field', 'args'=> array('option_1'=>'Option 1', 'option_2'=>'Option 2', 'option_3'=>'Option 3')),
        array('type'=>'radio', 'default'=>'option_1', 'item_id'=>'select_field', 'name'=>'Radio Field', 'args'=> array('option_1'=>'Option 1', 'option_2'=>'Option 2', 'option_3'=>'Option 3')),
        array('type'=>'checkbox', 'default'=>array('option_1','option_3'), 'item_id'=>'select_field', 'name'=>'Checkbox Field', 'args'=> array('option_1'=>'Option 1', 'option_2'=>'Option 2', 'option_3'=>'Option 3')),
    ),
),

array(
    'id'		=> 'wp_editor_field',
    'title'		=> __('WP editor Field','text-domain'),
    'details'	=> __('Description of wp_editor field, please see detail here https://codex.wordpress.org/Function_Reference/wp_editor','text-domain'),
    'type'		=> 'wp_editor',
    'editor_settings'=>array('textarea_name'=>'wp_editor_field', 'editor_height'=>'150px'),
    'placeholder' => __('wp_editor value','text-domain'),
    'default'		=> 'Editor content',
),


array(
    'id'		=> 'link_color_field5',
    'title'		=> __('Link Color picker field','text-domain'),
    'details'	=> __('Description of Link Color field','text-domain'),
    'type'		=> 'link_color',
    'args'		=> array('link'	=> '#1B2A41','hover' => '#3F3244','active' => '#60495A','visited' => '#7D8CA3' ),
),



array(
    'id'		=> 'colorpicker_field3',
    'title'		=> __('Color picker field','text-domain'),
    'details'	=> __('Description of colorpicker field','text-domain'),
    'default'		=> '#1e73be',
    'type'		=> 'colorpicker',
),

array(
    'id'		=> 'colorpicker_multi_field',
    'title'		=> __('Multi colorpicker Field','text-domain'),
    'details'	=> __('Description of multi colorpicker field','text-domain'),
    'type'		=> 'colorpicker_multi',
    'default'		=> array('#dd3333','#1e73be','#8224e3'),
),


array(
    'id'		=> 'field_media_multi',
    'title'		=> __('Media multi','text-domain'),
    'details'	=> __('Media multi field description.','text-domain'),
    'type'		=> 'media_multi',
),


array(
    'id'		    => 'field_media',
    'title'		    => __('Media ','text-domain'),
    'details'	    => __('Field media description','text-domain'),
    'placeholder'	=> 'https://i.imgur.com/GD3zKtz.png',
    'type'		    => 'media',
),




            )
        ),

    ),
);




$args = array(
	'add_in_menu'       => true,
	'menu_type'         => 'main',
    'menu_name'         => __( 'Admin Settings', 'text-domain' ),
	'menu_title'        => __( 'Admin Settings', 'text-domain' ),
	'page_title'        => __( 'Admin Settings', 'text-domain' ),
	'menu_page_title'   => __( 'Admin Settings', 'text-domain' ),

	'capability'        => "manage_options",
	'menu_slug'         => "admin-settings",
    'menu_icon'         => "dashicons-image-filter",
    'item_name'         => "PickPlugins",
    'item_version'         => "1.0.2",
    'pages' 	        => array(
		'page-1'    => $page_1_options,
		'page-2'    => $page_2_options,
        'page-3'    => $page_3_options,
        'page-4'    => $page_4_options,

	),
);

$wpThemeSettings = new wpThemeSettings( $args );






























