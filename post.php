<?php if (!defined('__TYPECHO_ROOT_DIR__'))
  exit; ?>
<?php $this->need('header.php'); ?>
<link rel="stylesheet" href="<?php $this->options->themeUrl('assets/entry/comments.css'); ?>">

<?php
if (!($this->fields->layoutType) || $this->fields->layoutType == 'normal'):
  $this->need('post-normal.php');
elseif ($this->fields->layoutType == 'normal-cover'):
  $this->need('post-normal-cover.php');
elseif ($this->fields->layoutType == 'topimage'):
  $this->need('post-topimage.php');
elseif ($this->fields->layoutType == 'leftimage'):
  $this->need('post-leftimage.php');
endif;
?>


<?php if (is_array($this->options->renderopt) && in_array('formula', $this->options->renderopt)): ?>
  <script>
    MathJax = {
      tex: {
        inlineMath: [['$', '$'], ['\\(', '\\)']]
      },
      svg: {
        fontCache: 'global'
      }
    };
  </script>
  <script id="MathJax-script" async src="https://cdn.jsdelivr.net/npm/mathjax@3/es5/tex-mml-chtml.js" defer></script>
<?php endif; ?>

<?php if (!is_array($this->options->renderopt) || in_array('highlight', $this->options->renderopt)): ?>
  <script src="<?php $this->options->themeUrl('highlight/highlight.min.js'); ?>" defer></script>
  <script>
    window.onload = () => hljs.highlightAll();
  </script>
  <style>
    code,
    kbd,
    samp,
    pre {
      font-family: 'JetBrains Mono', 'Sarasa Term SC', Consolas, 'Courier New', Courier, monospace;
    }

    .light-theme .hljs {
      background-color: #f5f5f5;
    }

    .dark-theme .hljs {
      background-color: #1d1f23;
    }

    .hljs {
      font-size: 15px;
    }
  </style>
<?php endif; ?>

<style>
  article table {
    display: block;
    border-collapse: collapse;
    margin: 20px 0;
    overflow-x: auto
  }

  article tr {
    background-color: #8881;
    border-top: 1px solid #8885;
    transition: background-color .5s
  }

  article tr:nth-child(2n) {
    background-color: transparent
  }

  article th,
  article td {
    border: 1px solid #8885;
    padding: 8px 16px
  }

  article th {
    text-align: left;
    font-size: 15px;
    font-weight: 600;
    background-color: #8881
  }

  article td {
    font-size: 15px
  }
</style>

<script>
  // 处理评论表单提交后的反馈
  (function() {
    // 检查URL hash，如果有评论ID则滚动到该评论
    if (window.location.hash && window.location.hash.startsWith('#comment-')) {
      setTimeout(function() {
        const commentElement = document.querySelector(window.location.hash);
        if (commentElement) {
          commentElement.scrollIntoView({ behavior: 'smooth', block: 'center' });
          commentElement.style.animation = 'highlight 2s ease';
        }
      }, 300);
    }
    
    // 检查URL参数，显示评论提交状态
    const urlParams = new URLSearchParams(window.location.search);
    const commentStatus = urlParams.get('comment');
    
    if (commentStatus) {
      const messageDiv = document.getElementById('comment-form-message');
      if (messageDiv) {
        messageDiv.style.display = 'block';
        if (commentStatus === 'success' || commentStatus === 'approved') {
          messageDiv.className = 'comment-form-message comment-form-success';
          messageDiv.textContent = '评论提交成功！';
          // 滚动到评论区域
          setTimeout(function() {
            const respondDiv = document.querySelector('.comment-respond');
            if (respondDiv) {
              respondDiv.scrollIntoView({ behavior: 'smooth', block: 'center' });
            }
          }, 100);
        } else if (commentStatus === 'waiting' || commentStatus === 'moderated') {
          messageDiv.className = 'comment-form-message comment-form-waiting';
          messageDiv.textContent = '评论已提交，等待审核。';
        } else {
          messageDiv.className = 'comment-form-message comment-form-error';
          messageDiv.textContent = '评论提交失败，请重试。';
        }
      }
    }
    
    // 表单提交处理
    const commentForm = document.getElementById('comment-form');
    if (commentForm) {
      commentForm.addEventListener('submit', function(e) {
        const submitButton = this.querySelector('button[type="submit"]');
        if (submitButton) {
          submitButton.disabled = true;
          submitButton.textContent = '提交中...';
        }
      });
    }
  })();
</script>
<style>
  @keyframes highlight {
    0% { background-color: rgba(var(--un-rc-accent), 0.3); }
    100% { background-color: transparent; }
  }
</style>

<?php $this->need('footer.php'); ?>