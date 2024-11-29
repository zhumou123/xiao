<?php
use Typecho\Widget\Helper\Form\Element\Radio;
use Typecho\Widget\Helper\Form\Element\Text;
use Typecho\Widget\Helper\Form\Element\Checkbox;
use Typecho\Widget\Helper\Form\Element\Textarea;
/* xiao主题核心文件 */
require_once("core/core.php");
function themeConfig($form)
{
$_db = Typecho_Db::get();
  $_prefix = $_db->getPrefix();
  try {
    if (!array_key_exists('views', $_db->fetchRow($_db->select()->from('table.contents')->page(1, 1)))) {
      $_db->query('ALTER TABLE `' . $_prefix . 'contents` ADD `views` INT DEFAULT 0;');
    }
    if (!array_key_exists('agree', $_db->fetchRow($_db->select()->from('table.contents')->page(1, 1)))) {
      $_db->query('ALTER TABLE `' . $_prefix . 'contents` ADD `agree` INT DEFAULT 0;');
    }
  } catch (Exception $e) {
  }
?>

<div class="xiao_config">
  <div>
    <div class="xiao_config__aside">
      <h2 class="text">xiao <?php echo _getVersion() ?> 主题设置</h2>
      <?php require_once('core/backup.php'); ?>
    </div>
  </div>
<?php
$JCommentStatus = new Typecho_Widget_Helper_Form_Element_Select('JCommentStatus', array('on' => '开启（默认）', 'off' => '关闭'), '3', '开启或关闭全站评论', '介绍：用于一键开启关闭所有页面的评论 <br>注意：此处的权重优先级最高 <br>若关闭此项而文章内开启评论，评论依旧为关闭状态');
$form->addInput($JCommentStatus->multiMode());
/* --------------------------------------- */
$wutu = new Typecho_Widget_Helper_Form_Element_Select('wutu', array('on' => '有图模式（默认）', 'off' => '无图模式'), '3', '首页文章卡片', '用于一键开启关闭首页文章卡片是否有图 ');
$form->addInput($wutu->multiMode());
/* --------------------------------------- */
$pjax = new Typecho_Widget_Helper_Form_Element_Select('pjax', array('off' => '关闭（默认）', 'on' => '开启'), '3', '全站pjax刷新', '全站pjax刷新');
$form->addInput($pjax->multiMode());
/* --------------------------------------- */
$ce = new Typecho_Widget_Helper_Form_Element_Select('ce', array('off' => '关闭（默认）', 'on' => '开启'), '3', '网站点击特效', '网站点击特效');
$form->addInput($ce->multiMode());
/* --------------------------------------- */
$denglu = new Typecho_Widget_Helper_Form_Element_Select('denglu', array('on' => '开启（默认）', 'off' => '关闭'), '3', '前台登录按钮', '用于一键开启关闭前台登录功能');
$form->addInput($denglu->multiMode());
/* --------------------------------------- */
$favicon = new Typecho_Widget_Helper_Form_Element_Text('favicon', null, null, _t('站点标题 LOGO 地址'), _t('在这里填入一个图片 URL 地址, 以在网站标题前加上一个 LOGO  支持Base64 地址'));
$form->addInput($favicon);
/* --------------------------------------- */
$JDynamic_Background = new Typecho_Widget_Helper_Form_Element_Select('JDynamic_Background',array('off' => '关闭（默认）','backdrop1.js' => '效果1','backdrop2.js' => '效果2','backdrop3.js' => '效果3','backdrop4.js' => '效果4','backdrop5.js' => '效果5','backdrop6.js' => '效果6'),'off','是否开启动态背景图','用于设置PC端动态背景效果<br>注意：请勿和下方网站背景同时开启');
$form->addInput($JDynamic_Background->multiMode());
/* --------------------------------------- */
$background = new Typecho_Widget_Helper_Form_Element_Text('background', NULL, NULL, _t('网站背景'), _t('在这里输入背景链接,留空则不显示 支持Base64 地址<br>注意：请勿和上方动态背景图同时开启'));
$form->addInput($background);
/* --------------------------------------- */
$yxsj = new Typecho_Widget_Helper_Form_Element_Text('yxsj', NULL, NULL, _t('站点运行时间'), _t('在这里输入（年,月,日,时,分,秒）如：2024, 2, 29, 00, 00, 00,留空则不显示'));
$form->addInput($yxsj);
/* --------------------------------------- */
$Reward = new Typecho_Widget_Helper_Form_Element_Text('Reward', NULL, NULL, _t('文章打赏'), _t('在这里输入收款码,留空则不显示'));
$form->addInput($Reward);
/* --------------------------------------- */
$ICPbeian = new Typecho_Widget_Helper_Form_Element_Text('ICPbeian', NULL, NULL, _t('ICP备案号'), _t('在这里输入ICP备案号,留空则不显示'));
$form->addInput($ICPbeian);
/* --------------------------------------- */
$gonganbeian = new Typecho_Widget_Helper_Form_Element_Text('gonganbeian', NULL, NULL, _t('公安联网备案号'), _t('在这里输入公安联网备案号, 留空则不显示'));
$form->addInput($gonganbeian);
/* --------------------------------------- */
$CustomCSS = new Typecho_Widget_Helper_Form_Element_Textarea('CustomCSS', NULL, NULL, _t('自定义css'), _t('在这里填入你的自定义css（直接填入css，无需< style >标签）'));
$form->addInput($CustomCSS);
/* --------------------------------------- */
$JCustomScript = new Typecho_Widget_Helper_Form_Element_Textarea('JCustomScript',NULL,NULL,'自定义JS','请填写自定义JS内容，例如网站统计等，填写时无需填写script标签。');
$form->addInput($JCustomScript);
/* --------------------------------------- */
$JFooter_Left = new Typecho_Widget_Helper_Form_Element_Textarea('JFooter_Left',NULL,'','自定义底部栏内容','介绍：用于修改/增加底部栏内容<br>例如：&lt;a href="/"&gt;首页&lt;/a&gt; &lt;a href="/"&gt;关于&lt;/a&gt;');
$form->addInput($JFooter_Left);
/* --------------------------------------- */
$CustomContent = new Typecho_Widget_Helper_Form_Element_Textarea('CustomContent', NULL, NULL, _t('底部自定义内容'), _t('位于底部，footer之后body之前。'));
$form->addInput($CustomContent);
/* --------------------------------------- */
}