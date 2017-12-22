<?php

//MY Function 

function news_ticker_value($var,$def){
	$myvar = get_option($var);
	if($myvar){
		return $myvar;
	}
	else{
		return $def;
	}
}

//Shortcode Function Here
	
function simple_ticker_shortcodes($atts,$content){
	
	$tickershortcode_attr = shortcode_atts(
		array(
			'title'=>news_ticker_value('tickers_title','Breaking News:'),
			'per_page_item'=>news_ticker_value('per_page_item','5'),
			'post_type'=>news_ticker_value('post_type','post'),
			'title_color'=>news_ticker_value('title_color','#ffffff'),
			'items_color'=>news_ticker_value('items_color','#000000'),
			'title_bg_color'=>news_ticker_value('title_bg_color','#ff0000'),
			'items_bg_color'=>news_ticker_value('items_bg_color','#ffffff'),
			'effect_type'=>news_ticker_value('effect_type','fade')
		),$atts
	);
	$id=rand();
	extract($tickershortcode_attr);
	ob_start();
	?>
	
	<div class="ticker_title<?php echo $id;?>"><?php echo $title;?></div>
	<div id="ticker<?php echo $id;?>" class="ticker<?php echo $id;?>">
		<ul>
			<?php 
				$ticker_query_args = array(
					'post_type' => $post_type,
					'posts_per_page' => $per_page_item,
				);
				$ticker_posts = new WP_Query($ticker_query_args);
				if($ticker_posts->have_posts()): while($ticker_posts->have_posts()): $ticker_posts->the_post();
				?>
				<li><a href="<?php the_permalink();?>"><?php the_title();?></a></li>
				<?php endwhile;
				else: 
					?>
					<li><a href="">List Item One</a></li>
					<li><a href="">List Item Two</a></li>
					<li><a href="">List Item Three</a></li>
					<li><a href="">List Item Four</a></li>
					<li><a href="">List Item Five</a></li>
					<?php
				endif;
			
			?>
		</ul>
	</div>
	<style type="text/css">
		.ticker_title<?php echo $id;?>{border: 1px solid <?php echo $title_bg_color;?>;background: <?php echo $title_bg_color;?>;color:<?php echo $title_color;?>;float:left;font-size: 18px;padding:3px 10px;position: relative;}
		.ticker<?php echo $id;?>{border:1px solid <?php echo $title_bg_color;?>;border-left:0px solid <?php echo $title_bg_color;?>;background:<?php echo $items_bg_color;?>;position: relative;overflow: hidden;padding-left:20px;height:35px}
		.ticker<?php echo $id;?> ul{width: 100%;position: relative;}
		.ticker<?php echo $id;?> ul li{display:none;}
		.ticker<?php echo $id;?> ul li a{color:<?php echo $items_color;?>;border-bottom:0px solid #000;text-decoration:none;box-shadow:none;padding:5px;display:block}
		.ticker<?php echo $id;?> ul li a:hover{text-decoration:none;box-shadow:none}
		.ticker_title<?php echo $id;?>::before{background: <?php echo $title_bg_color;?>;content: "";height: 16px;margin-top: -8px;position: absolute;right: -8px;top: 50%;transform: rotate(45deg);width: 16px;z-index:999}
		.ticker<?php echo $id;?> a{text-decoration:none}
	</style>
	<script type="text/javascript">
		jQuery(function(){
			jQuery.simpleTicker(jQuery("#ticker<?php echo $id;?>"),{'effectType':'<?php echo $effect_type;?>'});
			jQuery('#ticker<?php echo $id;?>').removeAttr("style");
		});
	</script>
	<?php 
	wp_reset_query();
	return ob_get_clean();
	
	
}
add_shortcode('tickershortcode','simple_ticker_shortcodes');

