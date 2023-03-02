<?php $form = \app\core\form\Form::begin('/create-blog', 'post'); ?>
<?php echo $form->field($model, 'title'); ?>
<?php echo $form->field($model, 'description'); ?>
<?php echo $form->field($model, 'image'); ?>
<button type="submit" class="btn btn-primary">Submit</button>
<?php \app\core\form\Form::end(); ?>
