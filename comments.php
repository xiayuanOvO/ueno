<?php if (!defined('__TYPECHO_ROOT_DIR__'))
  exit; ?>
<?php $this->comments()->to($comments); ?>
<section class="entry-section comment">
  <div class="inner">
    <?php if ($comments->have()): ?>
      <h2><?php $this->commentsNum(_t('暂无评论'), _t('仅有一条评论'), _t('已有 %d 条评论')); ?></h2>
      <ul class="comment-list">
        <?php $comments->listComments(); ?>
      </ul>
      <?php $comments->pageNav('&laquo; 前一页', '后一页 &raquo;'); ?>
    <?php endif; ?>

    <?php if ($this->allow('comment')): ?>
      <div id="<?php $this->respondId(); ?>" class="comment-respond">
        <div class="cancel-comment-reply">
          <?php $comments->cancelReply(); ?>
        </div>

        <h2 id="response"><?php _e('添加新评论'); ?></h2>
        <div id="comment-form-message" class="comment-form-message" style="display: none;"></div>
        <form method="post" action="<?php $this->commentUrl() ?>" id="comment-form" class="comment-form" role="form">
          <?php if ($this->user->hasLogin()): ?>
            <div class="comment-logged-in">
              <p><?php _e('登录身份: '); ?><a href="<?php $this->options->profileUrl(); ?>"><?php $this->user->screenName(); ?></a>.
                <a href="<?php $this->options->logoutUrl(); ?>" title="Logout"><?php _e('退出'); ?> &raquo;</a>
              </p>
            </div>
          <?php else: ?>
            <div class="comment-form-fields">
              <div class="comment-form-field">
                <label for="author" class="required"><?php _e('称呼'); ?></label>
                <input type="text" name="author" id="author" class="text" value="<?php $this->remember('author'); ?>"
                  required />
              </div>
              <div class="comment-form-field">
                <label for="mail" <?php if ($this->options->commentsRequireMail): ?> class="required" <?php endif; ?>><?php _e('Email'); ?></label>
                <input type="email" name="mail" id="mail" class="text" value="<?php $this->remember('mail'); ?>" <?php if ($this->options->commentsRequireMail): ?> required<?php endif; ?> />
              </div>
              <div class="comment-form-field">
                <label for="url" <?php if ($this->options->commentsRequireURL): ?> class="required" <?php endif; ?>><?php _e('网站'); ?></label>
                <input type="url" name="url" id="url" class="text" placeholder="<?php _e('http://'); ?>"
                  value="<?php $this->remember('url'); ?>" <?php if ($this->options->commentsRequireURL): ?> required<?php endif; ?> />
              </div>
            </div>
          <?php endif; ?>
          <div class="comment-form-field">
            <label for="textarea" class="required"><?php _e('内容'); ?></label>
            <textarea rows="8" cols="50" name="text" id="textarea" class="textarea"
              required><?php $this->remember('text'); ?></textarea>
          </div>
          <div class="comment-form-submit">
            <button type="submit" class="submit"><?php _e('提交评论'); ?></button>
          </div>
        </form>
      </div>
    <?php else: ?>
      <h2><?php _e('评论已关闭'); ?></h2>
    <?php endif; ?>
  </div>
</section>
