  <footer id="footer" class="bd-footer py-4 mt-3 bg-body-tertiary yy">
    <div class="text-center text-muted">
      <div class="item">
        <?php if ($this->options->ICPbeian): ?>
          <img src="<?php echo $this->options->themeUrl('/assets/img/ICP.svg'); ?>" alt="icp" class="icp-icon" width="16">
          <a href="http://beian.miit.gov.cn" class="icpnum" target="_blank" rel="noreferrer"><?php echo $this->options->ICPbeian(); ?></a>
        <?php endif; ?>
      </div>
      <div class="item">
        <?php if ($this->options->gonganbeian): ?>
          <img src="<?php echo $this->options->themeUrl('/assets/img/bei.svg'); ?>" alt="ga" class="icp-icon" width="16">  
          <a href="https://beian.mps.gov.cn/#/query/webSearch" class="icpnum" target="_blank" rel="noreferrer"><?php echo $this->options->gonganbeian(); ?></a>
        <?php endif; ?>
      </div>
      <div class="item">
        <?php $this->options->JFooter_Left() ?>
      </div>
      <div class="item">
        <?php if ($this->options->yxsj): ?>  
          <span id="sitetime"><!-- 站点运行时间 --></span>
        <?php endif; ?>
      </div>
      <div class="item">
        &copy; <?php echo date('Y'); ?> <a href="<?php $this->options->siteUrl(); ?>"><?php $this->options->title(); ?></a><?php _e(' 由 <a href="http://www.typecho.org">Typecho</a> 强力驱动'); ?>
      </div>
    </div>
  </footer>
  
  <script src="<?php $this->options->themeUrl('assets/js/xiao.main.js'); ?>"></script>
  <script src="<?php $this->options->themeUrl('assets/js/bootstrap.bundle.min.js'); ?>"></script>
  <script src="<?php $this->options->themeUrl('assets/js/fancybox.umd.js'); ?>"></script>
  <?php if ($this->options->ce!== "off") :?>
    <script src="<?php $this->options->themeUrl('assets/js/xiao.mouse.js'); ?>"></script>
  <?php endif;?>
  <?php if ($this->options->pjax!== "off") :?>
    <script src="<?php $this->options->themeUrl('assets/js/xiao.pjax.js'); ?>"></script>
  <?php endif;?>
  <?php if ($this->options->JDynamic_Background && $this->options->JDynamic_Background !== 'off') : ?>
    <script src="<?php $this->options->themeUrl('assets/backdrop/' . $this->options->JDynamic_Background); ?>" async></script>
  <?php endif; ?>
  <?php $this->need('core/js.php'); ?>
  <?php $this->footer(); ?>
  <?php if ($this->options->CustomContent): $this->options->CustomContent(); ?>
  <?php endif; ?>
</body>