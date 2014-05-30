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
define( 'CHILD_THEME_VER', '2.0' );
define( 'GA_CHILDTHEME_FIELD', 'genesisawesome_dedicated_settings' );

require_once( get_template_directory() . '/lib/init.php' );

/* Load GenesisAwesome Settings Page class */
require_once( CHILD_DIR . '/lib/genesisawesome-settings.php' );

/* Load GenesisAwesome Flexslider */
require_once( CHILD_DIR . '/lib/genesisawesome-slider.php' );

/* Load Genesis Awesome Widgets */
require_once( CHILD_DIR . '/lib/widgets/widget-facebook-likebox.php' );
require_once( CHILD_DIR . '/lib/widgets/widget-flickr.php' );

/* Add GenesisAwesome Theme supports */
add_theme_support( 'html5' );
add_theme_support( 'genesis-responsive-viewport' );
add_theme_support( 'genesis-footer-widgets', 3 );
add_theme_support( 'genesis-menus', array( 'primary' => __( 'Primary Navigation', 'genesisawesome' ), 'footernav' => __( 'Footer Navigation Links', 'genesisawesome' ) ) );

/* Register new Image sizes */
add_image_size( 'dedicated-slider-image', 980, 350, true );
add_image_size( 'dedicated-post-image', 740, 260, true );

/* Load Styles and Stykes for Genesis Child Theme */
add_action( 'wp_print_styles', 'genesisawesome_childtheme_styles' );
/**
 * GenesisAwesome Childtheme Styles
 *
 * @since 1.0
 *
 * @return null
 */
function genesisawesome_childtheme_styles() {

	wp_enqueue_style( 'google-font', '//fonts.googleapis.com/css?family=Great+Vibes|Source+Sans+Pro:300,300i,400,400i,700,700i', null, null );
	wp_enqueue_style( 'font-awesome', '//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.min.css', null, null );

}

add_action( 'wp_enqueue_scripts', 'genesisawesome_childtheme_scripts' );
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

/* Load inline Styles and Scripts for Genesis Child Theme */
add_action( 'wp_head', 'genesisawesome_childtheme_inline_styles' );
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

	$logo_css    = ( $logo_url && $logo_width && $logo_height ) ? ".header-image .site-title a { background: url('{$logo_url}') no-repeat;width: {$logo_width}px;height: {$logo_height}px;}\n" : '' ;
	$logo_css    .= ( $logo_css && $logo_height ) ? sprintf( '.header-image .site-header .widget-area { margin-top: %dpx;}', (($logo_height/2)-16) ) : '' ;

	// Typography CSS
	$typo_css = '';

	$typography_classes = array(
		'body, p, select, textarea' => array( 'color' => 'ga_font_color', 'fontsize' => 'ga_font_size' ),
		'a, a:visited'              => array( 'color' => 'ga_link_color' ),
		'a:hover'                   => array( 'color' => 'ga_link_hover_color' ),
		'h1'                        => array( 'color' => 'ga_h1_font_color', 'fontsize' => 'ga_h1_font_size', ),
		'h1 a, h1 a:visited'        => array( 'color' => 'ga_h1_link_color' ),
		'h1 a:hover'                => array( 'color' => 'ga_h1_link_hover_color' ),
		'h2'                        => array( 'color' => 'ga_h2_font_color', 'fontsize' => 'ga_h2_font_size', ),
		'h2 a, h2 a:visited'        => array( 'color' => 'ga_h2_link_color' ),
		'h2 a:hover'                => array( 'color' => 'ga_h2_link_hover_color' ),
		'h3'                        => array( 'color' => 'ga_h3_font_color', 'fontsize' => 'ga_h3_font_size', ),
		'h3 a, h3 a:visited'        => array( 'color' => 'ga_h3_link_color' ),
		'h3 a:hover'                => array( 'color' => 'ga_h3_link_hover_color' ),
		'h4'                        => array( 'color' => 'ga_h4_font_color', 'fontsize' => 'ga_h4_font_size', ),
		'h4 a, h4 a:visited'        => array( 'color' => 'ga_h4_link_color' ),
		'h4 a:hover'                => array( 'color' => 'ga_h4_link_hover_color' ),
		'h5'                        => array( 'color' => 'ga_h5_font_color', 'fontsize' => 'ga_h5_font_size', ),
		'h5 a, h5 a:visited'        => array( 'color' => 'ga_h5_link_color' ),
		'h5 a:hover'                => array( 'color' => 'ga_h5_link_hover_color' ),
	);

	foreach ( $typography_classes as $selector => $options ) {

		$css = '';

		foreach ( $options as $proeprty => $pro_opt ) {
			switch ( $proeprty ) {
				case 'color' :
					$color = genesis_get_option( $pro_opt, GA_CHILDTHEME_FIELD );
					if ( ! empty( $color ) )
						$css .= sprintf( 'color: %s;', $color );
					break;
				case 'fontsize' :
					$fontsize = genesis_get_option( $pro_opt, GA_CHILDTHEME_FIELD );
					if ( ! empty( $fontsize ) )
						$css .= sprintf( 'font-size: %dpx;', $fontsize );
					break;
			}
		}

		if ( ! empty( $css ) )
			$typo_css .=  "$selector { $css }\n";

	}

	if ( ! $logo_css && ! $typo_css )
		return;
	?>
	<style type="text/css">
	<?php echo $logo_css . $typo_css; ?>
	</style>
	<?php

}

