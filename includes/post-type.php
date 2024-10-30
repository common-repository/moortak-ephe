<?php
if ( ! post_type_exists('portfolio') ){
    // Register Custom Post Type
    function mphe_register_portfolio()
    {
        $labels          = [
            'name'                  => _x('Portfolios', 'Post Type General Name', 'moortak-ephe'),
            'singular_name'         => _x('Portfolio', 'Post Type Singular Name', 'moortak-ephe'),
            'menu_name'             => __('Portfolios', 'moortak-ephe'),
            'name_admin_bar'        => __('Portfolio', 'moortak-ephe'),
            'archives'              => __('Portfolio Archives', 'moortak-ephe'),
            'attributes'            => __('Portfolio Attributes', 'moortak-ephe'),
            'parent_item_colon'     => __('Parent Portfolio:', 'moortak-ephe'),
            'all_items'             => __('All Portfolios', 'moortak-ephe'),
            'add_new_item'          => __('Add New Portfolio', 'moortak-ephe'),
            'add_new'               => __('Add New', 'moortak-ephe'),
            'new_item'              => __('New Portfolio', 'moortak-ephe'),
            'edit_item'             => __('Edit Portfolio', 'moortak-ephe'),
            'update_item'           => __('Update Portfolio', 'moortak-ephe'),
            'view_item'             => __('View Portfolio', 'moortak-ephe'),
            'view_items'            => __('View Portfolios', 'moortak-ephe'),
            'search_items'          => __('Search Portfolio', 'moortak-ephe'),
            'not_found'             => __('Not found', 'moortak-ephe'),
            'not_found_in_trash'    => __('Not found in Trash', 'moortak-ephe'),
            'featured_image'        => __('Featured Image', 'moortak-ephe'),
            'set_featured_image'    => __('Set featured image', 'moortak-ephe'),
            'remove_featured_image' => __('Remove featured image', 'moortak-ephe'),
            'use_featured_image'    => __('Use as featured image', 'moortak-ephe'),
            'uploaded_to_this_item' => __('Uploaded to this Portfolio', 'moortak-ephe'),
            'items_list'            => __('Portfolios list', 'moortak-ephe'),
            'items_list_navigation' => __('Portfolios list navigation', 'moortak-ephe'),
            'filter_items_list'     => __('Filter Portfolios list', 'moortak-ephe'),
        ];
        $args            = [
            'label'               => __('Portfolio', 'moortak-ephe'),
            'description'         => __('Portfolios', 'moortak-ephe'),
            'labels'              => $labels,
            'supports'            => [ 'title', 'editor','excerpt', 'thumbnail', 'comments' ],
            'taxonomies'          => [ 'Portfolio_category', 'Portfolio_tag' ],
            'hierarchical'        => false,
            'public'              => true,
            'show_ui'             => true,
            'show_in_menu'        => true,
            'menu_position'       => 5,
            'menu_icon'           => 'dashicons-format-gallery',
            'show_in_admin_bar'   => true,
            'show_in_nav_menus'   => true,
            'can_export'          => true,
            'has_archive'         => true,
            'exclude_from_search' => false,
            'publicly_queryable'  => true,
            'capability_type'     => 'page',
            'show_in_rest'        => true,
        ];
        $category_labels = [
            'name'              => __('Portfolio Categories', 'moortak-ephe'),
            'singular_name'     => __('Portfolio Category', 'moortak-ephe'),
            'search_items'      =>
                __('Search Portfolio Categories', 'moortak-ephe'),
            'all_items'         =>
                __('All Portfolio Categories', 'moortak-ephe'),
            'parent_item'       =>
                __('Parent Portfolio Category', 'moortak-ephe'),
            'parent_item_colon' =>
                __('Parent Portfolio Category:', 'moortak-ephe'),
            'edit_item'         =>
                __('Edit Portfolio Category', 'moortak-ephe'),
            'update_item'       =>
                __('Update Portfolio Category', 'moortak-ephe'),
            'add_new_item'      =>
                __('Add New  Portfolio Category', 'moortak-ephe'),
            'new_item_name'     =>
                __('New Portfolio Category Name', 'moortak-ephe'),
            'menu_name'         => __('Portfolio Categories', 'moortak-ephe'),
        ];
        $tag_labels      = [
            'name'              => __('Portfolio Tags', 'moortak-ephe'),
            'singular_name'     => __('Portfolio Tag', 'moortak-ephe'),
            'search_items'      => __('Search Portfolio Tags', 'moortak-ephe'),
            'all_items'         => __('All Portfolio Tags', 'moortak-ephe'),
            'parent_item_colon' => __('Parent Portfolio Tag:', 'moortak-ephe'),
            'edit_item'         => __('Edit Portfolio Tag', 'moortak-ephe'),
            'update_item'       => __('Update Portfolio Tag', 'moortak-ephe'),
            'add_new_item'      => __('Add New Portfolio Tag', 'moortak-ephe'),
            'new_item_name'     =>
                __('New Portfolio Tag Name', 'moortak-ephe'),
            'menu_name'         => __('Portfolio Tags', 'moortak-ephe'),
        ];
        $category_args   = [
            'hierarchical'      => true,
            'labels'            => $category_labels,
            'show_ui'           => true,
            'show_admin_column' => true,
            'query_var'         => true,
            'rewrite'           => [
                'slug' => 'portfolio-category',
            ],
        ];
        $tag_args        = [
            'hierarchical'      => false,
            'labels'            => $tag_labels,
            'show_ui'           => true,
            'show_admin_column' => true,
            'query_var'         => true,
            'rewrite'           => [ 'slug' => 'portfolio-tag' ],
        ];
        register_post_type('portfolio', $args);
        if ( ! taxonomy_exists('portfolio_category') ){
            register_taxonomy('portfolio_category', [ 'portfolio' ], $category_args);
        }
        if ( ! taxonomy_exists('portfolio_tag') ){
            register_taxonomy('portfolio_tag', [ 'portfolio' ], $tag_args);
        }
    }

    add_action('init', 'mphe_register_portfolio', 0);
}
