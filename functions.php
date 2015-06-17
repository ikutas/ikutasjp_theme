<?php
function register_jq_script() {
	if (!is_admin()) {
		$script_dir = get_template_directory_uri();
		wp_deregister_script( 'jquery' );
		wp_enqueue_script( 'jquery', 'http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js',array(), false, false);
	}
}
add_action('wp_enqueue_scripts','register_jq_script');

//WordPress の投稿スラッグを自動的に生成する
function auto_post_slug( $slug, $post_ID, $post_status, $post_type ) {
    if ( preg_match( '/(%[0-9a-f]{2})+/', $slug ) ) {
        $slug = utf8_uri_encode( $post_type ) . '-' . $post_ID;
    }
    return $slug;
}
add_filter( 'wp_unique_post_slug', 'auto_post_slug', 10, 4  );

//カスタム背景
$custom_bgcolor_defaults = array(
        'default-color' => '#f2f2f2',
);
add_theme_support( 'custom-background', $custom_bgcolor_defaults );

//カスタムヘッダー
$custom_header = array(
 'random-default' => false,
 'width' => 980,
 'height' => 250,
 'flex-height' => true,
 'flex-width' => false,
 'default-text-color' => '',
 'header-text' => false,
 'uploads' => true,
 'default-image' => get_template_directory_uri() . '/images/stinger5.png',
);
add_theme_support( 'custom-header', $custom_header );

// 抜粋の長さを変更する
function custom_excerpt_length( $length ) {
     return 40;
}
add_filter( 'excerpt_length', 'custom_excerpt_length', 999 );

// 文末文字を変更する
function custom_excerpt_more($more) {
	return ' ... ';
}
add_filter('excerpt_more', 'custom_excerpt_more');

//スマホ表示分岐
function is_mobile(){
    $useragents = array(
        'iPhone', // iPhone
        'iPod', // iPod touch
        'Android.*Mobile', // 1.5+ Android *** Only mobile
        'Windows.*Phone', // *** Windows Phone
        'dream', // Pre 1.5 Android
        'CUPCAKE', // 1.5+ Android
        'blackberry9500', // Storm
        'blackberry9530', // Storm
        'blackberry9520', // Storm v2
        'blackberry9550', // Storm v2
        'blackberry9800', // Torch
        'webOS', // Palm Pre Experimental
        'incognito', // Other iPhone browser
        'webmate' // Other iPhone browser

    );
    $pattern = '/'.implode('|', $useragents).'/i';
    return preg_match($pattern, $_SERVER['HTTP_USER_AGENT']);
}
//アイキャッチサムネイル
add_theme_support('post-thumbnails');
add_image_size('thumb100',100,100,true);
add_image_size('thumb150',150,150,true);


//カスタムメニュー
register_nav_menus(array('navbar' => 'ナビゲーションバー'));

//RSS
add_theme_support('automatic-feed-links');

// 管理画面にオリジナルのスタイルを適用
add_editor_style("style.css");	// メインのCSS
add_editor_style('editor-style.css');	// これは入れておこう
if ( ! isset( $content_width ) ) $content_width = 580;
function custom_editor_settings( $initArray ){
	$initArray['body_id'] = 'primary';	// id の場合はこれ
	$initArray['body_class'] = 'post';	// class の場合はこれ
	return $initArray;
}
add_filter( 'tiny_mce_before_init', 'custom_editor_settings' );

//投稿用ファイルを読み込む
get_template_part('functions/create-thread');

//ページャー機能
function pagination($pages = '', $range = 4)
{
     $showitems = ($range * 2)+1;

     global $paged;
     if(empty($paged)) $paged = 1;

     if($pages == '')
     {
         global $wp_query;
         $pages = $wp_query->max_num_pages;
         if(!$pages)
         {
             $pages = 1;
         }
     }

     if(1 != $pages)
     {
         echo "<div class=\"pagination\"><span>Page ".$paged." of ".$pages."</span>";
         if($paged > 2 && $paged > $range+1 && $showitems < $pages) echo "<a href='".get_pagenum_link

(1)."'>&laquo; First</a>";
         if($paged > 1 && $showitems < $pages) echo "<a href='".get_pagenum_link($paged - 1)."'>&lsaquo;

Previous</a>";

         for ($i=1; $i <= $pages; $i++)
         {
             if (1 != $pages &&( !($i >= $paged+$range+1 || $i <= $paged-$range-1) || $pages <= $showitems

))
             {
                 echo ($paged == $i)? "<span class=\"current\">".$i."</span>":"<a href='".get_pagenum_link

($i)."' class=\"inactive\">".$i."</a>";
             }
         }

         if ($paged < $pages && $showitems < $pages) echo "<a href=\"".get_pagenum_link($paged +

1)."\">Next &rsaquo;</a>";
         if ($paged < $pages-1 &&  $paged+$range-1 < $pages && $showitems < $pages) echo "<a

href='".get_pagenum_link($pages)."'>Last &raquo;</a>";
         echo "</div>\n";
     }
}

