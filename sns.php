<?php
  $url_encode=urlencode(get_permalink());
  $title_encode=urlencode(get_the_title());
?>

<div class="share">
<div class="share-bg">記事が気に入ったらシェアしてくれると嬉しいですヽ(=´▽`=)ﾉ</div>

<div class="sns">
<ul class="clearfix">
<!--ツイートボタン-->
<li class="twitter"> 
<a href="http://twitter.com/intent/tweet?url=<?php echo $url_encode ?>&text=<?php echo $title_encode ?>&via=ikutas_tweet&tw_p=tweetbutton"><i class="fa fa-twitter"></i>&nbsp;<?php if(function_exists('scc_get_share_twitter')) echo (scc_get_share_twitter()==0)?'':scc_get_share_twitter(); ?><br />Tweet</a>
</li>


<!--Facebookボタン-->      
<li class="facebook">       
<a href="http://www.facebook.com/sharer.php?src=bm&u=<?php echo $url_encode;?>&t=<?php echo $title_encode;?>" onclick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=300,width=600');return false;"><i class="fa fa-facebook"></i>&nbsp;<?php if(function_exists('scc_get_share_facebook')) echo (scc_get_share_facebook()==0)?'':scc_get_share_facebook(); ?><br />シェア</a>
</li>

      
<!--Google+1ボタン-->
<li class="googleplus">
<a href="https://plus.google.com/share?url=<?php echo $url_encode;?>" onclick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=500');return false;"><i class="fa fa-google-plus"></i>&nbsp;&nbsp;<?php if(function_exists('scc_get_share_gplus')) echo (scc_get_share_gplus()==0)?'':scc_get_share_gplus(); ?><br/>g+1</a>
</li>

 
<!--はてブボタン-->  
<li class="hatebu"> 
<a href="http://b.hatena.ne.jp/add?mode=confirm&url=<?php echo $url_encode ?>" onclick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=400,width=510');return false;" ><i class="fa fa-hatena"></i>&nbsp;&nbsp; <?php if(function_exists('scc_get_share_hatebu')) echo (scc_get_share_hatebu()==0)?'':scc_get_share_hatebu(); ?><br/>はてブ</a>
</li>
 
 <!--LINEボタン-->      
<li class="line">
<a href="http://line.me/R/msg/text/?<?php echo $title_encode . '%0A' . $url_encode;?>"><span class="icon-line"></span>&nbsp;<br />LINE</a>
</li>       
 

<!--ポケットボタン-->      
<li class="pocket">
<a href="http://getpocket.com/edit?url=<?php echo $url_encode;?>&title=<?php echo $title_encode;?>"><span class="icon-pocket"></span>&nbsp;<?php if(function_exists('scc_get_share_pocket')) echo (scc_get_share_pocket()==0)?'':scc_get_share_pocket(); ?><br />Pocket</a></li>
  
<!--RSSボタン-->
<li class="rss">
<a href="<?php echo home_url(); ?>/?feed=rss2"><i class="fa fa-rss"></i>&nbsp;<br />RSS</a></li>
 
<!--feedlyボタン-->
<li class="feedly">
<a href="http://feedly.com/index.html#subscription%2Ffeed%2Fhttp%3A%2F%2Fikutas.jp%2Ffeed%2F" target="blank"><span class="icon-feedly"></span>&nbsp;<?php if(function_exists('scc_get_follow_feedly')) echo (scc_get_follow_feedly()==0)?'':scc_get_follow_feedly(); ?><br />Feedly</a></li>    
</ul>
</div> 

</div>

<div style="padding: 10px 0px;"></div>



