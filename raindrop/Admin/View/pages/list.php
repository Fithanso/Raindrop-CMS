<?php $this->theme->header(); ?>

    <main>
        <div class="container">
            <div class="row">
                <div class="col page-title">
                    <h3>
	                    <?= $lang->dashboardMain['pages_pages']?>
                        <a href="/admin/pages/create/" class="create-link"><?= $lang->dashboardMain['pages_create']?></a>
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
                <?php foreach($pages as $page): ?>
                <tr>

                    <th scope="row">
                        <a href="/admin/pages/edit/<?=$page->id?>" class="page-name"><?= $page->id ?> </a>
                    </th>

                    <td>
                        <a href="/admin/pages/edit/<?=$page->id?>" class="page-name"><?= $page->title ?></a>
                    </td>

                    <td>
                        <?= $page->date ?>
                    </td>
                </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </main>

<?php $this->theme->footer(); ?>