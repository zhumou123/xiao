<?php
$this->comments()->to($comments);
?>

<div class="card mt-3 yy">
    <div class="card-body">
        <?php if ($this->hidden) :?>
            <span>当前文章受密码保护，无法评论</span>
        <?php else :?>
            <?php if ($this->allow('comment') && $this->options->JCommentStatus!== "off") :?>
                <div id="<?php $this->respondId();?>">
                    <?php $comments->cancelReply();?>

                    <form method="post" action="<?php $this->commentUrl()?>" id="comment-form" role="form">
                        <div class="inputgrap">
                            <p>
                                <label for="author" class="required"><?php _e('昵称');?></label>
                                <input class="form-control" type="text" name="author" id="author" class="text" placeholder="必填" value="<?php $this->user->hasLogin()? $this->user->screenName() : $this->remember('author')?>" autocomplete="off" maxlength="16" required/>
                            </p>
                            <p>
                                <label for="mail"<?php if ($this->options->commentsRequireMail):?> class="required"<?php endif;?>><?php _e('邮箱');?></label>
                                <input class="form-control text" type="email" name="mail" id="mail1" placeholder="必填" value="<?php echo $this->user->hasLogin()? $this->user->mail() : $this->remember('mail');?>"<?php if ($this->options->commentsRequireMail):?> autocomplete="off" required<?php endif;?> />
                            </p>
                            <p>
                                <label for="url"<?php if ($this->options->commentsRequireURL):?> class="required"<?php endif;?>><?php _e('网址');?></label>
                                <input class="form-control" type="url" name="url" id="url" autocomplete="off" class="text" placeholder="<?php _e('https://');?>" value="<?php $this->remember('url');?>"<?php if ($this->options->commentsRequireURL):?> required<?php endif;?> />
                            </p>
                        </div>
                        <div class="mb-3">
                            <label for="textarea" class="required"><?php _e('内容');?></label>
                            <textarea class="form-control OwO-textarea" rows="8" cols="50" name="text" id="textarea" class="textarea" placeholder="善语结善缘，恶语伤人心..." required><?php $this->remember('text');?></textarea>
                        </div>
                        <div class="d-grid">
                          <button class="btn btn-outline-secondary btn-block btn-sm" type="submit" style="float: right;">发送评论</button>
                        </div>
                    </form>
                </div>
                
                <h3 class="comment-separator">
                    <div class="comment-tab-current">
                        <div style="margin: 20px auto;width: fit-content;">
                            ---------
                            <span style="color: white;background-color: black;padding: 0 5px;font-size:.7rem;">
                                <?php $this->commentsNum(_t('暂无评论'), _t('仅有一条评论'), _t('已有 %d 条评论'));?>
                            </span> 
                            ---------
                        </div>
                    </div>
                </h3>

                <?php if ($comments->have()) :?>
                    <!--<div class="card p-4 respond">-->
                    <?php $comments->listComments();?>
                    <!--</div>-->
                <?php endif;?>

            <?php else :?>
                <?php if ($this->options->JCommentStatus === "off") :?>
                    <span>博主关闭了所有页面的评论</span>
                <?php else :?>
                    <span>博主关闭了当前页面的评论</span>
                <?php endif;?>
            <?php endif;?>
        <?php endif;?>
    </div>
</div>

<?php function threadedComments($comments, $options) {
    $commentClass = '';
    if ($comments->authorId) {
        if ($comments->authorId == $comments->ownerId) {
            $commentClass .= ' comment-by-author';
        } else {
            $commentClass .= ' comment-by-user';
        }
    }

    $commentLevelClass = $comments->levels > 0 ? ' comment-child' : ' comment-parent';
?>

<li id="li-<?php $comments->theId(); ?>" class="comment-body<?php 
if ($comments->levels > 0) {
    echo ' comment-child';
    $comments->levelsAlt(' comment-level-odd', ' comment-level-even');
} else {
    echo ' comment-parent';
}
$comments->alt(' comment-odd', ' comment-even');
echo $commentClass;
?>">
    <div id="<?php $comments->theId(); ?>">
        <div class="comment-author">
            <?php $comments->gravatar('40', ''); ?>
            <cite class="fn"><?php $comments->author();?></cite>
        </div>
        <div class="comment-meta">
            <?php $comments->date('Y-m-d H:i'); ?>
            <span class="comment-reply"><?php $comments->reply(); ?></span>
        </div>
        <?php $comments->content(); ?>
        <span class="badge bg-secondary"><?php _getAgentOS($comments->agent); ?></span>
        <span class="badge bg-secondary"><?php _getAgentBrowser($comments->agent); ?></span>
    </div>
    <?php if ($comments->children) { ?>
    <div class="comment-children">
        <?php $comments->threadedComments($options); ?>
    </div>
<?php } ?>
</li>
<?php } ?>