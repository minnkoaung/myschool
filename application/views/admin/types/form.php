<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<?php echo form_open('', array('role'=>'form')); ?>

    <?php // hidden id ?>
    <?php if (isset($user_id)) : ?>
        <?php echo form_hidden('id', $user_id); ?>
    <?php endif; ?>

    <div class="row">
        <?php // name ?>
        <div class="form-group col-sm-4<?php echo form_error('name') ? ' has-error' : ''; ?>">
            <?php echo form_label(lang('types input name'), 'name', array('class'=>'control-label')); ?>
            <span class="required">*</span>
            <?php echo form_input(array('name'=>'name', 'value'=>set_value('name', (isset($user['name']) ? $user['name'] : '')), 'class'=>'form-control')); ?>
        </div>
    </div>

    <div class="row">
        <?php // parent_id?>
        <div class="form-group col-sm-4<?php echo form_error('parent_id') ? ' has-error' : ''; ?>">
            <?php echo form_label(lang('types input parent_id'), 'parent_id', array('class'=>'control-label')); ?>
            <span class="required">*</span>
            <?php echo form_input(array('name'=>'parent_id', 'value'=>set_value('parent_id', (isset($user['parent_id']) ? $user['parent_id'] : '')), 'class'=>'form-control')); ?>
        </div>

    </div>

    <div class="row">
        <?php // updated_at ?>
        <div class="form-group col-sm-6<?php echo form_error('updated_by') ? ' has-error' : ''; ?>">
            <?php echo form_label(lang('types input updated_by'), 'updated_by', array('class'=>'control-label')); ?>
            <span class="required">*</span>
            <?php echo form_input(array('name'=>'updated_by', 'value'=>set_value('updated_by', (isset($user['updated_by']) ? $user['updated_by'] : '')), 'class'=>'form-control')); ?>
        </div>

    </div>

    
    <?php // buttons ?>
    <div class="row pull-right">
        <a class="btn btn-default" href="<?php echo $cancel_url; ?>"><?php echo lang('core button cancel'); ?></a>
        <button type="submit" name="submit" class="btn btn-success"><span class="glyphicon glyphicon-save"></span> <?php echo lang('core button save'); ?></button>
    </div>

<?php echo form_close(); ?>
