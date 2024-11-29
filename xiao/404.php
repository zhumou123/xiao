<?php
if (!defined('__TYPECHO_ROOT_DIR__')) exit;
$this->need('public/header.php');
?>

<main id="main" class="main">
  <div class="container">
    <div class="card mt-3 yy">
      <div class="card-body">
        <h2 class="post-title">404 - <?php _e('页面没找到'); ?></h2>
        <p><?php _e('你想查看的页面已被转移或删除了, 要不要搜索看看: '); ?></p>
        <form class="col-12 col-lg-auto mb-3 mb-lg-0" id="search" method="post" action="<?php $this->options->siteUrl(); ?>" role="search">
          <input type="search" class="form-control" id="s" name="s" placeholder="<?php _e('输入关键字后回车'); ?>" aria-label="Search">
        </form>
      </div>
    </div>
  </div>
</main>

<?php $this->need('public/footer.php'); ?>