<?php $this->theme->header(); ?>

    <main>
        <div class="container">
            <div class="row">
                <div class="col page-title">
                    <h3>
	                    <?= $lang->dashboardMain['posts_posts']?>
                        <a href="/admin/posts/create/" class="create-link"><?= $lang->dashboardMain['posts_create']?></a>
                    </h3>
                </div>
            </div>

            <table class="table">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Title</th>
                    <th>Date</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach($posts as $post): ?>
                <tr>
                    <th scope="row">
                        <?= $post->id ?>
                    </th>

                    <td>
                        <a href="/admin/posts/edit/<?=$post->id?>" class="post-name"><?= $post->title ?></a>
                    </td>

                    <td>
                        <?= $post->date ?>
                    </td>
                </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </main>

<?php $this->theme->footer(); ?>