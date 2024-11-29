<?php
/* 获取主题当前版本号 */
function _getVersion()
{
  return "v1.0.4";
};

/* 主题初始化 */
function themeInit($archive){
  //文章描述中暴露短代码的问题
  if ($archive->is('single')){
    //注意：这里就是需要过滤短代码的正则表达，请根据实际情况自行修改。
    $archiv = preg_replace('/{bl av="(.+?)"}/sm','',$archive->getDescription());
    //这个方法是typecho提供设置描述的方法
    $archive->setDescription($archiv);
  }
    
  Helper::options()->commentsMaxNestingLevels = 999;//评论回复楼层最高999层.这个正常设置最高只有7层
  Helper::options()->commentsAntiSpam = false;//强制评论关闭反垃圾保护
  if ($archive->is('author')) {
    $archive->parameter->pageSize = 50; // 作者页面每50篇文章分页一次
  }
  if ($archive->is('category','av')) {
  $archive->parameter->pageSize = 9; // 分类缩略名为av的分类列表每9篇文章分页一次
  }
  $archive->content = a_class_replace($archive->content);//文章内容，让a_class_replace函数处理
}
  
function a_class_replace($content){
  $content = preg_replace('#<a(.*?) href="([^"]*/)?(([^"/]*)\.[^"]*)"(.*?)>#',
    '<a$1 href="$2$3"$5 target="_blank">', $content);//给文章每个超链接点击后新窗口打开，原理就是用正则替换文章内容
  return $content;
}

/* 判断是否是wap */
function _isMobile()
{
  if (isset($_SERVER['HTTP_X_WAP_PROFILE']))
    return true;
  if (isset($_SERVER['HTTP_VIA'])) {
    return stristr($_SERVER['HTTP_VIA'], "wap") ? true : false;
  }
  if (isset($_SERVER['HTTP_USER_AGENT'])) {
    $clientkeywords = array('nokia', 'sony', 'ericsson', 'mot', 'samsung', 'htc', 'sgh', 'lg', 'sharp', 'sie-', 'philips', 'panasonic', 'alcatel', 'lenovo', 'iphone', 'ipod', 'blackberry', 'meizu', 'android', 'netfront', 'symbian', 'ucweb', 'windowsce', 'palm', 'operamini', 'operamobi', 'openwave', 'nexusone', 'cldc', 'midp', 'wap', 'mobile');
    if (preg_match("/(" . implode('|', $clientkeywords) . ")/i", strtolower($_SERVER['HTTP_USER_AGENT'])))
      return true;
  }
  if (isset($_SERVER['HTTP_ACCEPT'])) {
    if ((strpos($_SERVER['HTTP_ACCEPT'], 'vnd.wap.wml') !== false) && (strpos($_SERVER['HTTP_ACCEPT'], 'text/html') === false || (strpos($_SERVER['HTTP_ACCEPT'], 'vnd.wap.wml') < strpos($_SERVER['HTTP_ACCEPT'], 'text/html')))) {
      return true;
    }
  }
  return false;
}

/* 根据评论agent获取浏览器类型 */
function _getAgentBrowser($agent)
{
  if (preg_match('/MSIE\s([^\s|;]+)/i', $agent, $regs)) {
    $outputer = 'Internet Explore';
  } else if (preg_match('/FireFox\/([^\s]+)/i', $agent, $regs)) {
    $outputer = 'FireFox';
  } else if (preg_match('/Maxthon([\d]*)\/([^\s]+)/i', $agent, $regs)) {
    $outputer = 'MicroSoft Edge';
  } else if (preg_match('#360([a-zA-Z0-9.]+)#i', $agent, $regs)) {
    $outputer = '360 Fast Browser';
  } else if (preg_match('/Edge([\d]*)\/([^\s]+)/i', $agent, $regs)) {
    $outputer = 'MicroSoft Edge';
  } else if (preg_match('/UC/i', $agent)) {
    $outputer = 'UC Browser';
  } else if (preg_match('/QQ/i', $agent, $regs) || preg_match('/QQ Browser\/([^\s]+)/i', $agent, $regs)) {
    $outputer = 'QQ Browser';
  } else if (preg_match('/UBrowser/i', $agent, $regs)) {
    $outputer = 'UC Browser';
  } else if (preg_match('/Opera[\s|\/]([^\s]+)/i', $agent, $regs)) {
    $outputer = 'Opera';
  } else if (preg_match('/Chrome([\d]*)\/([^\s]+)/i', $agent, $regs)) {
    $outputer = 'Google Chrome';
  } else if (preg_match('/safari\/([^\s]+)/i', $agent, $regs)) {
    $outputer = 'Safari';
  } else {
    $outputer = 'Google Chrome';
  }
  echo $outputer;
}

