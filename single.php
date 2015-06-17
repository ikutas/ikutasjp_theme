<?php get_header(); ?>

<?php if (is_mobile()) :?>

  <?php get_template_part('sns-top-mobile');?>

<?php else: ?>

  <?php get_template_part('sns-top');?>

<?php endif; ?>


<div id="content" class="clearfix">
  <div id="contentInner">
    <main>
      <article>
        <div class="post">
          <!--ぱんくず -->
          <div id="breadcrumb">
            <div itemscope itemtype="http://data-vocabulary.org/Breadcrumb"> <a href="<?php echo home_url(); ?>" itemprop="url"> <span itemprop="title">ホーム</span> </a> &gt; </div>
            <?php $postcat = get_the_category(); ?>
            <?php $catid = $postcat[0]->cat_ID; ?>
            <?php $allcats = array($catid); ?>
            <?php
while(!$catid==0) {
    $mycat = get_category($catid);
    $catid = $mycat->parent;
    array_push($allcats, $catid);
}
array_pop($allcats);
$allcats = array_reverse($allcats);
?>
            <?php foreach($allcats as $catid): ?>
            <div itemscope itemtype="http://data-vocabulary.org/Breadcrumb"> <a href="<?php echo get_category_link($catid); ?>" itemprop="url"> <span itemprop="title"><?php echo get_cat_name($catid); ?></span> </a> &gt; </div>
            <?php endforeach; ?>
          </div>
          <!--/ ぱんくず -->

          <section>
            <!--ループ開始 -->
            <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
            <h1 class="entry-title">
              <?php the_title(); //タイトル ?>
            </h1>
            <div class="blogbox">
              <p><span class="kdate"><i class="fa fa-calendar"></i>&nbsp;
                <time class="entry-date" datetime="<?php the_time('c') ;?>">
                  <?php the_time('Y/m/d') ;?>
                </time>
                &nbsp;
                <?php if ($mtime = get_mtime('Y/m/d')) echo ' <i class="fa fa-repeat"></i>&nbsp; ' , $mtime; ?>
                </span>

        <?php if (!is_mobile()) :?>
        <?php the_tags('<span class="tag-smart">','</span><span class="tag-smart">','</span>' ); ?>
        <?php endif; ?>

<span id="shares">
<?php $jetpack_views = stats_get_csv('postviews', array('days' => -1, 'limit' => 1, 'post_id' => $post->ID )); echo $jetpack_views[0]['views'];  ?>
 View</span>

</p>

            </div>


<?php
  $url_encode=urlencode(get_permalink());
  $title_encode=urlencode(get_the_title());
?>

<div class="sns-top-btn sns-btn" id="sns-top-pc">

<a class="sns-btn-twitter" href=http://twitter.com/intent/tweet?url=<?php echo $url_encode ?>&text=<?php echo $title_encode ?>&via=ikutas_tweet&tw_p=tweetbutton><i class="fa fa-twitter"></i><br><span class="sns-btn-style"><?php if(function_exists('scc_get_share_twitter')) echo (scc_get_share_twitter()==0)?'':scc_get_share_twitter(); ?></span></a>

<a class="sns-btn-facebook" href="http://www.facebook.com/sharer.php?src=bm&u=<?php echo $url_encode;?>&t=<?php echo $title_encode;?>" onclick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=300,width=600');return false;"><i class="fa fa-facebook"></i><br><span class="sns-btn-style"><?php if(function_exists('scc_get_share_facebook')) echo (scc_get_share_facebook()==0)?'':scc_get_share_facebook(); ?></span></a>

<a class="sns-btn-googleplus" href="https://plus.google.com/share?url=<?php echo $url_encode;?>" onclick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=500');return false;"><i class="fa fa-google-plus"></i><br><span class="sns-btn-style"><?php if(function_exists('scc_get_share_gplus')) echo (scc_get_share_gplus()==0)?'':scc_get_share_gplus(); ?></span></a>

<a class="sns-btn-hatebu" href="http://b.hatena.ne.jp/add?mode=confirm&url=<?php echo $url_encode ?>" onclick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=400,width=510');return false;"><i class="fa fa-hatena"></i><br><span class="sns-btn-style"><?php if(function_exists('scc_get_share_hatebu')) echo (scc_get_share_hatebu()==0)?'':scc_get_share_hatebu(); ?></span></a>

<a class="sns-btn-pocket" href="http://getpocket.com/edit?url=<?php echo $url_encode;?>&title=<?php echo $title_encode;?>"><span class="icon-pocket"></span><br><span class="sns-btn-style"><?php if(function_exists('scc_get_share_pocket')) echo (scc_get_share_pocket()==0)?'':scc_get_share_pocket(); ?></span></a>

<?php if (is_mobile()) :?>

<a class="sns-btn-line" href="http://line.me/R/msg/text/?<?php echo $title_encode . '%0A' . $url_encode;?>"><span class="icon-line"></span></a>

<?php else: ?>
<?php endif; ?>


</div>


<div style="padding:10px 0px;"></div>


            <?php the_content(); //本文 ?>

