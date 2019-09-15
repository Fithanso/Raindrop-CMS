<?php $this->theme->header(); ?>

	<main>
		<div class="container">
			<div class="col-lg-4">
				<div class="page-title">
					<h3><?= $lang->dashboardMain['user_edit']?></h3>
				</div>
			</div>
            <div class="row">
			<div class="col-lg-6">
				<form class="form-group" id="userForm">

                    <?php foreach($changeable_properties as $key => $property):?>

                        <?php if(is_array($property)):?>

                            <?php if($property[1] == 'select'):?>

                                <label class="user-edit-input-label" for="<?=$property[0]?>"><?= $lang->dashboardMain['user_edit_input_'.$property[0]]?></label>
                                <select class="form-control select-write" name="<?=$property[0]?>" id="<?=$property[0]?>">

                                    <?php foreach($property[2] as $select_key => $value):?>
                                        <option value="<?=$property[2][$select_key]?>" <?php if($user[$property[0]] == $property[2][$select_key]):?> selected <?php endif;?>><?=$property[2][$select_key]?></option>
                                    <?php endforeach;?>

                                </select>

                            <?php elseif ($property[1] == 'bool_select'):?>

                                <label class="user-edit-input-label" for="<?=$property[0]?>"><?= $lang->dashboardMain['user_edit_input_'.$property[0]]?></label>
                                <select class="form-control select-write" name="<?=$property[0]?>" id="<?=$property[0]?>">
                                    <option value="1" <?php if($user[$property[0]] == '1'):?> selected <?php endif;?>><?= $lang->dashboardMain['settings_yes']?></option>
                                    <option value="0" <?php if($user[$property[0]] == '0'):?> selected <?php endif;?>><?= $lang->dashboardMain['settings_no']?></option>
                                </select>

                            <?php endif;?>

                        <?php else:?>

                            <label class=" user-edit-input-label" for="<?=$property?>"><?= $lang->dashboardMain['user_edit_input_'.$property]?></label>
                            <input class="form-control input-write" type="text" id="<?=$property?>" name="<?=$property?>" value="<?=$user[$property]?>">

                        <?php endif;?>

                    <?php endforeach;?>


					<?php foreach($unchangeable_properties as $key => $val):?>
						<label class=" user-edit-input-label" for="<?=$val?>"><?= $lang->dashboardMain['user_edit_input_'.$val]?></label>
						<input class="form-control input-block" type="text" id="<?=$val?>" name="<?=$val?>" value="<?=$user[$val]?>" readonly="readonly">
					<?php endforeach;?>
				</form>
			</div>

                <div class="col-lg-2"></div>
                <button type="submit" class="btn btn-primary upd-btn" onclick="user.update(this)">
		            <?= $lang->dashboardMain['pages_edit_update']?>
                </button>

            </div>
            <div class="row">
                <div class="col-lg-2">
                    <button class="btn btn-primary btn-delete" onclick="user.ban()">Ban</button>
                </div>

            </div>
		</div>
	</main>

<?php $this->theme->footer(); ?>