<?php

/**
 * 友链
 * 
 * @package custom 
 * 
 **/
if (!defined('__TYPECHO_ROOT_DIR__')) exit;
$this->need('public/header.php');
?>

<main id="main" class="main">
  <div class="container">
    <div class="card mt-3 yy">
      <div class="card-header">
        <div class="item">
          <?php $this->title() ?>
        </div>
      </div>
      <div class="card-body">
        <div id="post-nice">  
          <?php
            $pattern = '/\<img.*?src\=\"(.*?)\"[^>]*>/i';
            $replacement = '<a href="$1" class="index-img" data-fancybox="gallery" /><img class="img-fluid mx-auto" data-src="$1" alt="'.$this->title.'" title="点击放大图片"></a>';
            $content = preg_replace($pattern, $replacement, $this->content);
            echo $content;
          ?>
          <h2>我的朋友们</h2>
        </div>
        <div class="box">
          <div id="boxs">
            <div class="track-list">  
              <?php if (isset($this->options->plugins['activated']['Links'])) : ?>
                <?php
                  Links_Plugin::output('
                    <h6 style="margin-bottom: 10px;">{sort}</h6>
                    <a href="{url}" title="{title}" target="_blank" rel="noopener" style="color: rgb(103 103 103)!important;"><div class="web bg-light text-dark">{name}</div></a>
		          ', 0);
                ?>
              <?php endif; ?>
            </div>
          </div>
        </div> 
        <div style="color:#aaa;text-align:center;font-size:12px">注: 上下滑动查看友链列表</div>
      </div> 
    </div>
    <?php $this->need('public/comments.php'); ?>
  </div>
</main>

<?php $this->need('public/footer.php'); ?>