<?php $this->theme->header(); ?>

<main>
    <div class="container">

        <div class="row">
            <div class="col page-title">
                <h3><?= $lang->dashboardMain['settings_settings']?></h3>
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
            <div class="col">
                <form id="settingForm">
                    <?php foreach($settings as $setting):?>
                        <?php if($setting->key_field == 'language'): ?>
                            <div class="form-group setting-div row">
                                <label for="formLangSite" class="col-2 col-form-label">
	                                <?=$lang->dashboardMain['settings_'.$setting->key_field]?>
                                </label>
                                <div class="col-10">
                                    <select class="form-control select-write" name="<?= $setting->key_field ?>" id="formLangSite">
                                        <?php foreach($languages as $language): ?>
                                            <option value="<?= $language->info->key ?>"<?php if($language->info->key == $setting->value):?> selected <?php endif;?>>
                                                <?= $language->info->title ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
	                            <?php if($setting->description == '1'):?>
                                    <span class="setting-description">
                                        <?=$lang->dashboardMain['settings_'.$setting->key_field.'_desc']?>
                                    </span>
	                            <?php endif;?>
                            </div>

                        <?php elseif($setting->field_type == 'binary_choice'): ?>

                                <div class="form-group setting-div row">
                                    <label for="formNameSite" class="col-2 col-form-label">
	                                    <?=$lang->dashboardMain['settings_'.$setting->key_field]?>
                                    </label>
                                    <div class="col-10">
                                        <select class="form-control select-write" name="<?= $setting->key_field ?>" id="formNameSite">
		                                    <option value="1"<?php if($setting->value == '1'):?> selected<?php endif;?>><?=$lang->dashboardMain['settings_yes']?></option>
                                            <option value="0"<?php if($setting->value == '0'):?> selected<?php endif;?>><?=$lang->dashboardMain['settings_no']?></option>
                                        </select>
                                    </div>
	                                <?php if($setting->description == '1'):?>
                                        <span class="setting-description">
                                            <?=$lang->dashboardMain['settings_'.$setting->key_field.'_desc']?>
                                        </span>
	                                <?php endif;?>
                                </div>


                        <?php else: ?>
                            <div class="form-group setting-div row">
                                <label for="formNameSite" class="col-2 col-form-label">
	                                <?=$lang->dashboardMain['settings_'.$setting->key_field]?>
                                </label>
                                <div class="col-10">
                                    <input class="form-control input-write" type="text" name="<?= $setting->key_field ?>" value="<?= $setting->value ?>" id="formNameSite">
                                </div>
                                <?php if($setting->description == '1'):?>
                                    <span class="setting-description">
                                        <?=$lang->dashboardMain['settings_'.$setting->key_field.'_desc']?>
                                    </span>
                                <?php endif;?>
                            </div>

                        <?php endif; ?>
                    <?php endforeach; ?>
                    <button type="submit" id="setting-submit" class="btn btn-primary btn-save" onclick="setting.update(); return false;">
	                    <?= $lang->dashboardMain['settings_save']?>
                    </button>
                </form>
            </div>
        </div>
    </div>
</main>

<?php $this->theme->footer(); ?>