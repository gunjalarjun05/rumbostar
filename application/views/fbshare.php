<script src="http://connect.facebook.net/en_US/all.js"></script>
<script>
  window.fbAsyncInit = function() {
    FB.init({
      appId      : '442288292615529',
      xfbml      : true,
       status     : true,
        cookie     : true,
      version    : 'v2.7'
    });
    FB.AppEvents.logPageView();
  };
</script>
<div class="page-header">
  <h1>Share Dialog</h1>
</div>
<p>Click the button below to trigger a Share Dialog</p>
<div id="shareBtn" class="btn btn-success clearfix">Share</div>
<input type="text" id="title" name="title" value="Sample Name">
<input type="text" id="share_capt" name="share_capt" value="Sample Site Caption";>
<p id="description">sample description goes here</p>
<a href="http://exceptionaire.co/rumbostar" id="share_url" name="share_url">


<script>
document.getElementById('shareBtn').onclick = function() {
	 var product_name = jQuery("#title").val();
     var description =   jQuery("#description").html();
     //var share_image =   jQuery("#share_image").attr('src');
     var share_url   =   jQuery("#share_url").attr('href');
     var share_capt = jQuery("#share_capt").val();
     //var id = location.href.replace(/.*pid=/, '');
     var id = 'http://exceptionaire.co/rumbostar';
     //$.galleriffic.gotoImage(id);
	
  FB.ui({
    method: 'feed',
    display: 'popup',
    href: 'http://exceptionaire.co/rumbostar',
    name: product_name,
	link: id,
	//picture: images,
	caption: share_capt,
    description: description
	
 }, function(response){
	 console.log(response);
	 });
}
</script>
