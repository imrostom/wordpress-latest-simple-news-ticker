<?php 

//Add News Ticker Menu In Settings Options
function newsticker_menu_options(){
	add_options_page('Simple NewsTicker Options','NewsTicker Options','manage_options','newsticker_options','newsticker_menu_options_cb');
}
add_action('admin_menu','newsticker_menu_options');

//News Ticker Callback Function

function newsticker_menu_options_cb(){
	echo "<div class='wrap'>";
	echo "<h1>Welcome To All Latest News Ticker Options</h1>";
	settings_errors('newsticker_options');
	?>
	<form action="options.php" method="post">
		<?php 
			settings_fields( 'tickers_groups' ); 
			do_settings_sections( 'ticker' );
		?>
		<?php submit_button();?>
	</form>
	<?php
	echo "</div>";
	?>
	<div class="wrap">
		<h1>Documentation For NewsTicker Plugin</h1>
		<h3>Your Just Put This Shortcode Any Where Our Below Shortcode <b style="color:red;font-size:20px;padding:3px">[tickershortcode]</b></h3>
		<h2>Use Can Use this Code<b><input style="width:100%" type="text" value='[tickershortcode title="News" per_page_item="3" post_type="page" title_color="#fff" items_color="#000" title_bg_color="blue" items_bg_color="#fff" effect_type="fade"]'/></b></h2>
	</div>
	<?php
}


/*Setting a Option Add */

function newsticker_menu_options_input(){
	register_setting('tickers_groups','tickers_title');
	register_setting('tickers_groups','per_page_item');
	register_setting('tickers_groups','post_type');
	register_setting('tickers_groups','title_color');
	register_setting('tickers_groups','items_color');
	register_setting('tickers_groups','title_bg_color');
	register_setting('tickers_groups','items_bg_color');
	register_setting('tickers_groups','effect_type');
	
	add_settings_section('ticker_option','News Ticker Options Settings','newsticker_menu_options_secction','ticker');
	
	add_settings_field('ticker_title','Ticker Title:','newsticker_options_title','ticker','ticker_option');
	add_settings_field('per_page_item','Per Page Item :','newsticker_options_per_page_item','ticker','ticker_option');
	add_settings_field('post_type','Post Type :','newsticker_options_post_type','ticker','ticker_option');
	add_settings_field('title_color','Ticker Font Color:','newsticker_options_title_color','ticker','ticker_option');
	add_settings_field('items_color','Items Font Color:','newsticker_options_items_color','ticker','ticker_option');
	add_settings_field('title_bg_color','Title Background Color:','newsticker_options_title_bg_color','ticker','ticker_option');
	add_settings_field('items_bg_color','Items Background Color :','newsticker_options_items_bg_color','ticker','ticker_option');
	add_settings_field('effect_type','Effect Type:','newsticker_options_effect_type','ticker','ticker_option');
	
	
}
add_action('admin_init','newsticker_menu_options_input');

function newsticker_options_title(){
		$tickers_title = get_option('tickers_title');
		?>
		<input type="text" name="tickers_title" value="<?php myifelse($tickers_title,'Breaking News :');?>" id="" />
		<?php
}

function newsticker_options_per_page_item(){
		$per_page_item = get_option('per_page_item');
		?>
		<input type="number" name="per_page_item" value="<?php myifelse($per_page_item,'6');?>" id="" />
		<?php
}

function newsticker_options_post_type(){
		$post_type = get_option('post_type');
		if($post_type){
			$post_type;
		}
		else{
			$post_type=array('post');
		}
		$args = array(
		   'show_in_nav_menus' =>true
		);
		$i=0;
		foreach(get_post_types($args) as $key=>$types){
		?>
		<input type="checkbox" id="mytickerposttype" name="post_type[]" value="<?php echo $key;?>" <?php if(in_array("$key", $post_type)){echo 'checked="checked"';}?>/><?php echo ucwords($types);
		}
		$i++;
}

function newsticker_options_title_color(){
		$title_color = get_option('title_color');
		?>
		<input type="text" data-default-color="#ffffff" class="simple_ticker_title_color" name="title_color" value="<?php myifelse($title_color,'#ffffff');?>" id="" />
		<?php
}

function newsticker_options_items_color(){
		$items_color = get_option('items_color');
		?>
		<input type="text" data-default-color="#000000" class="simple_ticker_items_color"  name="items_color" value="<?php myifelse($items_color,'#000000');?>" id="" />
		<?php
}

function newsticker_options_title_bg_color(){
		$title_bg_color = get_option('title_bg_color');
		?>
		<input type="text" data-default-color="#ff0000" class="simple_ticker_title_bg_color"  name="title_bg_color" value="<?php myifelse($title_bg_color,'#ff0000');?>" id="" />
		<?php
}

function newsticker_options_items_bg_color(){
		$items_bg_color = get_option('items_bg_color');
		?>
		<input type="text" data-default-color="#ffffff" class="simple_ticker_items_bg_color"  name="items_bg_color" value="<?php myifelse($items_bg_color,'#ffffff');?>" id="" />
		<?php
}

function newsticker_options_effect_type(){
		$effect_type = get_option('effect_type');
		?>
		<input type="radio" name="effect_type" value="fade" <?php checked('fade',get_option('effect_type'),true);?> id=""/>Fade
		<input type="radio" name="effect_type" value="roll" <?php checked('roll',get_option('effect_type'),true);?> id=""/>Roll
		<input type="radio" name="effect_type" value="slide" <?php checked('slide',get_option('effect_type'),true);?> id=""/>Slide
		
		<?php
}



function newsticker_menu_options_secction(){
	echo "Add Here Your Information";
}

//My function
function myifelse($cond,$text){
	if($cond){
		echo $cond;
	}
	else{
		echo $text;
	}
}

