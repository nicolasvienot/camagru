<?php
    include (__DIR__ . '/../controller/templates/header.php');
?>

<div class="columns">
    <div class="column is-full">
        <div class="card-image">
            <?php echo $image ?>
        </div>
    </div>
</div>


<article class="media">
  <div class="media-content">
    <div class="content" id="comments_div">
        <?php echo $comments ?>
    </div>
  </div>
</article>

<article class="media">
  <div class="media-content">
    <div class="field">
      <p class="control">
        <textarea class="textarea" placeholder="Add a comment..." id="comment_content"></textarea>
      </p>
    </div>
    <nav class="level">
      <div class="level-left">
        <div class="level-item">
          <a class="button is-info" id="submit_comment">Submit</a>
        </div>
      </div>
      </div>
    </nav>
  </div>
</article>

<script src="../public/js/comments.js"></script>

<?php
    include (__DIR__ . '/../controller/templates/footer.php');
?>