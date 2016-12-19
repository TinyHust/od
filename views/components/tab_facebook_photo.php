<?php if (!defined('ABSPATH')) exit; // Exit if accessed directly  ?>
<?php 
$opt_val = get_option('nbdesigner'); 
if(is_array($opt_val)){
    extract($opt_val);
    $api_key = $facebook_api_key;
}else{
    $api_key = '';
}
?>
<div id="fb-root"></div>
<script>
  window.fbAsyncInit = function() {
    FB.init({
        appId      : '<?php echo $api_key; ?>',
        status     : true, 
        cookie     : true,      
        xfbml      : true,
        version    : 'v2.7'
    });
  };

  (function(d, s, id){
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) {return;}
        js = d.createElement(s); js.id = id;
        js.src = "//connect.facebook.net/en_US/sdk.js";
        fjs.parentNode.insertBefore(js, fjs);
   }(document, 'script', 'facebook-jssdk'));    
</script>
<div class="fb-login-button" data-max-rows="1" data-size="medium" data-show-faces="false" data-auto-logout-link="false" data-scope="user_photos" onlogin="nbdesigner_fb1(null)"></div>