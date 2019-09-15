<?php $this->theme->header(); ?>

	<main>
		<div class="container">
			<div class="row">
				<div class="col page-title">
					<h3><?= $lang->dashboardMain['users_banned']?></h3>
				</div>
			</div>

			<div class="row">
				<div class="col">
					<div class="setting-tabs">
						<?php Theme::block('users/tabs') ?>
					</div>
				</div>
			</div>


			<table class="table users-table">
				<thead>
				<tr>
					<th>ID</th>
                    <th>Login</th>
					<th>Email</th>
					<th>Last visit</th>
					<th>Role</th>
					<th>Hash</th>
				</tr>
				</thead>
				<tbody>
				<?php foreach($users as $user): ?>
					<tr>

						<th scope="row">
							<?= $user->id ?>
						</th>

                        <th scope="row">
                            <a href="/admin/user/<?=$user->id ?>" class="gradient-text"><?= $user->login ?></a>
                        </th>

						<td>
                            <?= $user->email ?>
						</td>

						<td>
							<?= $user->last_visit ?>
						</td>


						<td>
							<?= $user->role ?>
						</td>

						<td>
							<?= $user->hash ?>
						</td>

					</tr>
				<?php endforeach; ?>
				</tbody>
			</table>
		</div>
	</main>

<?php $this->theme->footer(); ?>