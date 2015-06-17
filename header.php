<!DOCTYPE html>
<!--[if lt IE 7]> <html class="ie6" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 7]> <html class="i7" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 8]> <html class="ie" <?php language_attributes(); ?>> <![endif]-->
<!--[if gt IE 8]><!--> <html <?php language_attributes(); ?>> <!--<![endif]-->
<head>
<meta charset="<?php bloginfo('charset'); ?>" />
<meta name="viewport" content="width=device-width,initial-scale=1.0,user-scalable=no">
<meta name="format-detection" content="telephone=no" />
<?php if(is_category()): ?>
<?php elseif(is_archive()): ?>
<meta name="robots" content="noindex,follow">
<?php elseif(is_search()): ?>
<meta name="robots" content="noindex,follow">
<?php elseif(is_tag()): ?>
<meta name="robots" content="noindex,follow">
<?php elseif(is_paged()): ?>
<meta name="robots" content="noindex,follow">
<?php endif; ?>
<title>
<?php
global $page, $paged;
if(is_front_page()):
elseif(is_single()):
wp_title('|',true,'right');
elseif(is_page()):
wp_title('|',true,'right');
elseif(is_archive()):
wp_title('|',true,'right');
elseif(is_search()):
wp_title('|',true,'right');
elseif(is_404()):
echo'404 |';
endif;
bloginfo('name');
if($paged >= 2 || $page >= 2):
echo'-'.sprintf('%sページ',
max($paged,$page));
endif;
?>
</title>
<link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/css/normalize.css">
<link rel="stylesheet" href="<?php echo get_stylesheet_uri(); ?>" type="text/css" media="screen" />
<link rel="alternate" type="application/rss+xml" title="<?php bloginfo('name'); ?> RSS Feed" href="<?php bloginfo('rss2_url'); ?>" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
<link rel="shortcut icon" href="http://ikutas.jp/wp-content/uploads/2015/03/favicon.ico" />
<link href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css" rel="stylesheet">
<!--[if lt IE 9]>
<script src="http://css3-mediaqueries-js.googlecode.com/svn/trunk/css3-mediaqueries.js"></script>
<script src="<?php bloginfo('template_directory'); ?>/js/html5shiv.js"></script>
<![endif]-->
<?php wp_head(); ?>
<?php if(is_mobile()) { ?>
<link rel="apple-touch-icon-precomposed" href="<?php echo get_template_directory_uri(); ?>/images/apple-touch-icon-precomposed.png" />
<?php } else { ?>
<?php } ?>

<!--Google analyticsコード-->
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-53380701-1', 'auto');
　ga('require', 'displayfeatures');
　ga('require', 'linkid', 'linkid.js');
  ga('send', 'pageview');

</script>

<!--Google+ Author登録-->
<link rel="author" href="https://plus.google.com/112193508553448280907/posts" />

<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/icomoon/style.css">
<link href='http://fonts.googleapis.com/css?family=Quicksand' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Play:400,700' rel='stylesheet' type='text/css'>

<script type='text/javascript' src='<?php echo get_template_directory_uri(); ?>/js/cssmenu.js'></script>