//ヘッダーを綺麗に
remove_action( 'wp_head', 'feed_links_extra', 3 );
remove_action( 'wp_head', 'feed_links', 2 );
remove_action( 'wp_head', 'rsd_link' );
remove_action( 'wp_head', 'wlwmanifest_link' );
remove_action( 'wp_head', 'index_rel_link' );
remove_action( 'wp_head', 'parent_post_rel_link', 10, 0 );
remove_action( 'wp_head', 'start_post_rel_link', 10, 0 );
remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0 );
remove_action( 'wp_head', 'wp_generator' );

//moreリンク
function custom_content_more_link( $output ) {
    $output = preg_replace('/#more-[\d]+/i', '', $output );
    return $output;
}
add_filter( 'the_content_more_link', 'custom_content_more_link' );

//セルフピンバック禁止
function no_self_ping( &$links ) {
    $home = home_url();
    foreach ( $links as $l => $link )
        if ( 0 === strpos( $link, $home ) )
            unset($links[$l]);
}
add_action( 'pre_ping', 'no_self_ping' );

//iframeのレスポンシブ対応
function wrap_iframe_in_div($the_content) {
  if ( is_singular() ) {
    $the_content = preg_replace('/< *?iframe/i', '<div class="youtube-container"><iframe', $the_content);
    $the_content = preg_replace('/<\/ *?iframe *?>/i', '</iframe></div>', $the_content);
  }
  return $the_content;
}
add_filter('the_content','wrap_iframe_in_div');

//ウイジェット追加
if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar(4) )
register_sidebars(1,
    array(
    'name'=>'サイドバーウイジェット',
    'before_widget' => '<ul><li>',
    'after_widget' => '</li></ul>',
    'before_title' => '<h4 class="menu_underh2">',
    'after_title' => '</h4>',
    ));
register_sidebars(1,
    array(
    'name'=>'スクロール広告用',
    'description' => '「テキスト」をここにドロップして内容を入力して下さい。アドセンスは禁止です。※PC以外では非表示部分',
    'before_widget' => '<ul><li>',
    'after_widget' => '</li></ul>',
    'before_title' => '<h4 class="menu_underh2" style="text-align:left;">',
    'after_title' => '</h4>',
    ));
register_sidebars(1,
    array(
    'name'=>'Googleアドセンス用336px',
    'description' => '「テキスト」をここにドロップしてコードを入力して下さい。タイトルは反映されません。',
    'before_widget' => '',
    'after_widget' => '',
    'before_title' => '<h4 style="display:none">',
    'after_title' => '</h4>',
    ));

register_sidebars(1,
    array(
    'name'=>'Googleアドセンスのスマホ用300px',
    'description' => '「テキスト」をここにドロップしてコードを入力して下さい。タイトルは反映されません。',
    'before_widget' => '',
    'after_widget' => '',
    'before_title' => '<h4 style="display:none">',
    'after_title' => '</h4>',
    ));


//更新日の追加
function get_mtime($format) {
    $mtime = get_the_modified_time('Ymd');
    $ptime = get_the_time('Ymd');
    if ($ptime > $mtime) {
        return get_the_time($format);
    } elseif ($ptime === $mtime) {
        return null;
    } else {
        return get_the_modified_time($format);
    }
}


//more位置へ挿入
add_filter('the_content', 'adMoreReplace');
function adMoreReplace($contentData) {
$adTags = <<< EOD
	<div class="more_pr_area">
	<div class="more_pr_advert">
    <p>SPONSERD LINK</p>
<style>
.my_adslot { width: 336px; height: 280px; }
@media(min-width: 500px) { .my_adslot { width: 336px; height: 280px; } }
@media(min-width: 800px) { .my_adslot { width: 336px; height: 280px; } }
</style>
<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
<!-- イクタス記事中レスポンシブ -->
<ins class="adsbygoogle my_adslot"
     style="display:inline-block"
     data-ad-client="ca-pub-6958489098141860"
     data-ad-slot="7375110239"></ins>
<script>
(adsbygoogle = window.adsbygoogle || []).push({});
</script>
	</div>
	</div>
EOD
;
$contentData = preg_replace('/<p><span id="more-([0-9]+?)"><\/span>(.*?)<\/p>/i', $adTags, $contentData);
$contentData = str_replace('', "", $contentData);
$contentData = str_replace('', '', $contentData);
return $contentData;
}

