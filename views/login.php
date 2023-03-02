<div class="row">
    <?php $form = \app\core\form\Form::begin('/login', 'post'); ?>
    <?php echo $form->field($model, 'email')->emailField(); ?>
    <?php echo $form->field($model, 'password')->passwordField(); ?>
    <button type="submit" class="btn btn-primary btn-block mt-4">Submit</button>
    <?php \app\core\form\Form::end(); ?>
</div>
