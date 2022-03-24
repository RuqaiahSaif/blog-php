<?php

function get_share_url($id,$title,$link="news",$media)
{
    global $domain;
      $title = stripslashes(str_replace(array('\'', '"'), '', $title));
    if ($media == "facebook") {
        return "http://www.facebook.com/sharer.php?u=" . $domain . "/" .  $link . $id . ".html";
    } else if ($media == "twitter") {
        return "http://twitter.com/share?text=" . stripslashes($title) . "&url=https://" . $domain . "/" . $link . $id . ".html";
    } else if ($media == "whatsapp") {
        return "whatsapp://send?text=" . stripslashes($title) . "\n https://" . $domain . "/" . $link . $id . ".html";
    } else if ($media == "telegram") {
        return  "https://telegram.me/share/url?url=" . $domain . "/" . $link . $id . ".html&text=<TEXT>=" . stripslashes($title);
    }
    return "";
}
?>