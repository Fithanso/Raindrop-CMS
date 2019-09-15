<?php $this->theme->header(); ?>

	<main>
		<div class="container">
			<div class="row">
				<div class="col page-title">
					<h3><?= $lang->dashboardMain['settings_themes']?></h3>
				</div>
			</div>
			<div class="row">
				<div class="col">
					<div class="setting-tabs">
						<?php Theme::block('setting/tabs') ?>
					</div>
				</div>
			</div>
			<div class="row">
				<?php foreach($themes as $theme):?>
					<div class="col-lg-4">
						<div class="container">
							<div class="image">
								<img src="<?=$theme->screen?>">
							</div>
							<div class="content theme-unit">
								<span class="header"><?=$theme->name?></span>
								<div class="meta">
									<span><?= $lang->dashboardMain['settings_themes_version']?>: <?=$theme->version?></span>
								</div>
								<div class="description">
									<?=$theme->description?>
								</div>
							</div>
							<div class="extra-content">
								<?php if($activeTheme == $theme->dirTheme):?>
									<button class="btn btn-light activate-theme" disabled>
										<?= $lang->dashboardMain['settings_themes_activated']?>
									</button>
								<?php else: ?>
									<button class="btn btn-primary activate-theme" onclick="setting.setActiveTheme(this,'<?=$theme->dirTheme?>')">
										<?= $lang->dashboardMain['settings_themes_activate']?>
									</button>
								<?php endif;?>
							</div>
						</div>
					</div>
				<?php endforeach;?>
			</div>
		</div>
	</main>

	<div class="modal fade" id="addMenu" tabindex="-1" role="dialog" aria-labelledby="addMenuLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="addMenuLabel">New menu</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<form>
						<div class="form-group">
							<label for="menuName" class="form-control-label">Name menu</label>
							<input type="text" class="form-control input-write" id="menuName">
						</div>
					</form>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">
						Close
					</button>
					<button type="button" class="btn btn-primary" onclick="menu.add();">
						Save menu
					</button>
				</div>
			</div>
		</div>
	</div>

<?php $this->theme->footer(); ?>