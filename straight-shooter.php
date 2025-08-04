<?php
/**
 * Plugin Name: Straight Shooter
 * Description: Replaces curly quotes, dashes, and other problematic characters with straight ASCII equivalents.
 * Version: 1.2
 * Author: AirborneSurfer.com
 * Author URI: https://airbornesurfer.com
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * The core function that performs the find-and-replace.
 * It targets a list of problematic Unicode characters and replaces them with
 * their simple, ASCII-friendly equivalents.
 *
 * @param string $content The post or comment content.
 * @return string The sanitized content.
 */
function pn_straight_shooter($content) {
    // A list of problematic characters and their ASCII-friendly replacements.
    $find = array(
        '—', '–',           // Em-dash and en-dash
        '‘', '’',           // Curly single quotes
        '“', '”',           // Curly double quotes
        '…',              // Ellipsis
        '€',              // Euro sign
        '™',              // Trademark symbol
        '®',              // Registered trademark symbol
        '©',              // Copyright symbol
        '█',              // Unicode block character
    );

    // Replaced with the user's preferred aesthetic and ASCII equivalents.
    $replace = array(
        '--', ' - ',
        '\'', '\'',
        '"', '"',
        '...',
        'E',
        '(TM)',
        '(R)',
        '(C)',
        chr(219),         // ASCII 219 is the block character
    );

    // Perform the replacement using str_replace, which is fast and efficient.
    $sanitized_content = str_replace($find, $replace, $content);

    return $sanitized_content;
}

// Attach the function to the `the_content` filter. This will sanitize content on the front-end.
add_filter('the_content', 'pn_straight_shooter');

// Attach the function to the `the_editor_content` filter to sanitize content directly in the editor.
add_filter('the_editor_content', 'pn_straight_shooter');

// Attach the function to the `comment_text` filter to sanitize comments.
add_filter('comment_text', 'pn_straight_shooter');
