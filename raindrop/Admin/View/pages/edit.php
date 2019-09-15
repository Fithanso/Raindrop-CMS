<?php Theme::header();?>

	<main>
		<div class="container">
			<div class="row">
				<div class="col page-title">
					<h3><?=$page->title?></h3>
                    <div class="sub header grey">
						<?php echo $baseUrl . '/page/' . \Raindrop\Helper\Text::transliteration($page->title) ?>
                    </div>
                    <div class="goto-page">
                        <a href="<?= $baseUrl . '/page/' . \Raindrop\Helper\Text::transliteration($page->title) ?>" class="gradient-text" target="_blank"><?= $lang->dashboardMain['pages_edit_gotopage']?></a>
                    </div>
                </div>
			</div>
			<div class="row">
				<div class="col-9">
					<form id="formPage">
						<input type="hidden" name="page_id" id="formPageId" value="<?=$page->id?>">
						<div class="form-group">
							<label for="formTitle"><?= $lang->dashboardMain['pages_edit_title']?></label>
							<input type="text" name="title" class="form-control input-write" id="formTitle" placeholder="Title page..." value="<?=$page->title?>">
						</div>
						<div class="form-group">
							<label for="formContent"><?= $lang->dashboardMain['pages_edit_content']?></label>
							<textarea name="content" id="redactor" class="form-control" id="formContent"><?=$page->content?></textarea>
						</div>

                        <button class="btn btn-danger btn-delete" onclick="page.delete(this)"><?= $lang->dashboardMain['pages_delete']?></button>
					</form>
				</div>
				<div class="col-3">
					<div>
						<!--<p>Update this page</p>
						<button type="submit" class="btn btn-primary" onclick="page.update()">
							Update
						</button>-->
                        <div class="container page-upd-btn">
                            <button type="submit" class="btn btn-primary upd-btn" onclick="page.update(this)">
	                            <?= $lang->dashboardMain['pages_edit_update']?>
                            </button>
                        </div>
                        <div class="container page-status-container">
                            <div>
                                <form>
                                <div class="form-group">
                                    <label><?= $lang->dashboardMain['pages_edit_status']?></label>
                                    <select id="status" class="form-control select-write">
                                        <option value="publish"<?php if ('publish' == $page->status) echo ' selected'; ?>><?= $lang->dashboardMain['pages_edit_status_publish']?></option>
                                        <option value="draft"<?php if ('draft' == $page->status) echo ' selected'; ?>><?= $lang->dashboardMain['pages_edit_status_draft']?></option>
                                    </select>
                                </div>
                                </form>
                            </div>
                        </div>

                        <br>
                        <div class="container page-settings-container">
                            <div class="ui blue segment">
                                <h4><?= $lang->dashboardMain['pages_edit_settings']?></h4>
                            </div>
                            <div>
                                <div class="field">
                                    <label><?= $lang->dashboardMain['pages_edit_template']?></label>
                                    <form>
                                    <select id="type" class="form-control select-write">
                                        <option value="page"><?= $lang->dashboardMain['pages_edit_template_basic']?></option>
										<?php foreach (getTypes('page') as $key => $type): ?>
                                            <option value="<?php echo $key ?>"<?php if ($key == $page->type) echo ' selected'; ?>>
												<?php echo $type ?>
                                            </option>
										<?php endforeach; ?>
                                    </select>
                                    </form>
                                </div>
                            </div>
                        </div>
					</div>
				</div>
			</div>
		</div>
	</main>

<?php Theme::footer();?>