<!--OGP開始-->
<meta property="fb:app_id" content="430854143739024" />
<meta property="og:locale" content="ja_JP">
<meta property="og:type" content="blog">
<?php
if (is_single()){// 投稿記事
     if(have_posts()): while(have_posts()): the_post();
          echo '<meta property="og:description" content="'.mb_substr(get_the_excerpt(), 0, 150).'">';echo "\n";//抜粋から
     endwhile; endif;
     echo '<meta property="og:title" content="'; the_title(); echo '">';echo "\n";//投稿記事タイトル
     echo '<meta property="og:url" content="'; the_permalink(); echo '">';echo "\n";//投稿記事パーマリンク
} else {//投稿記事以外（ホーム、カテゴリーなど）
     echo '<meta property="og:description" content="'; bloginfo('description'); echo '">';echo "\n";//「一般設定」で入力したブログの説明文
     echo '<meta property="og:title" content="'; bloginfo('name'); echo '">';echo "\n";//「一般設定」で入力したブログのタイトル
     echo '<meta property="og:url" content="'; home_url('/'); echo '">';echo "\n";//「一般設定」で入力したブログのURL
}
?>
<meta property="og:site_name" content="<?php bloginfo('name'); ?>">
<?php
$str = $post->post_content;
$searchPattern = '/<img.*?src=(["\'])(.+?)\1.*?>/i';//投稿記事に画像があるか調べる
if (is_single() or is_page()){//投稿記事か固定ページの場合
if (has_post_thumbnail()){//アイキャッチがある場合
     $image_id = get_post_thumbnail_id();
     $image = wp_get_attachment_image_src( $image_id, 'full');
     echo '<meta property="og:image" content="'.$image[0].'">';echo "\n";
} else if ( preg_match( $searchPattern, $str, $imgurl ) && !is_archive()) {//アイキャッチは無いが画像がある場合
     echo '<meta property="og:image" content="'.$imgurl[2].'">';echo "\n";
} else {//画像が1つも無い場合
     echo '<meta property="og:image" content="【デフォルト画像のURL】">';echo "\n";
}
} else {//投稿記事や固定ページ以外の場合（ホーム、カテゴリーなど）
     echo '<meta property="og:image" content="【デフォルト画像のURL】">';echo "\n";
}
?>
<!--OGP完了-->



</head>
<body <?php body_class(); ?>>
<!-- アコーディオン -->
<nav id="s-navi" class="pcnone">
  <div class="rainbow"></div>

    <dt class="trigger_search">
      <div class="fb-like" data-href="https://www.facebook.com/ikutasjp" data-layout="button_count" data-action="like" data-show-faces="false" data-share="false"></div>
    </dt>

    <dt class="navbar_logo">
      <a href="/"><img src="http://ikutas.jp/wp-content/uploads/2015/02/62cbfbee904a0f593d939cf47432dee8.png" class="navbar_logo_img"></a>
    </dt>
  <dl class="acordion">
    <dt class="trigger">
      <span class="op"><i class="fa fa-bars"></i></span>
    </dt>
    <dd class="acordion_tree">
      <ul>
        <?php wp_nav_menu(array('theme_location' => 'navbar'));?>
      </ul>
      <div class="clear"></div>
    </dd>
</dl>

</nav>
<!-- /アコーディオン -->
<div id="wrapper">
<header>
  <!-- ロゴ又はブログ名 -->
  <p class="sitename"><a href="<?php echo home_url(); ?>/">
    <?php if (get_option('stinger_logo_image')): //ロゴ画像がある時 ?>
    <img alt="<?php bloginfo( 'name' ); ?>" src="<?php echo esc_url(get_option('stinger_logo_image')); ?>" />
    <?php else: //ロゴ画像が無い時 ?>
    <?php bloginfo( 'name' ); ?>
    <?php endif; ?>
    </a></p>
  <!-- キャプション -->
  <?php if (is_home()) { ?>
  <h1 class="descr">
    <?php bloginfo('description'); ?>
  </h1>
  <?php } else { ?>
  <p class="descr">
    <?php bloginfo('description'); ?>
  </p>
  <?php } ?>

  <!--
カスタムヘッダー画像
-->
  <div id="gazou">
    <?php if(get_header_image()): ?>
    <p id="headimg"><img src="<?php header_image(); ?>" alt="*" width="<?php echo HEADER_IMAGE_WIDTH; ?>" height="<?php echo HEADER_IMAGE_HEIGHT; ?>" /></p>
    <?php endif; ?>
  </div>
  <!-- /gazou -->
<!--メニュー-->
<nav class="smanone clearfix">
<?php wp_nav_menu(
array(
'container' => false ,
'items_wrap' => '<ul id="menu">%3$s</ul>'
)
); ?>
</nav>
</header>
