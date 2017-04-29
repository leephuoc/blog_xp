<?php
/**
 * 	Set define value
 */
define('THEME_URL', get_stylesheet_directory());
define('CORE', THEME_URL . '/core');

require_once(CORE. '/init.php');

/**
 * @ set width content 
 */
if(!isset($content_width)) {
	$content_width = 620;
}

/**
 * Set function for theme
 */
if(!function_exists('leephuoc_theme_setup')) {
	function leephuoc_theme_setup() {
		/** Set textdomain */
		$language_folder = THEME_URL . '/languages';
		load_theme_textdomain('leephuoc', $language_folder);

		/** Auto add link RSS in <head> */
		add_theme_support('automatic-feed-links');

		/** Add post thumbnail */
		add_theme_support('post-thumbnails');

		/** Post Format */
		add_theme_support('post-format', [
				'image',
				'video',
				'gallery',
				'quote',
				'link'
			]);

		/** Add title-tag */
		add_theme_support('title-tag');

		/** Custom background */
		$default = ['default' => '#e8e8e8'];
		add_theme_support('custom-background');

		/** Add theme menu */
		register_nav_menu('primary-menu', __('Primary menu', 'leephuooc'));

		/** Create sidebar */
		$sidebar = [
			'name' => __('Main Sidebar', 'leephuoc'),
			'id' => 'main-sidebar',
			'description' => __('Default sidebar'),
			'class' => 'main-sidebar',
			'before_title' => '<h3 class="widgettitle>',
			'after_title' => '</h3>'
		];
		register_sidebar($sidebar);
	}
	add_action('init', 'leephuoc_theme_setup');
}

/** TEMPLATE FUNCTION */
if(!function_exists('leephuoc_header')) {
	function leephuoc_header() { ?>
		<div class="side-name">
			<?php
					if(is_home()) {
						printf('<h1><a href="%s" title="%s">%s</a></h1>',
							get_bloginfo('url'),
							get_bloginfo('description'),
							get_bloginfo('sitename')
						);
					} 
					else {
						printf('<p><a href="%s" title="%s">%s</a></p>',
							get_bloginfo('url'),
							get_bloginfo('description'),
							get_bloginfo('sitename')
						);
					}
			?>
		</div>
		<div class="site-description ">
			<?php bloginfo('description') ?>
		</div>
	<?php }
}

/** Set menu */
if(!function_exists('leephuoc_menu')) {
	function leephuoc_menu($menu) {
		$menu = [
			'theme_location' => $menu,
			'container' => 'nav',
			'container_class' => $menu
		];
		wp_nav_menu($menu);
	}
}

/** Set pagination */
if(!function_exists('leephuoc_pagination')) {
	function leephuoc_pagination() {
		// if($GLOBAL['wp_query']->get_num_pages < 2) {
		// 	return '';
		// }
		echo '<nav class="pagination" role="navigation"> ';
		if(get_next_post_link()) {
			printf('<div class="prev">%s</div>', next_post_link(__('<', 'leephuoc')));
		} elseif (get_previous_post_link()) {
			printf('<div class="next">%s</div>', previous_post_link(__('>', 'leephuoc')));
		}
		echo '</nav>';
	}
}

/** Show image thumnail */
if(!function_exists('leephuoc_thumbnail')) {
	function leephuoc_thumbnail($size) {
		if(!is_single() && has_post_thumbnail() && !has_post_format('image')) { ?>
			<figure class="post-thumbnail"><?php the_post_thumbnail($size); ?></figure> 
		<?php }
	}
}

/** Function to show title of post */
if(!function_exists('leephuoc_entry_header')) {
	function leephuoc_entry_header() { 
		if(is_single()) { ?>
			<h1><a href="<?php the_permalink(); ?>" title="<?php the_title();?>"><?php the_title(); ?></a></h1>
		<?php } else { ?>
			<h2><a href="<?php the_permalink(); ?>" title="<?php the_title();?>"><?php the_title(); ?></a></h2>
		<?php }
	}
}

/** Function to get data post */
if(!function_exists('leephuoc_entry_meta')) {
	function leephuoc_entry_meta() {
		if(!is_page()) { ?>
			<div class="entry-meta">
				<?php  
					printf(__('<span class="author">Posted by %s</span>', 'leephuoc'), get_the_author());
					printf(__('<span class="date-published"> at %s</span>', 'leephuoc'), get_the_date());
					printf(__('<span class="category"> in %s</span>', 'leephuoc'), get_the_category_list(','));

					if(comments_open()) {
						echo '<span class="meta-reply">';
						comments_popup_link(
							__(' Leave a comment', 'leephuoc'),
							__(' One comment', 'leephuoc'),
							__(' %s comments', 'leephuoc'),
							__(' Read all comments', 'leephuoc')
						);
						echo '<span>';
					}
				?>
			</div>
		<?php }
	}
}

/** Function to show content of post/page */
if(!function_exists('leephuoc_entry_content')) {
	function leephuoc_entry_content() {
		if(!is_single()) {
			the_excerpt();
		} else {
			the_content();

			/** Pagination in single */
			$link_pages = array(
				'before' => __('<p>Page:', 'leephuoc'),
				'after' => '</p>',
				'nextpageLink' => __('Next page', 'leephuoc'),
				'previouspageLink' => __('Previous Page', 'leephuoc')
			);
			wp_link_page($link_pages);
		}
	}
}

if(!function_exists('leephuoc_readmore')) {
	function leephuoc_readmore() {
		return '<a class="read-more" href="'. get_permalink(get_the_ID) . '">' . __('...[Read more]', 'leephuoc') . '</a>';
	}
}
add_filter('excerpt_more', 'leephuoc_readmore');

