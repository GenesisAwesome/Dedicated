<?php
/**
 * Dedicated Child Theme functions
 * 
 * Child Theme functions for Genesis by GenesisAwesome.com
 * 
 * @package Genesis Child Theme
 * @author  Harish Dasari
 * @version 1.0
 * @link    http://www.genesisawesome.com/
 */

/**
 * GenesisAwesome Constents
 * 
 * @since 1.0
 */
define( 'CHILD_THEME_NAME', 'Dedicated' );
define( 'CHILD_THEME_URL', 'http://www.genesisawesome.com/themes/dedicated-genesis-child-theme/' );
define( 'CHILD_THEME_VER', '1.2' );
define( 'GA_CHILDTHEME_FIELD', 'genesisawesome_dedicated_settings' );

add_action( 'genesis_init', 'genesisawesome_childtheme_init', 20 );
/**
 * GenesisAwesome Child Theme init
 * 
 * @since 1.0
 * 
 * @return null
 */
function genesisawesome_childtheme_init() {

	/* Load HTML5 for Genesis Child Theme */
	require_once( CHILD_DIR . '/lib/genesisawesome-html5.php' );

	/* Load GenesisAwesome Settings Page class */
	require_once( CHILD_DIR . '/lib/genesisawesome-settings.php' );

	/* Load GenesisAwesome Flexslider */
	require_once( CHILD_DIR . '/lib/genesisawesome-slider.php' );

	/* Load Genesis Awesome Widgets */
	require_once( CHILD_DIR . '/lib/widgets/widget-facebook-likebox.php' );
	require_once( CHILD_DIR . '/lib/widgets/widget-flickr.php' );

	/* Add GenesisAwesome Theme supports */
	add_theme_support( 'genesis-footer-widgets', 3 );
	add_theme_support( 'genesis-menus', array( 'primary' => __( 'Primary Navigation', 'genesisawesome' ), 'footernav' => __( 'Footer Navigation Links', 'genesisawesome' ) ) );

	/* Register new Image sizes */
	add_image_size( 'dedicated-slider-image', 980, 350, true );
	add_image_size( 'dedicated-post-image', 630, 220, true );
	
	/* Load Parent Theme Stylesheet */
	add_action( 'genesis_meta', 'genesisawesome_parent_stylesheet', 0 );

	/* Header Right Content. Social Icons and Search */
	add_action( 'genesis_header_right', 'genesisawesome_do_header_right' );

	/* Load Styles and Stykes for Genesis Child Theme */
	add_action( 'wp_enqueue_styles', 'genesisawesome_childtheme_styles' );
	add_action( 'wp_enqueue_scripts', 'genesisawesome_childtheme_scripts' );

	/* Load inline Styles and Scripts for Genesis Child Theme */
	add_action( 'wp_head', 'genesisawesome_childtheme_inline_styles' );
	add_action( 'wp_footer', 'genesisawesome_childtheme_inline_scripts' );

	/* Remove Default Post Image */
	remove_action( 'genesis_post_content', 'genesis_do_post_image' );
	/* Add Custom Post Image */
	add_action( 'genesis_post_content', 'genesisawesome_do_post_image', 1 );

	/* Init Custom GenesisAwesome Widgets */
	add_action( 'widgets_init', 'genesisawesome_custom_widgets' );

	/* Post Share and Sunscribe Boxes */
	add_action( 'genesis_after_post_content', 'genesisawesome_subscribe_sharebox' );

}

add_action( 'after_setup_theme', 'genesisawesome_childtheme_setup' );
/**
 * GensisAwesome Child Theme Setup
 * 
 * Instantiate Child theme settings page and Localization.
 * 
 * @since 1.0
 * 
 * @return null
 */
function genesisawesome_childtheme_setup() {

	$GLOBALS['_genesisawesome_childtheme_settings'] = new GenesisAwesome_Childtheme_Settings;

	/* Loalization */
	load_child_theme_textdomain( 'genesisawesome', CHILD_DIR . '/languages' );

}

/**
 * Print Google Fonts
 * 
 * @since 1.0
 * 
 * @return null
 */
function genesisawesome_parent_stylesheet() {

	echo '<link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Great+Vibes|Open+Sans:r,ri,b,bi|Arimo:r,b,ri,bi" type="text/css" />' . "\n";

}

/**
 * GenesisAwesome Childtheme Styles
 * 
 * @since 1.0
 * 
 * @return null
 */
