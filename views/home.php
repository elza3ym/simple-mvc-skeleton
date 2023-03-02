<div class="blog-list row mt-5">
    <?php if ($blogs): ?>
    <?php foreach ($blogs as $blog): ?>
    <div class="card mb-3 col-12">
        <a href="/blog-post?id=<?php echo $blog->id ?? '' ?>" style="color: inherit; text-decoration: inherit;">
            <div class="row g-0">
                <div class="col-md-4">
                    <img src="<?php echo $blog->image ?? '' ?>" class="img-fluid rounded-start" alt="...">
                </div>
                <div class="col-md-8">
                    <div class="card-body">
                        <p class="card-text"><small class="text-muted"><?php echo \app\models\Blog::getUser($blog->userId)->getDisplayName() ?? '' ?></small></p>
                        <h5 class="card-title"><?php echo $blog->title ?? '' ?></h5>
                        <p class="card-text"><?php echo $blog->description ?? '' ?></p>
                        <p class="card-text"><small class="text-muted"><?php echo $blog->created_at ?? '' ?></small></p>
                    </div>
                </div>
            </div>
        </a>
    </div>
    <?php endforeach; ?>
    <?php else: ?>
    <h3>No Records are found please insert some</h3>
    <?php endif; ?>

</div>