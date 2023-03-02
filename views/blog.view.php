<div class="card">
    <img src="<?php echo $blog->image ?? '' ?>" class="card-img-top" alt="...">
    <div class="card-body">
        <p class="card-text"><small class="text-muted"><?php echo \app\models\Blog::getUser($blog->userId)->getDisplayName() ?? '' ?></small></p>
        <h5 class="card-title"><?php echo $blog->title ?? '' ?></h5>
        <p class="card-text"><?php echo $blog->description ?? '' ?></p>
        <p class="card-text"><small class="text-muted"><?php echo $blog->created_at ?? '' ?></small></p>
    </div>
</div>