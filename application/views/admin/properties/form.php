<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<?php echo form_open('', array('role'=>'form')); ?>

    <?php // hidden id
    //var_dump($property);
     ?>
    <?php if (isset($property_id)) : ?>
        <?php echo form_hidden('id', $property_id); ?>
    <?php endif; ?>

    <div class="row">
        <?php // title ?>
        <div class="form-group col-sm-4<?php echo form_error('title') ? ' has-error' : ''; ?>">
            <?php echo form_label(lang('properties input title'), 'title', array('class'=>'control-label')); ?>
            <span class="required">*</span>
            <?php echo form_input(array('name'=>'title', 'value'=>set_value('title', (isset($property['title']) ? $property['title'] : '')), 'class'=>'form-control')); ?>
        </div>
    </div>

    <div class="row">
        <?php // first name ?>
        <div class="form-group col-sm-4<?php echo form_error('address') ? ' has-error' : ''; ?>">
            <?php echo form_label(lang('properties input address'), 'address', array('class'=>'control-label')); ?>
            <span class="required">*</span>
            <?php echo form_input(array('name'=>'address', 'value'=>set_value('address', (isset($property['address']) ? $property['address'] : '')), 'class'=>'form-control')); ?>
        </div>

        <?php // last name ?>
        <div class="form-group col-sm-4<?php echo form_error('price') ? ' has-error' : ''; ?>">
            <?php echo form_label(lang('properties input price'), 'price', array('class'=>'control-label')); ?>
            <span class="required">*</span>
            <?php echo form_input(array('name'=>'price', 'value'=>set_value('price', (isset($property['price']) ? $property['price'] : '')), 'class'=>'form-control')); ?>
        </div>
    </div>

    <div class="row">
        <?php // type ?>
        <div class="form-group col-sm-6<?php echo form_error('type') ? ' has-error' : ''; ?>">
            <?php echo form_label(lang('properties input type'), 'type', array('class'=>'control-label')); ?>
            <span class="required">*</span>
            <?php echo form_dropdown('type', $types, (isset($property['type']) ? $property['type'] : $this->config->item('type')), 'id="type" class="form-control"'); ?>
        </div>
    </div>

    <div class="row">

        <?php // status ?>
        <div class="form-group col-sm-3<?php echo form_error('status') ? ' has-error' : ''; ?>">
            <?php echo form_label(lang('properties input status'), '', array('class'=>'control-label')); ?>
            <span class="required">*</span>
            <div class="radio">
                <label>
                    <?php echo form_radio(array('name'=>'status', 'id'=>'radio-status-1', 'value'=>'1', 'checked'=>(( ! isset($property['status']) OR (isset($property['status']) && (int)$property['status'] == 1) OR $property['id'] == 1) ? 'checked' : FALSE))); ?>
                    <?php echo lang('admin input active'); ?>
                </label>
            </div>
            <?php if ( ! $property['id'] OR $property['id'] > 1) : ?>
                <div class="radio">
                    <label>
                        <?php echo form_radio(array('name'=>'status', 'id'=>'radio-status-2', 'value'=>'0', 'checked'=>((isset($property['status']) && (int)$property['status'] == 0) ? 'checked' : FALSE))); ?>
                        <?php echo lang('admin input inactive'); ?>
                    </label>
                </div>
            <?php endif; ?>
        </div>

        <?php // administrator ?>
        <div class="form-group col-sm-3<?php echo form_error('is_featured') ? ' has-error' : ''; ?>">
            <?php echo form_label(lang('properties input is_featured'), '', array('class'=>'control-label')); ?>
            <span class="required">*</span>
            <?php if ( ! $property['id'] OR $property['id'] > 1) : ?>
                <div class="radio">
                    <label>
                        <?php echo form_radio(array('name'=>'is_featured', 'id'=>'radio-is_admin-1', 'value'=>'0', 'checked'=>(( ! isset($property['is_featured']) OR (isset($property['is_featured']) && (int)$property['is_featured'] == 0) && $property['id'] != 1) ? 'checked' : FALSE))); ?>
                        <?php echo lang('core text no'); ?>
                    </label>
                </div>
            <?php endif; ?>
            <div class="radio">
                <label>
                    <?php echo form_radio(array('name'=>'is_featured', 'id'=>'radio-is_admin-2', 'value'=>'1', 'checked'=>((isset($property['is_featured']) && (int)$property['is_featured'] == 1) ? 'checked' : FALSE))); ?>
                    <?php echo lang('core text yes'); ?>
                </label>
            </div>
        </div>
    </div>
    <div class="row">
        <?php // Township ?>
        <div class="form-group col-sm-6<?php echo form_error('township_id') ? ' has-error' : ''; ?>">
            <?php echo form_label(lang('properties input township_id'), 'township_id', array('class'=>'control-label')); ?>
            <span class="required">*</span>
            <?php echo form_dropdown('township_id', $township, (isset($property['township_id']) ? $property['township_id'] : $this->config->item('township_id')), 'id="type" class="form-control"'); ?>
        </div>
    </div>
    
    <div class="row">
        <?php // Region ?>
        <div class="form-group col-sm-6<?php echo form_error('region_id') ? ' has-error' : ''; ?>">
            <?php echo form_label(lang('properties input region_id'), 'region_id', array('class'=>'control-label')); ?>
            <span class="required">*</span>
            <?php echo form_dropdown('region_id', $region, (isset($property['region_id']) ? $property['region_id'] : $this->config->item('region_id')), 'id="type" class="form-control"'); ?>
        </div>
    </div>
    <div class="row">
        <?php // Area ?>
        <div class="form-group col-sm-6<?php echo form_error('area') ? ' has-error' : ''; ?>">
            <?php echo form_label(lang('properties input area'), 'area', array('class'=>'control-label')); ?>
            <span class="required">*</span>
            <?php echo form_input('area', (isset($property['area']) ? $property['area'] : $this->config->item('area')), 'id="type" class="form-control"'); ?>
        </div>
    </div>
    <div class="row">
        <?php // Bedrooms ?>
        <div class="form-group col-sm-6<?php echo form_error('bedrooms') ? ' has-error' : ''; ?>">
            <?php echo form_label(lang('properties input bedrooms'), 'bedrooms', array('class'=>'control-label')); ?>
            <span class="required">*</span>
            <?php echo form_input('bedrooms', (isset($property['bedrooms']) ? $property['bedrooms'] : $this->config->item('bedrooms')), 'id="type" class="form-control"'); ?>
        </div>
    </div>
    <div class="row">
        <?php // Bathrooms ?>
        <div class="form-group col-sm-6<?php echo form_error('bathrooms') ? ' has-error' : ''; ?>">
            <?php echo form_label(lang('properties input bathrooms'), 'bathrooms', array('class'=>'control-label')); ?>
            <span class="required">*</span>
            <?php echo form_input('bathrooms', (isset($property['bathrooms']) ? $property['bathrooms'] : $this->config->item('bathrooms')), 'id="type" class="form-control"'); ?>
        </div>
    </div>
    <div class="row">
        <?php // description ?>
        <div class="form-group col-sm-4<?php echo form_error('description') ? ' has-error' : ''; ?>">
            <?php echo form_label(lang('properties input description'), 'description', array('class'=>'control-label')); ?>
            <span class="required">*</span>
            <?php echo form_textarea(array('name'=>'description', 'value'=>set_value('description', (isset($property['description']) ? $property['description'] : '')), 'class'=>'form-control')); ?>
        </div>
    </div>

    <?php // buttons ?>
    <div class="row pull-right">
        <a class="btn btn-default" href="<?php echo $cancel_url; ?>"><?php echo lang('core button cancel'); ?></a>
        <button type="submit" name="submit" class="btn btn-success"><span class="glyphicon glyphicon-save"></span> <?php echo lang('core button save'); ?></button>
    </div>

<?php echo form_close(); ?>
