<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<?php echo form_open('', array('role'=>'form')); ?>x

    <?php // hidden id ?>
    <?php if (isset($user_id)) : ?>
        <?php echo form_hidden('id', $user_id); ?>
    <?php endif; ?>

    <div class="row">
        <?php // username ?>
        <div class="form-group col-sm-4<?php echo form_error('username') ? ' has-error' : ''; ?>">
            <?php echo form_label(lang('agents input username'), 'username', array('class'=>'control-label')); ?>
            <span class="required">*</span>
            <?php echo form_input(array('name'=>'username', 'value'=>set_value('username', (isset($user['username']) ? $user['username'] : '')), 'class'=>'form-control')); ?>
        </div>
    </div>

    <div class="row">
        <?php // first name ?>
        <div class="form-group col-sm-4<?php echo form_error('first_name') ? ' has-error' : ''; ?>">
            <?php echo form_label(lang('agents input first_name'), 'first_name', array('class'=>'control-label')); ?>
            <span class="required">*</span>
            <?php echo form_input(array('name'=>'first_name', 'value'=>set_value('first_name', (isset($user['first_name']) ? $user['first_name'] : '')), 'class'=>'form-control')); ?>
        </div>

        <?php // last name ?>
        <div class="form-group col-sm-4<?php echo form_error('last_name') ? ' has-error' : ''; ?>">
            <?php echo form_label(lang('agents input last_name'), 'last_name', array('class'=>'control-label')); ?>
            <span class="required">*</span>
            <?php echo form_input(array('name'=>'last_name', 'value'=>set_value('last_name', (isset($user['last_name']) ? $user['last_name'] : '')), 'class'=>'form-control')); ?>
        </div>
    </div>

    <div class="row">
        <?php // language ?>
        <div class="form-group col-sm-6<?php echo form_error('language') ? ' has-error' : ''; ?>">
            <?php echo form_label(lang('agents input language'), 'language', array('class'=>'control-label')); ?>
            <span class="required">*</span>
            <?php echo form_dropdown('language', $this->languages, (isset($user['language']) ? $user['language'] : $this->config->item('language')), 'id="language" class="form-control"'); ?>
        </div>
    </div>

    <div class="row">
        <?php // email ?>
        <div class="form-group col-sm-6<?php echo form_error('email') ? ' has-error' : ''; ?>">
            <?php echo form_label(lang('agents input email'), 'email', array('class'=>'control-label')); ?>
            <span class="required">*</span>
            <?php echo form_input(array('name'=>'email', 'value'=>set_value('email', (isset($user['email']) ? $user['email'] : '')), 'class'=>'form-control')); ?>
        </div>

        <?php // status ?>
        <div class="form-group col-sm-3<?php echo form_error('status') ? ' has-error' : ''; ?>">
            <?php echo form_label(lang('agents input status'), '', array('class'=>'control-label')); ?>
            <span class="required">*</span>
            <div class="radio">
                <label>
                    <?php echo form_radio(array('name'=>'status', 'id'=>'radio-status-1', 'value'=>'1', 'checked'=>(( ! isset($user['status']) OR (isset($user['status']) && (int)$user['status'] == 1) OR $user['id'] == 1) ? 'checked' : FALSE))); ?>
                    <?php echo lang('admin input active'); ?>
                </label>
            </div>
            <?php if ( ! $user['id'] OR $user['id'] > 1) : ?>
                <div class="radio">
                    <label>
                        <?php echo form_radio(array('name'=>'status', 'id'=>'radio-status-2', 'value'=>'0', 'checked'=>((isset($user['status']) && (int)$user['status'] == 0) ? 'checked' : FALSE))); ?>
                        <?php echo lang('admin input inactive'); ?>
                    </label>
                </div>
            <?php endif; ?>
        </div>

        <?php // administrator ?>
        
    </div>

    <div class="row">
        <?php // password ?>
        <div class="form-group col-sm-4<?php echo form_error('password') ? ' has-error' : ''; ?>">
            <?php echo form_label(lang('agents input password'), 'password', array('class'=>'control-label')); ?>
            <?php if ($password_required) : ?><span class="required">*</span><?php endif; ?>
            <?php echo form_password(array('name'=>'password', 'value'=>'', 'class'=>'form-control', 'autocomplete'=>'off')); ?>
        </div>

        <?php // password repeat ?>
        <div class="form-group col-sm-4<?php echo form_error('password_repeat') ? ' has-error' : ''; ?>">
            <?php echo form_label(lang('agents input password_repeat'), 'password_repeat', array('class'=>'control-label')); ?>
            <?php if ($password_required) : ?><span class="required">*</span><?php endif; ?>
            <?php echo form_password(array('name'=>'password_repeat', 'value'=>'', 'class'=>'form-control', 'autocomplete'=>'off')); ?>
        </div>
        <?php if ( ! $password_required) : ?>
            <span class="help-block"><br /><?php echo lang('users help passwords'); ?></span>
        <?php endif; ?>
    </div>

    <div class="row">
        <?php // company ?>
        <div class="form-group col-sm-6<?php echo form_error('company') ? ' has-error' : ''; ?>">
            <?php echo form_label(lang('agents input company'), 'company', array('class'=>'control-label')); ?>
            <span class="required">*</span>
            <?php echo form_input(array('name'=>'company', 'value'=>set_value('company', (isset($user['company']) ? $user['company'] : '')), 'class'=>'form-control')); ?>
        </div>
    </div>

    <div class="row">
        <?php // company_address ?>
        <div class="form-group col-sm-6<?php echo form_error('company_address') ? ' has-error' : ''; ?>">
            <?php echo form_label(lang('agents input company_address'), 'company_address', array('class'=>'control-label')); ?>
            <span class="required">*</span>
            <?php echo form_textarea(array('name'=>'company_address', 'value'=>set_value('company_address', (isset($user['company_address']) ? $user['company_address'] : '')), 'class'=>'form-control')); ?>
        </div>

        <div class="form-group col-sm-6<?php echo form_error('description') ? ' has-error' : ''; ?>">
            <?php echo form_label(lang('agents input description'), 'description', array('class'=>'control-label')); ?>
            <span class="required">*</span>
            <?php echo form_textarea(array('name'=>'description', 'value'=>set_value('description', (isset($user['description']) ? $user['description'] : '')), 'class'=>'form-control')); ?>
        </div>
    </div>

    <div class="row">
        <?php // profile_photo ?>
        <div class="form-group col-sm-6<?php echo form_error('profile_photo') ? ' has-error' : ''; ?>">
            <?php echo form_label(lang('agents input profile_photo'), 'profile_photo', array('class'=>'control-label')); ?>
            <?php echo form_upload(array('name'=>'profile_photo', 'value'=>set_value('profile_photo', (isset($user['profile_photo']) ? $user['profile_photo'] : '')), 'class'=>'form-control')); ?>
        </div>

        <?php // contact_phone ?>
        <div class="form-group col-sm-6<?php echo form_error('contact_phone') ? ' has-error' : ''; ?>">
            <?php echo form_label(lang('agents input contact_phone'), 'contact_phone', array('class'=>'control-label')); ?>
            <span class="required">*</span>
            <?php echo form_input(array('name'=>'contact_phone', 'value'=>set_value('contact_phone', (isset($user['contact_phone']) ? $user['contact_phone'] : '')), 'class'=>'form-control')); ?>
        </div>
    </div>

    <div class="row">
        <?php // contact_email ?>
        <div class="form-group col-sm-6<?php echo form_error('contact_email') ? ' has-error' : ''; ?>">
            <?php echo form_label(lang('agents input contact_email'), 'contact_email', array('class'=>'control-label')); ?>
            <span class="required">*</span>
            <?php echo form_input(array('name'=>'contact_email', 'value'=>set_value('contact_email', (isset($user['contact_email']) ? $user['contact_email'] : '')), 'class'=>'form-control')); ?>
        </div>
    </div>

    <?php // buttons ?>
    <div class="row pull-right">
        <a class="btn btn-default" href="<?php echo $cancel_url; ?>"><?php echo lang('core button cancel'); ?></a>
        <button type="submit" name="submit" class="btn btn-success"><span class="glyphicon glyphicon-save"></span> <?php echo lang('core button save'); ?></button>
    </div>

<?php echo form_close(); ?>
