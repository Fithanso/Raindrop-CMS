<ul class="nav nav-tabs">
    <?php foreach (Customize::getInstance()->getSettingsMenuItems() as $key => $item):?>
        <div class="tabs-link nav-link<?php if(\Raindrop\Helper\Common::isLinkActive($key)) echo ' active';?>">
            <a class="" href="<?=$item['urlPath']?>">
	            <?=$lang->dashboardMain['settings_tabs_'.$key]?>
            </a>
        </div>
    <?php endforeach;?>
</ul>