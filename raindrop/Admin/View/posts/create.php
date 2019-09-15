<?php $this->theme->header(); ?>

    <main>
        <div class="container">
            <div class="row">
                <div class="col page-title">
                    <h3><?= $lang->dashboardMain['posts_create']?></h3>
                </div>
            </div>
            <div class="row">
                <div class="col-9">
                    <form id="formPage">
                        <div class="form-group">
                            <label for="formTitle"><?= $lang->dashboardMain['posts_create_title']?></label>
                            <input type="text" name="title" class="form-control input-write" id="formTitle" placeholder="">
                        </div>
                        <div class="form-group">
                            <label for="formContent"><?= $lang->dashboardMain['posts_create_content']?></label>
                            <textarea name="content" id="redactor" class="form-control" id="formContent"></textarea>
                        </div>
                    </form>
                </div>
                <div class="col-3">
                    <div>
                        <br>
                        <button type="submit" class="btn btn-primary btn-publish" onclick="post.add()">
	                        <?= $lang->dashboardMain['posts_create_publish']?>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </main>

<?php $this->theme->footer(); ?>