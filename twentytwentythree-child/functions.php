<?php 
/* enqueue scripts and style from parent theme */
    
function twentytwentythree_styles() {
    wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );

}
add_action( 'wp_enqueue_scripts', 'twentytwentythree_styles');

add_action( 'init', 'custom_post_type',0);

function custom_post_type() {
      
    $labels = array(
        'name'                => _x( 'Documentation', 'Post Type General Name', 'twentytwentytwo' ),
        'singular_name'       => _x( 'Document', 'Post Type Singular Name', 'twentytwentytwo' ),
        'menu_name'           => __( 'Documentation', 'twentytwentytwo' ),
        'all_items'           => __( 'All Documentation', 'twentytwentytwo' ),
        'view_item'           => __( 'View Document', 'twentytwentytwo' ),
        'add_new_item'        => __( 'Add New Document', 'twentytwentytwo' ),
        'add_new'             => __( 'Add New', 'twentytwentytwo' ),
        'edit_item'           => __( 'Edit Document', 'twentytwentytwo' ),
        'update_item'         => __( 'Update Document', 'twentytwentytwo' ),
        'search_items'        => __( 'Search Document', 'twentytwentytwo' ),
        'not_found'           => __( 'Not Found', 'twentytwentytwo' ),
        'not_found_in_trash'  => __( 'Not found in Trash', 'twentytwentytwo' ),
    );
                
    $args = array(
        'label'               => __( 'Documentation', 'twentytwentytwo' ),
        'description'         => __( 'Testimonial news and reviews', 'twentytwentytwo' ),
        'labels'              => $labels,
        'supports'            => array( 'title', 'editor', 'excerpt', 'author', 'thumbnail', 'comments', 'revisions', 'custom-fields', ),
        'taxonomies'          => array( 'testimonial_categories' ),
        
        'hierarchical'        => false,
        'public'              => true,
        'show_ui'             => true,
        'show_in_menu'        => true,
        'show_in_nav_menus'   => true,
        'show_in_admin_bar'   => true,
        'menu_position'       => 5,
        'can_export'          => true,
        'has_archive'         => true,
        'exclude_from_search' => false,
        'publicly_queryable'  => true,
        'capability_type'     => 'post',
        'show_in_rest' => true,
  
    );
      
register_post_type( 'documentation', $args );
}

function meta_test() {
    register_block_type_from_metadata(
        __DIR__ . '/blocks/documentation-meta',
        array(
            'render_callback' => 'render_block_core_documentation_meta',
        )
    );
}
add_action( 'init', 'meta_test' );


function render_block_core_documentation_meta( $attributes, $content, $block ){
    static $seen_ids = array();
   $postId = $block->context['postId']; 
    $post_meta =  get_post_meta($postId);
    $html  .= '<ul>';
    foreach ($post_meta as $key => $value) {
        $html .= "<li>".$key." : ". $value." </li>";
    }
    $html  .= '</ul><br>';
    return $html;
}


