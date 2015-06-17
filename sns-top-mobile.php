<?php if (is_home()) { ?>
<!--
    <div id="share2">
<ul class="clearfix">
	<li>▼更新通知　<div class="fb-like" data-href="https://www.facebook.com/manamishibata.blog" data-layout="box_count" data-action="like" data-show-faces="true" data-share="false"></div>
	</li>
</ul>
    </div>
-->

<?php } /*else if (is_page()) { ?>
<?php } */ else { ?>

<?php
  $url_encode=urlencode(get_permalink());
  $title_encode=urlencode(get_the_title());
?>


<div id="share3" class="page-top-show">
  <ui>
    <li>
      <a class="sns-btn-facebook" href="http://www.facebook.com/sharer.php?src=bm&u=<?php echo $url_encode;?>&t=<?php echo $title_encode;?>" onclick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=300,width=600');return false;"><i class="fa fa-facebook"></i></a>
    </li>
    <li>
      <a class="sns-btn-twitter" href=http://twitter.com/intent/tweet?url=<?php echo $url_encode ?>&text=<?php echo $title_encode ?>&via=ikutas_tweet&tw_p=tweetbutton><i class="fa fa-twitter"></i></a>
    </li>
    <li>
      <a class="sns-btn-line" href="http://line.me/R/msg/text/?<?php echo $title_encode . '%0A' . $url_encode;?>"><i class="fa icon-line"></i></a>
    </li>
    <li>
      <a href="#wrapper" class="fa fa-angle-up page-top"></a>
    </li>
  </ui>
<!-- /#share3 --></div>

<?php } ?>
