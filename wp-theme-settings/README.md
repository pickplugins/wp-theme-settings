# WPAdminSettings
An easy option and settings management framework for WordPress, Developer friendly and elegant look build with native WordPress UI,  

#### Version: 1.0.0

## Input fields

* text
* text_multi
* textarea
* number
* select
* select_multi
* checkbox
* radio
* colorpicker
* datepicker
* faq
* custom






### How to use

#### Adding class-WPAdminSettings.php class file
```php
include "class-WPAdminSettings.php";
```

#### Add your menu to WordPress Admin Menu
```php
$args = array(
	'add_in_menu'     => true,
	'menu_type'       => 'main',
	'menu_title'      => __( 'My Settings', 'text-domain' ),
	'page_title'      => __( 'My Settings', 'text-domain' ),
	'menu_page_title' => __( 'My Settings Page', 'text-domain' ),
	'capability'      => "manage_options",
	'menu_slug'       => "my-settings",
	'menu_icon'       => "dashicons-hammer",
);

$WPAdminSettings = new WPAdminSettings( $args );
```

#### Design options for your menu
```php
$setting_page_1 = array(

	'page_nav' 	=> __( 'Page 1', 'text-domain' ),
	'page_settings' => array(
		
		'section_1' => array(
			'title' 	=> 	__('Section 1','text-domain'),
			'description' 	=> __('Description of section 1','text-domain'),
			'options' 	=> array(
				array(
					'id'		=> 'select_field',
					'title'		=> __('Select field','text-domain'),
					'details'	=> __('Description of select field','text-domain'),
					'type'		=> 'select',
					'args'		=> array(
						'option_1'	=> __('Option 1','text-domain'),
						'option_2'	=> __('Option 2','text-domain'),
					),
				),
				array(
					'id'		=> 'text_field',
					'title'		=> __('Text field','text-domain'),
					'details'	=> __('Description of text field','text-domain'),
					'type'		=> 'text',
					'placeholder' => __('My text field','text-domain'),
				),
				array(
					'id'		=> 'colorpicker_field',
					'title'		=> __('Color picker field','text-domain'),
					'details'	=> __('Description of colorpicker field','text-domain'),
					'type'		=> 'colorpicker',
				),
				array(
					'id'		=> 'radio_field',
					'title'		=> __('Radio field','text-domain'),
					'details'	=> __('Description of radio field','text-domain'),
					'type'		=> 'radio',
					'args'		=> array(
						'item_1'	=> __('Item 1','text-domain'),
						'item_2'	=> __('Item 2','text-domain'),
						'item_3'	=> __('Item 3','text-domain'),
						'item_4'	=> __('Item 4','text-domain'),
					),
				),
				
			)
		),
		
		'section_2' => array(
			'title' 	=> 	__('Section 2','text-domain'),
			'description' 	=> __('Description of section 2','text-domain'),
			'options' 	=> array(
				array(
					'id'		=> 'number_field',
					'title'		=> __('Number field','text-domain'),
					'details'	=> __('Description of number field','text-domain'),
					'type'		=> 'number',
					'placeholder' => 10,
				),
				array(
					'id'		=> 'checkbox_field',
					'title'		=> __('Checkbox field','text-domain'),
					'details'	=> __('Description of checkbox field','text-domain'),
					'type'		=> 'checkbox',
					'args'		=> array(
						'item_1'	=> __('Item 1','text-domain'),
						'item_2'	=> __('Item 2','text-domain'),
						'item_3'	=> __('Item 3','text-domain'),
					),
				),
			)
		),
	),
);
```

#### Add options `$setting_page_1` to your mainmenu
```php
$args = array(
	'add_in_menu'     => true,
	'menu_type'       => 'main',
	'menu_title'      => __( 'My Settings', 'text-domain' ),
	'page_title'      => __( 'My Settings', 'text-domain' ),
	'menu_page_title' => __( 'My Settings Page', 'text-domain' ),
	'capability'      => "manage_options",
	'menu_slug'       => "my-settings",
	'menu_icon'       => "dashicons-hammer",
	'pages' 	  => array(
		'setting_page_1' => $setting_page_1,
	),
);

$WPAdminSettings = new WPAdminSettings( $args );
```

