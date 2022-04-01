
<style>
#cfacebook{ position: fixed; bottom: 0px; right: 8px; z-index: 999999999999999; width: 300px; height: auto; box-shadow: 6px 6px 6px 10px rgba(0,0,0,0.2); border-top-left-radius: 5px; border-top-right-radius: 5px; overflow: hidden; }
#cfacebook .fchat{float: left; width: 100%; height: 400px; overflow: hidden; display: none; background-color: #fff;}
#cfacebook .fchat .chat-single{float: left; line-height: 25px; line-height: 25px; color: #333; width: 100%;}
#cfacebook .fchat .chat-single a{float: right; text-decoration: none; margin-right: 10px; color: #888; font-size: 12px;}
#cfacebook .fchat .chat-single a:hover{color: #222;}
#cfacebook .fchat .fb-page{margin-top:0px; float: left;}
#cfacebook a.chat_fb{ float: left; padding: 0 25px; width: 300px; color: #fff; text-decoration: none; height: 40px; line-height: 40px; text-shadow: 0 1px 0 rgba(0, 0, 0, 0.1); background-image: url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAEAAAAqCAMAAABFoMFOAAAAWlBMV…8/UxBxQDQuFwlpqgBZBq6+P+unVY1GnDgwqbD2zGz5e1lBdwvGGPE6OgAAAABJRU5ErkJggg==); background-repeat: repeat-x; background-size: auto; background-position: 0 0; background-color: #009320; border: 0; border-bottom: 1px solid #009320; z-index: 9999999; margin-right: 12px; font-size: 18px;}
#cfacebook a.chat_fb:hover{color: yellow; text-decoration: none;}
.fchat_fb_showhi_hide{display: none !important}
.fchat_fb_showhi_show{display: block !important}
.cur{cursor: pointer;}


#cfacebook a.chat_fb {
  text-align: center;
  padding: 0 !important;
  margin: 0 !important;
}
#cfacebook a.chat_fb i { display: none; }

</style>

<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;//vi_VN //en_US
  js.src = "//connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v2.7&appId=1568565433443656";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
<script>
    function fchat()
      {
              var tchat= document.getElementById("tchat").value;
              if(tchat==0 || tchat=='0')
              {                
                  document.getElementById("fchat").style.display = "block";
                  document.getElementById("tchat").value=1;
              }else{
                  document.getElementById("fchat").style.display = "none";
                  document.getElementById("tchat").value=0;
              }             
      }
    function SHOWHI_fb(argument) {
      if($(".fchat_fb_showhi_show").length > 0)
      {
        console.log('1');
        $(".fchat_fb_showhi").removeClass("fchat_fb_showhi_show");
        $(".fchat_fb_showhi").addClass("fchat_fb_showhi_hide");
      }
      else 
      {
        $(".fchat_fb_showhi").removeClass("fchat_fb_showhi_hide");
        $(".fchat_fb_showhi").addClass("fchat_fb_showhi_show");
      console.log('1')
      }
    }
    
    setTimeout(function() { 
      $(".fchat_fb_showhi").addClass("fchat_fb_showhi_show");
  }, 15000);
  
</script>
<div id="cfacebook">
    <a class="chat_fb cur" onclick="SHOWHI_fb()"><i class="fa fa-comments"></i> HỖ TRỢ TRỰC TUYẾN</a>
    <div id="fchat" class="fchat fchat_fb_showhi">
  <div class="fb-page" data-href="https://www.facebook.com/hethongtuoivanhogiot" data-tabs="messages" data-width="300" data-height="400" data-small-header="true" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true"><blockquote cite="https://www.facebook.com/hethongtuoivanhogiot" class="fb-xfbml-parse-ignore"></blockquote></div><div class="chat-single"><a target="_blank" href="https://www.facebook.com/hethongtuoivanhogiot"><i class="fa fa-facebook-square"></i>xanhtuoitot.com</a></div>
    </div>
    <input type="hidden" id="tchat" value="0">
</div>