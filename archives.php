<?php
/**
 * 归档
 *
 * @package custom
 */
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
        <article class="post" itemscope itemtype="http://schema.org/BlogPosting">
          <div class="post-archives" itemprop="articleBody">
            <?php Typecho_Widget::widget('Widget_Stat')->to($stat); ?>
            <div class="text"><span class="badge bg-primary">文章总数：<?php $stat->publishedPostsNum() ?>篇</span></div>
            <div class="text"><span class="badge bg-primary">分类总数：<?php $stat->categoriesNum() ?>个</span></div>
            <div class="text"><span class="badge bg-primary">页面总数：<?php $stat->publishedPagesNum() ?>个</span></div>
            <div class="text"><span class="badge bg-primary">评论总数：<?php $stat->publishedCommentsNum() ?>条</span></div>
            <div class="text"><span class="badge bg-primary">垃圾评论：<?php $stat->spamCommentsNum() ?>条</span></div>
            <hr>
            <?php
            $Month_E = array(
            1 => "1月",
            2 => "2月",
            3 => "3月",
            4 => "4月",
            5 => "5月",
            6 => "6月",
            7 => "7月",
            8 => "8月",
            9 => "9月",
            10 => "10月",
            11 => "11月",
            12 => "12月");
            $this->widget('Widget_Contents_Post_Recent', 'pageSize=10000')->to($archives);
            $year = 0;
            $mon = 0;
            $i = 0;
            $j = 0;
            $all = array();
            $output = '';
            while ($archives->next()):
            $year_tmp = date('Y年', $archives->created);
            $mon_tmp = date('n', $archives->created);
            $y = $year;
            $m = $mon;
            if ($mon != $mon_tmp && $mon > 0) $output .= '</div></div>';
            if ($year != $year_tmp) {
            $year = $year_tmp;
            $all[$year] = array();
            }
            if ($mon != $mon_tmp) {
            $mon = $mon_tmp;
            array_push($all[$year], $mon);
            $output .= "<div class='archive-title' id='arti-$year-$mon'><h4 class='text-primary'>$year$Month_E[$mon]</h4><div class='archives archives-$mon' data-date='$year-$mon'>";
            }
            $output .= '<div class="brick text-muted">' . date('Y年m月d日', $archives->created) . '：<a href="' . $archives->permalink . '" class="text-muted" style="text-decoration:none;">' . $archives->title . '</a></div>';
            endwhile;
            $output .= '</div></div>';
            echo $output;

            $html = "";
            $year_now = date("Y");
            foreach ($all as $key => $value) {
            $html .= "<li class='year' id='year-$key'><a href='#' class='year-toogle' id='yeto-$key'>$key</a><ul class='monthall'>";
            for ($i = 12; $i > 0; $i--) {
            if ($key == $year_now && $i > $value[0]) continue;
            $html .= in_array($i, $value) ? ("<li class='month monthed' id='mont-$key-$i'>$i</li>") : ("<li class='month'>$i</li>");
            }
            $html .= "</ul></li>";
            }
            ?>
          </div>
        </article>
      </div>  
    </div>  
  </div>
</main>

<?php $this->need('public/footer.php'); ?>