<?php
if (!defined('__TYPECHO_ROOT_DIR__')) exit;
$this->need('public/header.php');
?>

<main id="main" class="main">
  <div class="container">
    <div class="card mt-3 yy">
      <div class="card-header">
        <?php $this->title() ?>
      </div>
      <div class="card-body">
        <div id="post-nice">  
          <?php
            $pattern = '/\<img.*?src\=\"(.*?)\"[^>]*>/i';
            $replacement = '<a href="$1" class="index-img" data-fancybox="gallery" /><img class="img-fluid mx-auto" data-src="$1" alt="'.$this->title.'" title="点击放大图片"></a>';
            $content = preg_replace($pattern, $replacement, $this->content);
            echo $content;
          ?>
        </div>
      </div> 
    </div>
    <?php $this->need('public/comments.php'); ?>
  </div>
</main>

<?php $this->need('public/footer.php'); ?>