add_action( 'wp_footer', 'genesisawesome_childtheme_inline_scripts' );
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
	<script type="text/javascript" async src="//assets.pinterest.com/js/pinit.js"></script>
	<script type='text/javascript'>
	/*<![CDATA[*/
		!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");
		// function run_pinmarklet() {var e=document.createElement('script'); e.setAttribute('type','text/javascript');e.setAttribute('charset','UTF-8');e.setAttribute('src','http://assets.pinterest.com/js/pinmarklet.js?r=' + Math.random()*99999999);document.body.appendChild(e);}
		(function() {var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;po.src = 'https://apis.google.com/js/plusone.js';var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);})();
		(function() {var s = document.createElement('SCRIPT'), s1 = document.getElementsByTagName('SCRIPT')[0];s.type = 'text/javascript';s.async = true;s.src = 'http://widgets.digg.com/buttons.js';s1.parentNode.insertBefore(s, s1);})();
	/*]]>*/
	</script>
		<?php
	}

}

/* Header Right Content. Social Icons and Search */
add_action( 'genesis_header_right', 'genesisawesome_do_header_right' );
/**
 * Header Right social and search box
 *
 * @since 1.0
 *
 * @return null
 */
function genesisawesome_do_header_right() {

	$socials = array(
		'facebook_url'   => 'Facebook',
		'twitter_url'    => 'Twitter',
		'googleplus_url' => 'Google Plus',
		'pinterest_url'  => 'Pinterest',
		'instagram_url'  => 'Instagram',
		'linkedin_url'   => 'LinkedIn',
		'dribbble_url'   => 'Dribbble',
		'youtube_url'    => 'Youtube',
	);

	?>
	<form action='<?php bloginfo( 'url' ); ?>' id='dedicated-search' method='GET'>
		<input class='searchinput' name='s' type='text' placeholder='<?php esc_attr_e( 'Search...', 'genesisawesome' );?>' value=""/>
		<button class='searchbutton fa fa-search' type='submit'><span><?php esc_html_e( 'Go', 'genesisawesome' );?></span></button>
	</form>
	<ul id='dedicated-social'>
		<?php foreach ( $socials as $social_option => $social_name ) : ?>
		<?php if ( $social_url = genesis_get_option( $social_option, GA_CHILDTHEME_FIELD ) ) : ?>
		<li><a href='<?php echo esc_url( $social_url ) ?>' target='_blank' title='<?php echo esc_attr( $social_name ); ?>' class="fa fa-<?php echo sanitize_html_class( sanitize_title( $social_name ) ); ?>"><span><?php echo esc_html( $social_name ); ?></span></a></li>
		<?php endif;?>
		<?php endforeach; ?>
	</ul>
	<?php

}

