<?php
    include (__DIR__ . '/../controller/templates/header.php');
?>

<!-- <div style="width: 50%; margin: auto; padding: 30px; text-align: center;">
    <p style="padding-bottom: 5px;">Work in progress...</p>
    <br>
    <progress class="progress is-primary" max="100">30%</progress> <br/>
</div> -->

<div class="columns">
    <div class="column is-full">
        <div class="card-image">
            <?php echo $image ?>
        </div>
    </div>
</div>


<article class="media">
  <div class="media-content">
    <div class="content">
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
      <!-- <div class="level-right">
        <div class="level-item">
          <label class="checkbox">
            <input type="checkbox"> Press enter to submit
          </label>
        </div> -->
      </div>
    </nav>
  </div>
</article>

<script src="../public/js/comments.js"></script>

<?php
    include (__DIR__ . '/../controller/templates/footer.php');
?>