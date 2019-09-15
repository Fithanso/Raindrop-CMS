<?php $this->theme->header(); ?>

	<main>
		<div class="container">
			<div class="row">
				<div class="col page-title">
					<h3><?=$post->title?></h3>
				</div>
			</div>
			<div class="row">
				<div class="col-9">
					<form id="formPage">
						<input type="hidden" name="post_id" id="formPostId" value="<?=$post->id?>">
						<div class="form-group">
							<label for="formTitle"><?= $lang->dashboardMain['posts_edit_title']?></label>
							<input type="text" name="title" class="form-control input-write" id="formTitle" placeholder="Title post..." value="<?=$post->title?>">
						</div>
						<div class="form-group">
							<label for="formContent"><?= $lang->dashboardMain['posts_edit_content']?></label>
							<textarea name="content" id="redactor" class="form-control" id="formContent"><?=$post->content?></textarea>
						</div>
					</form>
				</div>
				<div class="col-3">
					<div>
						<br>
						<button type="submit" class="btn btn-primary upd-btn" onclick="post.update()">
							<?= $lang->dashboardMain['posts_edit_update']?>
						</button>
					</div>
				</div>
			</div>
		</div>
	</main>

<?php $this->theme->footer(); ?>