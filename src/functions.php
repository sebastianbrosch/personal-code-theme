<?php
/**
 * editor stylesheet
 */
if (function_exists('personal_code_editor_style') === false) :

  /**
   * add the stylesheet for editor
   */
  function personal_code_editor_style() {
    add_editor_style('style.css');
  }
endif;

add_action('after_setup_theme', 'personal_code_editor_style');

/**
 * enqueue main stylesheet
 */
if (function_exists('personal_code_style') === false) :

  /**
   * enqueue main stylesheet
   */
  function personal_code_style() {
    wp_enqueue_style('personal-code-style', get_template_directory_uri().'/style.css', array(), wp_get_theme(get_template())->get('Version'));
  }
endif;

add_action('wp_enqueue_scripts', 'personal_code_style');

/**
 * enqueue block stylesheets
 */
if (function_exists('personal_code_block_stylesheets') === false) :

  /**
   * we can use wp_enqueue_block_style() to enqueue a stylesheet
   * for a specific block. these will only get loaded when the block
   * is rendered. this leads to an improved performance and is reducing
   * the amount of data requested by visitors.
   */
  function personal_code_block_stylesheets() {
    $blocks = [
      'core/code',
      'core/heading',
      'core/navigation',
      'core/post-content',
      'core/post-date',
      'core/post-excerpt',
      'core/post-template',
      'core/post-terms',
      'core/post-title',
      'core/quote'
    ];

    foreach ($blocks as $block) {
      $slug = str_replace('/', '-', $block);

      wp_enqueue_block_style($block, [
        'handle' => "personal-code-block-{$slug}",
        'src' => get_parent_theme_file_uri("assets/blocks/{$slug}.css"),
        'ver' => wp_get_theme(get_template())->get('Version'),
        'path' => get_parent_theme_file_path("assets/blocks/{$slug}.css")
      ]);
    }
  }
endif;

add_action('after_setup_theme', 'personal_code_block_stylesheets');