/** Function to show tag */
if(!function_exists('leephuoc_entry_tag')) {
	function leephuoc_entry_tag() {
		if(has_tag()) {
			echo '<div class="entry-tag">';
			printf(__('Tagged in %s', 'leephuoc'), get_the_tag('', ','));
			echo '</div>';
		}
	}
}

/** Function to demo action hook */
if(!(function_exists('leephuoc_header_modify'))) {
	function leephuoc_header_modify($query) {
		echo 'abc';
	}	
}
add_action('wp_head', 'leephuoc_header_modify');



/** Function to */
// if(!function_exists('leephuoc_copyright')) {
// 	function leephuoc_copyright() {
// 		return 'abc';
// 	}
// }
// add_filter('leephuoc_copyright')

/** Function to demo filter hook */
if(!function_exists('change_copyright')) {
	function change_copyright($output) {
		$output = 'Hello footer';

		return $output;
	}
}
add_filter('leephuoc_copyright', 'change_copyright');

//hook into the init action and call create_topics_nonhierarchical_taxonomy when it fires

add_action( 'init', 'create_topics_nonhierarchical_taxonomy', 0 );

function create_topics_nonhierarchical_taxonomy() {

    // Labels part for the GUI
    $labels = array(
        'name'                  => _x( 'Books', 'Post type general name', 'textdomain' ),
        'singular_name'         => _x( 'Book', 'Post type singular name', 'textdomain' ),
        'menu_name'             => _x( 'Books', 'Admin Menu text', 'textdomain' ),
        'name_admin_bar'        => _x( 'Book', 'Add New on Toolbar', 'textdomain' ),
        'add_new'               => __( 'Add New', 'textdomain' ),
        'add_new_item'          => __( 'Add New Book', 'textdomain' ),
        'new_item'              => __( 'New Book', 'textdomain' ),
        'edit_item'             => __( 'Edit Book', 'textdomain' ),
        'view_item'             => __( 'View Book', 'textdomain' ),
        'all_items'             => __( 'All Books', 'textdomain' ),
        'search_items'          => __( 'Search Books', 'textdomain' ),
        'parent_item_colon'     => __( 'Parent Books:', 'textdomain' ),
        'not_found'             => __( 'No books found.', 'textdomain' ),
        'not_found_in_trash'    => __( 'No books found in Trash.', 'textdomain' ),
        'featured_image'        => _x( 'Book Cover Image', 'Overrides the “Featured Image” phrase for this post type. Added in 4.3', 'textdomain' ),
        'set_featured_image'    => _x( 'Set cover image', 'Overrides the “Set featured image” phrase for this post type. Added in 4.3', 'textdomain' ),
        'remove_featured_image' => _x( 'Remove cover image', 'Overrides the “Remove featured image” phrase for this post type. Added in 4.3', 'textdomain' ),
        'use_featured_image'    => _x( 'Use as cover image', 'Overrides the “Use as featured image” phrase for this post type. Added in 4.3', 'textdomain' ),
        'archives'              => _x( 'Book archives', 'The post type archive label used in nav menus. Default “Post Archives”. Added in 4.4', 'textdomain' ),
        'insert_into_item'      => _x( 'Insertinto book', 'Overrides the “Insert into post”/”Insert into page” phrase (used when inserting media into a post). Added in 4.4', 'textdomain' ),
        'uploaded_to_this_item' => _x( 'Uploaded to this book', 'Overrides the “Uploaded to this post”/”Uploaded to this page” phrase (used when viewing media attached to a post). Added in 4.4', 'textdomain' ),
        'filter_items_list'     => _x( 'Filter books list', 'Screen reader text for the filter links heading on the post type listing screen. Default “Filter posts list”/”Filter pages list”. Added in 4.4', 'textdomain' ),
        'items_list_navigation' => _x( 'Books list navigation', 'Screen reader text for the pagination heading on the post type listing screen. Default “Posts list navigation”/”Pages list navigation”. Added in 4.4', 'textdomain' ),
        'items_list'            => _x( 'Books list', 'Screen reader text for the items list heading on the post type listing screen. Default “Posts list”/”Pages list”. Added in 4.4', 'textdomain' ),
    );

    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => true,
        'rewrite'            => array( 'slug' => 'book' ),
        'capability_type'    => 'post',
        'has_archive'        => true,
        'hierarchical'       => false,
        'menu_position'      => null,
        'supports'           => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments' ),
    );

    register_post_type( 'book', $args );

    $labels = array(
        'name' => _x( 'Topics', 'taxonomy general name' ),
        'singular_name' => _x( 'Topic', 'taxonomy singular name' ),
        'search_items' =>  __( 'Search Topics' ),
        'popular_items' => __( 'Popular Topics' ),
        'all_items' => __( 'All Topics' ),
        'parent_item' => null,
        'parent_item_colon' => null,
        'edit_item' => __( 'Edit Topic' ),
        'update_item' => __( 'Update Topic' ),
        'add_new_item' => __( 'Add New Topic' ),
        'new_item_name' => __( 'New Topic Name' ),
        'separate_items_with_commas' => __( 'Separate topics with commas' ),
        'add_or_remove_items' => __( 'Add or remove topics' ),
        'choose_from_most_used' => __( 'Choose from the most used topics' ),
        'menu_name' => __( 'Topics' ),
    );

    // Now register the non-hierarchical taxonomy like tag

    register_taxonomy('topics','book',array(
        'hierarchical' => false,
        'labels' => $labels,
        'show_ui' => true,
        'show_admin_column' => true,
        'update_count_callback' => '_update_post_term_count',
        'query_var' => true,
        'rewrite' => array( 'slug' => 'topic' ),
    ));
}