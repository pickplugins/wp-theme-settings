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
			    if( isset($option['type']) && $option['type'] === 'select' ) 		$this->generate_field_select( $option );
            elseif( isset($option['type']) && $option['type'] === 'select_multi')	$this->generate_field_select_multi( $option );
            elseif( isset($option['type']) && $option['type'] === 'select2')	    $this->generate_field_select2( $option );
            elseif( isset($option['type']) && $option['type'] === 'thumb_sizes')	$this->generate_field_thumb_sizes( $option );
			elseif( isset($option['type']) && $option['type'] === 'checkbox')	    $this->generate_field_checkbox( $option );
			elseif( isset($option['type']) && $option['type'] === 'radio')		    $this->generate_field_radio( $option );
			elseif( isset($option['type']) && $option['type'] === 'textarea')	    $this->generate_field_textarea( $option );
			elseif( isset($option['type']) && $option['type'] === 'number' ) 	    $this->generate_field_number( $option );
			elseif( isset($option['type']) && $option['type'] === 'text' ) 		    $this->generate_field_text( $option );
            elseif( isset($option['type']) && $option['type'] === 'text_multi' ) 	$this->generate_field_text_multi( $option );
            elseif( isset($option['type']) && $option['type'] === 'range' ) 	    $this->generate_field_range( $option );
            elseif( isset($option['type']) && $option['type'] === 'range_input' ) 	$this->generate_field_range_input( $option );
			elseif( isset($option['type']) && $option['type'] === 'colorpicker')    $this->generate_field_colorpicker( $option );
			elseif( isset($option['type']) && $option['type'] === 'datepicker')	    $this->generate_field_datepicker( $option );
            elseif( isset($option['type']) && $option['type'] === 'faq')	        $this->generate_field_faq( $option );
            elseif( isset($option['type']) && $option['type'] === 'grid')	        $this->generate_field_grid( $option );
            elseif( isset($option['type']) && $option['type'] === 'custom_html')	$this->generate_field_custom_html( $option );
            elseif( isset($option['type']) && $option['type'] === 'media')		    $this->generate_media( $option );
            elseif( isset($option['type']) && $option['type'] === 'media_multi')    $this->generate_media_multi( $option );
            elseif( isset($option['type']) && $option['type'] === 'repeatable')	    $this->generate_repeatable( $option );
            elseif( isset($option['type']) && $option['type'] === 'wp_editor')	    $this->generate_wp_editor( $option );
            elseif( isset($option['type']) && $option['type'] === 'link_color')	    $this->generate_field_link_color( $option );
            elseif( isset($option['type']) && $option['type'] === 'switch')	        $this->generate_field_switch( $option );






			elseif( isset($option['type']) && $option['type'] === $type ) 	do_action( "wp_admin_settings_custom_field_$type", $option );

			if( !empty( $details ) ) echo "<p class='description'>$details</p>";
		
		}
		catch(Pick_error $e) {
			echo $e->get_error_message();
		}
	}



    public function generate_media( $option ){

        $id			= isset( $option['id'] ) ? $option['id'] : "";
        $value		= get_option( $id );
        $media_url	= wp_get_attachment_url( $value );
        $media_type	= get_post_mime_type( $value );
        $media_title= get_the_title( $value );

        wp_enqueue_media();

        echo "<div class='media_preview' style='width: 150px;margin-bottom: 10px;background: #d2d2d2;padding: 15px 5px;    text-align: center;border-radius: 5px;'>";

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













	public function generate_field_datepicker( $option ){
		
		$id 			= isset( $option['id'] ) ? $option['id'] : "";
		$placeholder 	= isset( $option['placeholder'] ) ? $option['placeholder'] : "";
		$value 	 		= get_option( $id );
		

		//var_dump(plugins_url('/', __FILE__));
		
		echo "<input type='text' class='regular-text' name='$id' id='$id' placeholder='$placeholder' value='$value' />";
		
	
		echo "<script>jQuery(document).ready(function($) { $('#$id').datepicker({dateFormat : 'dd-mm-yy'});});</script>";
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
        $default 	= isset( $option['default'] ) ? $option['default'] : "";;

        $value = !empty($value) ? $value : $default;

		echo "<input type='text' class='regular-text' name='$id' id='$id' placeholder='$placeholder' value='$value' />";
	}



    public function generate_field_text_multi( $option ){

        $id 			= isset( $option['id'] ) ? $option['id'] : "";
        $placeholder 	= isset( $option['placeholder'] ) ? $option['placeholder'] : "";
        $values 	 		= get_option( $id );


        //var_dump($values);
        ?>

        <script>jQuery(document).ready(function($) {
                html_<?php echo $id; ?> = '<div class=""><input type="text" class="regular-text" name="<?php echo $id?>[]"  placeholder="<?php echo $placeholder; ?>" value="" /><span class="button" onclick="$(this).parent().remove()">X</span></div>';
            });</script>

        <span class="button" onclick="$('#<?php echo $id; ?>').append(html_<?php echo $id; ?>)">Add</span>
        <div class="field-list" id="<?php echo $id; ?>">

            <?php
            if(!empty($values)):

                foreach ($values as $value):

                    ?>
                    <div class="">
                        <input type='text' class='regular-text' name='<?php echo $id?>[]'  placeholder='<?php echo $placeholder; ?>' value='<?php echo $value; ?>' /><span class="button" onclick="$(this).parent().remove()">X</span>
                    </div>
                    <?php

                endforeach;

            else:

                ?>
                <div class="">
                    <input type='text' class='regular-text' name='<?php echo $id?>[]'  placeholder='<?php echo $placeholder; ?>' value='' /><span class="button" onclick="$(this).parent().remove()">X</span>
                </div>
                <?php

            endif;

            ?>



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

                                    <?php if($type == 'text'):?>
                                    <input type="text" class="regular-text" name="<?php echo $id; ?>[<?php echo $index; ?>][<?php echo $item_id; ?>]" placeholder="" value="<?php echo esc_html($val[$item_id]); ?>">

                                    <?php elseif($type == 'select'):
                                        $args = isset($field['args']) ? $field['args'] : array();
                                        ?>
                                    <select class="">
                                        <?php foreach ($args as $argIndex => $argName):?>
                                        <option value="<?php echo $argIndex; ?>"><?php echo $argName; ?></option>

                                        <?php endforeach; ?>

                                    </select>


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
		$placeholder 	= isset( $option['placeholder'] ) ? $option['placeholder'] : "";
		$value 	 		= get_option( $id );
		
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
		
		$id 	= isset( $option['id'] ) ? $option['id'] : "";
		$args 	= isset( $option['args'] ) ? $option['args'] : array();	
		$args	= is_array( $args ) ? $args : $this->generate_args_from_string( $args );
		$value	= get_option( $id );
		
		echo "<select name='$id' id='$id'>";
		foreach( $args as $key => $name ):
			$selected = $value == $key ? "selected" : "";
			echo "<option $selected value='$key'>$name</option>";
		endforeach;
		echo "</select>";
	}

    public function generate_field_thumb_sizes( $option ){

        $id 	= isset( $option['id'] ) ? $option['id'] : "";
        $args 	= isset( $option['args'] ) ? $option['args'] : array();
        $args	= is_array( $args ) ? $args : $this->generate_args_from_string( $args );
        $value	= get_option( $id );

        $get_intermediate_image_sizes =  get_intermediate_image_sizes();
        $get_intermediate_image_sizes = array_merge($get_intermediate_image_sizes,array('full'));

        echo "<select name='$id' id='$id'>";
        foreach( $get_intermediate_image_sizes as $key => $name ):
            $selected = $value == $name ? "selected" : "";
            $size_key = str_replace('_', ' ',$name);
            $size_key = str_replace('-', ' ',$size_key);
            $size_name = ucfirst($size_key);

            echo "<option $selected value='$name'>$size_name</option>";
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
        $args 		= isset( $option['args'] ) ? $option['args'] : array();
        $args		= is_array( $args ) ? $args : $this->generate_args_from_string( $args, $option );
        $value		= get_option( $id );
        $multiple 	= isset( $option['multiple'] ) ? $option['multiple'] : '';


        if($multiple):
            $value = !empty($value) ? $value : array();
        endif;

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
		$args			= isset( $option['args'] ) ? $option['args'] : array();
		$args			= is_array( $args ) ? $args : $this->generate_args_from_string( $args );
		$option_value	= get_option( $id );


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

        $values 	 		= get_option( $id );

        ?>
        <div class="addons-grid">
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
		$args			= isset( $option['args'] ) ? $option['args'] : array();
		$args			= is_array( $args ) ? $args : $this->generate_args_from_string( $args );
		$option_value	= get_option( $id );

		echo "<fieldset>";
		foreach( $args as $key => $value ):

			$checked = is_array( $option_value ) && in_array( $key, $option_value ) ? "checked" : "";
			echo "<label for='$id-$key'><input name='{$id}[]' type='radio' id='$id-$key' value='$key' $checked>$value</label><br>";
				
		endforeach;
		echo "</fieldset>";
	}



    public function generate_field_switch( $option ){

        $id				= isset( $option['id'] ) ? $option['id'] : "";
        $args			= isset( $option['args'] ) ? $option['args'] : array();
        $args			= is_array( $args ) ? $args : $this->generate_args_from_string( $args );
        $option_value	= get_option( $id );



        ?>
        <div class="field-switch-wrapper field-switch-wrapper-<?php echo $id; ?>">
            <?php
            foreach( $args as $key => $value ):

                $checked = is_array( $option_value ) && in_array( $key, $option_value ) ? "checked" : "";
                ?><label class="<?php echo $checked; ?>" for='<?php echo $id; ?>-<?php echo $key; ?>'><input name='<?php echo $id; ?>[]' type='radio' id='<?php echo $id; ?>-<?php echo $key; ?>' value='<?php echo $key; ?>' <?php echo $checked; ?>><span class="sw-button"><?php echo $value; ?></span></label><?php

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
		if( strpos( $string, 'WPADMINSETTINGS_TAX_' ) !== false ) return $this->get_taxonomies_array( $string );
		
		
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