<?php if (is_mobile()) :?>

      <div class="p-shareButton p-asideList p-shareButton-bottom">


        <div class="p-shareButton__cont">
          <div class="p-shareButton__a-cont">
            <div class="p-shareButton__a-cont__img" style="background-image: url('<?php echo wp_get_attachment_url( get_post_thumbnail_id($post->ID) ); ?>')"></div>
            <div class="p-shareButton__a-cont__btn">
              <p>この記事が気に入ったらいいね！しよう</p>
              <div class="p-shareButton__fb-cont p-shareButton__fb">
                <div class="fb-like" data-href="https://www.facebook.com/ikutasjp" data-layout="button_count" data-action="like" data-show-faces="false" data-share="false"></div>
                <span class="p-shareButton__fb-unable"></span>
              </div>
            </div>
          </div>
        </div>

        <div class="p-asideFollowUs__twitter">
          <div class="p-asideFollowUs__twitter__cont">
            <p class="p-asideFollowUs__twitter__item">Twitterでイクタスを</p>
            <a href="https://twitter.com/ikutas_tweet" class="twitter-follow-button p-asideFollowUs__twitter__item" data-show-count="false" data-size="large" data-show-screen-name="false">Follow @ikutas</a>
            <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>
          </div>
        </div>

 </div>

<?php else: ?>

<div style="padding:10px 0px;"></div>

 <!-- 記事がよかったらいいね -->
            <div class="p-entry__push">
              <div class="p-entry__pushThumb" style="background-image: url('<?php echo wp_get_attachment_url( get_post_thumbnail_id($post->ID) ); ?>')"></div>
              <div class="p-entry__pushLike">
                <p>この記事が気に入ったら<br>いいね！しよう</p>
                <div class="p-entry__pushButton">
<div class="fb-like" data-href="https://www.facebook.com/ikutasjp" data-layout="button_count" data-action="like" data-show-faces="false" data-share="false"></div>
                </div>
                <p class="p-entry__note">イクタスの最新情報をお届けします</p>
              </div>
            </div>

                        <div class="p-entry__tw-follow">
              <div class="p-entry__tw-follow__cont">
                <p class="p-entry__tw-follow__item">Twitterでイクタスをフォローしよう！</p>
                <a href="https://twitter.com/ikutas_tweet" class="twitter-follow-button p-entry__tw-follow__item" data-show-count="false" data-size="large" data-show-screen-name="false">Follow @ikutas</a>
                <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>
              </div>
</div>


 <!-- 記事がよかったらいいね　ここまで -->

<?php endif; ?>


    <div class="more_pr_area">
    <div class="more_pr_advert">
    <p>SPONSERD LINK</p>
<style>
.my_adslot { width: 336px; height: 280px; }
@media(min-width: 500px) { .my_adslot { width: 336px; height: 280px; } }
@media(min-width: 800px) { .my_adslot { width: 336px; height: 280px; } }
</style>
<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
<!-- イクタス記事下レスポンシブ -->
<ins class="adsbygoogle my_adslot"
     style="display:inline-block"
     data-ad-client="ca-pub-6958489098141860"
     data-ad-slot="4282043039"></ins>
<script>
(adsbygoogle = window.adsbygoogle || []).push({});
</script>
    </div>
    </div>


<h4>この記事を書いた人</h4>
<?php if ( function_exists( 'wpsabox_author_box' ) ) echo wpsabox_author_box(); ?>

          </section>
          <!--/section-->

          <?php wp_link_pages(); ?>

          <div style="padding:0px 0px;">


            <?php get_template_part('ad'); //アドセンス読み込み ?>
            <?php if(is_mobile()) { //スマホの場合 ?>
            <?php } else { //PCの場合 ?>
            <div class="smanone" style="padding-top:0px;">
              <?php get_template_part('ad'); //アドセンス読み込み ?>
            </div>
            <?php } ?>
          </div>
          <?php get_template_part('sns'); //ソーシャルボタン読み込み ?>
          <?php endwhile; else: ?>
          <p>記事がありません</p>
          <?php endif; ?>
          <!--ループ終了-->

          <?php if (is_mobile()) :?>
            <h4 class="point"><i class="fa fa-th-list"></i>&nbsp; 関連するキーワード</h4>
            <?php the_tags('<span class="tag-smart">','</span><span class="tag-smart">','</span>' ); ?>
          <?php endif; ?>

          <?php if( comments_open() || get_comments_number() ){
          comments_template(); } ?>
          <!--関連記事-->
          <h4 class="point"><i class="fa fa-th-list"></i>&nbsp;  関連記事</h4>
          <?php get_template_part('kanren');?>

          <!--ページナビ-->
          <div class="p-navi clearfix">
            <dl>
              <?php
        $prev_post = get_previous_post();
        if (!empty( $prev_post )): ?>
              <dt>PREV </dt>
              <dd><a href="<?php echo get_permalink( $prev_post->ID ); ?>"><?php echo $prev_post->post_title; ?></a></dd>
              <?php endif; ?>
              <?php
        $next_post = get_next_post();
        if (!empty( $next_post )): ?>
              <dt>NEXT </dt>
              <dd><a href="<?php echo get_permalink( $next_post->ID ); ?>"><?php echo $next_post->post_title; ?></a></dd>
              <?php endif; ?>
            </dl>
          </div>
        </div>
        <!--/post-->
      </article>
    </main>
  </div>
  <!-- /#contentInner -->
  <?php get_sidebar(); ?>
</div>
<!--/#content -->
<?php get_footer(); ?>
