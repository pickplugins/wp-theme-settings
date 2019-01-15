<?php
/*
* @Author 	:	PickPlugins
* Copyright	: 	2015 PickPlugins.com
*
* Version	:	1.0.3	
*/

if ( ! defined('ABSPATH')) exit;  // if direct access 


if( ! class_exists( 'wpThemeSettings' ) ) {
	
class wpThemeSettings {
	
	public $data = array();
	
    public function __construct( $args ){
		
		$this->data = &$args;
	
		if( $this->add_in_menu() ) {
			add_action( 'admin_menu', array( $this, 'add_menu_in_admin_menu' ), 12 );
		}
		
		add_action( 'admin_init', array( $this, 'display_fields' ), 12 );
		add_filter( 'whitelist_options', array( $this, 'whitelist_options' ), 99, 1 );
		add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_color_picker' ) );
	}
	
	public function add_menu_in_admin_menu() {
		
		if( "main" == $this->get_menu_type() ) {
            add_theme_page( $this->get_menu_name(), $this->get_menu_title(), $this->get_capability(), $this->get_menu_slug(), array( $this, 'display_function' ), $this->get_menu_icon() );
		}

//		if( "submenu" == $this->get_menu_type() ) {
//			add_submenu_page( $this->get_parent_slug(), $this->get_page_title(), $this->get_menu_title(), $this->get_capability(), $this->get_menu_slug(), array( $this, 'display_function' ) );
//		}
	}
	
	public function enqueue_color_picker(){
		wp_enqueue_style( 'wp-color-picker' );
		wp_enqueue_script( 'wp-color-picker' );
		wp_enqueue_script( 'jquery-ui-datepicker' );

        wp_register_style( 'jquery-ui', 'http://code.jquery.com/ui/1.11.2/themes/smoothness/jquery-ui.css' );
        wp_enqueue_style( 'jquery-ui' );

        wp_register_style( 'wp-theme-settings', plugins_url('/', __FILE__).'css/wp-theme-settings.css' );
        wp_enqueue_style( 'wp-theme-settings' );


	}
	
	public function display_fields() { 

 		foreach( $this->get_settings_fields() as $key => $setting ):
		
			add_settings_section(
				$key,
				isset( $setting['title'] ) ? $setting['title'] : "",
				array( $this, 'section_callback' ), 
				$this->get_current_page()
			);
			
			foreach( $setting['options'] as $option ) :
				
			add_settings_field( $option['id'], $option['title'], array($this,'field_generator'), $this->get_current_page(), $key, $option );

			endforeach;
		
		endforeach;
	}
	
	public function field_generator( $option ) {
			
		$id 		= isset( $option['id'] ) ? $option['id'] : "";
		$type 		= isset( $option['type'] ) ? $option['type'] : "";
		$details 	= isset( $option['details'] ) ? $option['details'] : "";
		
		if( empty( $id ) ) return;
		
		try{

		    //var_dump($type);
            if( isset($option['type']) && $option['type'] === 'select' ) 		        $this->generate_field_select( $option );
            elseif( isset($option['type']) && $option['type'] === 'select_multi')	    $this->generate_field_select_multi( $option );
            elseif( isset($option['type']) && $option['type'] === 'select2')	        $this->generate_field_select2( $option );
			elseif( isset($option['type']) && $option['type'] === 'checkbox')	        $this->generate_field_checkbox( $option );
			elseif( isset($option['type']) && $option['type'] === 'radio')		        $this->generate_field_radio( $option );
			elseif( isset($option['type']) && $option['type'] === 'textarea')	        $this->generate_field_textarea( $option );
			elseif( isset($option['type']) && $option['type'] === 'number' ) 	        $this->generate_field_number( $option );
			elseif( isset($option['type']) && $option['type'] === 'text' ) 		        $this->generate_field_text( $option );
            elseif( isset($option['type']) && $option['type'] === 'text_multi' ) 	    $this->generate_field_text_multi( $option );
            elseif( isset($option['type']) && $option['type'] === 'dimensions' ) 	    $this->generate_field_dimensions( $option );

            elseif( isset($option['type']) && $option['type'] === 'range' ) 	        $this->generate_field_range( $option );
            elseif( isset($option['type']) && $option['type'] === 'range_input' ) 	    $this->generate_field_range_input( $option );
			elseif( isset($option['type']) && $option['type'] === 'colorpicker')        $this->generate_field_colorpicker( $option );
            elseif( isset($option['type']) && $option['type'] === 'colorpicker_multi')  $this->generate_field_colorpicker_multi( $option );
            elseif( isset($option['type']) && $option['type'] === 'color_palette')      $this->generate_field_color_palette( $option );
            elseif( isset($option['type']) && $option['type'] === 'color_palette_multi') $this->generate_field_color_palette_multi( $option );

            elseif( isset($option['type']) && $option['type'] === 'date_format')	    $this->generate_field_date_format( $option );

            elseif( isset($option['type']) && $option['type'] === 'time_format')        $this->generate_field_time_format( $option );

            elseif( isset($option['type']) && $option['type'] === 'datepicker')	        $this->generate_field_datepicker( $option );
            elseif( isset($option['type']) && $option['type'] === 'faq')	            $this->generate_field_faq( $option );
            elseif( isset($option['type']) && $option['type'] === 'grid')	            $this->generate_field_grid( $option );
            elseif( isset($option['type']) && $option['type'] === 'custom_html')	    $this->generate_field_custom_html( $option );
            elseif( isset($option['type']) && $option['type'] === 'media')		        $this->generate_media( $option );
            elseif( isset($option['type']) && $option['type'] === 'media_multi')        $this->generate_media_multi( $option );
            elseif( isset($option['type']) && $option['type'] === 'repeatable')	        $this->generate_repeatable( $option );
            elseif( isset($option['type']) && $option['type'] === 'wp_editor')	        $this->generate_wp_editor( $option );
            elseif( isset($option['type']) && $option['type'] === 'link_color')	        $this->generate_field_link_color( $option );
            elseif( isset($option['type']) && $option['type'] === 'switch')	            $this->generate_field_switch( $option );
            elseif( isset($option['type']) && $option['type'] === 'switch_multi')	    $this->generate_field_switch_multi( $option );
            elseif( isset($option['type']) && $option['type'] === 'switch_img')	        $this->generate_field_switch_img( $option );
            elseif( isset($option['type']) && $option['type'] === 'icon')	            $this->generate_field_icon($option );
            elseif( isset($option['type']) && $option['type'] === 'icon_multi')	        $this->generate_field_icon_multi($option );

            elseif( isset($option['type']) && $option['type'] === 'linear_gradient')	$this->generate_linear_gradient($option );




			elseif( isset($option['type']) && $option['type'] === $type ) 	do_action( "wp_theme_settings_field_$type", $option );

			if( !empty( $details ) ) echo "<p class='description'>$details</p>";
		
		}
		catch(Pick_error $e) {
			echo $e->get_error_message();
		}
	}



    public function generate_media( $option ){

        $id			= isset( $option['id'] ) ? $option['id'] : "";
        $placeholder	= isset( $option['placeholder'] ) ? $option['placeholder'] : "";

        $value		= get_option( $id );
        $media_url	= wp_get_attachment_url( $value );
        $media_type	= get_post_mime_type( $value );
        $media_title= get_the_title( $value );


        $media_url = !empty($media_url) ? $media_url : $placeholder;

        wp_enqueue_media();

        echo "<div class='media_preview' style='width: 150px;margin-bottom: 10px;background: #eee;padding: 5px;    text-align: center;'>";

        if( "audio/mpeg" == $media_type ){

            echo "<div id='media_preview_$id' class='dashicons dashicons-format-audio' style='font-size: 70px;display: inline;'></div>";
            echo "<div>$media_title</div>";
        }
        else {
            echo "<img id='media_preview_$id' src='$media_url' style='width:100%'/>";
        }

        echo "</div>";
        echo "<input type='hidden' name='$id' id='media_input_$id' value='$value' />";
        echo "<div class='button' id='media_upload_$id'>Upload</div>";

        echo "<script>jQuery(document).ready(function($){
		$('#media_upload_$id').click(function() {
			var send_attachment_bkp = wp.media.editor.send.attachment;
			wp.media.editor.send.attachment = function(props, attachment) {
				$('#media_preview_$id').attr('src', attachment.url);
				$('#media_input_$id').val(attachment.id);
				wp.media.editor.send.attachment = send_attachment_bkp;
			}
			wp.media.editor.open($(this));
			return false;
		});
		});	</script>";
    }


    public function generate_media_multi( $option ){

        $id			= isset( $option['id'] ) ? $option['id'] : "";
        $values		= get_option( $id );

        wp_enqueue_media();

        ?>

        <div class="media">
            <div class='button' id='media_upload_<?php echo $id; ?>'>Upload</div>
            <div class="media-list media-list-<?php echo $id; ?>">

                <?php
                if(!empty($values) && is_array($values)):
                foreach ($values as $value ):
                    $media_url	= wp_get_attachment_url( $value );
                    $media_type	= get_post_mime_type( $value );
                    $media_title= get_the_title( $value );
                    ?>
                    <div class="item">
                        <span class="remove" onclick="jQuery(this).parent().remove()">X</span>
                        <img id='media_preview_<?php echo $id; ?>' src='<?php echo $media_url; ?>' style='width:100%'/>
                        <div class="item-title"><?php echo $media_title; ?></div>
                        <input type='hidden' name='<?php echo $id; ?>[]' value='<?php echo $value; ?>' />
                    </div>
                    <?php
                endforeach;
                endif;
                ?>

            </div>


        </div>

        <script>jQuery(document).ready(function($){
                $('#media_upload_<?php echo $id; ?>').click(function() {
                    var send_attachment_bkp = wp.media.editor.send.attachment;
                    wp.media.editor.send.attachment = function(props, attachment) {

                        attachment_id = attachment.id;
                        attachment_url = attachment.url;

                        html = '<div class="item">';
                        html += '<span class="remove" onclick="jQuery(this).parent().remove()">X</span>';
                        html += '<img src="'+attachment_url+'" style="width:100%"/>';
                        html += '<input type="hidden" name="<?php echo $id; ?>[]" value="'+attachment_id+'" />';
                        html += '</div>';

                        $('.media-list-<?php echo $id; ?>').append(html);

                        wp.media.editor.send.attachment = send_attachment_bkp;
                    }
                    wp.media.editor.open($(this));
                    return false;
                });
            });	</script>

        <?php



        echo "";
    }







    public function generate_field_time_format( $option ){

        $id 			= isset( $option['id'] ) ? $option['id'] : "";
        $default 	= isset( $option['default'] ) ? $option['default'] : "";
        $args 	= isset( $option['args'] ) ? $option['args'] : "";


        $value 	 		= get_option( $id );

        $value 	 		= !empty($value) ? $value : $default;

        //var_dump($value);

        ?>
        <div class="field-time-format-wrapper field-time-format-wrapper-<?php echo $id; ?>">
            <ul class="format-list">
                <?php
                if(!empty($args)):
                    foreach ($args as $item):

                        $checked = ($item == $value) ? 'checked':false;

                        //var_dump($checked);

                        ?>
                        <li datavalue="<?php echo $item; ?>">
                            <label><input type="radio" <?php echo $checked; ?> name="preset_<?php echo $id; ?>"
                                          value="<?php echo $item; ?>">
                                <span
                                        class="name"><?php echo date($item); ?></span></label>
                            <span class="format"><code><?php echo $item; ?></code></span>
                        </li>
                    <?php

                    endforeach;

                    ?>
                    <li class="format-value">

                        <span class="format"><input value="<?php echo $value; ?>" name="<?php echo $id; ?>"></span>
                        <div class="">Preview: <?php echo date($value); ?></div>
                    </li>
                <?php
                endif;
                ?>
            </ul>



        </div>

        <script>jQuery(document).ready(function($) {

                jQuery(document).on('click', '.field-time-format-wrapper-<?php echo $id; ?> .format-list li', function () {

                    value = $(this).attr('datavalue');
                    $('.field-time-format-wrapper-<?php echo $id; ?> .format-value input').val(value);

                })

            });</script>


        <?php

    }





    public function generate_field_date_format( $option ){

        $id 			= isset( $option['id'] ) ? $option['id'] : "";
        $default 	= isset( $option['default'] ) ? $option['default'] : "";
        $args 	= isset( $option['args'] ) ? $option['args'] : "";


        $value 	 		= get_option( $id );

        $value 	 		= !empty($value) ? $value : $default;

        //var_dump($value);

        ?>
        <div class="field-date-format-wrapper field-date-format-wrapper-<?php echo $id; ?>">
            <ul class="format-list">
                <?php
                if(!empty($args)):
                    foreach ($args as $item):

                        $checked = ($item == $value) ? 'checked':false;

                    //var_dump($checked);

                        ?>
                        <li datavalue="<?php echo $item; ?>">
                            <label><input type="radio" <?php echo $checked; ?> name="preset_<?php echo $id; ?>"
                                          value="<?php echo $item; ?>">
                                <span
                                        class="name"><?php echo date($item); ?></span></label>
                            <span class="format"><code><?php echo $item; ?></code></span>
                        </li>
                        <?php

                    endforeach;

                    ?>
                    <li class="format-value">

                        <span class="format"><input value="<?php echo $value; ?>" name="<?php echo $id; ?>"></span>
                        <div class="">Preview: <?php echo date($value); ?></div>
                    </li>
                <?php
                endif;
                ?>
            </ul>



        </div>

        <script>jQuery(document).ready(function($) {

                jQuery(document).on('click', '.field-date-format-wrapper-<?php echo $id; ?> .format-list li', function () {

                    value = $(this).attr('datavalue');
                    $('.field-date-format-wrapper-<?php echo $id; ?> .format-value input').val(value);

                })

            });</script>


        <?php

    }


	public function generate_field_datepicker( $option ){
		
		$id 			= isset( $option['id'] ) ? $option['id'] : "";
		$placeholder 	= isset( $option['placeholder'] ) ? $option['placeholder'] : "";
        $default 	    = isset( $option['default'] ) ? $option['default'] : "";
        $date_format	= isset( $option['date_format'] ) ? $option['date_format'] : "dd-mm-yy";
		$value 	 		= get_option( $id );

        $value          = !empty($value) ?$value : $default;


		echo "<input type='text' class='regular-text' name='$id' id='$id' placeholder='$placeholder' value='$value' />";
		
	
		echo "<script>jQuery(document).ready(function($) { $('#$id').datepicker({dateFormat : '$date_format'});});</script>";
	}


    public function generate_linear_gradient( $option ){

        $id 			= isset( $option['id'] ) ? $option['id'] : "";
        $placeholder 	= isset( $option['placeholder'] ) ? $option['placeholder'] : "";
        $direction 	= isset( $option['direction'] ) ? $option['direction'] : "";
        $args 	= isset( $option['args'] ) ? $option['args'] : "";
        $value 	 		= get_option( $id );


        ?>
        <div class="field-linear-gradient-wrapper field-linear-gradient-wrapper-<?php echo $id; ?>">

            <select name="<?php echo $id; ?>[direction]">
                <option value="to bottom">to bottom</option>
                <option value="to top">to top</option>
                <option value="to right">to right</option>




            </select>

            <div class="gr-preview">
                Preview
            </div>
        </div>


        <style type="text/css">
            .field-linear-gradient-wrapper-<?php echo $id; ?> .gr-preview{
                height: 20px;
                width: 200px;
                text-align: center;
            }
        </style>

        <?php

        //var_dump(plugins_url('/', __FILE__));

        //echo "<input type='text' class='regular-text' name='$id' id='$id' placeholder='$placeholder' value='$value'
        // />";


        //echo "<script>jQuery(document).ready(function($) { $('#$id').datepicker({dateFormat : 'dd-mm-yy'});});
        //</script>";
    }





	
	public function generate_field_colorpicker( $option ){
		
		$id 			= isset( $option['id'] ) ? $option['id'] : "";
		$placeholder 	= isset( $option['placeholder'] ) ? $option['placeholder'] : "";
		$value 	 		= get_option( $id );
        $default 	= isset( $option['default'] ) ? $option['default'] : "";

        $value = !empty($value) ? $value : $default;

		
		echo "<input type='text' class='regular-text' name='$id' id='$id' placeholder='$placeholder' value='$value' />";
		
		echo "<script>jQuery(document).ready(function($) { $('#$id').wpColorPicker();});</script>";
	}


    public function generate_field_colorpicker_multi( $option ){

        $id 			= isset( $option['id'] ) ? $option['id'] : "";
        $placeholder 	= isset( $option['placeholder'] ) ? $option['placeholder'] : "";
        $value 	 		= get_option( $id );
        $default 	= isset( $option['default'] ) ? $option['default'] : array();

        $values = !empty($value) ? $value : $default;

        if(!empty($values)):
            ?>
            <div class="field-colorpicker-multi field-colorpicker-multi-<?php echo $id; ?>">

                <div class="button add">Add</div>
                <div class="item-list">
                    <?php
                    foreach ($values as $value):
                        ?>
                        <div class="item">
                            <input type='text' class='regular-text' name='<?php echo $id; ?>[]' value='<?php echo $value; ?>' />
                        </div>

                    <?php
                    endforeach;
                    ?>
                </div>

            </div>
            <?php

        endif;


        ?>
        <script>jQuery(document).ready(function($) {

                jQuery(document).on('click', '.field-colorpicker-multi-<?php echo $id; ?> .add', function() {

                    html='<div class="item">';
                    html+='<input type="text"  name="<?php echo $id; ?>[]" value="" />';
                    html+='</div>';

                    $('.field-colorpicker-multi-<?php echo $id; ?> .item-list').append(html);
                    $('.field-colorpicker-multi-<?php echo $id; ?> input').wpColorPicker();

                })


            $('.field-colorpicker-multi-<?php echo $id; ?> input').wpColorPicker();

        });</script>
        <?php

        echo "";
    }









    public function generate_field_link_color( $option ){

        $id 			= isset( $option['id'] ) ? $option['id'] : "";
        $placeholder 	= isset( $option['placeholder'] ) ? $option['placeholder'] : "";
        $values 	 		= get_option( $id );
        $args 	= isset( $option['args'] ) ? $option['args'] : array('link'	=> '#1B2A41','hover' => '#3F3244','active' => '#60495A','visited' => '#7D8CA3' );

        //var_dump($values);
        ?>
        <ul class="link-color">
        <?php
        if(!empty($values) && is_array($values)):

            foreach ($args as $argindex=>$value):

                ?>
                <li>
                    <div class="item"><span class="title">a:<?php echo $argindex; ?> Color</span><div class="colorpicker"><input type='text' class='<?php echo $id; ?>' name='<?php echo $id; ?>[<?php echo $argindex; ?>]'   value='<?php echo $values[$argindex]; ?>' /></div></div>
                </li>
                <?php
            endforeach;

        else:
            foreach ($args as $argindex=>$value):
                ?>
                <li>
                    <div class="item"><span class="title">a:<?php echo $argindex; ?> Color</span><div class="colorpicker"><input type='text' class='<?php echo $id; ?>' name='<?php echo $id; ?>[<?php echo $argindex; ?>]'   value='<?php echo $value; ?>' /></div></div>
                </li>
            <?php
            endforeach;

        endif;
        ?>
        </ul>
        <?php
        //echo "<input type='text' class='regular-text' name='$id' id='$id' placeholder='$placeholder' value='$value' />";

        echo "<script>jQuery(document).ready(function($) { $('.$id').wpColorPicker();});</script>";
    }




    public function generate_field_range_input( $option ){

        $id 			= isset( $option['id'] ) ? $option['id'] : "";
        $value 	 		= get_option( $id );
        $default 	= isset( $option['default'] ) ? $option['default'] : "";
        $args 	= isset( $option['args'] ) ? $option['args'] : "";

        $value = !empty($value) ? $value : $default;

        ?>
        <div class="range-input range-input-<?php echo $id; ?>">
            <input type="number" class="range-val" name='<?php echo $id; ?>' value="<?php echo $value; ?>">
            <input type='range' min='<?php echo $args['min']; ?>' max='<?php echo $args['max']; ?>' step='<?php echo $args['step']; ?>'  class='range-hndle' value='<?php echo $value; ?>' />
        </div>




    <script>jQuery(document).ready(function($) {


            jQuery(document).on('change', '.range-input-<?php echo $id; ?> .range-hndle', function() {

                val = $(this).val();
                $('.range-input-<?php echo $id; ?> .range-val').val(val);
            })

            jQuery(document).on('keyup', '.range-input-<?php echo $id; ?> .range-val', function() {

                val = $(this).val();
                console.log(val);
                $('.range-input-<?php echo $id; ?> .range-hndle').val(val);
            })


        })

    </script>



        <?php
    }


    public function generate_field_range( $option ){

        $id 			= isset( $option['id'] ) ? $option['id'] : "";
        $value 	 		= get_option( $id );
        $default 	= isset( $option['default'] ) ? $option['default'] : "";
        $args 	= isset( $option['args'] ) ? $option['args'] : "";

        $value = !empty($value) ? $value : $default;

        ?>
        <input type='range' min='<?php echo $args['min']; ?>' max='<?php echo $args['max']; ?>' step='<?php echo $args['step']; ?>' name='<?php echo $id; ?>' id='<?php echo $id; ?>' value='<?php echo $value; ?>' />

        <?php
    }



	public function generate_field_text( $option ){
		
		$id 			= isset( $option['id'] ) ? $option['id'] : "";
		$placeholder 	= isset( $option['placeholder'] ) ? $option['placeholder'] : "";
		$value 	 		= get_option( $id );
        $default 	= isset( $option['default'] ) ? $option['default'] : "";

        $value = !empty($value) ? $value : $default;

		echo "<input type='text' class='regular-text' name='$id' id='$id' placeholder='$placeholder' value='$value' />";
	}


    public function generate_field_icon( $option ){

        $id 			= isset( $option['id'] ) ? $option['id'] : "";
        $value 	 		= get_option( $id );
        $args 			= isset( $option['args'] ) ? $option['args'] : array();
        $default 	    = isset( $option['default'] ) ? $option['default'] : "";
        $icons		    = is_array( $args ) ? $args : $this->generate_args_from_string( $args, $option );

        $value = !empty($value) ? $value : $default;






        ?>
        <div class="field-icon-wrapper field-icon-wrapper-<?php echo $id; ?>">

            <div class="icon-wrapper" >
                <span><i class="<?php echo $value; ?>"></i></span>
                <input type="hidden" name="<?php echo $id; ?>" value="<?php echo $value; ?>">
            </div>
            <div class="icon-list">
                <div class="button select-icon" >Choose Icon</div>
                <div class="search-icon" ><input class="" type="text" placeholder="start typing..."></div>
                <ul>
                    <?php
                    if(!empty($icons)):

                        foreach ($icons as $iconindex=>$iconTitle):

                            ?>
                            <li title="<?php echo $iconTitle; ?>" iconData="<?php echo $iconindex; ?>"><i class="<?php echo $iconindex; ?>"></i></li>
                            <?php

                        endforeach;

                    endif;
                    ?>
                </ul>
            </div>

        </div>


        <script>jQuery(document).ready(function($){
            jQuery(document).on('click', '.field-icon-wrapper-<?php echo $id; ?> .select-icon', function(){


                if(jQuery(this).parent().hasClass('active')){
                    jQuery(this).parent().removeClass('active');
                }else{
                    jQuery(this).parent().addClass('active');
                }


            })


            jQuery(document).on('keyup', '.field-icon-wrapper-<?php echo $id; ?> .search-icon input', function(){

                text = jQuery(this).val();



                $('.field-icon-wrapper-<?php echo $id; ?> .icon-list li').each(function( index ) {
                    console.log( index + ": " + $( this ).attr('title') );

                    title = $( this ).attr('title');

                    n = title.indexOf(text);

                    if(n<0){
                        $( this ).hide();
                    }else{
                        $( this ).show();
                    }



                });



            })


            jQuery(document).on('click', '.field-icon-wrapper-<?php echo $id; ?> .icon-list li', function(){

                iconData = jQuery(this).attr('iconData');

                html = '<i class="'+iconData+'"></i>';

                jQuery('.field-icon-wrapper-<?php echo $id; ?> .icon-wrapper span').html(html);
                jQuery('.field-icon-wrapper-<?php echo $id; ?> .icon-wrapper input').val(iconData);


            })

        })
        </script>

        <?php
    }



    public function generate_field_icon_multi( $option ){

        $id 			= isset( $option['id'] ) ? $option['id'] : "";
        $value 	 		= get_option( $id );
        $args 			= isset( $option['args'] ) ? $option['args'] : array();
        $default 	    = isset( $option['default'] ) ? $option['default'] : array();
        $icons		    = is_array( $args ) ? $args : $this->generate_args_from_string( $args, $option );

        $values = !empty($value) ? $value : $default;


        //var_dump($values);
        ?>
        <div class="field-icon-multi-wrapper field-icon-multi-wrapper-<?php echo $id; ?>">

            <div class="icons-wrapper" >
                <?php if(!empty($values)):
                    foreach ($values as $value):
                        ?><div class="item" title="click to remove"><span><i class="<?php echo $value; ?>"></i></span><input type="hidden" name="<?php echo $id; ?>[]" value="<?php echo $value; ?>"></div><?php
                    endforeach;
                endif; ?>

            </div>
            <div class="icon-list">
                <div class="button select-icon" >Choose Icon</div>
                <div class="search-icon" ><input class="" type="text" placeholder="start typing..."></div>
                <ul>
                    <?php
                    if(!empty($icons)):

                        foreach ($icons as $iconindex=>$iconTitle):

                            ?>
                            <li title="<?php echo $iconTitle; ?>" iconData="<?php echo $iconindex; ?>"><i class="<?php echo $iconindex; ?>"></i></li>
                        <?php

                        endforeach;

                    endif;
                    ?>
                </ul>
            </div>

        </div>


        <script>jQuery(document).ready(function($){


                jQuery(document).on('click', '.field-icon-multi-wrapper-<?php echo $id; ?> .icons-wrapper .item', function(){

                    jQuery(this).remove();

                })

                    jQuery(document).on('click', '.field-icon-multi-wrapper-<?php echo $id; ?> .select-icon', function(){


                    if(jQuery(this).parent().hasClass('active')){
                        jQuery(this).parent().removeClass('active');
                    }else{
                        jQuery(this).parent().addClass('active');
                    }


                })


                jQuery(document).on('keyup', '.field-icon-multi-wrapper-<?php echo $id; ?> .search-icon input', function(){

                    text = jQuery(this).val();



                    $('.field-icon-multi-wrapper-<?php echo $id; ?> .icon-list li').each(function( index ) {
                        console.log( index + ": " + $( this ).attr('title') );

                        title = $( this ).attr('title');

                        n = title.indexOf(text);

                        if(n<0){
                            $( this ).hide();
                        }else{
                            $( this ).show();
                        }



                    });



                })


                jQuery(document).on('click', '.field-icon-multi-wrapper-<?php echo $id; ?> .icon-list li', function(){

                    iconData = jQuery(this).attr('iconData');

                    html = '';

                    html = '<div class="item" title="click to remove"><span><i class="'+iconData+'"></i></span><input type="hidden" name="<?php echo $id; ?>[]" value="'+iconData+'"></div>';



                    jQuery('.field-icon-multi-wrapper-<?php echo $id; ?> .icons-wrapper').append(html);



                })

            })
        </script>

        <?php
    }




    public function generate_field_dimensions( $option ){

        $id 			= isset( $option['id'] ) ? $option['id'] : "";
        $placeholder 	= isset( $option['placeholder'] ) ? $option['placeholder'] : "";
        $value 	 		= get_option( $id );
        $default 	= isset( $option['default'] ) ? $option['default'] : array();
        $args 	= isset( $option['args'] ) ? $option['args'] : "";

        $values = !empty($value) ? $value : $default;


        if(!empty($args)):
            ?>
            <div class="field-dimensions field-dimensions-<?php echo $id; ?>">

                <div class="item-list">
                    <?php
                    foreach ($args as $index=>$name):

                        ?>
                        <div class="item">
                            <span class="field-title"><?php echo $name; ?></span>
                            <span class="input-wrapper"><input type='number' name='<?php echo $id;?>[<?php
                                echo $index; ?>]' value='<?php
                                echo $values[$index]; ?>' /></span>

                        </div>
                        <?php

                    endforeach;
                    ?>
                </div>
            </div>
            <?php
        endif;

    }





    public function generate_field_text_multi( $option ){

        $id 			= isset( $option['id'] ) ? $option['id'] : "";
        $placeholder 	= isset( $option['placeholder'] ) ? $option['placeholder'] : "";
        $values 	 		= get_option( $id );


        ?>

        <script>jQuery(document).ready(function($) {
                html_<?php echo $id; ?> = '<div class=""><input type="text" class="regular-text" name="<?php echo $id?>[]"  placeholder="<?php echo $placeholder; ?>" value="" /><span class="button" onclick="$(this).parent().remove()">X</span></div>';
            });</script>

        <div class="field-text-multi-wrapper field-text-multi-wrapper-<?php echo $id; ?>">
            <span class="button" onclick="$('#<?php echo $id; ?>').append(html_<?php echo $id; ?>)">Add</span>
            <div class="field-list" id="<?php echo $id; ?>">

                <?php
                if(!empty($values)):
                    foreach ($values as $value):
                        ?>
                        <div class="item">
                            <input type='text' class='regular-text' name='<?php echo $id?>[]'  placeholder='<?php echo $placeholder; ?>' value='<?php echo $value; ?>' /><span class="button" onclick="$(this).parent().remove()">X</span>
                        </div>
                    <?php
                    endforeach;
                else:
                    ?>
                    <div class="item">
                        <input type='text' class='regular-text' name='<?php echo $id?>[]'  placeholder='<?php echo $placeholder; ?>' value='' /><span class="button" onclick="$(this).parent().remove()">X</span>
                    </div>
                <?php
                endif;
                ?>
            </div>
        </div>


        <?php

    }



    public function generate_repeatable( $option ){

        $id 			= isset( $option['id'] ) ? $option['id'] : "";
        $collapsible 	= isset( $option['collapsible'] ) ? $option['collapsible'] : "";
        $placeholder 	= isset( $option['placeholder'] ) ? $option['placeholder'] : "";
        $values 	 		= get_option( $id );
        $fields 			= isset( $option['fields'] ) ? $option['fields'] : array();

        //var_dump($collapsible);
        ?>


        <script>jQuery(document).ready(function($) {


                jQuery(document).on('click', '.repeatable-<?php echo $id; ?> .collapsible .header', function() {

                    if(jQuery(this).parent().hasClass('active')){
                        jQuery(this).parent().removeClass('active');
                    }else{
                        jQuery(this).parent().addClass('active');
                    }
                })





                jQuery(document).on('click', '.repeatable-<?php echo $id; ?> .add-item', function() {
                    now = jQuery.now();

                    fields_arr = <?php echo json_encode($fields); ?>;

                    html = '<div class="item-wrap"><span class="button" onclick="jQuery(this).parent().remove()">X</span>';

                    fields_arr.forEach(function(element) {

                        html+='<div class="item">';
                        html+='<div>'+element.name+'</div>';
                        html+='<input type="text" class="regular-text" name="<?php echo $id; ?>['+now+']['+element.item_id+']" placeholder="" value="">';

                        html+='</div>';

                    });
                    html+='</div>';


                    //console.log(html);

                    jQuery('.<?php echo 'repeatable-'.$id; ?> .field-list').append(html);

                })


            });</script>

        <div class="repeatable <?php echo 'repeatable-'.$id; ?>">
            <div class="button add-item">Add</div>
            <div class="field-list" id="<?php echo $id; ?>">

                <?php
                if(!empty($values)):
                    //var_dump($fields);

                    $count = 1;
                    foreach ($values as $index=>$val):
                        //foreach ($fields as $field):
                        //var_dump($val);


                        ?>
                        <div class="item-wrap <?php if($collapsible) echo 'collapsible'; ?>">

                            <?php if($collapsible):?>
                            <div class="header">
                                <?php endif; ?>
                                <span class="button remove" onclick="jQuery(this).parent().parent().remove()">X</span>

                                <span>#<?php echo $count; ?></span>

                                <?php if($collapsible):?>
                            </div>

                            <?php endif; ?>


                            <?php foreach ($fields as $field_index => $field):
                                $type = $field['type'];
                                $item_id = $field['item_id'];
                                $name = $field['name'];

                                ?>




                            <div class="item">

                                <?php if($collapsible):?>
                                <div class="content">
                                <?php endif; ?>

                                    <div><?php echo $name; ?></div>

                                    <?php if($type == 'text'):
                                        $default = isset($field['default']) ? $field['default'] : '';

                                        $value = !empty($val[$item_id]) ? $val[$item_id] : $default;

                                        ?>
                                    <input type="text" class="regular-text" name="<?php echo $id; ?>[<?php echo $index; ?>][<?php echo $item_id; ?>]" placeholder="" value="<?php echo esc_html($value); ?>">


                                    <?php elseif($type == 'number'):
                                        $default = isset($field['default']) ? $field['default'] : '';

                                        $value = !empty($val[$item_id]) ? $val[$item_id] : $default;

                                        ?>
                                        <input type="number" class="regular-text" name="<?php echo $id; ?>[<?php echo $index; ?>][<?php echo $item_id; ?>]" placeholder="" value="<?php echo esc_html($value); ?>">


                                    <?php elseif($type == 'email'):
                                        $default = isset($field['default']) ? $field['default'] : '';

                                        $value = !empty($val[$item_id]) ? $val[$item_id] : $default;

                                        ?>
                                        <input type="email" class="regular-text" name="<?php echo $id; ?>[<?php echo $index; ?>][<?php echo $item_id; ?>]" placeholder="" value="<?php echo esc_html($value); ?>">









                                    <?php elseif($type == 'textarea'):
                                        $default = isset($field['default']) ? $field['default'] : '';

                                        $value = !empty($val[$item_id]) ? $val[$item_id] : $default;

                                        ?>
                                    <textarea name="<?php echo $id; ?>[<?php echo $index; ?>][<?php echo $item_id; ?>]"><?php echo esc_html($value); ?></textarea>

















                                    <?php elseif($type == 'select'):
                                        $args = isset($field['args']) ? $field['args'] : array();
                                        $default = isset($field['default']) ? $field['default'] : '';
                                        $value = !empty($val[$item_id]) ? $val[$item_id] : $default;

                                        ?>
                                    <select class="" name="<?php echo $id; ?>[<?php echo $index; ?>][<?php echo $item_id; ?>]">
                                        <?php foreach ($args as $argIndex => $argName):
                                            $selected = ($argIndex == $value) ? 'selected' : '';
                                            ?>
                                        <option <?php echo $selected; ?>  value="<?php echo $argIndex; ?>"><?php echo $argName; ?></option>

                                        <?php endforeach; ?>

                                    </select>


                                    <?php elseif($type == 'radio'):
                                        $args = isset($field['args']) ? $field['args'] : array();
                                        $default = isset($field['default']) ? $field['default'] : '';
                                        $value = !empty($val[$item_id]) ? $val[$item_id] : $default;

                                        ?>

                                            <?php foreach ($args as $argIndex => $argName):
                                                $checked = ($argIndex == $value) ? 'checked' : '';
                                                ?>
                                        <label class="" >
                                                <input  type="radio" name="<?php echo $id; ?>[<?php echo $index; ?>][<?php echo $item_id; ?>]" <?php echo $checked; ?>  value="<?php echo $argIndex; ?>"><?php echo $argName; ?></input>
                                        </label>

                                            <?php endforeach; ?>

                                    <?php elseif($type == 'checkbox'):
                                        $args = isset($field['args']) ? $field['args'] : array();
                                        $default = isset($field['default']) ? $field['default'] : '';
                                        $value = !empty($val[$item_id]) ? $val[$item_id] : $default;

                                        ?>

                                        <?php foreach ($args as $argIndex => $argName):
                                        $checked = in_array($argIndex, $value ) ? 'checked' : '';
                                        ?>
                                        <label class="" >
                                            <input  type="checkbox" name="<?php echo $id; ?>[<?php echo $index; ?>][<?php echo $item_id; ?>][]" <?php echo $checked; ?>  value="<?php echo $argIndex; ?>"><?php echo $argName; ?></input>
                                        </label>

                                    <?php endforeach; ?>





                                    <?php endif;?>

                                <?php if($collapsible):?>

                                </div>
                                <?php endif; ?>



                            </div>
                            <?php endforeach; ?>

                        </div>


                        <?php
                        //endforeach;

                        $count++;
                    endforeach;

                else:

                    ?>

                <?php

                endif;

                ?>



            </div>
        </div>



        <?php

    }






    public function generate_field_number( $option ){
		
		$id 			= isset( $option['id'] ) ? $option['id'] : "";
        $default 			= isset( $option['default'] ) ? $option['default'] : "";
		$placeholder 	= isset( $option['placeholder'] ) ? $option['placeholder'] : "";
		$value 	 		= get_option( $id );

        $value = !empty($value) ? $value : $default;


		echo "<input type='number' class='regular-text' name='$id' id='$id' placeholder='$placeholder' value='$value' />";
	}
	
	public function generate_field_textarea( $option ){
		
		$id = isset( $option['id'] ) ? $option['id'] : "";
		$placeholder = isset( $option['placeholder'] ) ? $option['placeholder'] : "";
		
		$value 	 = get_option( $id );
		
		echo "<textarea name='$id' id='$id' cols='40' rows='5' placeholder='$placeholder'>$value</textarea>";
	}


    public function generate_wp_editor( $option ){

        $id = isset( $option['id'] ) ? $option['id'] : "";
        $placeholder = isset( $option['placeholder'] ) ? $option['placeholder'] : "";
        $default = isset( $option['default'] ) ? $option['default'] : "";
        $editor_settings= isset( $option['editor_settings'] ) ? $option['editor_settings'] : array('textarea_name'=>$id);

        $value 	 = get_option( $id );
        $value = !empty($value) ? $value : $default;

        wp_editor( $value, $id, $settings = $editor_settings);

        //echo "<textarea name='$id' id='$id' cols='40' rows='5' placeholder='$placeholder'>$value</textarea>";
    }



	public function generate_field_select( $option ){
		
		$id 	    = isset( $option['id'] ) ? $option['id'] : "";
		$args 	    = isset( $option['args'] ) ? $option['args'] : array();
        $multiple 	= isset( $option['multiple'] ) ? $option['multiple'] : false;
        $args	    = is_array( $args ) ? $args : $this->generate_args_from_string( $args );
        $option_value	= get_option( $id );


        echo $multiple ? "<select name='{$id}[]' id='$id' multiple>" : "<select name='{$id}' id='$id'>";
		foreach( $args as $key => $value ):
            if( $multiple ) $selected = is_array( $option_value ) && in_array( $key, $option_value ) ? "selected" : "";
            else $selected = ($option_value == $key) ? "selected" : "";

			echo "<option $selected value='$key'>$value</option>";
		endforeach;
		echo "</select>";
	}











    public function generate_field_select_multi( $option ){

        $id				= isset( $option['id'] ) ? $option['id'] : "";
        $args			= isset( $option['args'] ) ? $option['args'] : array();
        $args			= is_array( $args ) ? $args : $this->generate_args_from_string( $args );
        $option_value	= get_option( $id );

        echo "<select multiple name='{$id}[]'>";
        foreach( $args as $key => $value ):
            $selected = is_array( $option_value ) && in_array( $key, $option_value ) ? "selected" : "";
            echo "<option value='$key' $selected>$value</option>";
        endforeach;
        echo "</select>";
    }

    public function generate_field_select2( $option ){
        $id 		= isset( $option['id'] ) ? $option['id'] : "";
        $default 		= isset( $option['default'] ) ? $option['default'] : array();
        $args 		= isset( $option['args'] ) ? $option['args'] : array();
        $args		= is_array( $args ) ? $args : $this->generate_args_from_string( $args, $option );
        $value		= get_option( $id );
        $value      = !empty($value) ?  $value : $default;

        $multiple 	= isset( $option['multiple'] ) ? $option['multiple'] : '';


        if($multiple):
            $value = !empty($value) ? $value : array();
        endif;

        //var_dump($value);

        wp_enqueue_style('select2', 'https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.5/css/select2.min.css' );
        wp_enqueue_script('select2', 'https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.5/js/select2.min.js', array('jquery') );


        echo $multiple ? "<select name='{$id}[]' id='$id' multiple>" : "<select name='{$id}' id='$id'>";
        foreach( $args as $key => $name ):

            if( $multiple ) $selected = in_array( $key, $value ) ? "selected" : "";
            else $selected = $value == $key ? "selected" : "";
            echo "<option $selected value='$key'>$name</option>";

        endforeach;
        echo "</select>";

        echo "<script>jQuery(document).ready(function($) { $('#$id').select2({
			width: '320px',
			allowClear: true
		});});</script>";
    }

    public function generate_field_checkbox( $option ){
		
		$id				= isset( $option['id'] ) ? $option['id'] : "";
        $default 		= isset( $option['default'] ) ? $option['default'] : array();
		$args			= isset( $option['args'] ) ? $option['args'] : array();
		$args			= is_array( $args ) ? $args : $this->generate_args_from_string( $args );
		$option_value	= get_option( $id );

        $option_value      = !empty($option_value) ?  $option_value : $default;
		//var_dump($option_value);

		echo "<fieldset>";
		foreach( $args as $key => $value ):

			$checked = is_array( $option_value ) && in_array( $key, $option_value ) ? "checked" : "";
			echo "<label for='$id-$key'><input name='{$id}[]' type='checkbox' id='$id-$key' value='$key' $checked>$value</label><br>";
			
		endforeach;
		echo "</fieldset>";
	}



    public function generate_field_faq( $option ){

        $id				= isset( $option['id'] ) ? $option['id'] : "";
        $args			= isset( $option['args'] ) ? $option['args'] : array();
        $args			= is_array( $args ) ? $args : $this->generate_args_from_string( $args );
        $option_value	= get_option( $id );


        //var_dump($option_value);

        ?>
        <script>jQuery(document).ready(function($) {


                jQuery(document).on('click', '.faq-list-<?php echo $id; ?> .faq-header', function() {

                    if(jQuery(this).parent().hasClass('active')){
                        jQuery(this).parent().removeClass('active');
                    }else{
                        jQuery(this).parent().addClass('active');
                    }
                })
            })

        </script>



        <div class='faq-list faq-list-<?php echo $id; ?>'>
            <?php
            foreach( $args as $key => $value ):

                $title = $value['title'];
                $link = $value['link'];
                $content = $value['content'];

                ?>
                <div class="faq-item">
                    <div class="faq-header"><?php echo $title; ?></div>
                    <div class="faq-content"><?php echo $content; ?></div>

                </div>
                <?php

            endforeach;
            ?>

        </div>

        <?php


    }




    public function generate_field_grid( $option ){

        $id 			= isset( $option['id'] ) ? $option['id'] : "";
        $placeholder 	= isset( $option['placeholder'] ) ? $option['placeholder'] : "";
        $args 			= isset( $option['args'] ) ? $option['args'] : "";
        $widths 			= isset( $option['width'] ) ? $option['width'] : array('768px'=>'100%','992px'=>'50%', '1200px'=>'30%', );
        $heights 			= isset( $option['height'] ) ? $option['height'] : array('768px'=>'auto','992px'=>'250px', '1200px'=>'250px', );

        $values 	 		= get_option( $id );

        ?>
        <div class="field-grid-wrapper field-grid-wrapper-<?php echo $id; ?>">
            <?php

            foreach($args as $key=>$grid_item){

                $title = isset($grid_item['title']) ? $grid_item['title'] : '';
                $link = isset($grid_item['link']) ? $grid_item['link'] : '';
                $thumb = isset($grid_item['thumb']) ? $grid_item['thumb'] : '';

                ?>

                <div class="item">
                    <div class="thumb"><a href="<?php echo $link; ?>"><img src="<?php echo $thumb; ?>"></img></a></div>
                    <div class="name"><a href="<?php echo $link; ?>"><?php echo $title; ?></a></div>
                </div>
                <?php

            }
            ?>
        </div>

        <style type="text/css">

            <?php
            if(!empty($widths)):
                foreach ($widths as $screen_size=>$width):

                $height = !empty($heights[$screen_size]) ? $heights[$screen_size] : 'auto';


                ?>
                @media screen and (min-width: <?php echo $screen_size; ?>) {
                    .field-grid-wrapper-<?php echo $id; ?> .item{
                        width: <?php echo $width; ?>;
                    }

                    .field-grid-wrapper-<?php echo $id; ?> .item .thumb{

                        height: <?php echo $height; ?>;
                    }


                }
                <?php

                endforeach;
            endif;

            ?>

        </style>

        <?php



    }







    public function generate_field_custom_html( $option ){

        $id 			= isset( $option['id'] ) ? $option['id'] : "";
        $placeholder 	= isset( $option['placeholder'] ) ? $option['placeholder'] : "";
        $args 			= isset( $option['args'] ) ? $option['args'] : "";

        $values 	 		= get_option( $id );
        $html 			= isset( $option['html'] ) ? $option['html'] : "";

        echo $html;



    }





	public function generate_field_radio( $option ){

		$id				= isset( $option['id'] ) ? $option['id'] : "";
        $default 		= isset( $option['default'] ) ? $option['default'] : array();
        $args			= isset( $option['args'] ) ? $option['args'] : array();
		$args			= is_array( $args ) ? $args : $this->generate_args_from_string( $args );
		$option_value	= get_option( $id );

        $option_value      = !empty($option_value) ?  $option_value : $default;

		echo "<fieldset>";
		foreach( $args as $key => $value ):

			$checked = ( $key == $option_value ) ? "checked" : "";
			echo "<label for='$id-$key'><input name='{$id}' type='radio' id='$id-$key' value='$key' $checked>$value</label><br>";
				
		endforeach;
		echo "</fieldset>";
	}



    public function generate_field_switch( $option ){

        $id				= isset( $option['id'] ) ? $option['id'] : "";
        $default 		= isset( $option['default'] ) ? $option['default'] : '';
        $args			= isset( $option['args'] ) ? $option['args'] : array();
        $args			= is_array( $args ) ? $args : $this->generate_args_from_string( $args );
        $option_value	= get_option( $id );

        $option_value      = !empty($option_value) ?  $option_value : $default;

        ?>
        <div class="field-switch-wrapper field-switch-wrapper-<?php echo $id; ?>">
            <?php
            foreach( $args as $key => $value ):

                $checked = ( $key == $option_value ) ? "checked" : "";
                ?><label class="<?php echo $checked; ?>" for='<?php echo $id; ?>-<?php echo $key; ?>'><input name='<?php echo $id; ?>' type='radio' id='<?php echo $id; ?>-<?php echo $key; ?>' value='<?php echo $key; ?>' <?php echo $checked; ?>><span class="sw-button"><?php echo $value; ?></span></label><?php

            endforeach;
            ?>
        </div>
        <script>jQuery(document).ready(function($) {
                jQuery(document).on('click', '.field-switch-wrapper-<?php echo $id; ?> .sw-button', function() {

                    jQuery('.field-switch-wrapper-<?php echo $id; ?> label').removeClass('checked');

                    if(jQuery(this).parent().hasClass('checked')){
                        jQuery(this).parent().removeClass('checked');
                    }else{
                        jQuery(this).parent().addClass('checked');
                    }
                })
            })

        </script>

        <?php

    }


    public function generate_field_color_palette( $option ){

        $id				= isset( $option['id'] ) ? $option['id'] : "";
        $args			= isset( $option['args'] ) ? $option['args'] : array();
        $colors			= isset( $option['colors'] ) ? $option['colors'] : array();
        $option_value	= get_option( $id );

        ?>
        <div class="field-color-palette-wrapper field-color-palette-wrapper-<?php echo $id; ?>">
            <?php
            foreach( $colors as $key => $color ):

                $checked = is_array( $option_value ) && in_array( $key, $option_value ) ? "checked" : "";
                ?><label  class="<?php echo $checked; ?>" for='<?php echo $id; ?>-<?php echo $key; ?>'><input
                        name='<?php echo $id; ?>[]' type='radio' id='<?php echo $id; ?>-<?php echo $key; ?>'
                        value='<?php echo $key; ?>' <?php echo $checked; ?>><span title="<?php echo $color; ?>" style="background-color: <?php
                echo $color; ?>" class="sw-button"></span></label><?php

            endforeach;
            ?>
        </div>

        <style type="text/css">
            .field-color-palette-wrapper-<?php echo $id; ?> .sw-button{
                transition: ease all 1s;
            }

            .field-color-palette-wrapper-<?php echo $id; ?> label:hover .sw-button{

            }


        </style>

        <script>jQuery(document).ready(function($) {
                jQuery(document).on('click', '.field-color-palette-wrapper-<?php echo $id; ?> .sw-button', function() {

                    jQuery('.field-color-palette-wrapper-<?php echo $id; ?> label').removeClass('checked');

                    if(jQuery(this).parent().hasClass('checked')){
                        jQuery(this).parent().removeClass('checked');
                    }else{
                        jQuery(this).parent().addClass('checked');
                    }
                })
            })

        </script>

        <?php

    }


    public function generate_field_color_palette_multi( $option ){

        $id				= isset( $option['id'] ) ? $option['id'] : "";
        $args			= isset( $option['args'] ) ? $option['args'] : array();
        $colors			= isset( $option['colors'] ) ? $option['colors'] : array();
        $option_value	= get_option( $id );

        ?>
        <div class="field-color-palette-wrapper-multi field-color-palette-wrapper-multi-<?php echo $id; ?>">
            <?php
            foreach( $colors as $key => $color ):

                $checked = is_array( $option_value ) && in_array( $key, $option_value ) ? "checked" : "";
                ?><label  class="<?php echo $checked; ?>" for='<?php echo $id; ?>-<?php echo $key; ?>'><input
                        name='<?php echo $id; ?>[]' type='checkbox' id='<?php echo $id; ?>-<?php echo $key; ?>'
                        value='<?php echo $key; ?>' <?php echo $checked; ?>><span title="<?php echo $color; ?>" style="background-color: <?php
                echo $color; ?>" class="sw-button"></span></label><?php

            endforeach;
            ?>
        </div>

        <style type="text/css">
            .field-color-palette-wrapper-multi-<?php echo $id; ?> .sw-button{
                transition: ease all 1s;
            }

            .field-color-palette-wrapper-multi-<?php echo $id; ?> label:hover .sw-button{

            }


        </style>

        <script>jQuery(document).ready(function($) {
                jQuery(document).on('click', '.field-color-palette-wrapper-multi-<?php echo $id; ?> .sw-button',
                    function() {

                    //jQuery('.field-color-palette-wrapper-<?php echo $id; ?> label').removeClass('checked');

                    if(jQuery(this).parent().hasClass('checked')){
                        jQuery(this).parent().removeClass('checked');
                    }else{
                        jQuery(this).parent().addClass('checked');
                    }
                })
            })

        </script>

        <?php

    }










    public function generate_field_switch_img( $option ){

        $id				= isset( $option['id'] ) ? $option['id'] : "";
        $width			= isset( $option['width'] ) ? $option['width'] : "";
        $height			= isset( $option['height'] ) ? $option['height'] : "";
        $default 		= isset( $option['default'] ) ? $option['default'] : '';
        $args			= isset( $option['args'] ) ? $option['args'] : array();
        $args			= is_array( $args ) ? $args : $this->generate_args_from_string( $args );
        $option_value	= get_option( $id );

        $option_value   = !empty($option_value) ?  $option_value : $default;

        ?>
        <div class="field-switch-img-wrapper field-switch-img-wrapper-<?php echo $id; ?>">
            <?php
            foreach( $args as $key => $value ):

                $src = isset( $value['src'] ) ? $value['src'] : "";
                $item_width = isset( $value['width'] ) ? $value['width'] : $width;
                $item_height = isset( $value['height'] ) ? $value['height'] : $height;

                $checked = ( $key == $option_value ) ? "checked" : "";
                ?><label style="width: <?php echo $item_width; ?>;height: <?php echo $item_height; ?>" class="<?php echo $checked; ?>" for='<?php echo $id; ?>-<?php echo $key; ?>'><input name='<?php echo $id; ?>' type='radio' id='<?php echo $id; ?>-<?php echo $key; ?>' value='<?php echo $key; ?>' <?php echo $checked; ?>><span class="sw-button"><img src="<?php echo $src; ?>"> </span></label><?php

            endforeach;
            ?>
        </div>
        <script>jQuery(document).ready(function($) {
                jQuery(document).on('click', '.field-switch-img-wrapper-<?php echo $id; ?> .sw-button img', function() {

                    jQuery('.field-switch-img-wrapper-<?php echo $id; ?> label').removeClass('checked');

                    if(jQuery(this).parent().parent().hasClass('checked')){
                        jQuery(this).parent().parent().removeClass('checked');
                    }else{
                        jQuery(this).parent().parent().addClass('checked');
                    }
                })
            })

        </script>

        <?php

    }









    public function generate_field_switch_multi( $option ){

        $id				= isset( $option['id'] ) ? $option['id'] : "";
        $default 		= isset( $option['default'] ) ? $option['default'] : '';
        $args			= isset( $option['args'] ) ? $option['args'] : array();
        $args			= is_array( $args ) ? $args : $this->generate_args_from_string( $args );
        $option_value	= get_option( $id );

        $option_value      = !empty($option_value) ?  $option_value : $default;
        ?>
        <div class="field-switch-multi-wrapper field-switch-multi-wrapper-<?php echo $id; ?>">
            <?php
            foreach( $args as $key => $value ):

                $checked = is_array( $option_value ) && in_array( $key, $option_value ) ? "checked" : "";
                ?><label class="<?php echo $checked; ?>" for='<?php echo $id; ?>-<?php echo $key; ?>'><input name='<?php echo $id; ?>[]' type='checkbox' id='<?php echo $id; ?>-<?php echo $key; ?>' value='<?php echo $key; ?>' <?php echo $checked; ?>><span class="sw-button"><?php echo $value; ?></span></label><?php

            endforeach;
            ?>
        </div>
        <script>jQuery(document).ready(function($) {
                jQuery(document).on('click', '.field-switch-multi-wrapper-<?php echo $id; ?> .sw-button', function() {



                    if(jQuery(this).parent().hasClass('checked')){
                        jQuery(this).parent().removeClass('checked');
                    }else{
                        jQuery(this).parent().addClass('checked');
                    }
                })
            })

        </script>

        <?php

    }















	public function section_callback( $section ) { 
		
		$data = isset( $section['callback'][0]->data ) ? $section['callback'][0]->data : array();
		$description = isset( $data['pages'][$this->get_current_page()]['page_settings'][$section['id']]['description'] ) ? $data['pages'][$this->get_current_page()]['page_settings'][$section['id']]['description'] : "";
		
		echo $description;
	}
	
	public function whitelist_options( $whitelist_options ){
		
		foreach( $this->get_pages() as $page_id => $page ): foreach( $page['page_settings'] as $section ):
			foreach( $section['options'] as $option ):
				$whitelist_options[$page_id][] = $option['id'];
			endforeach; endforeach;
		endforeach;
		
		return $whitelist_options;
	}
	
	public function display_function(){

        ?>
        <div class='wrap wpadminsettings'>

        <?php

		
		parse_str( $_SERVER['QUERY_STRING'], $nav_menu_url_args );
		global $pagenow;
		
		
		settings_errors();
		
		$tab_count 	 = 0;

		?>




        <div class='navigation'>

            <div class="nav-header">
                <div class="themeName"><?php echo $this->get_item_name(); ?></div>
                <div class="themeVersion"><?php echo sprintf(__('Version: %s', 'wp-theme-settings'), $this->get_item_version()); ?></div>

            </div>

            <?php
            echo "";
            foreach( $this->get_pages() as $page_id => $page ): $tab_count++;

                $active = $this->get_current_page() == $page_id ? 'nav-item-active' : '';
                $nav_menu_url_args['tab'] = $page_id;
                $nav_menu_url = http_build_query( $nav_menu_url_args );

                ?>
                <a href='<?php echo $pagenow.'?'.$nav_menu_url; ?>' class='nav-item <?php echo $active; ?>'><?php echo
                    $page['page_nav']; ?></a>
                <?php

            endforeach;
            ?>

            <div class="nav-footer">

            </div>

        </div>
        <div class="form-wrapper">




            <form class="" action='options.php' method='post'>
                <div class="form-header">
                    <div class="pp-row">
                        <div class="pp-col pp-col-50">
                            <div class="pagename"> # <?php echo $this->get_menu_page_title(); ?></div>
                        </div>
                        <div class="pp-col pp-col-50 text-align-right">
                            <?php submit_button(null,'primary', null, false); ?>
                        </div>

                    </div>

                </div>

                <div class="form-section">
                    <?php

                    settings_fields( $this->get_current_page() );
                    do_settings_sections( $this->get_current_page() );
                    //submit_button();

                    ?>

                </div>



                <div class="form-footer">

                    <div class="pp-row">
                        <div class="pp-col pp-col-50">
                            <div class=""></div>
                            <span><a target="_blank" href="https://github.com/pickplugins/wp-theme-settings">WP Theme Settings</a> | Developed by : <a class="" href="http://pickplugins.com">PickPlugins</a> | Version: 1.0.0</span>
                        </div>
                        <div class="pp-col pp-col-50 text-align-right">
                            <?php submit_button(null,'primary', null, false); ?>
                        </div>
                    </div>



                </div>


            </form>

        </div>

        </div>
        <?php
	}
	
	
	// Default Functions
	
	public function generate_args_from_string( $string ){
		
		if( strpos( $string, 'WPADMINSETTINGS_PAGES_ARRAY' ) !== false ) return $this->get_pages_array();
        if( strpos( $string, 'WPADMINSETTINGS_POSTS_ARRAY' ) !== false ) return $this->get_posts_array();
        if( strpos( $string, 'WPADMINSETTINGS_POST_TYPES_ARRAY' ) !== false ) return $this->get_post_types_array();
		if( strpos( $string, 'WPADMINSETTINGS_TAX_' ) !== false ) return $this->get_taxonomies_array( $string );
        if( strpos( $string, 'WPADMINSETTINGS_USER_ROLES' ) !== false ) return $this->get_user_roles_array();
        if( strpos( $string, 'WPADMINSETTINGS_MENUS' ) !== false ) return $this->get_menus_array();

        if( strpos( $string, 'WPADMINSETTINGS_SIDEBARS_ARRAY' ) !== false ) return $this->get_sidebars_array();


        if( strpos( $string, 'WPADMINSETTINGS_THUMB_SIEZS_ARRAY' ) !== false ) return $this->get_thumb_sizes_array();
        if( strpos( $string, 'WPADMINSETTINGS_FONTAWESOME_ARRAY' ) !== false ) return $this->get_font_aws_array();

        return array();
	}
	
	public function get_taxonomies_array( $string ){
		
		$taxonomies = array();

		preg_match_all( "/\%([^\]]*)\%/", $string, $matches );

		//var_dump($matches);

		if( isset( $matches[1][0] ) ) $taxonomy = $matches[1][0];
		else throw new Pick_error('Invalid taxonomy declaration !');
		
		if( ! taxonomy_exists( $taxonomy ) ) throw new Pick_error("Taxonomy <strong>$taxonomy</strong> doesn't exists !");
		
		$terms = get_terms( $taxonomy, array(
			'hide_empty' => false,
		) );
		
		foreach( $terms as $term ) $taxonomies[ $term->term_id ] = $term->name;
				
		return $taxonomies;		
	}
	
	public function get_pages_array(){
		
		$pages_array = array();
		foreach( get_pages() as $page ) $pages_array[ $page->ID ] = $page->post_title;
		
		return apply_filters( 'WPADMINSETTINGS_PAGES_ARRAY', $pages_array );
	}

    public function get_menus_array(){

        $menus = get_registered_nav_menus();



        return apply_filters( 'WPADMINSETTINGS_MENUS_ARRAY', $menus );
    }

    public function get_sidebars_array(){

        global $wp_registered_sidebars;
        $sidebars = $wp_registered_sidebars;

        foreach ($sidebars as $index => $sidebar){

            $sidebars_name[$index] = $sidebar['name'];
        }


        return apply_filters( 'WPADMINSETTINGS_SIDEBARS_ARRAY', $sidebars_name );
    }

    public function get_user_roles_array(){

        $roles = get_editable_roles();

        foreach ($roles as $index => $data){

            $role_name[$index] = $data['name'];
        }

        return apply_filters( 'WPADMINSETTINGS_USER_ROLES', $role_name );
    }



    public function get_post_types_array(){

        $post_types = get_post_types('', 'names' );

        //echo '<pre>'.var_export($post_types, true).'</pre>';
        $pages_array = array();
        foreach( $post_types as $index => $name ) $pages_array[ $index ] = $name;

        return apply_filters( 'WPADMINSETTINGS_PAGES_ARRAY', $pages_array );
    }


    public function get_posts_array(){

        $pages_array = array();
        foreach( get_posts(array('posts_per_page'=>-1)) as $page ) $pages_array[ $page->ID ] = $page->post_title;

        return apply_filters( 'WPADMINSETTINGS_POSTS_ARRAY', $pages_array );
    }


    public function get_thumb_sizes_array(){


        $get_intermediate_image_sizes =  get_intermediate_image_sizes();
        $get_intermediate_image_sizes = array_merge($get_intermediate_image_sizes,array('full'));

        //var_dump($get_intermediate_image_sizes);

        $thumb_sizes_array = array();

        foreach( $get_intermediate_image_sizes as $key => $name ):



            $size_key = str_replace('_', ' ',$name);
            $size_key = str_replace('-', ' ',$size_key);
            $size_name = ucfirst($size_key);


            $thumb_sizes_array[$name] = $size_name;

        endforeach;


        //var_dump($thumb_sizes_array);


        return apply_filters( 'WPADMINSETTINGS_THUMB_SIEZS_ARRAY', $get_intermediate_image_sizes );
    }


	
	// Get Data from Dataset //
	
	public function get_option_ids(){
		
		$option_ids = array();
		foreach( $this->get_pages() as $page ):
			$setting_sections = isset( $page['page_settings'] ) ? $page['page_settings'] : array();
			foreach( $setting_sections as $setting_section ):
		
				$options = isset( $setting_section['options'] ) ? $setting_section['options'] : array();
				foreach( $options as $option ) $option_ids[] = isset( $option['id'] ) ? $option['id'] : '';
				
			endforeach;
		endforeach;
		return $option_ids; 
	}
	
	public function get_current_page(){
		
		$all_pages 		= $this->get_pages();
		$page_keys 		= array_keys($all_pages);
		$default_tab 	= ! empty( $all_pages ) ? reset( $page_keys ) : "";
		
		return isset( $_GET['tab'] ) ? sanitize_text_field($_GET['tab']) : $default_tab;
	}

    private function get_item_name(){
        if( isset( $this->data['item_name'] ) ) return $this->data['item_name'];
        else return "PickPlugins";
    }

    private function get_item_version(){
        if( isset( $this->data['item_version'] ) ) return $this->data['item_version'];
        else return "1.0.0";
    }


	private function get_menu_type(){
		if( isset( $this->data['menu_type'] ) ) return $this->data['menu_type'];
		else return "main";
	}
	private function get_pages(){
		if( isset( $this->data['pages'] ) ) return $this->data['pages'];
		else return array();
	}
	private function get_settings_fields(){
		if( isset( $this->get_pages()[$this->get_current_page()]['page_settings'] ) ) return $this->get_pages()[$this->get_current_page()]['page_settings'];
		else return array();
	}
	private function get_settings_name(){
		if( isset( $this->data['settings_name'] ) ) return $this->data['settings_name'];
		else return "my_custom_settings";
	}
	private function get_menu_icon(){
		if( isset( $this->data['menu_icon'] ) ) return $this->data['menu_icon'];
		else return "";
	}
	private function get_menu_slug(){
		if( isset( $this->data['menu_slug'] ) ) return $this->data['menu_slug'];
		else return "my-custom-settings";
	}
	private function get_capability(){
		if( isset( $this->data['capability'] ) ) return $this->data['capability'];
		else return "manage_options";
	}
	private function get_menu_page_title(){
		if( isset( $this->data['menu_page_title'] ) ) return $this->data['menu_page_title'];
		else return "My Custom Menu";
	}
	private function get_menu_name(){
		if( isset( $this->data['menu_name'] ) ) return $this->data['menu_name'];
		else return "Menu Name";
	}
	private function get_menu_title(){
		if( isset( $this->data['menu_title'] ) ) return $this->data['menu_title'];
		else return "Menu Title";
	}
	private function get_page_title(){
		if( isset( $this->data['page_title'] ) ) return $this->data['page_title'];
		else return "Page Title";
	}
	private function add_in_menu(){
		if( isset( $this->data['add_in_menu'] ) && $this->data['add_in_menu'] ) return true;
		else return false;
	}
	private function get_parent_slug(){
		if( isset( $this->data['parent_slug'] ) && $this->data['parent_slug'] ) return $this->data['parent_slug'];
		else return "";
	}



    public function get_font_aws_array(){

        $fonts_arr = array (
            'fab fa-500px' => __( '500px', 'buildr' ),
            'fab fa-accessible-icon' => __( 'accessible-icon', 'buildr' ),
            'fab fa-accusoft' => __( 'accusoft', 'buildr' ),
            'fas fa-address-book' => __( 'address-book', 'buildr' ),
            'far fa-address-book' => __( 'address-book', 'buildr' ),
            'fas fa-address-card' => __( 'address-card', 'buildr' ),
            'far fa-address-card' => __( 'address-card', 'buildr' ),
            'fas fa-adjust' => __( 'adjust', 'buildr' ),
            'fab fa-adn' => __( 'adn', 'buildr' ),
            'fab fa-adversal' => __( 'adversal', 'buildr' ),
            'fab fa-affiliatetheme' => __( 'affiliatetheme', 'buildr' ),
            'fab fa-algolia' => __( 'algolia', 'buildr' ),
            'fas fa-align-center' => __( 'align-center', 'buildr' ),
            'fas fa-align-justify' => __( 'align-justify', 'buildr' ),
            'fas fa-align-left' => __( 'align-left', 'buildr' ),
            'fas fa-align-right' => __( 'align-right', 'buildr' ),
            'fas fa-allergies' => __( 'allergies', 'buildr' ),
            'fab fa-amazon' => __( 'amazon', 'buildr' ),
            'fab fa-amazon-pay' => __( 'amazon-pay', 'buildr' ),
            'fas fa-ambulance' => __( 'ambulance', 'buildr' ),
            'fas fa-american-sign-language-interpreting' => __( 'american-sign-language-interpreting', 'buildr' ),
            'fab fa-amilia' => __( 'amilia', 'buildr' ),
            'fas fa-anchor' => __( 'anchor', 'buildr' ),
            'fab fa-android' => __( 'android', 'buildr' ),
            'fab fa-angellist' => __( 'angellist', 'buildr' ),
            'fas fa-angle-double-down' => __( 'angle-double-down', 'buildr' ),
            'fas fa-angle-double-left' => __( 'angle-double-left', 'buildr' ),
            'fas fa-angle-double-right' => __( 'angle-double-right', 'buildr' ),
            'fas fa-angle-double-up' => __( 'angle-double-up', 'buildr' ),
            'fas fa-angle-down' => __( 'angle-down', 'buildr' ),
            'fas fa-angle-left' => __( 'angle-left', 'buildr' ),
            'fas fa-angle-right' => __( 'angle-right', 'buildr' ),
            'fas fa-angle-up' => __( 'angle-up', 'buildr' ),
            'fab fa-angrycreative' => __( 'angrycreative', 'buildr' ),
            'fab fa-angular' => __( 'angular', 'buildr' ),
            'fab fa-app-store' => __( 'app-store', 'buildr' ),
            'fab fa-app-store-ios' => __( 'app-store-ios', 'buildr' ),
            'fab fa-apper' => __( 'apper', 'buildr' ),
            'fab fa-apple' => __( 'apple', 'buildr' ),
            'fab fa-apple-pay' => __( 'apple-pay', 'buildr' ),
            'fas fa-archive' => __( 'archive', 'buildr' ),
            'fas fa-arrow-alt-circle-down' => __( 'arrow-alt-circle-down', 'buildr' ),
            'far fa-arrow-alt-circle-down' => __( 'arrow-alt-circle-down', 'buildr' ),
            'fas fa-arrow-alt-circle-left' => __( 'arrow-alt-circle-left', 'buildr' ),
            'far fa-arrow-alt-circle-left' => __( 'arrow-alt-circle-left', 'buildr' ),
            'fas fa-arrow-alt-circle-right' => __( 'arrow-alt-circle-right', 'buildr' ),
            'far fa-arrow-alt-circle-right' => __( 'arrow-alt-circle-right', 'buildr' ),
            'fas fa-arrow-alt-circle-up' => __( 'arrow-alt-circle-up', 'buildr' ),
            'far fa-arrow-alt-circle-up' => __( 'arrow-alt-circle-up', 'buildr' ),
            'fas fa-arrow-circle-down' => __( 'arrow-circle-down', 'buildr' ),
            'fas fa-arrow-circle-left' => __( 'arrow-circle-left', 'buildr' ),
            'fas fa-arrow-circle-right' => __( 'arrow-circle-right', 'buildr' ),
            'fas fa-arrow-circle-up' => __( 'arrow-circle-up', 'buildr' ),
            'fas fa-arrow-down' => __( 'arrow-down', 'buildr' ),
            'fas fa-arrow-left' => __( 'arrow-left', 'buildr' ),
            'fas fa-arrow-right' => __( 'arrow-right', 'buildr' ),
            'fas fa-arrow-up' => __( 'arrow-up', 'buildr' ),
            'fas fa-arrows-alt' => __( 'arrows-alt', 'buildr' ),
            'fas fa-arrows-alt-h' => __( 'arrows-alt-h', 'buildr' ),
            'fas fa-arrows-alt-v' => __( 'arrows-alt-v', 'buildr' ),
            'fas fa-assistive-listening-systems' => __( 'assistive-listening-systems', 'buildr' ),
            'fas fa-asterisk' => __( 'asterisk', 'buildr' ),
            'fab fa-asymmetrik' => __( 'asymmetrik', 'buildr' ),
            'fas fa-at' => __( 'at', 'buildr' ),
            'fab fa-audible' => __( 'audible', 'buildr' ),
            'fas fa-audio-description' => __( 'audio-description', 'buildr' ),
            'fab fa-autoprefixer' => __( 'autoprefixer', 'buildr' ),
            'fab fa-avianex' => __( 'avianex', 'buildr' ),
            'fab fa-aviato' => __( 'aviato', 'buildr' ),
            'fab fa-aws' => __( 'aws', 'buildr' ),
            'fas fa-backward' => __( 'backward', 'buildr' ),
            'fas fa-balance-scale' => __( 'balance-scale', 'buildr' ),
            'fas fa-ban' => __( 'ban', 'buildr' ),
            'fas fa-band-aid' => __( 'band-aid', 'buildr' ),
            'fab fa-bandcamp' => __( 'bandcamp', 'buildr' ),
            'fas fa-barcode' => __( 'barcode', 'buildr' ),
            'fas fa-bars' => __( 'bars', 'buildr' ),
            'fas fa-baseball-ball' => __( 'baseball-ball', 'buildr' ),
            'fas fa-basketball-ball' => __( 'basketball-ball', 'buildr' ),
            'fas fa-bath' => __( 'bath', 'buildr' ),
            'fas fa-battery-empty' => __( 'battery-empty', 'buildr' ),
            'fas fa-battery-full' => __( 'battery-full', 'buildr' ),
            'fas fa-battery-half' => __( 'battery-half', 'buildr' ),
            'fas fa-battery-quarter' => __( 'battery-quarter', 'buildr' ),
            'fas fa-battery-three-quarters' => __( 'battery-three-quarters', 'buildr' ),
            'fas fa-bed' => __( 'bed', 'buildr' ),
            'fas fa-beer' => __( 'beer', 'buildr' ),
            'fab fa-behance' => __( 'behance', 'buildr' ),
            'fab fa-behance-square' => __( 'behance-square', 'buildr' ),
            'fas fa-bell' => __( 'bell', 'buildr' ),
            'far fa-bell' => __( 'bell', 'buildr' ),
            'fas fa-bell-slash' => __( 'bell-slash', 'buildr' ),
            'far fa-bell-slash' => __( 'bell-slash', 'buildr' ),
            'fas fa-bicycle' => __( 'bicycle', 'buildr' ),
            'fab fa-bimobject' => __( 'bimobject', 'buildr' ),
            'fas fa-binoculars' => __( 'binoculars', 'buildr' ),
            'fas fa-birthday-cake' => __( 'birthday-cake', 'buildr' ),
            'fab fa-bitbucket' => __( 'bitbucket', 'buildr' ),
            'fab fa-bitcoin' => __( 'bitcoin', 'buildr' ),
            'fab fa-bity' => __( 'bity', 'buildr' ),
            'fab fa-black-tie' => __( 'black-tie', 'buildr' ),
            'fab fa-blackberry' => __( 'blackberry', 'buildr' ),
            'fas fa-blind' => __( 'blind', 'buildr' ),
            'fab fa-blogger' => __( 'blogger', 'buildr' ),
            'fab fa-blogger-b' => __( 'blogger-b', 'buildr' ),
            'fab fa-bluetooth' => __( 'bluetooth', 'buildr' ),
            'fab fa-bluetooth-b' => __( 'bluetooth-b', 'buildr' ),
            'fas fa-bold' => __( 'bold', 'buildr' ),
            'fas fa-bolt' => __( 'bolt', 'buildr' ),
            'fas fa-bomb' => __( 'bomb', 'buildr' ),
            'fas fa-book' => __( 'book', 'buildr' ),
            'fas fa-bookmark' => __( 'bookmark', 'buildr' ),
            'far fa-bookmark' => __( 'bookmark', 'buildr' ),
            'fas fa-bowling-ball' => __( 'bowling-ball', 'buildr' ),
            'fas fa-box' => __( 'box', 'buildr' ),
            'fas fa-box-open' => __( 'box-open', 'buildr' ),
            'fas fa-boxes' => __( 'boxes', 'buildr' ),
            'fas fa-braille' => __( 'braille', 'buildr' ),
            'fas fa-briefcase' => __( 'briefcase', 'buildr' ),
            'fas fa-briefcase-medical' => __( 'briefcase-medical', 'buildr' ),
            'fab fa-btc' => __( 'btc', 'buildr' ),
            'fas fa-bug' => __( 'bug', 'buildr' ),
            'fas fa-building' => __( 'building', 'buildr' ),
            'far fa-building' => __( 'building', 'buildr' ),
            'fas fa-bullhorn' => __( 'bullhorn', 'buildr' ),
            'fas fa-bullseye' => __( 'bullseye', 'buildr' ),
            'fas fa-burn' => __( 'burn', 'buildr' ),
            'fab fa-buromobelexperte' => __( 'buromobelexperte', 'buildr' ),
            'fas fa-bus' => __( 'bus', 'buildr' ),
            'fab fa-buysellads' => __( 'buysellads', 'buildr' ),
            'fas fa-calculator' => __( 'calculator', 'buildr' ),
            'fas fa-calendar' => __( 'calendar', 'buildr' ),
            'far fa-calendar' => __( 'calendar', 'buildr' ),
            'fas fa-calendar-alt' => __( 'calendar-alt', 'buildr' ),
            'far fa-calendar-alt' => __( 'calendar-alt', 'buildr' ),
            'fas fa-calendar-check' => __( 'calendar-check', 'buildr' ),
            'far fa-calendar-check' => __( 'calendar-check', 'buildr' ),
            'fas fa-calendar-minus' => __( 'calendar-minus', 'buildr' ),
            'far fa-calendar-minus' => __( 'calendar-minus', 'buildr' ),
            'fas fa-calendar-plus' => __( 'calendar-plus', 'buildr' ),
            'far fa-calendar-plus' => __( 'calendar-plus', 'buildr' ),
            'fas fa-calendar-times' => __( 'calendar-times', 'buildr' ),
            'far fa-calendar-times' => __( 'calendar-times', 'buildr' ),
            'fas fa-camera' => __( 'camera', 'buildr' ),
            'fas fa-camera-retro' => __( 'camera-retro', 'buildr' ),
            'fas fa-capsules' => __( 'capsules', 'buildr' ),
            'fas fa-car' => __( 'car', 'buildr' ),
            'fas fa-caret-down' => __( 'caret-down', 'buildr' ),
            'fas fa-caret-left' => __( 'caret-left', 'buildr' ),
            'fas fa-caret-right' => __( 'caret-right', 'buildr' ),
            'fas fa-caret-square-down' => __( 'caret-square-down', 'buildr' ),
            'far fa-caret-square-down' => __( 'caret-square-down', 'buildr' ),
            'fas fa-caret-square-left' => __( 'caret-square-left', 'buildr' ),
            'far fa-caret-square-left' => __( 'caret-square-left', 'buildr' ),
            'fas fa-caret-square-right' => __( 'caret-square-right', 'buildr' ),
            'far fa-caret-square-right' => __( 'caret-square-right', 'buildr' ),
            'fas fa-caret-square-up' => __( 'caret-square-up', 'buildr' ),
            'far fa-caret-square-up' => __( 'caret-square-up', 'buildr' ),
            'fas fa-caret-up' => __( 'caret-up', 'buildr' ),
            'fas fa-cart-arrow-down' => __( 'cart-arrow-down', 'buildr' ),
            'fas fa-cart-plus' => __( 'cart-plus', 'buildr' ),
            'fab fa-cc-amazon-pay' => __( 'cc-amazon-pay', 'buildr' ),
            'fab fa-cc-amex' => __( 'cc-amex', 'buildr' ),
            'fab fa-cc-apple-pay' => __( 'cc-apple-pay', 'buildr' ),
            'fab fa-cc-diners-club' => __( 'cc-diners-club', 'buildr' ),
            'fab fa-cc-discover' => __( 'cc-discover', 'buildr' ),
            'fab fa-cc-jcb' => __( 'cc-jcb', 'buildr' ),
            'fab fa-cc-mastercard' => __( 'cc-mastercard', 'buildr' ),
            'fab fa-cc-paypal' => __( 'cc-paypal', 'buildr' ),
            'fab fa-cc-stripe' => __( 'cc-stripe', 'buildr' ),
            'fab fa-cc-visa' => __( 'cc-visa', 'buildr' ),
            'fab fa-centercode' => __( 'centercode', 'buildr' ),
            'fas fa-certificate' => __( 'certificate', 'buildr' ),
            'fas fa-chart-area' => __( 'chart-area', 'buildr' ),
            'fas fa-chart-bar' => __( 'chart-bar', 'buildr' ),
            'far fa-chart-bar' => __( 'chart-bar', 'buildr' ),
            'fas fa-chart-line' => __( 'chart-line', 'buildr' ),
            'fas fa-chart-pie' => __( 'chart-pie', 'buildr' ),
            'fas fa-check' => __( 'check', 'buildr' ),
            'fas fa-check-circle' => __( 'check-circle', 'buildr' ),
            'far fa-check-circle' => __( 'check-circle', 'buildr' ),
            'fas fa-check-square' => __( 'check-square', 'buildr' ),
            'far fa-check-square' => __( 'check-square', 'buildr' ),
            'fas fa-chess' => __( 'chess', 'buildr' ),
            'fas fa-chess-bishop' => __( 'chess-bishop', 'buildr' ),
            'fas fa-chess-board' => __( 'chess-board', 'buildr' ),
            'fas fa-chess-king' => __( 'chess-king', 'buildr' ),
            'fas fa-chess-knight' => __( 'chess-knight', 'buildr' ),
            'fas fa-chess-pawn' => __( 'chess-pawn', 'buildr' ),
            'fas fa-chess-queen' => __( 'chess-queen', 'buildr' ),
            'fas fa-chess-rook' => __( 'chess-rook', 'buildr' ),
            'fas fa-chevron-circle-down' => __( 'chevron-circle-down', 'buildr' ),
            'fas fa-chevron-circle-left' => __( 'chevron-circle-left', 'buildr' ),
            'fas fa-chevron-circle-right' => __( 'chevron-circle-right', 'buildr' ),
            'fas fa-chevron-circle-up' => __( 'chevron-circle-up', 'buildr' ),
            'fas fa-chevron-down' => __( 'chevron-down', 'buildr' ),
            'fas fa-chevron-left' => __( 'chevron-left', 'buildr' ),
            'fas fa-chevron-right' => __( 'chevron-right', 'buildr' ),
            'fas fa-chevron-up' => __( 'chevron-up', 'buildr' ),
            'fas fa-child' => __( 'child', 'buildr' ),
            'fab fa-chrome' => __( 'chrome', 'buildr' ),
            'fas fa-circle' => __( 'circle', 'buildr' ),
            'far fa-circle' => __( 'circle', 'buildr' ),
            'fas fa-circle-notch' => __( 'circle-notch', 'buildr' ),
            'fas fa-clipboard' => __( 'clipboard', 'buildr' ),
            'far fa-clipboard' => __( 'clipboard', 'buildr' ),
            'fas fa-clipboard-check' => __( 'clipboard-check', 'buildr' ),
            'fas fa-clipboard-list' => __( 'clipboard-list', 'buildr' ),
            'fas fa-clock' => __( 'clock', 'buildr' ),
            'far fa-clock' => __( 'clock', 'buildr' ),
            'fas fa-clone' => __( 'clone', 'buildr' ),
            'far fa-clone' => __( 'clone', 'buildr' ),
            'fas fa-closed-captioning' => __( 'closed-captioning', 'buildr' ),
            'far fa-closed-captioning' => __( 'closed-captioning', 'buildr' ),
            'fas fa-cloud' => __( 'cloud', 'buildr' ),
            'fas fa-cloud-download-alt' => __( 'cloud-download-alt', 'buildr' ),
            'fas fa-cloud-upload-alt' => __( 'cloud-upload-alt', 'buildr' ),
            'fab fa-cloudscale' => __( 'cloudscale', 'buildr' ),
            'fab fa-cloudsmith' => __( 'cloudsmith', 'buildr' ),
            'fab fa-cloudversify' => __( 'cloudversify', 'buildr' ),
            'fas fa-code' => __( 'code', 'buildr' ),
            'fas fa-code-branch' => __( 'code-branch', 'buildr' ),
            'fab fa-codepen' => __( 'codepen', 'buildr' ),
            'fab fa-codiepie' => __( 'codiepie', 'buildr' ),
            'fas fa-coffee' => __( 'coffee', 'buildr' ),
            'fas fa-cog' => __( 'cog', 'buildr' ),
            'fas fa-cogs' => __( 'cogs', 'buildr' ),
            'fas fa-columns' => __( 'columns', 'buildr' ),
            'fas fa-comment' => __( 'comment', 'buildr' ),
            'far fa-comment' => __( 'comment', 'buildr' ),
            'fas fa-comment-alt' => __( 'comment-alt', 'buildr' ),
            'far fa-comment-alt' => __( 'comment-alt', 'buildr' ),
            'fas fa-comment-dots' => __( 'comment-dots', 'buildr' ),
            'fas fa-comment-slash' => __( 'comment-slash', 'buildr' ),
            'fas fa-comments' => __( 'comments', 'buildr' ),
            'far fa-comments' => __( 'comments', 'buildr' ),
            'fas fa-compass' => __( 'compass', 'buildr' ),
            'far fa-compass' => __( 'compass', 'buildr' ),
            'fas fa-compress' => __( 'compress', 'buildr' ),
            'fab fa-connectdevelop' => __( 'connectdevelop', 'buildr' ),
            'fab fa-contao' => __( 'contao', 'buildr' ),
            'fas fa-copy' => __( 'copy', 'buildr' ),
            'far fa-copy' => __( 'copy', 'buildr' ),
            'fas fa-copyright' => __( 'copyright', 'buildr' ),
            'far fa-copyright' => __( 'copyright', 'buildr' ),
            'fas fa-couch' => __( 'couch', 'buildr' ),
            'fab fa-cpanel' => __( 'cpanel', 'buildr' ),
            'fab fa-creative-commons' => __( 'creative-commons', 'buildr' ),
            'fas fa-credit-card' => __( 'credit-card', 'buildr' ),
            'far fa-credit-card' => __( 'credit-card', 'buildr' ),
            'fas fa-crop' => __( 'crop', 'buildr' ),
            'fas fa-crosshairs' => __( 'crosshairs', 'buildr' ),
            'fab fa-css3' => __( 'css3', 'buildr' ),
            'fab fa-css3-alt' => __( 'css3-alt', 'buildr' ),
            'fas fa-cube' => __( 'cube', 'buildr' ),
            'fas fa-cubes' => __( 'cubes', 'buildr' ),
            'fas fa-cut' => __( 'cut', 'buildr' ),
            'fab fa-cuttlefish' => __( 'cuttlefish', 'buildr' ),
            'fab fa-d-and-d' => __( 'd-and-d', 'buildr' ),
            'fab fa-dashcube' => __( 'dashcube', 'buildr' ),
            'fas fa-database' => __( 'database', 'buildr' ),
            'fas fa-deaf' => __( 'deaf', 'buildr' ),
            'fab fa-delicious' => __( 'delicious', 'buildr' ),
            'fab fa-deploydog' => __( 'deploydog', 'buildr' ),
            'fab fa-deskpro' => __( 'deskpro', 'buildr' ),
            'fas fa-desktop' => __( 'desktop', 'buildr' ),
            'fab fa-deviantart' => __( 'deviantart', 'buildr' ),
            'fas fa-diagnoses' => __( 'diagnoses', 'buildr' ),
            'fab fa-digg' => __( 'digg', 'buildr' ),
            'fab fa-digital-ocean' => __( 'digital-ocean', 'buildr' ),
            'fab fa-discord' => __( 'discord', 'buildr' ),
            'fab fa-discourse' => __( 'discourse', 'buildr' ),
            'fas fa-dna' => __( 'dna', 'buildr' ),
            'fab fa-dochub' => __( 'dochub', 'buildr' ),
            'fab fa-docker' => __( 'docker', 'buildr' ),
            'fas fa-dollar-sign' => __( 'dollar-sign', 'buildr' ),
            'fas fa-dolly' => __( 'dolly', 'buildr' ),
            'fas fa-dolly-flatbed' => __( 'dolly-flatbed', 'buildr' ),
            'fas fa-donate' => __( 'donate', 'buildr' ),
            'fas fa-dot-circle' => __( 'dot-circle', 'buildr' ),
            'far fa-dot-circle' => __( 'dot-circle', 'buildr' ),
            'fas fa-dove' => __( 'dove', 'buildr' ),
            'fas fa-download' => __( 'download', 'buildr' ),
            'fab fa-draft2digital' => __( 'draft2digital', 'buildr' ),
            'fab fa-dribbble' => __( 'dribbble', 'buildr' ),
            'fab fa-dribbble-square' => __( 'dribbble-square', 'buildr' ),
            'fab fa-dropbox' => __( 'dropbox', 'buildr' ),
            'fab fa-drupal' => __( 'drupal', 'buildr' ),
            'fab fa-dyalog' => __( 'dyalog', 'buildr' ),
            'fab fa-earlybirds' => __( 'earlybirds', 'buildr' ),
            'fab fa-edge' => __( 'edge', 'buildr' ),
            'fas fa-edit' => __( 'edit', 'buildr' ),
            'far fa-edit' => __( 'edit', 'buildr' ),
            'fas fa-eject' => __( 'eject', 'buildr' ),
            'fab fa-elementor' => __( 'elementor', 'buildr' ),
            'fas fa-ellipsis-h' => __( 'ellipsis-h', 'buildr' ),
            'fas fa-ellipsis-v' => __( 'ellipsis-v', 'buildr' ),
            'fab fa-ember' => __( 'ember', 'buildr' ),
            'fab fa-empire' => __( 'empire', 'buildr' ),
            'fas fa-envelope' => __( 'envelope', 'buildr' ),
            'far fa-envelope' => __( 'envelope', 'buildr' ),
            'fas fa-envelope-open' => __( 'envelope-open', 'buildr' ),
            'far fa-envelope-open' => __( 'envelope-open', 'buildr' ),
            'fas fa-envelope-square' => __( 'envelope-square', 'buildr' ),
            'fab fa-envira' => __( 'envira', 'buildr' ),
            'fas fa-eraser' => __( 'eraser', 'buildr' ),
            'fab fa-erlang' => __( 'erlang', 'buildr' ),
            'fab fa-ethereum' => __( 'ethereum', 'buildr' ),
            'fab fa-etsy' => __( 'etsy', 'buildr' ),
            'fas fa-euro-sign' => __( 'euro-sign', 'buildr' ),
            'fas fa-exchange-alt' => __( 'exchange-alt', 'buildr' ),
            'fas fa-exclamation' => __( 'exclamation', 'buildr' ),
            'fas fa-exclamation-circle' => __( 'exclamation-circle', 'buildr' ),
            'fas fa-exclamation-triangle' => __( 'exclamation-triangle', 'buildr' ),
            'fas fa-expand' => __( 'expand', 'buildr' ),
            'fas fa-expand-arrows-alt' => __( 'expand-arrows-alt', 'buildr' ),
            'fab fa-expeditedssl' => __( 'expeditedssl', 'buildr' ),
            'fas fa-external-link-alt' => __( 'external-link-alt', 'buildr' ),
            'fas fa-external-link-square-alt' => __( 'external-link-square-alt', 'buildr' ),
            'fas fa-eye' => __( 'eye', 'buildr' ),
            'fas fa-eye-dropper' => __( 'eye-dropper', 'buildr' ),
            'fas fa-eye-slash' => __( 'eye-slash', 'buildr' ),
            'far fa-eye-slash' => __( 'eye-slash', 'buildr' ),
            'fab fa-facebook' => __( 'facebook', 'buildr' ),
            'fab fa-facebook-f' => __( 'facebook-f', 'buildr' ),
            'fab fa-facebook-messenger' => __( 'facebook-messenger', 'buildr' ),
            'fab fa-facebook-square' => __( 'facebook-square', 'buildr' ),
            'fas fa-fast-backward' => __( 'fast-backward', 'buildr' ),
            'fas fa-fast-forward' => __( 'fast-forward', 'buildr' ),
            'fas fa-fax' => __( 'fax', 'buildr' ),
            'fas fa-female' => __( 'female', 'buildr' ),
            'fas fa-fighter-jet' => __( 'fighter-jet', 'buildr' ),
            'fas fa-file' => __( 'file', 'buildr' ),
            'far fa-file' => __( 'file', 'buildr' ),
            'fas fa-file-alt' => __( 'file-alt', 'buildr' ),
            'far fa-file-alt' => __( 'file-alt', 'buildr' ),
            'fas fa-file-archive' => __( 'file-archive', 'buildr' ),
            'far fa-file-archive' => __( 'file-archive', 'buildr' ),
            'fas fa-file-audio' => __( 'file-audio', 'buildr' ),
            'far fa-file-audio' => __( 'file-audio', 'buildr' ),
            'fas fa-file-code' => __( 'file-code', 'buildr' ),
            'far fa-file-code' => __( 'file-code', 'buildr' ),
            'fas fa-file-excel' => __( 'file-excel', 'buildr' ),
            'far fa-file-excel' => __( 'file-excel', 'buildr' ),
            'fas fa-file-image' => __( 'file-image', 'buildr' ),
            'far fa-file-image' => __( 'file-image', 'buildr' ),
            'fas fa-file-medical' => __( 'file-medical', 'buildr' ),
            'fas fa-file-medical-alt' => __( 'file-medical-alt', 'buildr' ),
            'fas fa-file-pdf' => __( 'file-pdf', 'buildr' ),
            'far fa-file-pdf' => __( 'file-pdf', 'buildr' ),
            'fas fa-file-powerpoint' => __( 'file-powerpoint', 'buildr' ),
            'far fa-file-powerpoint' => __( 'file-powerpoint', 'buildr' ),
            'fas fa-file-video' => __( 'file-video', 'buildr' ),
            'far fa-file-video' => __( 'file-video', 'buildr' ),
            'fas fa-file-word' => __( 'file-word', 'buildr' ),
            'far fa-file-word' => __( 'file-word', 'buildr' ),
            'fas fa-film' => __( 'film', 'buildr' ),
            'fas fa-filter' => __( 'filter', 'buildr' ),
            'fas fa-fire' => __( 'fire', 'buildr' ),
            'fas fa-fire-extinguisher' => __( 'fire-extinguisher', 'buildr' ),
            'fab fa-firefox' => __( 'firefox', 'buildr' ),
            'fas fa-first-aid' => __( 'first-aid', 'buildr' ),
            'fab fa-first-order' => __( 'first-order', 'buildr' ),
            'fab fa-firstdraft' => __( 'firstdraft', 'buildr' ),
            'fas fa-flag' => __( 'flag', 'buildr' ),
            'far fa-flag' => __( 'flag', 'buildr' ),
            'fas fa-flag-checkered' => __( 'flag-checkered', 'buildr' ),
            'fas fa-flask' => __( 'flask', 'buildr' ),
            'fab fa-flickr' => __( 'flickr', 'buildr' ),
            'fab fa-flipboard' => __( 'flipboard', 'buildr' ),
            'fab fa-fly' => __( 'fly', 'buildr' ),
            'fas fa-folder' => __( 'folder', 'buildr' ),
            'far fa-folder' => __( 'folder', 'buildr' ),
            'fas fa-folder-open' => __( 'folder-open', 'buildr' ),
            'far fa-folder-open' => __( 'folder-open', 'buildr' ),
            'fas fa-font' => __( 'font', 'buildr' ),
            'fab fa-font-awesome' => __( 'font-awesome', 'buildr' ),
            'fab fa-font-awesome-alt' => __( 'font-awesome-alt', 'buildr' ),
            'fab fa-font-awesome-flag' => __( 'font-awesome-flag', 'buildr' ),
            'fab fa-fonticons' => __( 'fonticons', 'buildr' ),
            'fab fa-fonticons-fi' => __( 'fonticons-fi', 'buildr' ),
            'fas fa-football-ball' => __( 'football-ball', 'buildr' ),
            'fab fa-fort-awesome' => __( 'fort-awesome', 'buildr' ),
            'fab fa-fort-awesome-alt' => __( 'fort-awesome-alt', 'buildr' ),
            'fab fa-forumbee' => __( 'forumbee', 'buildr' ),
            'fas fa-forward' => __( 'forward', 'buildr' ),
            'fab fa-foursquare' => __( 'foursquare', 'buildr' ),
            'fab fa-free-code-camp' => __( 'free-code-camp', 'buildr' ),
            'fab fa-freebsd' => __( 'freebsd', 'buildr' ),
            'fas fa-frown' => __( 'frown', 'buildr' ),
            'far fa-frown' => __( 'frown', 'buildr' ),
            'fas fa-futbol' => __( 'futbol', 'buildr' ),
            'far fa-futbol' => __( 'futbol', 'buildr' ),
            'fas fa-gamepad' => __( 'gamepad', 'buildr' ),
            'fas fa-gavel' => __( 'gavel', 'buildr' ),
            'fas fa-gem' => __( 'gem', 'buildr' ),
            'far fa-gem' => __( 'gem', 'buildr' ),
            'fas fa-genderless' => __( 'genderless', 'buildr' ),
            'fab fa-get-pocket' => __( 'get-pocket', 'buildr' ),
            'fab fa-gg' => __( 'gg', 'buildr' ),
            'fab fa-gg-circle' => __( 'gg-circle', 'buildr' ),
            'fas fa-gift' => __( 'gift', 'buildr' ),
            'fab fa-git' => __( 'git', 'buildr' ),
            'fab fa-git-square' => __( 'git-square', 'buildr' ),
            'fab fa-github' => __( 'github', 'buildr' ),
            'fab fa-github-alt' => __( 'github-alt', 'buildr' ),
            'fab fa-github-square' => __( 'github-square', 'buildr' ),
            'fab fa-gitkraken' => __( 'gitkraken', 'buildr' ),
            'fab fa-gitlab' => __( 'gitlab', 'buildr' ),
            'fab fa-gitter' => __( 'gitter', 'buildr' ),
            'fas fa-glass-martini' => __( 'glass-martini', 'buildr' ),
            'fab fa-glide' => __( 'glide', 'buildr' ),
            'fab fa-glide-g' => __( 'glide-g', 'buildr' ),
            'fas fa-globe' => __( 'globe', 'buildr' ),
            'fab fa-gofore' => __( 'gofore', 'buildr' ),
            'fas fa-golf-ball' => __( 'golf-ball', 'buildr' ),
            'fab fa-goodreads' => __( 'goodreads', 'buildr' ),
            'fab fa-goodreads-g' => __( 'goodreads-g', 'buildr' ),
            'fab fa-google' => __( 'google', 'buildr' ),
            'fab fa-google-drive' => __( 'google-drive', 'buildr' ),
            'fab fa-google-play' => __( 'google-play', 'buildr' ),
            'fab fa-google-plus' => __( 'google-plus', 'buildr' ),
            'fab fa-google-plus-g' => __( 'google-plus-g', 'buildr' ),
            'fab fa-google-plus-square' => __( 'google-plus-square', 'buildr' ),
            'fab fa-google-wallet' => __( 'google-wallet', 'buildr' ),
            'fas fa-graduation-cap' => __( 'graduation-cap', 'buildr' ),
            'fab fa-gratipay' => __( 'gratipay', 'buildr' ),
            'fab fa-grav' => __( 'grav', 'buildr' ),
            'fab fa-gripfire' => __( 'gripfire', 'buildr' ),
            'fab fa-grunt' => __( 'grunt', 'buildr' ),
            'fab fa-gulp' => __( 'gulp', 'buildr' ),
            'fas fa-h-square' => __( 'h-square', 'buildr' ),
            'fab fa-hacker-news' => __( 'hacker-news', 'buildr' ),
            'fab fa-hacker-news-square' => __( 'hacker-news-square', 'buildr' ),
            'fas fa-hand-holding' => __( 'hand-holding', 'buildr' ),
            'fas fa-hand-holding-heart' => __( 'hand-holding-heart', 'buildr' ),
            'fas fa-hand-holding-usd' => __( 'hand-holding-usd', 'buildr' ),
            'fas fa-hand-lizard' => __( 'hand-lizard', 'buildr' ),
            'far fa-hand-lizard' => __( 'hand-lizard', 'buildr' ),
            'fas fa-hand-paper' => __( 'hand-paper', 'buildr' ),
            'far fa-hand-paper' => __( 'hand-paper', 'buildr' ),
            'fas fa-hand-peace' => __( 'hand-peace', 'buildr' ),
            'far fa-hand-peace' => __( 'hand-peace', 'buildr' ),
            'fas fa-hand-point-down' => __( 'hand-point-down', 'buildr' ),
            'far fa-hand-point-down' => __( 'hand-point-down', 'buildr' ),
            'fas fa-hand-point-left' => __( 'hand-point-left', 'buildr' ),
            'far fa-hand-point-left' => __( 'hand-point-left', 'buildr' ),
            'fas fa-hand-point-right' => __( 'hand-point-right', 'buildr' ),
            'far fa-hand-point-right' => __( 'hand-point-right', 'buildr' ),
            'fas fa-hand-point-up' => __( 'hand-point-up', 'buildr' ),
            'far fa-hand-point-up' => __( 'hand-point-up', 'buildr' ),
            'fas fa-hand-pointer' => __( 'hand-pointer', 'buildr' ),
            'far fa-hand-pointer' => __( 'hand-pointer', 'buildr' ),
            'fas fa-hand-rock' => __( 'hand-rock', 'buildr' ),
            'far fa-hand-rock' => __( 'hand-rock', 'buildr' ),
            'fas fa-hand-scissors' => __( 'hand-scissors', 'buildr' ),
            'far fa-hand-scissors' => __( 'hand-scissors', 'buildr' ),
            'fas fa-hand-spock' => __( 'hand-spock', 'buildr' ),
            'far fa-hand-spock' => __( 'hand-spock', 'buildr' ),
            'fas fa-hands' => __( 'hands', 'buildr' ),
            'fas fa-hands-helping' => __( 'hands-helping', 'buildr' ),
            'fas fa-handshake' => __( 'handshake', 'buildr' ),
            'far fa-handshake' => __( 'handshake', 'buildr' ),
            'fas fa-hashtag' => __( 'hashtag', 'buildr' ),
            'fas fa-hdd' => __( 'hdd', 'buildr' ),
            'far fa-hdd' => __( 'hdd', 'buildr' ),
            'fas fa-heading' => __( 'heading', 'buildr' ),
            'fas fa-headphones' => __( 'headphones', 'buildr' ),
            'fas fa-heart' => __( 'heart', 'buildr' ),
            'far fa-heart' => __( 'heart', 'buildr' ),
            'fas fa-heartbeat' => __( 'heartbeat', 'buildr' ),
            'fab fa-hips' => __( 'hips', 'buildr' ),
            'fab fa-hire-a-helper' => __( 'hire-a-helper', 'buildr' ),
            'fas fa-history' => __( 'history', 'buildr' ),
            'fas fa-hockey-puck' => __( 'hockey-puck', 'buildr' ),
            'fas fa-home' => __( 'home', 'buildr' ),
            'fab fa-hooli' => __( 'hooli', 'buildr' ),
            'fas fa-hospital' => __( 'hospital', 'buildr' ),
            'far fa-hospital' => __( 'hospital', 'buildr' ),
            'fas fa-hospital-alt' => __( 'hospital-alt', 'buildr' ),
            'fas fa-hospital-symbol' => __( 'hospital-symbol', 'buildr' ),
            'fab fa-hotjar' => __( 'hotjar', 'buildr' ),
            'fas fa-hourglass' => __( 'hourglass', 'buildr' ),
            'far fa-hourglass' => __( 'hourglass', 'buildr' ),
            'fas fa-hourglass-end' => __( 'hourglass-end', 'buildr' ),
            'fas fa-hourglass-half' => __( 'hourglass-half', 'buildr' ),
            'fas fa-hourglass-start' => __( 'hourglass-start', 'buildr' ),
            'fab fa-houzz' => __( 'houzz', 'buildr' ),
            'fab fa-html5' => __( 'html5', 'buildr' ),
            'fab fa-hubspot' => __( 'hubspot', 'buildr' ),
            'fas fa-i-cursor' => __( 'i-cursor', 'buildr' ),
            'fas fa-id-badge' => __( 'id-badge', 'buildr' ),
            'far fa-id-badge' => __( 'id-badge', 'buildr' ),
            'fas fa-id-card' => __( 'id-card', 'buildr' ),
            'far fa-id-card' => __( 'id-card', 'buildr' ),
            'fas fa-id-card-alt' => __( 'id-card-alt', 'buildr' ),
            'fas fa-image' => __( 'image', 'buildr' ),
            'far fa-image' => __( 'image', 'buildr' ),
            'fas fa-images' => __( 'images', 'buildr' ),
            'far fa-images' => __( 'images', 'buildr' ),
            'fab fa-imdb' => __( 'imdb', 'buildr' ),
            'fas fa-inbox' => __( 'inbox', 'buildr' ),
            'fas fa-indent' => __( 'indent', 'buildr' ),
            'fas fa-industry' => __( 'industry', 'buildr' ),
            'fas fa-info' => __( 'info', 'buildr' ),
            'fas fa-info-circle' => __( 'info-circle', 'buildr' ),
            'fab fa-instagram' => __( 'instagram', 'buildr' ),
            'fab fa-internet-explorer' => __( 'internet-explorer', 'buildr' ),
            'fab fa-ioxhost' => __( 'ioxhost', 'buildr' ),
            'fas fa-italic' => __( 'italic', 'buildr' ),
            'fab fa-itunes' => __( 'itunes', 'buildr' ),
            'fab fa-itunes-note' => __( 'itunes-note', 'buildr' ),
            'fab fa-java' => __( 'java', 'buildr' ),
            'fab fa-jenkins' => __( 'jenkins', 'buildr' ),
            'fab fa-joget' => __( 'joget', 'buildr' ),
            'fab fa-joomla' => __( 'joomla', 'buildr' ),
            'fab fa-js' => __( 'js', 'buildr' ),
            'fab fa-js-square' => __( 'js-square', 'buildr' ),
            'fab fa-jsfiddle' => __( 'jsfiddle', 'buildr' ),
            'fas fa-key' => __( 'key', 'buildr' ),
            'fas fa-keyboard' => __( 'keyboard', 'buildr' ),
            'far fa-keyboard' => __( 'keyboard', 'buildr' ),
            'fab fa-keycdn' => __( 'keycdn', 'buildr' ),
            'fab fa-kickstarter' => __( 'kickstarter', 'buildr' ),
            'fab fa-kickstarter-k' => __( 'kickstarter-k', 'buildr' ),
            'fab fa-korvue' => __( 'korvue', 'buildr' ),
            'fas fa-language' => __( 'language', 'buildr' ),
            'fas fa-laptop' => __( 'laptop', 'buildr' ),
            'fab fa-laravel' => __( 'laravel', 'buildr' ),
            'fab fa-lastfm' => __( 'lastfm', 'buildr' ),
            'fab fa-lastfm-square' => __( 'lastfm-square', 'buildr' ),
            'fas fa-leaf' => __( 'leaf', 'buildr' ),
            'fab fa-leanpub' => __( 'leanpub', 'buildr' ),
            'fas fa-lemon' => __( 'lemon', 'buildr' ),
            'far fa-lemon' => __( 'lemon', 'buildr' ),
            'fab fa-less' => __( 'less', 'buildr' ),
            'fas fa-level-down-alt' => __( 'level-down-alt', 'buildr' ),
            'fas fa-level-up-alt' => __( 'level-up-alt', 'buildr' ),
            'fas fa-life-ring' => __( 'life-ring', 'buildr' ),
            'far fa-life-ring' => __( 'life-ring', 'buildr' ),
            'fas fa-lightbulb' => __( 'lightbulb', 'buildr' ),
            'far fa-lightbulb' => __( 'lightbulb', 'buildr' ),
            'fab fa-line' => __( 'line', 'buildr' ),
            'fas fa-link' => __( 'link', 'buildr' ),
            'fab fa-linkedin' => __( 'linkedin', 'buildr' ),
            'fab fa-linkedin-in' => __( 'linkedin-in', 'buildr' ),
            'fab fa-linode' => __( 'linode', 'buildr' ),
            'fab fa-linux' => __( 'linux', 'buildr' ),
            'fas fa-lira-sign' => __( 'lira-sign', 'buildr' ),
            'fas fa-list' => __( 'list', 'buildr' ),
            'fas fa-list-alt' => __( 'list-alt', 'buildr' ),
            'far fa-list-alt' => __( 'list-alt', 'buildr' ),
            'fas fa-list-ol' => __( 'list-ol', 'buildr' ),
            'fas fa-list-ul' => __( 'list-ul', 'buildr' ),
            'fas fa-location-arrow' => __( 'location-arrow', 'buildr' ),
            'fas fa-lock' => __( 'lock', 'buildr' ),
            'fas fa-lock-open' => __( 'lock-open', 'buildr' ),
            'fas fa-long-arrow-alt-down' => __( 'long-arrow-alt-down', 'buildr' ),
            'fas fa-long-arrow-alt-left' => __( 'long-arrow-alt-left', 'buildr' ),
            'fas fa-long-arrow-alt-right' => __( 'long-arrow-alt-right', 'buildr' ),
            'fas fa-long-arrow-alt-up' => __( 'long-arrow-alt-up', 'buildr' ),
            'fas fa-low-vision' => __( 'low-vision', 'buildr' ),
            'fab fa-lyft' => __( 'lyft', 'buildr' ),
            'fab fa-magento' => __( 'magento', 'buildr' ),
            'fas fa-magic' => __( 'magic', 'buildr' ),
            'fas fa-magnet' => __( 'magnet', 'buildr' ),
            'fas fa-male' => __( 'male', 'buildr' ),
            'fas fa-map' => __( 'map', 'buildr' ),
            'far fa-map' => __( 'map', 'buildr' ),
            'fas fa-map-marker' => __( 'map-marker', 'buildr' ),
            'fas fa-map-marker-alt' => __( 'map-marker-alt', 'buildr' ),
            'fas fa-map-pin' => __( 'map-pin', 'buildr' ),
            'fas fa-map-signs' => __( 'map-signs', 'buildr' ),
            'fas fa-mars' => __( 'mars', 'buildr' ),
            'fas fa-mars-double' => __( 'mars-double', 'buildr' ),
            'fas fa-mars-stroke' => __( 'mars-stroke', 'buildr' ),
            'fas fa-mars-stroke-h' => __( 'mars-stroke-h', 'buildr' ),
            'fas fa-mars-stroke-v' => __( 'mars-stroke-v', 'buildr' ),
            'fab fa-maxcdn' => __( 'maxcdn', 'buildr' ),
            'fab fa-medapps' => __( 'medapps', 'buildr' ),
            'fab fa-medium' => __( 'medium', 'buildr' ),
            'fab fa-medium-m' => __( 'medium-m', 'buildr' ),
            'fas fa-medkit' => __( 'medkit', 'buildr' ),
            'fab fa-medrt' => __( 'medrt', 'buildr' ),
            'fab fa-meetup' => __( 'meetup', 'buildr' ),
            'fas fa-meh' => __( 'meh', 'buildr' ),
            'far fa-meh' => __( 'meh', 'buildr' ),
            'fas fa-mercury' => __( 'mercury', 'buildr' ),
            'fas fa-microchip' => __( 'microchip', 'buildr' ),
            'fas fa-microphone' => __( 'microphone', 'buildr' ),
            'fas fa-microphone-slash' => __( 'microphone-slash', 'buildr' ),
            'fab fa-microsoft' => __( 'microsoft', 'buildr' ),
            'fas fa-minus' => __( 'minus', 'buildr' ),
            'fas fa-minus-circle' => __( 'minus-circle', 'buildr' ),
            'fas fa-minus-square' => __( 'minus-square', 'buildr' ),
            'far fa-minus-square' => __( 'minus-square', 'buildr' ),
            'fab fa-mix' => __( 'mix', 'buildr' ),
            'fab fa-mixcloud' => __( 'mixcloud', 'buildr' ),
            'fab fa-mizuni' => __( 'mizuni', 'buildr' ),
            'fas fa-mobile' => __( 'mobile', 'buildr' ),
            'fas fa-mobile-alt' => __( 'mobile-alt', 'buildr' ),
            'fab fa-modx' => __( 'modx', 'buildr' ),
            'fab fa-monero' => __( 'monero', 'buildr' ),
            'fas fa-money-bill-alt' => __( 'money-bill-alt', 'buildr' ),
            'far fa-money-bill-alt' => __( 'money-bill-alt', 'buildr' ),
            'fas fa-moon' => __( 'moon', 'buildr' ),
            'far fa-moon' => __( 'moon', 'buildr' ),
            'fas fa-motorcycle' => __( 'motorcycle', 'buildr' ),
            'fas fa-mouse-pointer' => __( 'mouse-pointer', 'buildr' ),
            'fas fa-music' => __( 'music', 'buildr' ),
            'fab fa-napster' => __( 'napster', 'buildr' ),
            'fas fa-neuter' => __( 'neuter', 'buildr' ),
            'fas fa-newspaper' => __( 'newspaper', 'buildr' ),
            'far fa-newspaper' => __( 'newspaper', 'buildr' ),
            'fab fa-nintendo-switch' => __( 'nintendo-switch', 'buildr' ),
            'fab fa-node' => __( 'node', 'buildr' ),
            'fab fa-node-js' => __( 'node-js', 'buildr' ),
            'fas fa-notes-medical' => __( 'notes-medical', 'buildr' ),
            'fab fa-npm' => __( 'npm', 'buildr' ),
            'fab fa-ns8' => __( 'ns8', 'buildr' ),
            'fab fa-nutritionix' => __( 'nutritionix', 'buildr' ),
            'fas fa-object-group' => __( 'object-group', 'buildr' ),
            'far fa-object-group' => __( 'object-group', 'buildr' ),
            'fas fa-object-ungroup' => __( 'object-ungroup', 'buildr' ),
            'far fa-object-ungroup' => __( 'object-ungroup', 'buildr' ),
            'fab fa-odnoklassniki' => __( 'odnoklassniki', 'buildr' ),
            'fab fa-odnoklassniki-square' => __( 'odnoklassniki-square', 'buildr' ),
            'fab fa-opencart' => __( 'opencart', 'buildr' ),
            'fab fa-openid' => __( 'openid', 'buildr' ),
            'fab fa-opera' => __( 'opera', 'buildr' ),
            'fab fa-optin-monster' => __( 'optin-monster', 'buildr' ),
            'fab fa-osi' => __( 'osi', 'buildr' ),
            'fas fa-outdent' => __( 'outdent', 'buildr' ),
            'fab fa-page4' => __( 'page4', 'buildr' ),
            'fab fa-pagelines' => __( 'pagelines', 'buildr' ),
            'fas fa-paint-brush' => __( 'paint-brush', 'buildr' ),
            'fab fa-palfed' => __( 'palfed', 'buildr' ),
            'fas fa-pallet' => __( 'pallet', 'buildr' ),
            'fas fa-paper-plane' => __( 'paper-plane', 'buildr' ),
            'far fa-paper-plane' => __( 'paper-plane', 'buildr' ),
            'fas fa-paperclip' => __( 'paperclip', 'buildr' ),
            'fas fa-parachute-box' => __( 'parachute-box', 'buildr' ),
            'fas fa-paragraph' => __( 'paragraph', 'buildr' ),
            'fas fa-paste' => __( 'paste', 'buildr' ),
            'fab fa-patreon' => __( 'patreon', 'buildr' ),
            'fas fa-pause' => __( 'pause', 'buildr' ),
            'fas fa-pause-circle' => __( 'pause-circle', 'buildr' ),
            'far fa-pause-circle' => __( 'pause-circle', 'buildr' ),
            'fas fa-paw' => __( 'paw', 'buildr' ),
            'fab fa-paypal' => __( 'paypal', 'buildr' ),
            'fas fa-pen-square' => __( 'pen-square', 'buildr' ),
            'fas fa-pencil-alt' => __( 'pencil-alt', 'buildr' ),
            'fas fa-people-carry' => __( 'people-carry', 'buildr' ),
            'fas fa-percent' => __( 'percent', 'buildr' ),
            'fab fa-periscope' => __( 'periscope', 'buildr' ),
            'fab fa-phabricator' => __( 'phabricator', 'buildr' ),
            'fab fa-phoenix-framework' => __( 'phoenix-framework', 'buildr' ),
            'fas fa-phone' => __( 'phone', 'buildr' ),
            'fas fa-phone-slash' => __( 'phone-slash', 'buildr' ),
            'fas fa-phone-square' => __( 'phone-square', 'buildr' ),
            'fas fa-phone-volume' => __( 'phone-volume', 'buildr' ),
            'fab fa-php' => __( 'php', 'buildr' ),
            'fab fa-pied-piper' => __( 'pied-piper', 'buildr' ),
            'fab fa-pied-piper-alt' => __( 'pied-piper-alt', 'buildr' ),
            'fab fa-pied-piper-hat' => __( 'pied-piper-hat', 'buildr' ),
            'fab fa-pied-piper-pp' => __( 'pied-piper-pp', 'buildr' ),
            'fas fa-piggy-bank' => __( 'piggy-bank', 'buildr' ),
            'fas fa-pills' => __( 'pills', 'buildr' ),
            'fab fa-pinterest' => __( 'pinterest', 'buildr' ),
            'fab fa-pinterest-p' => __( 'pinterest-p', 'buildr' ),
            'fab fa-pinterest-square' => __( 'pinterest-square', 'buildr' ),
            'fas fa-plane' => __( 'plane', 'buildr' ),
            'fas fa-play' => __( 'play', 'buildr' ),
            'fas fa-play-circle' => __( 'play-circle', 'buildr' ),
            'far fa-play-circle' => __( 'play-circle', 'buildr' ),
            'fab fa-playstation' => __( 'playstation', 'buildr' ),
            'fas fa-plug' => __( 'plug', 'buildr' ),
            'fas fa-plus' => __( 'plus', 'buildr' ),
            'fas fa-plus-circle' => __( 'plus-circle', 'buildr' ),
            'fas fa-plus-square' => __( 'plus-square', 'buildr' ),
            'far fa-plus-square' => __( 'plus-square', 'buildr' ),
            'fas fa-podcast' => __( 'podcast', 'buildr' ),
            'fas fa-poo' => __( 'poo', 'buildr' ),
            'fas fa-pound-sign' => __( 'pound-sign', 'buildr' ),
            'fas fa-power-off' => __( 'power-off', 'buildr' ),
            'fas fa-prescription-bottle' => __( 'prescription-bottle', 'buildr' ),
            'fas fa-prescription-bottle-alt' => __( 'prescription-bottle-alt', 'buildr' ),
            'fas fa-print' => __( 'print', 'buildr' ),
            'fas fa-procedures' => __( 'procedures', 'buildr' ),
            'fab fa-product-hunt' => __( 'product-hunt', 'buildr' ),
            'fab fa-pushed' => __( 'pushed', 'buildr' ),
            'fas fa-puzzle-piece' => __( 'puzzle-piece', 'buildr' ),
            'fab fa-python' => __( 'python', 'buildr' ),
            'fab fa-qq' => __( 'qq', 'buildr' ),
            'fas fa-qrcode' => __( 'qrcode', 'buildr' ),
            'fas fa-question' => __( 'question', 'buildr' ),
            'fas fa-question-circle' => __( 'question-circle', 'buildr' ),
            'far fa-question-circle' => __( 'question-circle', 'buildr' ),
            'fas fa-quidditch' => __( 'quidditch', 'buildr' ),
            'fab fa-quinscape' => __( 'quinscape', 'buildr' ),
            'fab fa-quora' => __( 'quora', 'buildr' ),
            'fas fa-quote-left' => __( 'quote-left', 'buildr' ),
            'fas fa-quote-right' => __( 'quote-right', 'buildr' ),
            'fas fa-random' => __( 'random', 'buildr' ),
            'fab fa-ravelry' => __( 'ravelry', 'buildr' ),
            'fab fa-react' => __( 'react', 'buildr' ),
            'fab fa-readme' => __( 'readme', 'buildr' ),
            'fab fa-rebel' => __( 'rebel', 'buildr' ),
            'fas fa-recycle' => __( 'recycle', 'buildr' ),
            'fab fa-red-river' => __( 'red-river', 'buildr' ),
            'fab fa-reddit' => __( 'reddit', 'buildr' ),
            'fab fa-reddit-alien' => __( 'reddit-alien', 'buildr' ),
            'fab fa-reddit-square' => __( 'reddit-square', 'buildr' ),
            'fas fa-redo' => __( 'redo', 'buildr' ),
            'fas fa-redo-alt' => __( 'redo-alt', 'buildr' ),
            'fas fa-registered' => __( 'registered', 'buildr' ),
            'far fa-registered' => __( 'registered', 'buildr' ),
            'fab fa-rendact' => __( 'rendact', 'buildr' ),
            'fab fa-renren' => __( 'renren', 'buildr' ),
            'fas fa-reply' => __( 'reply', 'buildr' ),
            'fas fa-reply-all' => __( 'reply-all', 'buildr' ),
            'fab fa-replyd' => __( 'replyd', 'buildr' ),
            'fab fa-resolving' => __( 'resolving', 'buildr' ),
            'fas fa-retweet' => __( 'retweet', 'buildr' ),
            'fas fa-ribbon' => __( 'ribbon', 'buildr' ),
            'fas fa-road' => __( 'road', 'buildr' ),
            'fas fa-rocket' => __( 'rocket', 'buildr' ),
            'fab fa-rocketchat' => __( 'rocketchat', 'buildr' ),
            'fab fa-rockrms' => __( 'rockrms', 'buildr' ),
            'fas fa-rss' => __( 'rss', 'buildr' ),
            'fas fa-rss-square' => __( 'rss-square', 'buildr' ),
            'fas fa-ruble-sign' => __( 'ruble-sign', 'buildr' ),
            'fas fa-rupee-sign' => __( 'rupee-sign', 'buildr' ),
            'fab fa-safari' => __( 'safari', 'buildr' ),
            'fab fa-sass' => __( 'sass', 'buildr' ),
            'fas fa-save' => __( 'save', 'buildr' ),
            'far fa-save' => __( 'save', 'buildr' ),
            'fab fa-schlix' => __( 'schlix', 'buildr' ),
            'fab fa-scribd' => __( 'scribd', 'buildr' ),
            'fas fa-search' => __( 'search', 'buildr' ),
            'fas fa-search-minus' => __( 'search-minus', 'buildr' ),
            'fas fa-search-plus' => __( 'search-plus', 'buildr' ),
            'fab fa-searchengin' => __( 'searchengin', 'buildr' ),
            'fas fa-seedling' => __( 'seedling', 'buildr' ),
            'fab fa-sellcast' => __( 'sellcast', 'buildr' ),
            'fab fa-sellsy' => __( 'sellsy', 'buildr' ),
            'fas fa-server' => __( 'server', 'buildr' ),
            'fab fa-servicestack' => __( 'servicestack', 'buildr' ),
            'fas fa-share' => __( 'share', 'buildr' ),
            'fas fa-share-alt' => __( 'share-alt', 'buildr' ),
            'fas fa-share-alt-square' => __( 'share-alt-square', 'buildr' ),
            'fas fa-share-square' => __( 'share-square', 'buildr' ),
            'far fa-share-square' => __( 'share-square', 'buildr' ),
            'fas fa-shekel-sign' => __( 'shekel-sign', 'buildr' ),
            'fas fa-shield-alt' => __( 'shield-alt', 'buildr' ),
            'fas fa-ship' => __( 'ship', 'buildr' ),
            'fas fa-shipping-fast' => __( 'shipping-fast', 'buildr' ),
            'fab fa-shirtsinbulk' => __( 'shirtsinbulk', 'buildr' ),
            'fas fa-shopping-bag' => __( 'shopping-bag', 'buildr' ),
            'fas fa-shopping-basket' => __( 'shopping-basket', 'buildr' ),
            'fas fa-shopping-cart' => __( 'shopping-cart', 'buildr' ),
            'fas fa-shower' => __( 'shower', 'buildr' ),
            'fas fa-sign' => __( 'sign', 'buildr' ),
            'fas fa-sign-in-alt' => __( 'sign-in-alt', 'buildr' ),
            'fas fa-sign-language' => __( 'sign-language', 'buildr' ),
            'fas fa-sign-out-alt' => __( 'sign-out-alt', 'buildr' ),
            'fas fa-signal' => __( 'signal', 'buildr' ),
            'fab fa-simplybuilt' => __( 'simplybuilt', 'buildr' ),
            'fab fa-sistrix' => __( 'sistrix', 'buildr' ),
            'fas fa-sitemap' => __( 'sitemap', 'buildr' ),
            'fab fa-skyatlas' => __( 'skyatlas', 'buildr' ),
            'fab fa-skype' => __( 'skype', 'buildr' ),
            'fab fa-slack' => __( 'slack', 'buildr' ),
            'fab fa-slack-hash' => __( 'slack-hash', 'buildr' ),
            'fas fa-sliders-h' => __( 'sliders-h', 'buildr' ),
            'fab fa-slideshare' => __( 'slideshare', 'buildr' ),
            'fas fa-smile' => __( 'smile', 'buildr' ),
            'far fa-smile' => __( 'smile', 'buildr' ),
            'fas fa-smoking' => __( 'smoking', 'buildr' ),
            'fab fa-snapchat' => __( 'snapchat', 'buildr' ),
            'fab fa-snapchat-ghost' => __( 'snapchat-ghost', 'buildr' ),
            'fab fa-snapchat-square' => __( 'snapchat-square', 'buildr' ),
            'fas fa-snowflake' => __( 'snowflake', 'buildr' ),
            'far fa-snowflake' => __( 'snowflake', 'buildr' ),
            'fas fa-sort' => __( 'sort', 'buildr' ),
            'fas fa-sort-alpha-down' => __( 'sort-alpha-down', 'buildr' ),
            'fas fa-sort-alpha-up' => __( 'sort-alpha-up', 'buildr' ),
            'fas fa-sort-amount-down' => __( 'sort-amount-down', 'buildr' ),
            'fas fa-sort-amount-up' => __( 'sort-amount-up', 'buildr' ),
            'fas fa-sort-down' => __( 'sort-down', 'buildr' ),
            'fas fa-sort-numeric-down' => __( 'sort-numeric-down', 'buildr' ),
            'fas fa-sort-numeric-up' => __( 'sort-numeric-up', 'buildr' ),
            'fas fa-sort-up' => __( 'sort-up', 'buildr' ),
            'fab fa-soundcloud' => __( 'soundcloud', 'buildr' ),
            'fas fa-space-shuttle' => __( 'space-shuttle', 'buildr' ),
            'fab fa-speakap' => __( 'speakap', 'buildr' ),
            'fas fa-spinner' => __( 'spinner', 'buildr' ),
            'fab fa-spotify' => __( 'spotify', 'buildr' ),
            'fas fa-square' => __( 'square', 'buildr' ),
            'far fa-square' => __( 'square', 'buildr' ),
            'fas fa-square-full' => __( 'square-full', 'buildr' ),
            'fab fa-stack-exchange' => __( 'stack-exchange', 'buildr' ),
            'fab fa-stack-overflow' => __( 'stack-overflow', 'buildr' ),
            'fas fa-star' => __( 'star', 'buildr' ),
            'far fa-star' => __( 'star', 'buildr' ),
            'fas fa-star-half' => __( 'star-half', 'buildr' ),
            'far fa-star-half' => __( 'star-half', 'buildr' ),
            'fab fa-staylinked' => __( 'staylinked', 'buildr' ),
            'fab fa-steam' => __( 'steam', 'buildr' ),
            'fab fa-steam-square' => __( 'steam-square', 'buildr' ),
            'fab fa-steam-symbol' => __( 'steam-symbol', 'buildr' ),
            'fas fa-step-backward' => __( 'step-backward', 'buildr' ),
            'fas fa-step-forward' => __( 'step-forward', 'buildr' ),
            'fas fa-stethoscope' => __( 'stethoscope', 'buildr' ),
            'fab fa-sticker-mule' => __( 'sticker-mule', 'buildr' ),
            'fas fa-sticky-note' => __( 'sticky-note', 'buildr' ),
            'far fa-sticky-note' => __( 'sticky-note', 'buildr' ),
            'fas fa-stop' => __( 'stop', 'buildr' ),
            'fas fa-stop-circle' => __( 'stop-circle', 'buildr' ),
            'far fa-stop-circle' => __( 'stop-circle', 'buildr' ),
            'fas fa-stopwatch' => __( 'stopwatch', 'buildr' ),
            'fab fa-strava' => __( 'strava', 'buildr' ),
            'fas fa-street-view' => __( 'street-view', 'buildr' ),
            'fas fa-strikethrough' => __( 'strikethrough', 'buildr' ),
            'fab fa-stripe' => __( 'stripe', 'buildr' ),
            'fab fa-stripe-s' => __( 'stripe-s', 'buildr' ),
            'fab fa-studiovinari' => __( 'studiovinari', 'buildr' ),
            'fab fa-stumbleupon' => __( 'stumbleupon', 'buildr' ),
            'fab fa-stumbleupon-circle' => __( 'stumbleupon-circle', 'buildr' ),
            'fas fa-subscript' => __( 'subscript', 'buildr' ),
            'fas fa-subway' => __( 'subway', 'buildr' ),
            'fas fa-suitcase' => __( 'suitcase', 'buildr' ),
            'fas fa-sun' => __( 'sun', 'buildr' ),
            'far fa-sun' => __( 'sun', 'buildr' ),
            'fab fa-superpowers' => __( 'superpowers', 'buildr' ),
            'fas fa-superscript' => __( 'superscript', 'buildr' ),
            'fab fa-supple' => __( 'supple', 'buildr' ),
            'fas fa-sync' => __( 'sync', 'buildr' ),
            'fas fa-sync-alt' => __( 'sync-alt', 'buildr' ),
            'fas fa-syringe' => __( 'syringe', 'buildr' ),
            'fas fa-table' => __( 'table', 'buildr' ),
            'fas fa-table-tennis' => __( 'table-tennis', 'buildr' ),
            'fas fa-tablet' => __( 'tablet', 'buildr' ),
            'fas fa-tablet-alt' => __( 'tablet-alt', 'buildr' ),
            'fas fa-tablets' => __( 'tablets', 'buildr' ),
            'fas fa-tachometer-alt' => __( 'tachometer-alt', 'buildr' ),
            'fas fa-tag' => __( 'tag', 'buildr' ),
            'fas fa-tags' => __( 'tags', 'buildr' ),
            'fas fa-tape' => __( 'tape', 'buildr' ),
            'fas fa-tasks' => __( 'tasks', 'buildr' ),
            'fas fa-taxi' => __( 'taxi', 'buildr' ),
            'fab fa-telegram' => __( 'telegram', 'buildr' ),
            'fab fa-telegram-plane' => __( 'telegram-plane', 'buildr' ),
            'fab fa-tencent-weibo' => __( 'tencent-weibo', 'buildr' ),
            'fas fa-terminal' => __( 'terminal', 'buildr' ),
            'fas fa-text-height' => __( 'text-height', 'buildr' ),
            'fas fa-text-width' => __( 'text-width', 'buildr' ),
            'fas fa-th' => __( 'th', 'buildr' ),
            'fas fa-th-large' => __( 'th-large', 'buildr' ),
            'fas fa-th-list' => __( 'th-list', 'buildr' ),
            'fab fa-themeisle' => __( 'themeisle', 'buildr' ),
            'fas fa-thermometer' => __( 'thermometer', 'buildr' ),
            'fas fa-thermometer-empty' => __( 'thermometer-empty', 'buildr' ),
            'fas fa-thermometer-full' => __( 'thermometer-full', 'buildr' ),
            'fas fa-thermometer-half' => __( 'thermometer-half', 'buildr' ),
            'fas fa-thermometer-quarter' => __( 'thermometer-quarter', 'buildr' ),
            'fas fa-thermometer-three-quarters' => __( 'thermometer-three-quarters', 'buildr' ),
            'fas fa-thumbs-down' => __( 'thumbs-down', 'buildr' ),
            'far fa-thumbs-down' => __( 'thumbs-down', 'buildr' ),
            'fas fa-thumbs-up' => __( 'thumbs-up', 'buildr' ),
            'far fa-thumbs-up' => __( 'thumbs-up', 'buildr' ),
            'fas fa-thumbtack' => __( 'thumbtack', 'buildr' ),
            'fas fa-ticket-alt' => __( 'ticket-alt', 'buildr' ),
            'fas fa-times' => __( 'times', 'buildr' ),
            'fas fa-times-circle' => __( 'times-circle', 'buildr' ),
            'far fa-times-circle' => __( 'times-circle', 'buildr' ),
            'fas fa-tint' => __( 'tint', 'buildr' ),
            'fas fa-toggle-off' => __( 'toggle-off', 'buildr' ),
            'fas fa-toggle-on' => __( 'toggle-on', 'buildr' ),
            'fas fa-trademark' => __( 'trademark', 'buildr' ),
            'fas fa-train' => __( 'train', 'buildr' ),
            'fas fa-transgender' => __( 'transgender', 'buildr' ),
            'fas fa-transgender-alt' => __( 'transgender-alt', 'buildr' ),
            'fas fa-trash' => __( 'trash', 'buildr' ),
            'fas fa-trash-alt' => __( 'trash-alt', 'buildr' ),
            'far fa-trash-alt' => __( 'trash-alt', 'buildr' ),
            'fas fa-tree' => __( 'tree', 'buildr' ),
            'fab fa-trello' => __( 'trello', 'buildr' ),
            'fab fa-tripadvisor' => __( 'tripadvisor', 'buildr' ),
            'fas fa-trophy' => __( 'trophy', 'buildr' ),
            'fas fa-truck' => __( 'truck', 'buildr' ),
            'fas fa-truck-loading' => __( 'truck-loading', 'buildr' ),
            'fas fa-truck-moving' => __( 'truck-moving', 'buildr' ),
            'fas fa-tty' => __( 'tty', 'buildr' ),
            'fab fa-tumblr' => __( 'tumblr', 'buildr' ),
            'fab fa-tumblr-square' => __( 'tumblr-square', 'buildr' ),
            'fas fa-tv' => __( 'tv', 'buildr' ),
            'fab fa-twitch' => __( 'twitch', 'buildr' ),
            'fab fa-twitter' => __( 'twitter', 'buildr' ),
            'fab fa-twitter-square' => __( 'twitter-square', 'buildr' ),
            'fab fa-typo3' => __( 'typo3', 'buildr' ),
            'fab fa-uber' => __( 'uber', 'buildr' ),
            'fab fa-uikit' => __( 'uikit', 'buildr' ),
            'fas fa-umbrella' => __( 'umbrella', 'buildr' ),
            'fas fa-underline' => __( 'underline', 'buildr' ),
            'fas fa-undo' => __( 'undo', 'buildr' ),
            'fas fa-undo-alt' => __( 'undo-alt', 'buildr' ),
            'fab fa-uniregistry' => __( 'uniregistry', 'buildr' ),
            'fas fa-universal-access' => __( 'universal-access', 'buildr' ),
            'fas fa-university' => __( 'university', 'buildr' ),
            'fas fa-unlink' => __( 'unlink', 'buildr' ),
            'fas fa-unlock' => __( 'unlock', 'buildr' ),
            'fas fa-unlock-alt' => __( 'unlock-alt', 'buildr' ),
            'fab fa-untappd' => __( 'untappd', 'buildr' ),
            'fas fa-upload' => __( 'upload', 'buildr' ),
            'fab fa-usb' => __( 'usb', 'buildr' ),
            'fas fa-user' => __( 'user', 'buildr' ),
            'far fa-user' => __( 'user', 'buildr' ),
            'fas fa-user-circle' => __( 'user-circle', 'buildr' ),
            'far fa-user-circle' => __( 'user-circle', 'buildr' ),
            'fas fa-user-md' => __( 'user-md', 'buildr' ),
            'fas fa-user-plus' => __( 'user-plus', 'buildr' ),
            'fas fa-user-secret' => __( 'user-secret', 'buildr' ),
            'fas fa-user-times' => __( 'user-times', 'buildr' ),
            'fas fa-users' => __( 'users', 'buildr' ),
            'fab fa-ussunnah' => __( 'ussunnah', 'buildr' ),
            'fas fa-utensil-spoon' => __( 'utensil-spoon', 'buildr' ),
            'fas fa-utensils' => __( 'utensils', 'buildr' ),
            'fab fa-vaadin' => __( 'vaadin', 'buildr' ),
            'fas fa-venus' => __( 'venus', 'buildr' ),
            'fas fa-venus-double' => __( 'venus-double', 'buildr' ),
            'fas fa-venus-mars' => __( 'venus-mars', 'buildr' ),
            'fab fa-viacoin' => __( 'viacoin', 'buildr' ),
            'fab fa-viadeo' => __( 'viadeo', 'buildr' ),
            'fab fa-viadeo-square' => __( 'viadeo-square', 'buildr' ),
            'fas fa-vial' => __( 'vial', 'buildr' ),
            'fas fa-vials' => __( 'vials', 'buildr' ),
            'fab fa-viber' => __( 'viber', 'buildr' ),
            'fas fa-video' => __( 'video', 'buildr' ),
            'fas fa-video-slash' => __( 'video-slash', 'buildr' ),
            'fab fa-vimeo' => __( 'vimeo', 'buildr' ),
            'fab fa-vimeo-square' => __( 'vimeo-square', 'buildr' ),
            'fab fa-vimeo-v' => __( 'vimeo-v', 'buildr' ),
            'fab fa-vine' => __( 'vine', 'buildr' ),
            'fab fa-vk' => __( 'vk', 'buildr' ),
            'fab fa-vnv' => __( 'vnv', 'buildr' ),
            'fas fa-volleyball-ball' => __( 'volleyball-ball', 'buildr' ),
            'fas fa-volume-down' => __( 'volume-down', 'buildr' ),
            'fas fa-volume-off' => __( 'volume-off', 'buildr' ),
            'fas fa-volume-up' => __( 'volume-up', 'buildr' ),
            'fab fa-vuejs' => __( 'vuejs', 'buildr' ),
            'fas fa-warehouse' => __( 'warehouse', 'buildr' ),
            'fab fa-weibo' => __( 'weibo', 'buildr' ),
            'fas fa-weight' => __( 'weight', 'buildr' ),
            'fab fa-weixin' => __( 'weixin', 'buildr' ),
            'fab fa-whatsapp' => __( 'whatsapp', 'buildr' ),
            'fab fa-whatsapp-square' => __( 'whatsapp-square', 'buildr' ),
            'fas fa-wheelchair' => __( 'wheelchair', 'buildr' ),
            'fab fa-whmcs' => __( 'whmcs', 'buildr' ),
            'fas fa-wifi' => __( 'wifi', 'buildr' ),
            'fab fa-wikipedia-w' => __( 'wikipedia-w', 'buildr' ),
            'fas fa-window-close' => __( 'window-close', 'buildr' ),
            'far fa-window-close' => __( 'window-close', 'buildr' ),
            'fas fa-window-maximize' => __( 'window-maximize', 'buildr' ),
            'far fa-window-maximize' => __( 'window-maximize', 'buildr' ),
            'fas fa-window-minimize' => __( 'window-minimize', 'buildr' ),
            'far fa-window-minimize' => __( 'window-minimize', 'buildr' ),
            'fas fa-window-restore' => __( 'window-restore', 'buildr' ),
            'far fa-window-restore' => __( 'window-restore', 'buildr' ),
            'fab fa-windows' => __( 'windows', 'buildr' ),
            'fas fa-wine-glass' => __( 'wine-glass', 'buildr' ),
            'fas fa-won-sign' => __( 'won-sign', 'buildr' ),
            'fab fa-wordpress' => __( 'wordpress', 'buildr' ),
            'fab fa-wordpress-simple' => __( 'wordpress-simple', 'buildr' ),
            'fab fa-wpbeginner' => __( 'wpbeginner', 'buildr' ),
            'fab fa-wpexplorer' => __( 'wpexplorer', 'buildr' ),
            'fab fa-wpforms' => __( 'wpforms', 'buildr' ),
            'fas fa-wrench' => __( 'wrench', 'buildr' ),
            'fas fa-x-ray' => __( 'x-ray', 'buildr' ),
            'fab fa-xbox' => __( 'xbox', 'buildr' ),
            'fab fa-xing' => __( 'xing', 'buildr' ),
            'fab fa-xing-square' => __( 'xing-square', 'buildr' ),
            'fab fa-y-combinator' => __( 'y-combinator', 'buildr' ),
            'fab fa-yahoo' => __( 'yahoo', 'buildr' ),
            'fab fa-yandex' => __( 'yandex', 'buildr' ),
            'fab fa-yandex-international' => __( 'yandex-international', 'buildr' ),
            'fab fa-yelp' => __( 'yelp', 'buildr' ),
            'fas fa-yen-sign' => __( 'yen-sign', 'buildr' ),
            'fab fa-yoast' => __( 'yoast', 'buildr' ),
            'fab fa-youtube' => __( 'youtube', 'buildr' ),
            'fab fa-youtube-square' => __( 'youtube-square', 'buildr' ),
        );


        return apply_filters( 'WPADMINSETTINGS_FONTAWESOME_ARRAY', $fonts_arr );
    }

	
}

}


if( ! class_exists( 'Pick_error' ) ) {
	class Pick_error extends Exception { 

		public function __construct($message, $code = 0, Exception $previous = null) {
			parent::__construct($message, $code, $previous);
		}
		
		public function get_error_message(){
			
			return "<p class='notice notice-error' style='padding: 10px;'>{$this->getMessage()}</p>";
		}
	}
}