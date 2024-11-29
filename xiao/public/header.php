<!DOCTYPE HTML>
<html lang="zh-CN" data-bs-theme="light">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="icon" type="image/png" href="<?php $this->options->favicon(); ?>">
  <title><?php $this->archiveTitle(array( 
         'category'  =>  _t('分类 %s 下的文章'), 
         'search'    =>  _t('包含关键字 %s 的文章'),
         'tag'       =>  _t('标签 %s 下的文章'),
         'author'    =>  _t('%s 发布的文章')
  ), '', ' - '); ?><?php $this->options->title(); ?><?php if($this->_currentPage>1) echo ' - 第 '.$this->_currentPage.' 页 '; ?></title>
  <link href="<?php $this->options->themeUrl('assets/css/xiao.main.css'); ?>" rel="stylesheet" type="text/css" media="all">
  <link href="<?php $this->options->themeUrl('assets/css/bootstrap.min.css'); ?>" rel="stylesheet">
  <link href="<?php $this->options->themeUrl('assets/css/fancybox.css'); ?>" rel="stylesheet">
  <?php $this->header('keywords=&generator=&template=&pingback=&xmlrpc=&wlw='); ?>
  <?php $this->options->JCustomHeadEnd() ?>
  <?php $this->need('core/css.php'); ?>
</head>
<body>
    
<svg xmlns="http://www.w3.org/2000/svg" class="d-none">
  <symbol id="check2" viewBox="0 0 16 16">
    <path d="M13.854 3.646a.5.5 0 0 1 0 .708l-7 7a.5.5 0 0 1-.708 0l-3.5-3.5a.5.5 0 1 1 .708-.708L6.5 10.293l6.646-6.647a.5.5 0 0 1 .708 0z"/>
  </symbol>
  <symbol id="circle-half" viewBox="0 0 16 16">
    <path d="M8 15A7 7 0 1 0 8 1v14zm0 1A8 8 0 1 1 8 0a8 8 0 0 1 0 16z"/>
  </symbol>
  <symbol id="moon-stars-fill" viewBox="0 0 16 16">
    <path d="M6 .278a.768.768 0 0 1 .08.858 7.208 7.208 0 0 0-.878 3.46c0 4.021 3.278 7.277 7.318 7.277.527 0 1.04-.055 1.533-.16a.787.787 0 0 1 .81.316.733.733 0 0 1-.031.893A8.349 8.349 0 0 1 8.344 16C3.734 16 0 12.286 0 7.71 0 4.266 2.114 1.312 5.124.06A.752.752 0 0 1 6 .278z"/>
    <path d="M10.794 3.148a.217.217 0 0 1 .412 0l.387 1.162c.173.518.579.924 1.097 1.097l1.162.387a.217.217 0 0 1 0 .412l-1.162.387a1.734 1.734 0 0 0-1.097 1.097l-.387 1.162a.217.217 0 0 1-.412 0l-.387-1.162A1.734 1.734 0 0 0 9.31 6.593l-1.162-.387a.217.217 0 0 1 0-.412l1.162-.387a1.734 1.734 0 0 0 1.097-1.097l.387-1.162zM13.863.099a.145.145 0 0 1 .274 0l.258.774c.115.346.386.617.732.732l.774.258a.145.145 0 0 1 0 .274l-.774.258a1.156 1.156 0 0 0-.732.732l-.258.774a.145.145 0 0 1-.274 0l-.258-.774a1.156 1.156 0 0 0-.732-.732l-.774-.258a.145.145 0 0 1 0-.274l.774-.258c.346-.115.617-.386.732-.732L13.863.1z"/>
  </symbol>
  <symbol id="sun-fill" viewBox="0 0 16 16">
    <path d="M8 12a4 4 0 1 0 0-8 4 4 0 0 0 0 8zM8 0a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-1 0v-2A.5.5 0 0 1 8 0zm0 13a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-1 0v-2A.5.5 0 0 1 8 13zm8-5a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1 0-1h2a.5.5 0 0 1 .5.5zM3 8a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1 0-1h2A.5.5 0 0 1 3 8zm10.657-5.657a.5.5 0 0 1 0 .707l-1.414 1.415a.5.5 0 1 1-.707-.708l1.414-1.414a.5.5 0 0 1 .707 0zm-9.193 9.193a.5.5 0 0 1 0 .707L3.05 13.657a.5.5 0 0 1-.707-.707l1.414-1.414a.5.5 0 0 1 .707 0zm9.193 2.121a.5.5 0 0 1-.707 0l-1.414-1.414a.5.5 0 0 1 .707-.707l1.414 1.414a.5.5 0 0 1 0 .707zM4.464 4.465a.5.5 0 0 1-.707 0L2.343 3.05a.5.5 0 1 1 .707-.707l1.414 1.414a.5.5 0 0 1 0 .708z"/>
  </symbol>
</svg>

