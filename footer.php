<?php if(is_mobile()) { ?>

<!-- このリンクでモーダルが表示-->

<div class="modal-window" id="modal-p01">
<div class="modal-inner"><!-- ここからモーダルウィンドウの中身-->
<?php
  $url_encode=urlencode(get_permalink());
  $title_encode=urlencode(get_the_title());
?>
    <ul class="clearfix">
<li>
<div style="margin:-20px;">
<div class="fb-page" data-href="https://www.facebook.com/ikutasjp" data-hide-cover="false" data-show-facepile="true" data-show-posts="false"><div class="fb-xfbml-parse-ignore"><blockquote cite="https://www.facebook.com/ikutasjp"><a href="https://www.facebook.com/ikutasjp">IKU+ （イクタス）Facebookページ</a></blockquote></div></div>

</div>
</li>
</ul>

<div style="padding:15px 0px;"></div>

    <ul class="clearfix">


<li>
<div style="margin:-15px;">
<a href="https://twitter.com/ikutas_tweet" class="twitter-follow-button" data-show-count="false" data-lang="ja">@ikutas_tweetさんをフォロー</a>
</div>
</li>
</ul>

<!-- ここまでモーダルウィンドウの中身-->
</div>
 <a href="#!" class="modal-close">&times;</a>
 </div>

<?php } else { ?>
<div id="testfoot">
<div id="testfoot-in">

<!-- ここからPCフッター内容１つめ　-->

<div id="testfoot-cont1">
<p class="foottitle">About</p>

<p class="describe">
もっと子育てをしやすく。</br>
もっと子育てを身近に。</br>
毎日の育児にプラスを。</br></br>

核家族化が進む現代において、「社会みんなで子供を育てていく」、そんな感覚があれば、もっと子育てがしやすくなるんじゃないか。</br>
そんな社会を目指して、このブログメディアをつくりました。</br></br>
子育てを「子育て世帯だけのもの」にせず、もっと身近なものにするべく、心を動かす記事を書いていきます。
</p>

</div>

<!-- ここまでフッター内容１つめ　-->
<!-- ここからフッター内容２つめ　-->

<div id="testfoot-cont2">
<p class="foottitle2">最新の投稿</p>

<?php
foreach((get_the_category()) as $cat) {
$cat_id = 0;
break ;
}$cat_id = NULL;
$query = 'cat=' . $cat_id. '&showposts=6'; //表示本数
query_posts($query) ;
?>
<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
<span style="font-weight:normal;line-height:200%;">●<?php the_time('Y/m/d') ?></span>　<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a><br>

<?php endwhile; else: ?>
<p>エントリがありません</p>
<?php endif; ?>
<?php wp_reset_query(); ?>
</div>
<p class="clear"></p>
<!-- ここまでフッター内容２つめ　＆　横並び終わり　-->

<!-- ここからフッター内容３つめ　-->
<div id="testfoot-cont3">
<p class="foottitle3">Menu</p>
<ul class="testnavi">
<?php wp_nav_menu(array('theme_location' => 'navbar'));?>
</ul>
<p class="clear"></p>

</div>

<!-- ここまでフッター内容３つめ　-->
</div>
</div>
<?php } ?>
<!-- testfoot終わり　-->



<footer id="footer">
  <h3>
    <?php if (is_home()) { ?>
    <?php bloginfo( 'name' ); ?>
    <?php } else { ?>
    <?php wp_title(''); ?>
    <?php } ?>
  </h3>
  <p>
    <?php bloginfo('description'); ?>
  </p>
  <p class="copy">Copyright&copy;
    <?php bloginfo('name');?>
    ,
    <?php the_date('Y');?>
    All Rights Reserved.</p>
</footer>
</div>
<!-- /#wrapper -->
<!-- ページトップへ戻る -->
<?php if(!is_mobile()){?>
  <div id="page-top" class="page-top page-top-show"><a href="#wrapper" class="fa fa-angle-up"></a></div>
<?php } ?>
<!-- ページトップへ戻る　終わり -->
<?php  wp_enqueue_script('base',get_bloginfo('template_url') . '/js/base.js', array()); ?>

<?php if(is_mobile()) { //PCのみ追尾広告のjs読み込み ?>
<?php } else { ?>
<?php  wp_enqueue_script('scroll',get_bloginfo('template_url') . '/js/scroll.js', array()); ?>
<?php } ?>

<?php wp_footer(); ?>

<!-- ソーシャルボタンスクリプト読み込み -->

<script>
(function (w, d) {
w._gaq = [["_setAccount", "UA-XXXXXXXX-X"],["_trackPageview"]];
w.___gcfg = {lang: "ja"};
var s, e = d.getElementsByTagName("script")[0],
a = function (u, i) {
if (!d.getElementById(i)) {
s = d.createElement("script");
s.src = u;
if (i) {s.id = i;}
e.parentNode.insertBefore(s, e);
}
};
a(("https:" == location.protocol ? "//ssl" : "//www") + ".google-analytics.com/ga.js", "ga");
a("https://apis.google.com/js/plusone.js");
a("//b.st-hatena.com/js/bookmark_button_wo_al.js");
a("//platform.twitter.com/widgets.js", "twitter-wjs");
a("//connect.facebook.net/ja_JP/all.js#xfbml=1", "facebook-jssdk");
})(this, document);
</script>

<script type="text/javascript">!function(d,i){if(!d.getElementById(i)){var j=d.createElement("script");j.id=i;j.src="https://widgets.getpocket.com/v1/j/btn.js?v=1";var w=d.getElementById(i);d.body.appendChild(j);}}(document,"pocket-btn-js");</script>



</body></html>