/* 根据评论agent获取设备类型 */
function _getAgentOS($agent)
{
  $os = "Linux";
  if (preg_match('/win/i', $agent)) {
    if (preg_match('/nt 6.0/i', $agent)) {
      $os = 'Windows Vista';
    } else if (preg_match('/nt 6.1/i', $agent)) {
      $os = 'Windows 7';
    } else if (preg_match('/nt 6.2/i', $agent)) {
      $os = 'Windows 8';
    } else if (preg_match('/nt 6.3/i', $agent)) {
      $os = 'Windows 8.1';
    } else if (preg_match('/nt 5.1/i', $agent)) {
      $os = 'Windows XP';
    } else if (preg_match('/nt 10.0/i', $agent)) {
      $os = 'Windows 10';
    } else {
      $os = 'Windows X64';
    }
  } else if (preg_match('/android/i', $agent)) {
    if (preg_match('/android 9/i', $agent)) {
      $os = 'Android Pie';
    } else if (preg_match('/android 8/i', $agent)) {
      $os = 'Android Oreo';
    } else {
      $os = 'Android';
    }
  } else if (preg_match('/ubuntu/i', $agent)) {
    $os = 'Ubuntu';
  } else if (preg_match('/linux/i', $agent)) {
    $os = 'Linux';
  } else if (preg_match('/iPhone/i', $agent)) {
    $os = 'iPhone';
  } else if (preg_match('/mac/i', $agent)) {
    $os = 'MacOS';
  } else if (preg_match('/fusion/i', $agent)) {
    $os = 'Android';
  } else {
    $os = 'Linux';
  }
  echo $os;
}

function img_postthumb($thumbThis) {
    $db = Typecho_Db::get();
    $rs = $db->fetchRow($db->select('table.contents.text')
        ->from('table.contents')
        ->where('table.contents.cid=?', $thumbThis->cid)
        ->order('table.contents.cid', Typecho_Db::SORT_ASC)
        ->limit(1));
    // 检查是否有自定义字段设置的缩略图链接
    $customThumbField = 'img'; // 将这里替换为你的自定义字段名
    if ($thumbThis->fields->$customThumbField) {
        return $thumbThis->fields->$customThumbField;
    }    
    preg_match_all('/\<img.*?src\=\"(.*?)\"[^>]*>/i', $rs['text'], $thumbUrl);  //通过正则式获取图片地址
    preg_match_all('/\!\[.*?\]\((http(s)?:\/\/.*?(jpg|png))/i', $rs['text'], $patternMD);  //通过正则式获取图片地址
    preg_match_all('/\[.*?\]:\s*(http(s)?:\/\/.*?(jpg|png))/i', $rs['text'], $patternMDfoot);  //通过正则式获取图片地址
    if(count($thumbUrl[0])>0){
        return $thumbUrl[1][0];  //当找到一个src地址的时候，输出缩略图
    }else if(count($patternMD[0])>0){
        return $patternMD[1][0];
    }else if(count($patternMDfoot[0])>0){
        return $patternMDfoot[1][0];
    }else{
        //在主题根目录下的 /assets/thumb/ 目录下放随机图片 img2_开头
        //如：img2_4.png
        return $thumbThis->widget('Widget_Options')->themeUrl."/assets/thumb/img2_".rand(1,10).".png";
    }
}