function genesisawesome_childtheme_styles() {

}

/**
 * GenesisAwesome Childtheme Scripts
 * 
 * @since 1.0
 * 
 * @return null
 */
function genesisawesome_childtheme_scripts() {

	wp_enqueue_script( 'ga-modernizr',  CHILD_URL . '/js/modernizr.min.js', '', null, false );
	wp_enqueue_script( 'ga-fancybox',   CHILD_URL . '/js/fancybox.min.js', array( 'jquery' ), null, true );
	wp_enqueue_script( 'ga-fitvids',    CHILD_URL . '/js/fitvids.min.js', array( 'jquery' ), null, true );
	wp_enqueue_script( 'ga-flexslider', CHILD_URL . '/js/flexslider.min.js', array( 'jquery' ), null, true );
	wp_enqueue_script( 'ga-tipsy',      CHILD_URL . '/js/tipsy.min.js', array( 'jquery' ), null, true );
	wp_enqueue_script( 'ga-dedicated',  CHILD_URL . '/js/dedicated-custom.js', array( 'ga-fancybox','ga-fitvids','ga-flexslider','ga-tipsy' ), null, true );

}

/**
 * GenesisAwesome Custom Stylings
 * 
 * @since 1.0
 * 
 * @return null
 */
function genesisawesome_childtheme_inline_styles() {


	// Logo CSS
	$logo_url    = esc_url_raw( genesis_get_option( 'logo_url', GA_CHILDTHEME_FIELD ) );
	$logo_width  = absint( genesis_get_option( 'logo_width', GA_CHILDTHEME_FIELD ) );
	$logo_height = absint( genesis_get_option( 'logo_height', GA_CHILDTHEME_FIELD ) );

	$logo_css    = ( $logo_url && $logo_width && $logo_height ) ? ".header-image #title-area #title { background: url('{$logo_url}') no-repeat;width: {$logo_width}px;height: {$logo_height}px;}\n" : '' ;

	// Typography CSS

	$the_css = ''; $enable_typography = false;

	$typography_classes = array(
		'enable_ga_typography',
		'body, p, select, textarea'     => array( 'color' => 'ga_font_color', 'fontsize' => 'ga_font_size' ),
		'a, a:link, a:visited'          => array( 'color' => 'ga_link_color' ),
		'a:hover, a:active'             => array( 'color' => 'ga_link_hover_color' ),
		'enable_ga_h1_typography',
		'h1'                            => array( 'fontsize' => 'ga_h1_font_size', 'color' => 'ga_h1_font_color' ),
		'h1 a, h1 a:link, h1 a:visited' => array( 'color' => 'ga_h1_link_color' ),
		'h1 a:hover, h1 a:active'       => array( 'color' => 'ga_h1_link_hover_color' ),
		'enable_ga_h2_typography',
		'h2'                            => array( 'fontsize' => 'ga_h2_font_size', 'color' => 'ga_h2_font_color' ),
		'h2 a, h2 a:link, h2 a:visited' => array( 'color' => 'ga_h2_link_color' ),
		'h2 a:hover, h2 a:active'       => array( 'color' => 'ga_h2_link_hover_color' ),
		'enable_ga_h3_typography',
		'h3'                            => array( 'fontsize' => 'ga_h3_font_size', 'color' => 'ga_h3_font_color' ),
		'h3 a, h3 a:link, h3 a:visited' => array( 'color' => 'ga_h3_link_color' ),
		'h3 a:hover, h3 a:active'       => array( 'color' => 'ga_h3_link_hover_color' ),
		'enable_ga_h4_typography',
		'h4'                            => array( 'fontsize' => 'ga_h4_font_size', 'color' => 'ga_h4_font_color' ),
		'h4 a, h4 a:link, h4 a:visited' => array( 'color' => 'ga_h4_link_color' ),
		'h4 a:hover, h4 a:active'       => array( 'color' => 'ga_h4_link_hover_color' ),
		'enable_ga_h5_typography',
		'h5'                            => array( 'fontsize' => 'ga_h5_font_size', 'color' => 'ga_h5_font_color' ),
		'h5 a, h5 a:link, h5 a:visited' => array( 'color' => 'ga_h5_link_color' ),
		'h5 a:hover, h5 a:active'       => array( 'color' => 'ga_h5_link_hover_color' )
	);

	foreach ( $typography_classes as $selector => $options ) {

		$css = '';

		if ( is_string( $options ) ) {
			$enable_typography = genesis_get_option( $options, GA_CHILDTHEME_FIELD );
			continue;
		}

		if ( is_array( $options ) && $enable_typography ) {

			foreach ( $options as $proeprty => $pro_opt ) {

				if ( $proeprty == 'color' && _ga_typography_color( $pro_opt ) )
					$css .= _ga_typography_color( $pro_opt );

				if (  $proeprty == 'fontsize' && _ga_typography_fontsize( $pro_opt ) )
					$css .= _ga_typography_fontsize( $pro_opt );

			}

			if ( ! empty( $css ) )
				$the_css .=  "$selector { $css }\n";

		}

	}

	if ( ! $logo_css && ! $the_css )
		return;
	?>
	<style type="text/css">
	/* <![CDATA[ */
	<?php echo $logo_css . $the_css; ?>
	/* ]]> */
	</style>
	<?php

}

