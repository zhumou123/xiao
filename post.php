<?php
if (!defined('__TYPECHO_ROOT_DIR__')) exit;
$this->need('public/header.php');
?>

<main id="main" class="main">
  <div class="container">
    <div class="card mt-3 yy">
      <div class="card-header">
        <div class="item">文章：<?php $this->title() ?></div>
        <div class="item">阅读：<?php get_post_view($this) ?></div>
        <div class="item">分类：<?php $this->category(','); ?></div>
        <div class="item">标签：<?php $this->tags(',', true, '无'); ?></div>
        <div class="item">发布：<?php $this->date(); ?></div>
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
        <div class="function mt-3 text-center">
          <button type="button" class="btn btn-outline-secondary"onclick="alert('点赞成功 ￣へ￣')">点赞</button>
          <?php if ($this->options->Reward): ?>
            <button type="button" class="btn btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#Reward">打赏</button>
          <?php endif; ?>
        </div>
      </div> 
    </div>
    <?php $this->need('public/comments.php'); ?>
  </div>
</main>

<!-- --------------------------------------- -->
<!-- 打赏弹窗 -->
<!-- --------------------------------------- -->
<div class="modal fade" id="Reward">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">打赏</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <?php if ($this->options->Reward): ?>
          <img class="img-fluid" src="<?php echo $this->options->Reward(); ?>" alt="Chania">
        <?php endif; ?>
      </div>
    </div>
  </div>
</div>
<!-- --------------------------------------- -->
<!-- 这是一条分割线 -->
<!-- --------------------------------------- -->
<?php $this->need('public/footer.php'); ?>