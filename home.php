<?php get_header(); ?>

<div id="content" class="clearfix">
  <div id="contentInner">
    <main>
      <article>
        <section>
          <?php get_template_part('itiran');?>
        </section>
        <!-- /section --> 
<?php if (is_mobile()) :?>
<?php else: ?>
<?php get_template_part('sns-top'); //ソーシャルボタン読み込み ?> 
<?php endif; ?>
        <!-- ページナビ -->
        <?php if (function_exists("pagination")) {
pagination($wp_query->max_num_pages);
} ?>
      </article>
    </main>
  </div>
  <!-- /#contentInner -->
  <?php get_sidebar(); ?>
</div>
<!-- /#content -->
<?php get_footer(); ?>
