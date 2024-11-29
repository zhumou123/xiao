<!-- xiao主题css样式 -->
<style type="text/css">
<?php $this->options->CustomCSS(); ?>
body{
  margin: 0;
  font-family: 'Helvetica Neue', Helvetica, 'PingFang SC', 'Hiragino Sans GB', 'Microsoft YaHei', '微软雅黑', Arial, sans-serif;
  font-size: var(--bs-body-font-size);
  font-weight: var(--bs-body-font-weight);
  line-height: var(--bs-body-line-height);
  color: var(--bs-body-color);
  text-align: var(--bs-body-text-align);
  background-color: var(--bs-secondary-bg);
  -webkit-text-size-adjust: 100%;
  -webkit-tap-highlight-color: transparent;
}
<?php if($this->options->background):?>
  body::before{z-index:-1;content:"";top:0;left:0;right:0;bottom:0;opacity:0.5;position:fixed;background:center/cover no-repeat;background-image:url(<?php if($this->options->background):?><?php $this->options->background();?><?php endif;?>);}
<?php endif;?>
a {
  text-decoration: none;
}
.yy {
  box-shadow: 2px 2px 5px #b1b4b6, -2px -2px 5px #b1b4b6;
}
.btn-bd-primary {
  --bd-violet-bg: #712cf9;
  --bd-violet-rgb: 112.520718, 44.062154, 249.437846;
  --bs-btn-font-weight: 600;
  --bs-btn-color: var(--bs-white);
  --bs-btn-bg: var(--bd-violet-bg);
  --bs-btn-border-color: var(--bd-violet-bg);
  --bs-btn-hover-color: var(--bs-white);
  --bs-btn-hover-bg: #6528e0;
  --bs-btn-hover-border-color: #6528e0;
  --bs-btn-focus-shadow-rgb: var(--bd-violet-rgb);
  --bs-btn-active-color: var(--bs-btn-hover-color);
  --bs-btn-active-bg: #5a23c8;
  --bs-btn-active-border-color: #5a23c8;
}
</style>