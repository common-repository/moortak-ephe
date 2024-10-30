<?php

namespace Elementor;

use WP_Query;

class moortak_portfolio_hover_effect_widget extends Widget_Base
{

    public function get_name()
    {
        return 'portfolio_hover';
    }

    public function get_title()
    {
        return __('Portfolio Hover Effect', 'moortak-ephe');
    }

    public function get_icon()
    {
        return 'fa fa-images';
    }

    public function get_categories()
    {
        return [ 'basic' ];
    }

    protected function _register_controls()
    {
        $this->start_controls_section(
            'content_section', [
                'label' => __('Portfolio Content', 'moortak-ephe'),
                'tab'   => Controls_Manager::TAB_CONTENT,
            ]
        );
        $categories = [];
        $terms = get_terms(
            [
                'taxonomy'   => 'portfolio_category',
                'hide_empty' => false,
                'number'     => 0,
            ]
        );
        if ( $terms && ! is_wp_error($terms) ){
            foreach ( $terms as $term ) {
                $categories[ $term->term_id ] = $term->name;
            }
        }
        $this->add_control(
            'categories', [
                'label'       => __('Categories', 'moortak-ephe'),
                'type'        => Controls_Manager::SELECT2,
                'multiple'    => true,
                'label_block' => true,
                'options'     => $categories,
            ]
        );
        $this->add_control(
            'order', [
                'label'   => __('Order Items', 'moortak-ephe'),
                'type'    => Controls_Manager::SELECT,
                'options' => [
                    'rand' => __('Random', 'moortak-ephe'),
                    'date' => __('Date', 'moortak-ephe'),
                ],
                'default' => 'rand',
            ]
        );
        $this->add_control(
            'count', [
                'label'   => __('Count', 'moortak-ephe'),
                'type'    => Controls_Manager::NUMBER,
                'default' => '8',
            ]
        );
        $this->add_control(
            'excerpt_count', [
                'label'   => __('Excerpt word count', 'moortak-ephe'),
                'type'    => Controls_Manager::NUMBER,
                'default' => '7',
            ]
        );
        $this->end_controls_section();
        $this->start_controls_section(
            'style_section', [
                'label' => __('Styles', 'moortak-ephe'),
                'tab'   => Controls_Manager::TAB_CONTENT,
            ]
        );
        $this->add_control(
            'popover-content-background',
            [
                'label'        => __('Item Content background', 'moortak-ephe'),
                'type'         => Controls_Manager::POPOVER_TOGGLE,
                'label_off'    => __('Off', 'moortak-ephe'),
                'label_on'     => __('On', 'moortak-ephe'),
                'return_value' => 'yes',
            ]
        );
        $this->start_popover();
        $this->add_group_control(
            Group_Control_Background::get_type(), [
                'name'     => 'content_background',
                'label'    => __('Content Background', 'moortak-ephe'),
                //                'types'    => [ 'classic', 'gradient' ],
                //                'default'  => '#000000',
                'selector' => '{{WRAPPER}} .portfolio-item a .portfolio-content',
            ]
        );
        $this->end_popover();
        $this->add_control(
            'popover-content-hover',
            [
                'label'        => __('Item hover background', 'moortak-ephe'),
                'type'         => Controls_Manager::POPOVER_TOGGLE,
                'label_off'    => __('Off', 'moortak-ephe'),
                'label_on'     => __('On', 'moortak-ephe'),
                'return_value' => 'yes',
            ]
        );
        $this->start_popover();
        $this->add_group_control(
            Group_Control_Background::get_type(), [
                'name'     => 'content_hover_background',
                'label'    => __('Content Hover Background', 'moortak-ephe'),
                //                'types'    => [ 'classic', 'gradient' ],
                //                'default'  => '#000000',
                'selector' => '{{WRAPPER}} .portfolio-item a:hover .portfolio-content',
            ]
        );
        $this->end_popover();
        $this->add_control(
            'popover-item-hover',
            [
                'label'        => __('Item hover after background', 'moortak-ephe'),
                'type'         => Controls_Manager::POPOVER_TOGGLE,
                'label_off'    => __('Off', 'moortak-ephe'),
                'label_on'     => __('On', 'moortak-ephe'),
                'return_value' => 'yes',
            ]
        );
        $this->start_popover();
        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name'     => 'item_after',
                'label'    => __('Item hover after background', 'moortak-ephe'),
                //                'types'    => [ 'classic', 'gradient' ],
                //                'default'  => 'linear-gradient(0deg, rgba(26, 90, 162, 0.7), transparent)',
                'selector' => '{{WRAPPER}} .portfolio-item a .portfolio-image:after',
            ]
        );
        $this->end_popover();
        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'item_shadow',
                'label'    => __('Box Shadow', 'moortak-ephe'),
                'selector' => '{{WRAPPER}} .portfolio-item a',
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'item_title_typography',
                'label'    => __('Item Title Typography', 'moortak-ephe'),
                'selector' => '{{WRAPPER}} .portfolio-item a .portfolio-title',
            ]
        );
        $this->add_control(
            'popover-title-style',
            [
                'label'        => __('Item Title styles', 'moortak-ephe'),
                'type'         => Controls_Manager::POPOVER_TOGGLE,
                'label_off'    => __('Off', 'moortak-ephe'),
                'label_on'     => __('On', 'moortak-ephe'),
                'return_value' => 'yes',
            ]
        );
        $this->start_popover();
        $this->add_control(
            'title_normal_color', [
                'label'     => __('Title Normal Color', 'moortak-ephe'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#000000',
                //                'alpha'    => false,
                'selectors' => [
                    '{{WRAPPER}} .portfolio-item a .portfolio-title' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_control(
            'title_hover_color', [
                'label'     => __('Title Hover Color', 'moortak-ephe'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#FFFFFF',
                //                'alpha'    => false,
                'selectors' => [
                    '{{WRAPPER}} .portfolio-item a:hover .portfolio-title' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->end_popover();
        $this->add_control(
            'show_excerpt', [
                'name'         => 'show_excerpt',
                'label'        => __('show excerpt?', 'moortak-ephe'),
                'show_label'   => true,
                'label_on'     => __('Yes', 'moortak-ephe'),
                'label_off'    => __('No', 'moortak-ephe'),
                'return_value' => 'yes',
                'default'      => 'off',
                'type'         => Controls_Manager::SWITCHER,
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'item_excerpt_typography',
                'label'    => __('Item Content Typography', 'moortak-ephe'),
                'selector' => '{{WRAPPER}} .portfolio-item a .portfolio-content .portfolio-excerpt',
            ]
        );
        $this->add_control(
            'popover-item-excerpt',
            [
                'label'        => __('Item excerpt styles', 'moortak-ephe'),
                'type'         => Controls_Manager::POPOVER_TOGGLE,
                'label_off'    => __('Off', 'moortak-ephe'),
                'label_on'     => __('On', 'moortak-ephe'),
                'return_value' => 'yes',
            ]
        );
        $this->start_popover();
        $this->add_control(
            'excerpt_normal_color', [
                'label'     => __('Excerpt Normal Color', 'moortak-ephe'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#000000',
                'alpha'     => false,
                'selectors' => [
                    '{{WRAPPER}} .portfolio-item a .portfolio-content .portfolio-excerpt' => 'color: {{VALUE}} !important;',
                ],
            ]
        );
        $this->add_control(
            'excerpt_hover_color', [
                'label'     => __('Excerpt Hover Color', 'moortak-ephe'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#FFFFFF',
                'alpha'     => false,
                'selectors' => [
                    '{{WRAPPER}} .portfolio-item a:hover .portfolio-content .portfolio-excerpt' => 'color: {{VALUE}} !important;',
                ],
            ]
        );
        $this->end_popover();
        $this->add_responsive_control(
            'items_per_row', [
                'label'           => __('Items Per Row', 'moortak-ephe'),
                'type'            => Controls_Manager::SELECT,
                'options'         => [
                    '1' => __('One', 'moortak-ephe'),
                    '2' => __('Two', 'moortak-ephe'),
                    '3' => __('Three', 'moortak-ephe'),
                    '4' => __('Four', 'moortak-ephe'),
                    '6' => __('Six', 'moortak-ephe'),
                ],
                'devices'         => [ 'desktop', 'tablet', 'mobile' ],
                'desktop_default' => '4',
                'tablet_default'  => '3',
                'mobile_default'  => '1',
                'selectors'       => [
                    '{{WRAPPER}} .portfolio-item' => 'flex-basis: calc(100% / {{VALUE}})',
                ],
            ]
        );
        $this->add_responsive_control(
            'item-padding', [
                'label'           => __('Item padding', 'moortak-ephe'),
                'type'            => Controls_Manager::SLIDER,
                'range'           => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'devices'         => [ 'desktop', 'tablet', 'mobile' ],
                'desktop_default' => [
                    'size' => 5,
                    'unit' => 'px',
                ],
                'tablet_default'  => [
                    'size' => 5,
                    'unit' => 'px',
                ],
                'mobile_default'  => [
                    'size' => 5,
                    'unit' => 'px',
                ],
                'selectors'       => [
                    '{{WRAPPER}} .portfolio-item' => 'padding: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'item-margin-bottom', [
                'label'           => __('Item Margin bottom', 'moortak-ephe'),
                'type'            => Controls_Manager::SLIDER,
                'range'           => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'devices'         => [ 'desktop', 'tablet', 'mobile' ],
                'desktop_default' => [
                    'size' => 0,
                    'unit' => 'px',
                ],
                'tablet_default'  => [
                    'size' => 0,
                    'unit' => 'px',
                ],
                'mobile_default'  => [
                    'size' => 0,
                    'unit' => 'px',
                ],
                'selectors'       => [
                    '{{WRAPPER}} .portfolio-item' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_control(
            'round-item', [
                'label'     => __('Border Radius', 'moortak-ephe'),
                'type'      => Controls_Manager::SLIDER,
                'range'     => [
                    'px' => [
                        'min' => 0,
                        'max' => 30,
                    ],
                ],
                'default'   => [
                    'size' => 4,
                    'unit' => 'px',
                ],
                'selectors' => [
                    '{{WRAPPER}} .portfolio-item a' => 'border-radius: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_section();
    }

    /**
     *
     */
    protected function render()
    {
        $settings      = $this->get_settings_for_display();
        $order         = $settings[ 'order' ];
        $count         = $settings[ 'count' ];
        $categories    = $settings[ 'categories' ];
        $show_excerpt  = $settings[ 'show_excerpt' ];
        $excerpt_count = $settings[ 'excerpt_count' ];
        $query         = new WP_Query(
            [
                'post_type'      => 'portfolio',
                'posts_per_page' => $count,
                'orderby'        => $order,
                'order'          => 'DESC',
                'tax_query'      => [
                    [
                        'taxonomy' => 'portfolio_category',
                        'field'    => 'id',
                        'terms'    => $categories,
                    ],
                ],
            ]
        );
        $html_content  = '';
        if ( $query->have_posts() ){
            $html_content .= '<div class=" moortak-portfolio-hover-box">';
            while ( $query->have_posts() ):$query->the_post();
                if ( $show_excerpt == 'on' ){
                    $get_excerpt = get_the_excerpt(get_the_ID());
                    $excerpt     = wp_trim_words($get_excerpt, $excerpt_count);
                }
                $img_url = get_theme_file_uri('img/default-portfolio-image.png');
                if ( has_post_thumbnail() ){
                    $img_url = get_the_post_thumbnail_url(
                        get_the_ID(), 'moortak_portfolio_hover_image'
                    );
                }
                $html_content .= '<div class="portfolio-item">' .
                                 '<a href="' . get_permalink() . '">' .
                                 '<div class="portfolio-image">' .
                                 '<img class="img-fluid" src="' . $img_url . '">' .
                                 '</div>' .
                                 '<div class="portfolio-content">' .
                                 '<h4 class="portfolio-title">' . get_the_title() . '</h4>';
                if ( $show_excerpt == 'on' ){
                    $html_content .= '<p data-show="'.$show_excerpt.'" class="portfolio-excerpt">' . $excerpt . '</p>';
                }
                $html_content .= '</div>' .
                                 '</a>' .
                                 '</div>';
            endwhile;
            wp_reset_postdata();
            $html_content .= '</div>';
        }
        echo $html_content;
    }
}