#### Add More Pages
```php
$setting_page_2 = array(

	'page_nav' 	=> __( 'Page 2', 'text-domain' ),
	'page_settings' => array(
		
		'p2_section_1' => array(
			'title' 	=> 	__('Page 2 Section 1','text-domain'),
			'description' 	=> __('Description of page 2 section 1','text-domain'),
			'options' 	=> array(
				array(
					'id'		=> 'select_field_2',
					'title'		=> __('Select field','text-domain'),
					'details'	=> __('Description of select field','text-domain'),
					'type'		=> 'select',
					'args'		=> array(
						'option_1'	=> __('Option 1','text-domain'),
						'option_2'	=> __('Option 2','text-domain'),
					),
				),
			)
		),
	),
);

$args = array(
	'add_in_menu'     => true,
	'menu_type'       => 'main',
	'menu_title'      => __( 'My Settings', 'text-domain' ),
	'page_title'      => __( 'My Settings', 'text-domain' ),
	'menu_page_title' => __( 'My Settings Page', 'text-domain' ),
	'capability'      => "manage_options",
	'menu_slug'       => "my-settings",
	'menu_icon'       => "dashicons-hammer",
	'pages' 	  => array(
		'setting_page_1' => $setting_page_1,
		'setting_page_2' => $setting_page_2,
	),
);

$WPAdminSettings = new WPAdminSettings( $args );
```

#### Add submenu under any main menu
```php
$sub_args = array(
	'add_in_menu' => true,
	'menu_type' => 'submenu',
	'menu_title' => __( 'Sub Settings', 'text-domain' ),
	'page_title' => __( 'Sub Settings', 'text-domain' ),
	'menu_page_title' => __( 'Sub Settings Page', 'text-domain' ),
	'capability' => "manage_options",
	'menu_slug' => "my-sub-settings",
	'parent_slug' => "my-settings",
);

$WPAdminSettings_sub = new WPAdminSettings( $sub_args );
```

#### Design options for your submenu
```php
$sub_setting_page_1 = array(

	'page_nav' 	=> __( 'Sub Menu Page 1', 'text-domain' ),
	'page_settings' => array(
		
		'sp1_section_1' => array(
			'title' 	=> 	__('Section 1','text-domain'),
			'description' 	=> __('Description of section 1','text-domain'),
			'options' 	=> array(
				array(
					'id'		=> 'sub_select_field',
					'title'		=> __('Select field','text-domain'),
					'details'	=> __('Description of select field','text-domain'),
					'type'		=> 'select',
					'args'		=> array(
						'option_1'	=> __('Option 1','text-domain'),
						'option_2'	=> __('Option 2','text-domain'),
					),
				),				
			)
		),
	),
);
```
#### Add options `$sub_setting_page_1` to your submenu
```php
$sub_args = array(
	'add_in_menu'     => true,
	'menu_type'       => 'submenu',
	'menu_title'      => __( 'Sub Settings', 'text-domain' ),
	'page_title'      => __( 'Sub Settings', 'text-domain' ),
	'menu_page_title' => __( 'Sub Settings Page', 'text-domain' ),
	'capability'      => "manage_options",
	'parent_slug' 	  => "my-settings",
	'menu_slug'       => "sub-settings",
	'pages' 	  => array(
		'sub_setting_page_1' => $sub_setting_page_1,
	),
);

$WPAdminSettings_sub = new WPAdminSettings( $sub_args );
```


### Screenshots

#### Add main menu
![alt text](https://github.com/pickplugins/WPAdminSettings/blob/master/images/main-menu.png?raw=true "Add main menu")


#### Add sub menu
![alt text](https://github.com/pickplugins/WPAdminSettings/blob/master/images/submenu.png?raw=true "Add sub menu")

