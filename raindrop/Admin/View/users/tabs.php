<ul class="nav nav-tabs">
	<?php foreach (Customize::getInstance()->getUsersManagementMenuItems() as $key => $item):?>
		<div class="tabs-link nav-link<?php if(\Raindrop\Helper\Common::isLinkActive($key)) echo ' active';?>">
			<a class="" href="<?=$item['urlPath']?>">
				<?=$lang->dashboardMain['users_tabs_'.$key]?>
			</a>
		</div>
	<?php endforeach;?>
</ul>