/**
 * Helper function to get CSS font-size property
 * 
 * @access private
 * @param  string $option
 * @return string
 */
function _ga_typography_fontsize( $option ) {

	if ( ! ( $_size = genesis_get_option( $option, GA_CHILDTHEME_FIELD ) ) )
		return false;

	 return 'font-size: ' . absint( $_size ) . 'px;';

}

/**
 * Helper function to get CSS color property
 * 
 * @access private
 * @param  string $option
 * @return string
 */
function _ga_typography_color( $option ) {

	if ( ! ( $_color = genesis_get_option( $option, GA_CHILDTHEME_FIELD ) ) )
		return false;

	 return 'color: ' . $_color . ';';

}

/**
 * GenesisAwesome Custom Scripts at Footer
 * 
 * @since 1.0
 * 
 * @return null
 */
function genesisawesome_childtheme_inline_scripts() {

	if ( is_singular( 'post' ) && genesis_get_option( 'enable_post_social_share', GA_CHILDTHEME_FIELD ) ) {
		?>
	<script src='http://assets.pinterest.com/js/pinit.js' type='text/javascript'></script>
	<script type='text/javascript'>
	/*<![CDATA[*/
		!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");
		function run_pinmarklet() {var e=document.createElement('script'); e.setAttribute('type','text/javascript');e.setAttribute('charset','UTF-8');e.setAttribute('src','http://assets.pinterest.com/js/pinmarklet.js?r=' + Math.random()*99999999);document.body.appendChild(e);}
		(function() {var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;po.src = 'https://apis.google.com/js/plusone.js';var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);})();
		(function() {var s = document.createElement('SCRIPT'), s1 = document.getElementsByTagName('SCRIPT')[0];s.type = 'text/javascript';s.async = true;s.src = 'http://widgets.digg.com/buttons.js';s1.parentNode.insertBefore(s, s1);})();
	/*]]>*/
	</script>
		<?php
	}

}

/**
 * Header Right social and search box
 * 
 * @since 1.0
 * 
 * @return null
 */
function genesisawesome_do_header_right() {

	?>	
	<ul id='dedicated-social'>
	<?php if ( $facebook_url = genesis_get_option( 'facebook_url', GA_CHILDTHEME_FIELD ) ) : ?>
		<li class='facebook'><a href='<?php echo esc_url( $facebook_url ) ?>' target='_blank' title='<?php esc_attr_e( 'Facebook', 'genesisawesome' );?>'><?php esc_html_e( 'Facebook', 'genesisawesome' );?></a></li>
	<?php endif;?>
	<?php if ( $twitter_url = genesis_get_option( 'twitter_url', GA_CHILDTHEME_FIELD ) ) : ?>
		<li class='twitter'><a href='<?php echo esc_url( $twitter_url ) ?>' title='<?php esc_attr_e( 'Twitter', 'genesisawesome' );?>'><?php esc_html_e( 'Twitter', 'genesisawesome' );?></a></li>
	<?php endif;?>
	<?php if ( $rss_feed = genesis_get_option( 'feed_uri' ) ) : ?>
		<li class='rss'><a href='<?php echo esc_url( $rss_feed ) ?>' title='<?php esc_attr_e( 'RSS Feed', 'genesisawesome' );?>'><?php esc_html_e( 'RSS Feed', 'genesisawesome' );?></a></li>
	<?php endif;?>
	<?php if ( $dribbble_url = genesis_get_option( 'dribbble_url', GA_CHILDTHEME_FIELD ) ) : ?>
		<li class='dribbble'><a href='<?php echo esc_url( $dribbble_url ) ?>' title='<?php esc_attr_e( 'Dribbble', 'genesisawesome' );?>'><?php esc_html_e( 'Dribbble', 'genesisawesome' );?></a></li>
	<?php endif;?>
	<?php if ( $linkedin_url = genesis_get_option( 'linkedin_url', GA_CHILDTHEME_FIELD ) ) : ?>
		<li class='linkedin'><a href='<?php echo esc_url( $linkedin_url ) ?>' title='<?php esc_attr_e( 'LinkedIn', 'genesisawesome' );?>'><?php esc_html_e( 'LinkedIn', 'genesisawesome' );?></a></li>
	<?php endif;?>
	</ul>

	<form action='<?php bloginfo( 'url' ); ?>' id='dedicated-search' method='GET'>
		<input class='searchinput' name='s' type='text' value='<?php esc_attr_e( 'Search...', 'genesisawesome' );?>'/>
		<input class='searchbutton' type='submit' value='<?php esc_attr_e( 'Go', 'genesisawesome' );?>'/>
	</form>
	<?php

}

