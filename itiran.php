<?php //jetPackのView数取得
$postviews = stats_get_csv('postviews', array('days' => -1, 'limit' => -1)); ?>
<div id="topnews">
  <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
  <dl class="clearfix">
    <dt> <a href="<?php the_permalink() ?>" >
      <?php if ( has_post_thumbnail() ): // サムネイルを持っているときの処理 ?>
      <?php the_post_thumbnail( 'thumb150' ); ?>
      <?php else: // サムネイルを持っていないときの処理 ?>
      <img src="<?php echo get_template_directory_uri(); ?>/images/no-img.png" alt="no image" title="no image" width="100" height="100" />
      <?php endif; ?>
   </a> </dt>
    <dd>
      <h3><a href="<?php the_permalink(); ?>">
        <?php the_title(); ?>
        </a></h3>
      <div class="blog_info">
        <p><span class="entry-date"><i class="fa fa-calendar"></i>&nbsp;
          <?php the_time('Y/m/d') ?>
<span id="shares">
  <?php
    foreach ( $postviews as $value ) {
      $my_id = $value['post_id'];
      if($my_id == $id){
        echo $value['views'];
      }
    }
  ?> View
  </span>
<br>
          <span class="cat-smart">
<!--
          <?php the_category(', ') ?>
          <?php the_tags('', ', '); ?>
-->
<?php
$cats = get_the_category();
$cat = $cats[0];
if($cat->parent){
$parent = get_category($cat->parent);
echo $parent->cat_name;
}else{
echo $cat->cat_name;
}
?>

          </span>

<?php if (is_mobile()) :?>

<?php else: ?>
<span id="author">
<?php the_author(); ?>
</span>
</p>
<?php endif; ?>
      </div>
<!--
      <div class="smanone">
        <?php the_excerpt(); //スマートフォンには表示しない抜粋文 ?>
      </div>
-->
    </dd>
  </dl>
  <?php endwhile; else: ?>
  <p>記事がありません</p>
  <?php endif; ?>
</div>