/* 文章编辑器添加字符统计 */
Typecho_Plugin::factory('admin/write-post.php')->bottom = array('myyodu', 'one');
Typecho_Plugin::factory('admin/write-page.php')->bottom = array('myyodu', 'one');
class myyodu {
    public static function one()
    {
    ?>
<style>
.field.is-grouped{display:-webkit-box;display:-ms-flexbox;display:flex;-webkit-box-pack:start;-ms-flex-pack:start;justify-content:flex-start;  -ms-flex-wrap: wrap;flex-wrap: wrap;}.field.is-grouped>.control{-ms-flex-negative:0;flex-shrink:0}.field.is-grouped>.control:not(:last-child){margin-bottom:.5rem;margin-right:.75rem}.field.is-grouped>.control.is-expanded{-webkit-box-flex:1;-ms-flex-positive:1;flex-grow:1;-ms-flex-negative:1;flex-shrink:1}.field.is-grouped.is-grouped-centered{-webkit-box-pack:center;-ms-flex-pack:center;justify-content:center}.field.is-grouped.is-grouped-right{-webkit-box-pack:end;-ms-flex-pack:end;justify-content:flex-end}.field.is-grouped.is-grouped-multiline{-ms-flex-wrap:wrap;flex-wrap:wrap}.field.is-grouped.is-grouped-multiline>.control:last-child,.field.is-grouped.is-grouped-multiline>.control:not(:last-child){margin-bottom:.75rem}.field.is-grouped.is-grouped-multiline:last-child{margin-bottom:-.75rem}.field.is-grouped.is-grouped-multiline:not(:last-child){margin-bottom:0}.tags{-webkit-box-align:center;-ms-flex-align:center;align-items:center;display:-webkit-box;display:-ms-flexbox;display:flex;-ms-flex-wrap:wrap;flex-wrap:wrap;-webkit-box-pack:start;-ms-flex-pack:start;justify-content:flex-start}.tags .tag{margin-bottom:.5rem}.tags .tag:not(:last-child){margin-right:.5rem}.tags:last-child{margin-bottom:-.5rem}.tags:not(:last-child){margin-bottom:1rem}.tags.has-addons .tag{margin-right:0}.tags.has-addons .tag:not(:first-child){border-bottom-left-radius:0;border-top-left-radius:0}.tags.has-addons .tag:not(:last-child){border-bottom-right-radius:0;border-top-right-radius:0}.tag{-webkit-box-align:center;-ms-flex-align:center;align-items:center;background-color:#f5f5f5;border-radius:3px;color:#4a4a4a;display:-webkit-inline-box;display:-ms-inline-flexbox;display:inline-flex;font-size:.75rem;height:2em;-webkit-box-pack:center;-ms-flex-pack:center;justify-content:center;line-height:1.5;padding-left:.75em;padding-right:.75em;white-space:nowrap}.tag .delete{margin-left:.25em;margin-right:-.375em}.tag.is-white{background-color:#fff;color:#0a0a0a}.tag.is-black{background-color:#0a0a0a;color:#fff}.tag.is-light{background-color:#fff;color:#363636}.tag.is-dark{background-color:#363636;color:#f5f5f5}.tag.is-primary{background-color:#00d1b2;color:#fff}.tag.is-info{background-color:#3273dc;color:#fff}.tag.is-success{background-color:#23d160;color:#fff}.tag.is-warning{background-color:#ffdd57;color:rgba(0,0,0,.7)}.tag.is-danger{background-color:#ff3860;color:#fff}.tag.is-large{font-size:1.25rem}.tag.is-delete{margin-left:1px;padding:0;position:relative;width:2em}.tag.is-delete:after,.tag.is-delete:before{background-color:currentColor;content:"";display:block;left:50%;position:absolute;top:50%;-webkit-transform:translateX(-50%) translateY(-50%) rotate(45deg);transform:translateX(-50%) translateY(-50%) rotate(45deg);-webkit-transform-origin:center center;transform-origin:center center}.tag.is-delete:before{height:1px;width:50%}.tag.is-delete:after{height:50%;width:1px}.tag.is-delete:focus,.tag.is-delete:hover{background-color:#e8e8e8}.tag.is-delete:active{background-color:#dbdbdb}.tag.is-rounded{border-radius:290486px}
</style>
<script language="javascript">
    var EventUtil = function() {};
    EventUtil.addEventHandler = function(obj, EventType, Handler) {
        if (obj.addEventListener) {
            obj.addEventListener(EventType, Handler, false);
        }
        else if (obj.attachEvent) {
            obj.attachEvent('on' + EventType, Handler);
        } else {
            obj['on' + EventType] = Handler;
        }
    }
    if (document.getElementById("text")) {
        EventUtil.addEventHandler(document.getElementById('text'), 'propertychange', CountChineseCharacters);
        EventUtil.addEventHandler(document.getElementById('text'), 'input', CountChineseCharacters);
    }
    function showit(Word) {
        alert(Word);
    }
    function CountChineseCharacters() {
        Words = document.getElementById('text').value;
        var W = new Object();
        var Result = new Array();
        var iNumwords = 0;
        var sNumwords = 0;
        var sTotal = 0;
        var iTotal = 0;
        var eTotal = 0;
        var otherTotal = 0;
        var bTotal = 0;
        var inum = 0;
      var znum = 0;
      var gl = 0;
      var paichu = 0;
        for (i = 0; i < Words.length; i++) {
            var c = Words.charAt(i);
            if (c.match(/[\u4e00-\u9fa5]/) || c.match(/[\u0800-\u4e00]/) || c.match(/[\uac00-\ud7ff]/)) {
                if (isNaN(W[c])) {
                    iNumwords++;
                    W[c] = 1;
                }
                iTotal++;
            }
        }
        for (i = 0; i < Words.length; i++) {
            var c = Words.charAt(i);
            if (c.match(/[^\x00-\xff]/)) {
                if (isNaN(W[c])) {
                    sNumwords++;
                }
                sTotal++;
            } else {
                eTotal++;
            }
            if (c.match(/[0-9]/)) {
                inum++;
            }
           if (c.match(/[a-zA-Z]/)) {
                znum++;
            }
          if (c.match(/[\s]/)) {
               gl++;
            }
           if (c.match(/[　◕‿↑↓←→↖↗↘↙↔↕。《》、【】“”•‘’❝❞′……—―‐〈〉„╗╚┐└‖〃「」‹›『』〖〗〔〕∶〝〞″≌∽≦≧≒≠≤≥㏒≡≈✓✔◐◑◐◑✕✖★☆₸₹€₴₰₤₳र₨₲₪₵₣₱฿₡₮₭₩₢₧₥₫₦₠₯○㏄㎏㎎㏎㎞㎜㎝㏕㎡‰〒々℃℉ㄅㄆㄇㄈㄉㄊㄋㄌㄍㄎㄏㄐㄑㄒㄓㄔㄕㄖㄗㄘㄙㄚㄛㄜㄝㄞㄟㄠㄡㄢㄣㄤㄥㄦㄧㄨㄩ]/)) {
               paichu++;
            }
        }
        document.getElementById('hanzi').innerText = iTotal - paichu;
        document.getElementById('zishu').innerText = inum + iTotal - paichu;
        document.getElementById('biaodian').innerText = sTotal - iTotal + eTotal - inum - znum - gl + paichu;
        document.getElementById('zimu').innerText = znum;
        document.getElementById('shuzi').innerText = inum;
        document.getElementById("zifu").innerHTML = iTotal * 2 + (sTotal - iTotal) * 2 + eTotal;
    }
</script>
<script> 
$(document).ready(function(){
$("#wmd-editarea").append('<div class="field is-grouped"style="margin-top: 15px;"><span class="tag">共计：</span><div class="control"><div class="tags has-addons"><span class="tag is-dark" id="zishu">0</span> <span class="tag is-primary">个字数</span></div></div><div class="control"><div class="tags has-addons"><span class="tag is-dark" id="zifu">0</span> <span class="tag is-primary">个字符</span></div></div><span class="tag">包含：</span><div class="control"><div class="tags has-addons"><span class="tag is-light" id="hanzi">0</span> <span class="tag is-danger">个文字</span></div></div><div class="control"><div class="tags has-addons"><span class="tag is-light" id="biaodian">0</span> <span class="tag is-info">个符号</span></div></div><div class="control"><div class="tags has-addons"><span class="tag is-light" id="zimu">0</span> <span class="tag is-success">个字母</span></div></div><div class="control"><div class="tags has-addons"><span class="tag is-light" id="shuzi">0</span> <span class="tag is-warning">个数字</span></div></div></div>');
CountChineseCharacters();
});
</script>
<?php
    }
}

/* 通过邮箱生成头像地址 */
function _getAvatarByMail($mail)
{
  $gravatarsUrl = Helper::options()->JCustomAvatarSource ? Helper::options()->JCustomAvatarSource : 'https://weavatar.com/avatar/';
  $mailLower = strtolower($mail);
  $md5MailLower = md5($mailLower);
  $qqMail = str_replace('@qq.com', '', $mailLower);
  if (strstr($mailLower, "qq.com") && is_numeric($qqMail) && strlen($qqMail) < 11 && strlen($qqMail) > 4) {
    echo 'https://thirdqq.qlogo.cn/g?b=qq&nk=' . $qqMail . '&s=100';
  } else {
    echo $gravatarsUrl . $md5MailLower . '?d=mm';
  }
};

//文章阅读量
function get_post_view($archive)
{
    $cid    = $archive->cid;
    $db     = Typecho_Db::get();
    $prefix = $db->getPrefix();
    if (!array_key_exists('views', $db->fetchRow($db->select()->from('table.contents')->page(1,1)))) {
        $db->query('ALTER TABLE `'. $prefix. 'contents` ADD `views` INT(10) DEFAULT 0;');
        echo 0;
        return;
    }
    $row = $db->fetchRow($db->select('views')->from('table.contents')->where('cid =?', $cid));
    if ($archive->is('single')) {
        $views = Typecho_Cookie::get('extend_contents_views');
        if(empty($views)){
            $views = array();
        }else{
            $views = explode(',', $views);
        }
        // 获取请求头信息
        $referer = isset($_SERVER['HTTP_REFERER'])? $_SERVER['HTTP_REFERER'] : '';
        $currentUrl = $_SERVER['REQUEST_URI'];
        if (!in_array($cid,$views) && ($referer === '' || strpos($referer, $currentUrl) === false)) {
            $db->query($db->update('table.contents')->rows(array('views' => (int) $row['views'] + 1))->where('cid =?', $cid));
            array_push($views, $cid);
            $views = implode(',', $views);
            // 设置 Cookie 过期时间为 1 天（86400 秒）
            Typecho_Cookie::set('extend_contents_views', $views, time() + 86400);
        }
    }
    echo $row['views'];
}