/**
 * Featured Post Image 
 * 
 * @since 1.0
 * 
 * @return null
 */
function genesisawesome_do_post_image() {

	$full_image = genesis_get_image( array( 'format' => 'url' ) );

	if ( $full_image && ! is_singular() && genesis_get_option( 'content_archive_thumbnail' ) ) {
		?>
		<div class="dedicated-thumb">
			<a href="<?php echo esc_attr( $full_image ); ?>" title="<?php the_title_attribute(); ?>"><?php genesis_image( array( 'size' => 'dedicated-post-image' ) ); ?></a>
		</div>
		<?php
	}

}

add_filter( 'the_content_more_link', 'genesisawesome_more_link' );
add_filter( 'get_the_content_more_link', 'genesisawesome_more_link' );
/**
 * More Link
 * 
 * @since 1.0 
 * 
 * @param  string $html Default More Link
 * @return string       Custom More link
 */
function genesisawesome_more_link( $html ) {
	
	global $post;
	$morelink = '<a href="' . get_permalink() . '#more-' . $post->ID . '" class="more-link">' . __( 'Read More', 'genesisawesome' ) . '</a>';
	return $morelink;

}

add_filter( 'genesis_footer_output', 'genesosawesome_footer_output', 10, 3 );
/**
 * Dedicated Custom Footer output
 * 
 * @since 1.0
 * 
 * @param  string $output      Default Footer HTML
 * @param  string $backtoptext BacktoTop HTML (Left)
 * @param  string $creds_text  Credits HTML (Right)
 * @return string              Custom Footer HTML
 */
function genesosawesome_footer_output( $output, $backtoptext, $creds_text ) {

	$left_text = $backtoptext;

	if ( has_nav_menu( 'footernav' ) ) {
		$left_text = wp_nav_menu(
			array(
				'theme_location'  => 'footernav',
				'container'       => 'null', 
				'container_class' => null, 
				'container_id'    => null,
				'menu_class'      => null, 
				'menu_id'         => 'footernav',
				'echo'            => false,
				'depth'           => 1
			)
		);
	}
 
	$left_text  = sprintf( '<div class="one-half first">%s</div>', $left_text );
	$right_text = sprintf( '<div class="one-half text-right">[footer_copyright before="%s "] &middot; [footer_childtheme_link before="" after=" %s"] [footer_genesis_link url="http://www.genesisawesome.com/recommends/genesis" before=""] &middot; [footer_wordpress_link]</div>', __( 'Copyright', 'genesis' ), __( 'on', 'genesis' ) );

	return $left_text . $right_text;

}

/**
 * GenesisAwesome Custom Widgets Register.
 * 
 * @since 1.0
 * 
 * @return null
 */
function genesisawesome_custom_widgets() {

	/* Unregister Defailt Header Right */
	unregister_sidebar( 'header-right' );

	/* Register Custom Widgets */
	register_widget( 'GA_Facebook_Likebox_Widget' );
	register_widget( 'GA_Flickr_Widget' );

}

/**
 * GenesisAwesome Subscribe and Shareing boxes.
 * 
 * @since 1.0
 * 
 * @return null
 */
