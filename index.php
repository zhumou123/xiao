<?php

/**
 * 一款基于 bootstrap@5.3.3 开发的 Typecho 单栏主题
 * @package xiao
 * @author 不语
 * @version v1.0.4
 * @link https://zhuxu.asia/
 */

if (!defined('__TYPECHO_ROOT_DIR__')) exit;
$this->need('public/header.php');
?>

<main id="main" class="main">
  <div class="container">
    <?php if ($this->options->wutu!== "on") :?>
      <?php if ($this->options->articleStyle == 0): ?>
        <?php while ($this->next()): ?>
            <a href="<?php $this->permalink() ?>" target="_self" rel="noopener">
              <div class="col mt-3 rounded yy">
                <div class="card h-100">
                  <div class="card-body">
                    <h5 class="card-title text-primary"><?php $this->title() ?></h5>
                    <p class="card-text"><?php $this->excerpt(20, '...'); ?></p>
                    <div class="d-flex justify-content-between align-items-center">
                      <div class="btn-groupp">
                        <span class="badge bg-secondary"><?php $this->date(); ?></span>
                        <span class="badge bg-secondary"><?php get_post_view($this) ?>次阅读</span>
                      </div>
                      <span class="badge bg-secondary"><?php $this->commentsNum('无评论', '1 条评论', '%d 条评论'); ?></span>
                    </div>
                  </div>
                </div>
              </div>
            </a>
        <?php endwhile; ?>
      <?php endif; ?>
    <?php endif; ?>
    <?php if ($this->options->wutu!== "off") :?>
      <div class="row row-cols-1 row-cols-md-3">
        <?php if ($this->options->articleStyle == 0): ?>
          <?php while ($this->next()): ?>
            <a href="<?php $this->permalink() ?>" target="_self" rel="noopener">
              <div class="col mt-3 rounded yy">
                <div class="card h-100">
                  <img src="<?php echo $this->options->themeUrl('/assets/img/ljz.gif'); ?>" data-src="<?php echo img_postthumb($this); ?>" class="card-img-top rounded" width="350px" height="220px">
                  <div class="card-body">
                    <h5 class="card-title text-primary"><?php $this->title() ?></h5>
                    <p class="card-text"><?php $this->excerpt(20, '...'); ?></p>
                    <div class="d-flex justify-content-between align-items-center">
                      <div class="btn-groupp">
                        <span class="badge bg-secondary"><?php $this->date(); ?></span>
                        <span class="badge bg-secondary"><?php get_post_view($this) ?>次阅读</span>
                      </div>
                      <span class="badge bg-secondary"><?php $this->commentsNum('无评论', '1 条评论', '%d 条评论'); ?></span>
                    </div>
                  </div>
                </div>
              </div>
           </a>
          <?php endwhile; ?>
        <?php endif; ?>
      </div>
    <?php endif; ?>
    <div class="text-center mt-3">
      <?php
        ob_start();
        $this->pageNav('&laquo;','&raquo;', 1, '', array('wrapTag' => 'ul', 'wrapClass' => 'pagination pagination-rounded mb-0 justify-content-center', 'itemTag' => 'li', 'textTag' => 'span', 'currentClass' => 'active',  'prevClass' => 'prev', 'nextClass' => 'next'));
        $content = ob_get_contents();
        ob_end_clean();
        $content = preg_replace("/<li><span>(.*?)<\/span><\/li>/sm", '', $content);
        $content = preg_replace("/<li [class=\"active\"]+>(.*?)<\/li>/sm", '<li class="page-item active">$1</li>', $content);
        $content = preg_replace("/<li [class=\"prev\"]+>(.*?)<\/li>/sm", '<li class="page-item">$1</li>', $content);
        $content = preg_replace("/<li [class=\"next\"]+>(.*?)<\/li>/sm", '<li class="page-item">$1</li>', $content);
        $content = preg_replace("/<li>(.*?)<\/li>/sm", '<li class="page-item">$1</li>', $content);
        $content = preg_replace("/<a href=\"(.*?)\">(.*?)<\/a>/sm", '<a class="page-link" href="$1">$2</a>', $content);
        echo $content;
      ?>
    </div>
  </div>
</main>

<?php $this->need('public/footer.php'); ?>