//browser shots カスタマイズ
function browser_shot_target_blank( $content){
    return str_replace( '<div class="browser-shot"><a href="', '<div class="browser-shot"><a target="_blank" href="', $content);
}
add_filter( 'the_content', 'browser_shot_target_blank', 9999);

/* Name : Resize an image at upload
 * Version: 1.0.0
 * Author : Otokuni Consulting Co.,Ltd.
 * Author URI: http://www.oto-con.com/
 * License: GPLv2 or later
 * Description : This function is useful when the user often upload very large size image.
 */

/*
This program is free software; you can redistribute it and/or
modify it under the terms of the GNU General Public License
as published by the Free Software Foundation; either version 2
of the License, or (at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.
*/

function otocon_resize_at_upload( $file ) {
  // $file contains file, url, type
  // array( 'file' => 'path to the image', 'url' => 'url of the image', 'type' => 'mime type' )

  // resize only if the mime type is image
  if ( $file['type'] == 'image/jpeg' OR $file['type'] == 'image/gif' OR $file['type'] == 'image/png') {

    // set width and height
    $w = intval(get_option( 'large_size_w' ) ); // get large size width
    $h = intval(get_option( 'large_size_h' ) ); // get large size height

    // get the uploaded image
    $image = wp_get_image_editor( $file['file'] );

    // if no error
    if ( ! is_wp_error( $image ) ){
      // get image width and height
      $size = getimagesize( $file['file'] ); // $size[0] = width, $size[1] = height

      if ( $size[0] > $w || $size[1] > $h ){ // if the width or height is larger than the large-size
        $image->resize( $w, $h, false ); // resize the image
        $final_image = $image->save( $file['file'] ); // save the resized image
      }
    }

  } // if mime type

  return $file;

}
add_action( 'wp_handle_upload', 'otocon_resize_at_upload' );

//ウィジェットカテゴリカスタマイズ
function theme_list_categories( $output, $args ) {
	$replaced_text = preg_replace('/<\/a> \(([0-9]*)\)/', ' <span class="count">${1}</span></a>', $output);
	if($replaced_text != NULL) {
		return $replaced_text;
	} else {
		return $output;
	}
}
add_filter( 'wp_list_categories', 'theme_list_categories', 10, 2 );

/*****2番目の見出しタグの直前にアドセンスを埋め込むコード********/
add_filter( 'the_content', 'my_insert_ads_into_posts' );
function my_insert_ads_into_posts( $content ) {
    global $my_menu_name;
    if(is_single()){
        $my_ad_code = '<div class="more_pr_area">
    <div class="more_pr_advert">
    <p>SPONSERD LINK</p>
<style>
.my_adslot { width: 336px; height: 280px; }
@media(min-width: 500px) { .my_adslot { width: 336px; height: 280px; } }
@media(min-width: 800px) { .my_adslot { width: 336px; height: 280px; } }
</style>
<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
<!-- イクタス記事中?レスポンシブ -->
<ins class="adsbygoogle my_adslot"
     style="display:inline-block"
     data-ad-client="ca-pub-6958489098141860"
     data-ad-slot="1328576631"></ins>
<script>
(adsbygoogle = window.adsbygoogle || []).push({});
</script>
    </div>
    </div>
';
        if (!is_admin() ) {
            return my_insert_before( $content,2, '<h2' , $my_ad_code );
        }
        return $content;
    }
    else
    {
    return $content;
    }
}
function my_insert_after( $my_content , $my_ikutume, $my_kugiri, $my_insert ) {
    $kugirare_parts = explode( $my_kugiri, $my_content );
    foreach ($kugirare_parts as $index => $kugirare_part) {
        if ( trim( $kugirare_part )) {
            $kugirare_parts[$index] .= $my_kugiri;
        }
        if ( $my_ikutume == $index+1 ) {
            $kugirare_parts[$index] .= $my_insert;
        }
    }
    return implode( '', $kugirare_parts );
}
function my_insert_before( $my_content , $my_ikutume, $my_kugiri, $my_insert ) {
    $kugirare_parts = explode( $my_kugiri, $my_content );
    foreach ($kugirare_parts as $index => $kugirare_part) {
        if ( trim( $kugirare_part )&& $index!=0) {
            $kugirare_parts[$index] = $my_kugiri.$kugirare_parts[$index];
        }
        if ( $my_ikutume == $index ) {
            $kugirare_parts[$index] = $my_insert.$kugirare_parts[$index];
        }
    }
    return implode( '', $kugirare_parts );

}

function my_scripts() {
  wp_enqueue_script( 'cssmenu.js', get_template_directory_uri() . '/js/cssmenu.js', array( 'jquery' ) );
}
add_action( 'wp_enqueue_scripts', 'my_scripts' );