function genesisawesome_subscribe_sharebox() {

	if ( ! is_singular( 'post' ) )
		return;

	if ( genesis_get_option( 'enable_post_social_share', GA_CHILDTHEME_FIELD ) ) :
	?>
<table id='sharetable' width='100%'>
	<caption><?php _e( 'Share this article!', 'genesisawesome' );?> </caption>
	<tr>
		<td><iframe allowTransparency='true' src='//www.facebook.com/plugins/like.php?href=<?php echo urlencode( get_permalink() ); ?>&amp;send=false&amp;layout=box_count&amp;width=50&amp;show_faces=false&amp;action=like&amp;colorscheme=light&amp;font&amp;height=65' frameborder='0' scrolling='no' style='border:none; overflow:hidden; width:50px; height:65px;'></iframe></td>
		<td><a class='twitter-share-button' data-count='vertical' data-lang='en' data-title='<?php the_title_attribute(); ?>' data-url='<?php the_permalink(); ?>' href='https://twitter.com/share'>Tweet</a></td>
		<td>	
			<div style='position:relative;'>
				<a class='pin-it-button' count-layout='vertical' href='http://pinterest.com/pin/create/button/?url=<?php echo urldecode( get_permalink() ); ?>'>Pin It now!</a>
				<a href='javascript:void(run_pinmarklet())' style='position:absolute;top:0;bottom:0;left:0;right:0;'></a>
			</div>
		</td>
		<td><g:plusone href='<?php the_permalink(); ?>' size='tall'></g:plusone></td>
		<td><a class='DiggThisButton DiggMedium'></a></td>
		<td>
			<script src='//platform.linkedin.com/in.js' type='text/javascript'></script>
			<script data-counter='top' data-url='<?php the_permalink(); ?>' type='IN/Share'></script>
		</td>
	</tr>
</table>
<div style='clear:both;'></div>
<?php endif; ?>
<?php if ( genesis_get_option( 'enable_post_related_subscribe', GA_CHILDTHEME_FIELD ) ) : ?>
<div id='dedicatedsubscribebox'>
	<div id='ddrelated'>
		 <h2><?php _e( 'Related Posts', 'genesisawesome' );?></h2>
		 <?php genesisawesome_related_posts(); ?>
	</div>
	<div id='ddsubscribe'>
		<h2><?php _e( 'Subscripe to Our Blog Updates!', 'genesisawesome' );?></h2>
		<ul class='social'>
			<?php if ( $twitter_url = genesis_get_option( 'twitter_url', GA_CHILDTHEME_FIELD ) ) : ?>
			<li><a class='twitter' href='<?php echo esc_url( $twitter_url ) ?>' target='_blank' title='<?php esc_attr_e( 'Twitter', 'genesisawesome' );?>'><?php _e( 'Twitter', 'genesisawesome' )?></a></li>
			<?php endif; 
			if ( $facebook_url = genesis_get_option( 'facebook_url', GA_CHILDTHEME_FIELD ) ) : ?>
			<li><a class='facebook' href='<?php echo esc_url( $facebook_url ) ?>' target='_blank' title='<?php esc_attr_e( 'Facebook', 'genesisawesome' );?>'><?php _e( 'Facebook', 'genesisawesome' )?></a></li>
			<?php endif; 
			if ( $feed_uri = genesis_get_option( 'feed_uri' ) ) : ?>
			<li><a class='rss' href='<?php echo esc_url( $feed_uri ) ?>' target='_blank' title='<?php esc_attr_e( 'Rss Feed', 'genesisawesome' );?>'><?php _e( 'Rss Feed', 'genesisawesome' )?></a></li>
			<?php endif; 
			if ( $googleplus_url = genesis_get_option( 'googleplus_url', GA_CHILDTHEME_FIELD ) ) : ?>
			<li><a class='gplus' href='<?php echo esc_url( $googleplus_url ) ?>' target='_blank' title='<?php esc_attr_e( 'Google Plus', 'genesisawesome' );?>'><?php _e( 'Google Plus', 'genesisawesome' )?></a></li>
			<?php endif; 
			if ( $digg_url = genesis_get_option( 'digg_url', GA_CHILDTHEME_FIELD ) ) : ?>
			<li><a class='digg' href='<?php echo esc_url( $digg_url ) ?>' target='_blank' title='<?php esc_attr_e( 'Digg', 'genesisawesome' );?>'><?php _e( 'Digg', 'genesisawesome' )?></a></li>
			<?php endif; 
			if ( $delicious_url = genesis_get_option( 'delicious_url', GA_CHILDTHEME_FIELD ) ) : ?>
			<li><a class='delicious' href='<?php echo esc_url( $delicious_url ) ?>' target='_blank' title='<?php esc_attr_e( 'Delicious', 'genesisawesome' );?>'><?php _e( 'Delicious', 'genesisawesome' )?></a></li>
			<?php endif; 
			if ( $youtube_url = genesis_get_option( 'youtube_url', GA_CHILDTHEME_FIELD ) ) : ?>
			<li><a class='youtube' href='<?php echo esc_url( $youtube_url ) ?>' target='_blank' title='<?php esc_attr_e( 'YouTube', 'genesisawesome' );?>'><?php _e( 'YouTube', 'genesisawesome' )?></a></li>
			<?php endif; ?>
		</ul>
		<p class='message'><?php _e( 'Subscribe to Our Free Email Updates!', 'genesisawesome' );?></p>
		<form action='http://feedburner.google.com/fb/a/mailverify' class='subscribeform' method='post' onsubmit='window.open("http://feedburner.google.com/fb/a/mailverify?uri=<?php echo esc_attr( genesis_get_option( 'feedburner_id', GA_CHILDTHEME_FIELD ) );?>", "popupwindow", "scrollbars=yes,width=550,height=520");return true' target='popupwindow'>
			<input name='uri' type='hidden' value='<?php echo esc_attr( genesis_get_option( 'feedburner_id', GA_CHILDTHEME_FIELD ) );?>'/>
			<input name='loc' type='hidden' value='en_US'/>
			<input class='einput' name='email' onblur='if (this.value == "") {this.value = "Enter your email...";}' onfocus='if (this.value == "Enter your email...") {this.value = ""}' type='text' value='Enter your email...'/>
			<input class='ebutton' title='' type='submit' value='<?php _e( 'Subscribe', 'genesisawesome' );?>'/>
		</form>
	</div>
</div>
	<?php
	endif;

}


