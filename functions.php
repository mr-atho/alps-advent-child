<?php
// Exit if accessed directly
if (!defined('ABSPATH')) exit;

// BEGIN ENQUEUE PARENT ACTION
// AUTO GENERATED - Do not modify or remove comment markers above or below:

function my_theme_enqueue_styles()
{

    $parent_style = 'parent-style';

    wp_enqueue_style($parent_style, get_template_directory_uri() . '/dist/styles/main.css');
    wp_enqueue_style(
        'child-style',
        get_stylesheet_directory_uri() . '/style.css',
        array($parent_style),
        wp_get_theme()->get('Version')
    );
}
add_action('wp_enqueue_scripts', 'my_theme_enqueue_styles');

// END ENQUEUE PARENT ACTION

// Tambah Post Format
add_theme_support('post-formats', array('image', 'video'));

/**
 * Register sidebars
 */
add_action('widgets_init', function () {
    $config = [
        'before_widget' => '<section class="c-widget c-%1$s c-%2$s u-spacing u-background-color--gray--light u-padding u-theme--border-color--darker u-border--left can-be--dark-dark">',
        'after_widget'  => '</section>',
        'before_title'  => '<h3 class="c-block__heading-title u-theme--color--darker">',
        'after_title'   => '</h3>'
    ];
    register_sidebar([
        'name'          => __('Page Sidebar Top', 'alps'),
        'id'            => 'sidebar-page-top'
    ] + $config);
});

// Ambil gambar pertama
function gpi_find_image_id($post_id)
{
    if (!$img_id = get_post_thumbnail_id($post_id)) {
        $attachments = get_children(array(
            'post_parent' => $post_id,
            'post_type' => 'attachment',
            'numberposts' => 1,
            'post_mime_type' => 'image'
        ));
        if (is_array($attachments)) foreach ($attachments as $a)
            $img_id = $a->ID;
    }
    if ($img_id)
        return $img_id;
    return false;
}

function find_img_src($post)
{
    if (!$img = gpi_find_image_id($post->ID))
        if ($img = preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $post->post_content, $matches))
            $img = $matches[1][0];
    if (is_int($img)) {
        $img = wp_get_attachment_image_src($img);
        $img = $img[0];
    }
    return $img;
}
add_action('init', 'gpi_find_image_id', 10);
add_action('init', 'find_img_src', 15);

// Cari video dalam sebuah post
function get_first_oembed_from_content($content)
{
    preg_match_all('|^\s*(https?://[^\s"]+)\s*$|im', $content, $matches);
    foreach ($matches[1] as $match) {
        if (wp_oembed_get($match)) {
            return $match;
        }
    }
    return false;
}

// Ambil Video Thumbnail
function get_video_thumbnail($src = '')
{
    if (empty($src))
        return false;

    $url_pieces = explode('/', $src);
    if ($url_pieces[2] == 'dai.ly') {
        $id = $url_pieces[3];
        $hash = json_decode(file_get_contents('https://api.dailymotion.com/video/' . $id . '?fields=thumbnail_large_url'), TRUE);
        $thumbnail = $hash['thumbnail_large_url'];
    } else if ($url_pieces[2] == 'www.dailymotion.com') {
        $id = $url_pieces[4];
        $hash = json_decode(file_get_contents('https://api.dailymotion.com/video/' . $id . '?fields=thumbnail_large_url'), TRUE);
        $thumbnail = $hash['thumbnail_large_url'];
    } else if ($url_pieces[2] == 'vimeo.com') { // If Vimeo
        $id = $url_pieces[3];
        $hash = unserialize(file_get_contents('http://vimeo.com/api/v2/video/' . $id . '.php'));
        $thumbnail = $hash[0]['thumbnail_large'];
    } elseif ($url_pieces[2] == 'youtu.be') { // If Youtube
        $extract_id = explode('?', $url_pieces[3]);
        $id = $extract_id[0];
        $thumbnail = 'http://img.youtube.com/vi/' . $id . '/mqdefault.jpg';
    } else if ($url_pieces[2] == 'player.vimeo.com') { // If Vimeo
        $id = $url_pieces[4];
        $hash = unserialize(file_get_contents('http://vimeo.com/api/v2/video/' . $id . '.php'));
        $thumbnail = $hash[0]['thumbnail_large'];
    } elseif ($url_pieces[2] == 'www.youtube.com') { // If Youtube
        $extract_id = explode('=', $url_pieces[3]);
        $id = $extract_id[1];
        $thumbnail = 'http://img.youtube.com/vi/' . $id . '/mqdefault.jpg';
    } else {
        $thumbnail = tim_thumb_default_image('video-icon.png', null, 147, 252);
    }
    return $thumbnail;
}
