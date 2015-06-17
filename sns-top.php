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


<div id="share2">
<ul class="clearfix">
<li class="twitter">
<div class="balloon">
<a href="https://twitter.com/search?q=<?php the_permalink(); ?>%2F" target="_blank"><?php if(function_exists('scc_get_share_twitter')) echo scc_get_share_twitter(); ?></a>
</div>
<a href="http://twitter.com/intent/tweet?url=<?php echo $url_encode ?>&text=<?php echo $title_encode ?>&via=ikutas_tweet&tw_p=tweetbutton"><span><i class="fa fa-twitter"></i>Tweet</span></a>
</li>

<li class="facebook">
<div class="balloon"><?php if(function_exists('scc_get_share_facebook')) echo scc_get_share_facebook(); ?></div>
<a href="http://www.facebook.com/sharer.php?src=bm&u=<?php echo $url_encode;?>&t=<?php echo $title_encode;?>" onclick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=300,width=600');return false;"><span><i class="fa fa-facebook"></i>Share</span></a></li>
						
<li class="hatebu">
<div class="balloon"><a href="http://b.hatena.ne.jp/entry/<?php the_permalink(); ?>" target="_blank"><?php if(function_exists('scc_get_share_hatebu')) echo scc_get_share_hatebu(); ?></a></div>
<a href="http://b.hatena.ne.jp/add?mode=confirm&url=<?php echo $url_encode ?>" onclick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=400,width=510');return false;" ><span><i class="fa fa-hatena"></i>はてブ</span></a></li>
						
						
<li class="googlePlus">
<div class="balloon"><?php if(function_exists('scc_get_share_gplus')) echo scc_get_share_gplus(); ?></div>
<a href="https://plus.google.com/share?url=<?php echo $url_encode;?>" onclick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=500');return false;"><span><i class="fa fa-google-plus"></i>Google+</span></a></li>
						
<li class="pocket">
<div class="balloon"><?php if(function_exists('scc_get_share_pocket')) echo scc_get_share_pocket(); ?></div>
<a href="http://getpocket.com/edit?url=<?php echo $url_encode;?>&title=<?php echo $title_encode;?>"><i class="icon-pocket"></i><span>Pocket</span></a></li>
		
<!--									
<li class="feedly">
<div class="balloon feedly_count"><?php if(function_exists('scc_get_follow_feedly')) echo scc_get_follow_feedly(); ?></div>
<a href="http://feedly.com/index.html#subscription%2Ffeed%2Fhttp%3A%2F%2Fikutas.jp%2Ffeed%2F" target="blank"><span><i class="icon-feedly"></i><span>Feedly</span></a></li>
-->

	</ul>
				<!-- /#share2 --></div>

<?php } ?>