add_filter( 'genesis_available_sanitizer_filters', 'genesisawesome_custom_filters' );
/**
 * GenesisAwesome Custom Option Filters for Genesis
 * 
 * @since 1.0
 * 
 * @param  array $filters Default Genesis Options Filters
 * @return array          Custom and Default Genesis Options Filters
 */
function genesisawesome_custom_filters( $filters ) {

	$filters['email']   = 'sanitize_email';
	$filters['integer'] = 'genesisawesome_intval';

	return $filters;

}

/**
 * Helper intval function for sanitization
 * 
 * @since 1.0
 * 
 * @param  mixed    $new_val submitted value
 * @param  mixed    $old_val old value
 * @return integeer          Integer value
 */
function genesisawesome_intval( $new_val, $old_val ) {
	
	return intval( $new_val );

}

/**
 * GenesisAwesome Related Posts Query
 * 
 * @since 1.0
 * 
 * @param  integer $number Number of related posts to show
 * @return null
 */
function genesisawesome_related_posts( $number = 5 ) {

	global $post;

	$categories = get_categories( $post->ID );
	$cat_ids = array();

	if ( ! $categories )
		return;

	foreach ( $categories as $cat ) {
		$cat_ids[] = $cat->term_id;
	}

	$args = array(
		'category__in'     => $cat_ids,
		'post__not_in'     => array( $post->ID ),
		'posts_per_page'   => absint( $number ),
	);

	$ga_related = new WP_Query( $args );

	if ( $ga_related->have_posts() ) {
		echo '<ul>';
		while ( $ga_related->have_posts() ) {
			$ga_related->the_post();
			printf( '<li><a href="%s" title="%s">%s</a></li>', get_permalink(), the_title_attribute( 'echo=0' ), get_the_title() );
		}
		echo '</ul>';
	}

	wp_reset_query();

}

add_filter( 'genesis_export_options', 'genesiawesome_childtheme_export_options' );
/**
 * Add to Genesis Import & Export Options
 * 
 * @since 1.0
 * 
 * @param  array $options Default Import & Export support
 * @return array          Dedicated and Default Import & Exoirt support
 */
function genesiawesome_childtheme_export_options( $options ) {

	$options['dedicated'] = array(
		'label'          => __( 'Dedicated Child Theme Settings', 'genesisawesome' ),
		'settings-field' => GA_CHILDTHEME_FIELD,
	);

	return $options;

}