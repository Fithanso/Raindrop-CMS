<?php $this->theme->header(); ?>

    <main>
        <div class="container">
            <div class="row">
                <div class="col page-title">
                    <h3><?= $lang->dashboardMain['settings_menus_menus']?></h3>
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
                <div class="col-4">
                    <h4 class="heading-setting-section">
                        <a href="javascript:void(0)" class="btn btn-primary btn-publish" data-toggle="modal" data-target="#addMenu" data-whatever="@getbootstrap">
	                        <?= $lang->dashboardMain['settings_menus_add']?>
                        </a>
                    </h4>
                    <?php if(!empty($menus)): ?>
                        <div class="list-group">
                                <?php foreach($menus as $menu): ?>
                                    <a class="list-group-item list-menus-items list-group-item-action<?php if (isset($menuId) && $menuId == $menu->id) echo ' active'; ?>" href="?menu_id=<?php echo $menu->id ?>">
                                            <?php echo $menu->name ?>
                                    </a>
                                <?php endforeach; ?>
                        </div>
                    <?php else: ?>
                        <div class="empty-items">
                            <p><?= $lang->dashboardMain['settings_menus_no_menus']?></p>
                        </div>
                    <?php endif; ?>
                </div>
                <div class="col-8">
                    <?php if (isset($menuId)): ?>

                        <h4 class="heading-setting-section">
	                        <?= $lang->dashboardMain['settings_menus_edit']?>
                        </h4>
                        <p>
                            ID : <?php print_r($menuId);?>
                        </p>

                        <br>
                        <input type="hidden" id="sortMenuId" value="<?php echo $menuId ?>" />
                        <ol id="listItems" class="edit-menu">
                            <?php foreach($editMenu as $item) {
                                Theme::block('setting/menu_item', [
                                    'item' => $item
                                ]);
                            } ?>
                        </ol>
                        <button class="add-item-button" onclick="menu.addItem(<?php echo $menuId ?>)">
                            <i class="icon-plus icons"></i> <?= $lang->dashboardMain['settings_menus_add_item']?>
                        </button>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </main>

    <div class="modal fade" id="addMenu" tabindex="-1" role="dialog" aria-labelledby="addMenuLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addMenuLabel"><?= $lang->dashboardMain['settings_menus_modal_new']?></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="form-group">
                            <label for="menuName" class="form-control-label"><?= $lang->dashboardMain['settings_menus_modal_name']?></label>
                            <input type="text" class="form-control input-write" id="menuName">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">
	                    <?= $lang->dashboardMain['settings_menus_modal_close']?>
                    </button>
                    <button type="button" class="btn btn-primary" onclick="menu.add();">
	                    <?= $lang->dashboardMain['settings_menus_modal_save']?>
                    </button>
                </div>
            </div>
        </div>
    </div>

<?php $this->theme->footer(); ?>