/* Remove Default Post Image */
remove_action( 'genesis_entry_content', 'genesis_do_post_image', 8 );
/* Add Custom Post Image */
add_action( 'genesis_entry_content', 'genesisawesome_do_post_image', 8 );
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

add_filter( 'genesis_post_info', 'genesisawesome_post_info_filter' );
/**
 * Custom entry post info
 *
 * @since 2.0
 *
 * @return string
 */
function genesisawesome_post_info_filter() {
	return '[post_date] [post_author_posts_link] [post_comments] [post_edit]';
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

/* Init Custom GenesisAwesome Widgets */
add_action( 'widgets_init', 'genesisawesome_custom_widgets' );
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

/* Post Share and Subscribe Boxes */
add_action( 'genesis_after_entry', 'genesisawesome_subscribe_sharebox', 9 );
/**
 * GenesisAwesome Subscribe and Sharing boxes.
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
<div id="dedicated-sharing">
	<h3><?php _e( 'Share this article!', 'genesisawesome' );?> </h3>
	<table id='sharetable' width='100%'>
		<tr>
			<td><iframe allowTransparency='true' src='//www.facebook.com/plugins/like.php?href=<?php echo urlencode( get_permalink() ); ?>&amp;send=false&amp;layout=box_count&amp;width=50&amp;show_faces=false&amp;action=like&amp;colorscheme=light&amp;font&amp;height=65' frameborder='0' scrolling='no' style='border:none; overflow:hidden; width:50px; height:65px;'></iframe></td>
			<td><a class='twitter-share-button' data-count='vertical' data-lang='en' data-title='<?php the_title_attribute(); ?>' data-url='<?php the_permalink(); ?>' href='https://twitter.com/share'>Tweet</a></td>
			<td><a href="//www.pinterest.com/pin/create/button/?url=<?php echo urlencode( get_permalink() ) ?>&amp;media=<?php echo urlencode( genesis_get_image( array( 'format' => 'url' ) ) ); ?>&amp;description=<?php echo urlencode( get_the_content_limit( 500, '' ) ) ?>" data-pin-do="buttonPin" data-pin-config="above"><img src="//assets.pinterest.com/images/pidgets/pinit_fg_en_rect_gray_20.png" /></a></td>
			<td><g:plusone href='<?php the_permalink(); ?>' size='tall'></g:plusone></td>
			<td><a class='DiggThisButton DiggMedium'></a></td>
			<td>
				<script src='//platform.linkedin.com/in.js' type='text/javascript'></script>
				<script data-counter='top' data-url='<?php the_permalink(); ?>' type='IN/Share'></script>
			</td>
		</tr>
	</table>
</div>
<div style='clear:both;'></div>
<?php endif; ?>
<?php if ( genesis_get_option( 'enable_post_related_subscribe', GA_CHILDTHEME_FIELD ) ) : ?>
<?php
$socials = array(
	'facebook_url'   => 'Facebook',
	'twitter_url'    => 'Twitter',
	'googleplus_url' => 'Google Plus',
	'pinterest_url'  => 'Pinterest',
	'instagram_url'  => 'Instagram',
	'linkedin_url'   => 'LinkedIn',
	'dribbble_url'   => 'Dribbble',
	'youtube_url'    => 'Youtube',
);
?>
<div id='dedicatedsubscribebox'>
	<div id='ddrelated'>
		 <h3><?php _e( 'Related Posts', 'genesisawesome' );?></h2>
		 <?php genesisawesome_related_posts(); ?>
	</div>
	<div id='ddsubscribe'>
		<h3><?php _e( 'Subscripe to Our Blog Updates!', 'genesisawesome' );?></h3>
		<ul class='social'>
			<?php foreach ( $socials as $social_option => $social_name ) : ?>
			<?php if ( $social_url = genesis_get_option( $social_option, GA_CHILDTHEME_FIELD ) ) : ?>
			<li><a href='<?php echo esc_url( $social_url ) ?>' target='_blank' title='<?php echo esc_attr( $social_name ); ?>' class="fa fa-<?php echo sanitize_title( $social_name ); ?>"><i><?php echo esc_html( $social_name ); ?></i></a></li>
			<?php endif; ?>
			<?php endforeach; ?>
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

	wp_reset_postdata();

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