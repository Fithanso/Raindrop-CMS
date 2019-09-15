<?php $this->theme->header(); ?>

	<main>
		<div class="container">
			<div class="row">
				<div class="col page-title">
					<h3><?= $lang->dashboardMain['plugins_plugins']?></h3>
				</div>
			</div>

			<div class="row">
				<table class="table">
					<thead>
						<tr>
							<th></th>
							<th><?= $lang->dashboardMain['plugins_plugin']?></th>
							<th><?= $lang->dashboardMain['plugins_description']?></th>
						</tr>
					</thead>
					<tbody>
					<?php foreach($plugins as $directory => $plugin):?>

						<tr>
							<td>
								<div class="checkbox">
	                          <?php if($plugin['is_install']): ?>
                                    <input type="checkbox" data-active="<?php echo $plugin['is_active'] ?>" onchange="plugin.activate(this, <?php echo $plugin['plugin_id'] ?>)"<?php if ($plugin['is_active']) echo ' checked'; ?>>								</div>
                                    <label></label>
                              <?php endif;?>
                            </td>
							<td>
								<?=$plugin['name']?><br>
								<?php if($plugin['is_install']): ?>
									<span class="disabled" style="color: #909090">
										<?= $lang->dashboardMain['plugins_installed']?>
									</span>
                                    <a href="javascript:void(0)" onclick="plugin.uninstall(this, '<?php echo $directory ?>')">
	                                    <?= $lang->dashboardMain['plugins_uninstall']?>
                                    </a>
								<?php else: ?>

                                    <a href="javascript:void(0)" onclick="plugin.install(this, '<?php echo $directory ?>')">
	                                    <?= $lang->dashboardMain['plugins_description']?>
									</a>
								<?php endif;?>
							</td>
							<td>
								<?=$plugin['description']?>
							</td>
						</tr>
					<?php endforeach;?>
					</tbody>
					<!--<tfoot>
					<tr>
						<th></th>
						<th colspan="4">
							<div>
								<a href="#"><i class="upload icon"></i><?= $lang->dashboardMain['plugins_add']?></a>
							</div>
						</th>
					</tr>
					</tfoot>-->
				</table>
			</div>
		</div>
	</main>



<?php $this->theme->footer(); ?>