<div class="dropdown position-fixed bottom-0 end-0 mb-3 me-2 bd-mode-toggle">
  <button class="btn btn-bd-primary py-2 dropdown-toggle d-flex align-items-center"id="bd-theme"type="button"aria-expanded="false"data-bs-toggle="dropdown"aria-label="Toggle theme (auto)">
    <svg class="bi my-1 theme-icon-active" width="1em" height="1em"><use href="#circle-half"></use></svg>
    <span class="visually-hidden" id="bd-theme-text">Toggle theme</span>
  </button>
  <ul class="dropdown-menu dropdown-menu-end shadow" aria-labelledby="bd-theme-text">
    <li>
      <button type="button" class="dropdown-item d-flex align-items-center" data-bs-theme-value="light" aria-pressed="false">
        <svg class="bi me-2 opacity-50" width="1em" height="1em"><use href="#sun-fill"></use></svg>
          浅色
        <svg class="bi ms-auto d-none" width="1em" height="1em"><use href="#check2"></use></svg>
      </button>
    </li>
    <li>
      <button type="button" class="dropdown-item d-flex align-items-center" data-bs-theme-value="dark" aria-pressed="false">
        <svg class="bi me-2 opacity-50" width="1em" height="1em"><use href="#moon-stars-fill"></use></svg>
          深色
        <svg class="bi ms-auto d-none" width="1em" height="1em"><use href="#check2"></use></svg>
      </button>
    </li>
    <li>
      <button type="button" class="dropdown-item d-flex align-items-center active" data-bs-theme-value="auto" aria-pressed="true">
        <svg class="bi me-2 opacity-50" width="1em" height="1em"><use href="#circle-half"></use></svg>
          自动
        <svg class="bi ms-auto d-none" width="1em" height="1em"><use href="#check2"></use></svg>
      </button>
    </li>
  </ul>
</div>
    
<?php $this->need('core/Modal.php'); ?>
<header id="header" class="navbar navbar-expand-lg bd-navbar sticky-top bg-body-tertiary yy">
  <nav class="container bd-gutter flex-wrap flex-lg-nowrap">
    <a href="<?php $this->options->siteUrl(); ?>" class="navbar-brand">
      <span class="fs-4"><?php $this->options->title(); ?></span>
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar2" aria-controls="offcanvasNavbar2" title="Title">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasNavbar2" aria-labelledby="offcanvasNavbar2Label">
      <div class="offcanvas-header">
        <h5 class="offcanvas-title" id="offcanvasNavbar2Label"><?php $this->options->title() ?></h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
      </div>
      <div class="offcanvas-body">
        <ul class="navbar-nav me-auto mb-2 mb-md-0">
          <li class="nav-item">
            <a class="nav-link link-body-emphasis px-2" href="<?php $this->options->siteUrl() ?>" <?php if ($this->is('index')) : ?> class="nav-focus"<?php endif; ?>>首页</a>
          </li>
          <li class="nav-item">
            <div class="dropdown">
              <a type="button" class="nav-link link-body-emphasis px-2 dropdown-toggle" data-bs-toggle="dropdown">分类</a>
              <div class="dropdown-menu">
                <?php $this->widget('Widget_Metas_Category_List')->to($categories); ?>
                  <?php while($categories->next()): ?>
                  <a class="dropdown-item" href="<?php $categories->permalink(); ?>" rel="section"><?php $categories->name(); ?></a>
                <?php endwhile; ?>
              </div>
            </div>
          </li>
          <li class="nav-item">
            <?php $this->widget('Widget_Contents_Page_List')->to($pages); ?>
              <?php while($pages->next()): ?>
                <li class="nav-item">
                  <a class="nav-link link-body-emphasis px-2"
                    <?php if($this->is('page', $pages->slug)): ?> class="current"<?php endif; ?> href="<?php $pages->permalink(); ?>" title="<?php $pages->title(); ?>"><?php $pages->title(); ?>
                  </a>
                </li>
              <?php endwhile; ?>
          </li>
        </ul>
        <form class="col-12 col-lg-auto mb-3 mb-lg-0" id="search" method="post" action="<?php $this->options->siteUrl(); ?>" role="search">
          <input type="search" class="form-control" id="s" name="s" placeholder="<?php _e('输入关键字后回车'); ?>" aria-label="Search">
        </form>
        <?php if ($this->options->denglu!== "off") :?>
        <div class="ms-lg-3 dropdown dropdown-menu-end" style="display: grid!important;">
          <?php if ($this->user->hasLogin()) : ?>
            <button type="button" class="btn btn-outline-secondary" data-bs-toggle="dropdown">用户：<?php $this->user->screenName(); ?></button>
            <ul class="dropdown-menu" style="width: 100%;">
              <li><a class="dropdown-item" target="_blank" href="<?php $this->options->adminUrl("manage-posts.php"); ?>">管理文章</a></li>
              <li><a class="dropdown-item" target="_blank" href="<?php $this->options->adminUrl("manage-comments.php"); ?>">管理评论</a></li>
              <li><a class="dropdown-item" target="_blank" href="<?php $this->options->adminUrl("options-theme.php"); ?>">主题设置</a></li>
              <li><a class="dropdown-item" target="_blank" href="<?php $this->options->adminUrl(); ?>">进入后台</a></li>
              <li><hr class="dropdown-divider"></li>
              <li><a class="dropdown-item" href="<?php $this->options->logoutUrl(); ?>">退出登录</a></li>
            </ul>
            <?php else : ?>
            <div class="d-grid">
              <button type="button" class="btn btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#myModal">登录<?php if ($this->options->allowRegister) : ?>/注册<?php endif; ?></button>
            </div>
            <?php endif; ?>
        </div>
        <?php endif;?>
      </div>
    </div>
  </nav>
</header>