<script type="text/javascript">
  //控制台打印
  console.log(
    "%c%s",
    "color: blue; font-size: 16px;",
    "当前主题版本：xiao <?php echo _getVersion() ?>\n主题作者邮箱：xz@zhuxu.asia"
  );

  <?php if ($this->options->pjax!== "off") :?>
    document.addEventListener('pjax:send', () => {
      NProgress.start();
    });
    document.addEventListener('pjax:complete', () => {
      NProgress.done();
    });
    let pjax = new Pjax({
      elements: 'a[href^="<?php $this->options->siteUrl(); ?>"]:not(a[target="_blank"], a[no-pjax], a[href^="<?php $this->options->adminUrl(); ?>"])',
      selectors: [
        "title",
        ".main-menu",
        "main",
        "#logout",
      ]
    });
    // 这里插入其他代码
  <?php endif;?>
    
  //图片灯箱
  Fancybox.bind("[data-fancybox]", {
    Toolbar: {
      display: {
        left: ["infobar",],
          middle: [
            "zoomIn",
            "zoomOut",
            "toggle1to1",
            "rotateCCW",
            "rotateCW",
          ],
        right: ["slideshow", "close"],
      },
    },
  });
    
  //站点运行时间
  function siteTime() {
    window.setTimeout("siteTime()", 1000);
      var seconds = 1000;
      var minutes = seconds * 60;
      var hours = minutes * 60;
      var days = hours * 24;
      var years = days * 365;
      var today = new Date();
      var todayYear = today.getFullYear();
      var todayMonth = today.getMonth() + 1;
      var todayDate = today.getDate();
      var todayHour = today.getHours();
      var todayMinute = today.getMinutes();
      var todaySecond = today.getSeconds();
      var t1 = Date.UTC(<?php echo $this->options->yxsj(); ?>); 
      var t2 = Date.UTC(todayYear, todayMonth, todayDate, todayHour, todayMinute, todaySecond);
      var diff = t2 - t1;
      var diffYears = Math.floor(diff / years);
      var diffDays = Math.floor((diff / days) - diffYears * 365);
      var diffHours = Math.floor((diff - (diffYears * 365 + diffDays) * days) / hours);
      var diffMinutes = Math.floor((diff - (diffYears * 365 + diffDays) * days - diffHours * hours) / minutes);
      var diffSeconds = Math.floor((diff - (diffYears * 365 + diffDays) * days - diffHours * hours - diffMinutes * minutes) / seconds);
    document.getElementById("sitetime").innerHTML = "站点已运行 " +   diffDays + " 天 " + diffHours + " 小时 " + diffMinutes + " 分钟 " + diffSeconds + " 秒";
  }  
  siteTime();
  <?php $this->options->JCustomScript() ?>
</script>