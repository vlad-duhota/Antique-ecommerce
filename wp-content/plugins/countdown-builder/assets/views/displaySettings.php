<?php
use ycd\DisplayConditionBuilder;
use ycd\AdminHelper;

$defaultData = AdminHelper::defaultData();
$savedData = $this->getOptionValue('ycd-display-settings');
$obj = new DisplayConditionBuilder();
$obj->setSavedData($savedData);
$allowed_html = AdminHelper::getAllowedTags();
?>
<div class="ystp-bootstrap-wrapper">
    <div class="row form-group">
        <div class="col-md-5">
            <label for="ycd-countdown-text-size" class="ycd-label-of-select"><?php _e('Position Of Countdown', YCD_TEXT_DOMAIN); ?></label>
        </div>
        <div class="col-md-7">
            <?php
            $postionCountdown = AdminHelper::selectBox($defaultData['position-countdown'], esc_attr($this->getOptionValue('ycd-position-countdown')), array('name' => 'ycd-position-countdown', 'class' => 'js-ycd-select'));
            echo wp_kses($postionCountdown, $allowed_html);
            ?>
        </div>
    </div>
    <?php echo wp_kses($obj->render(), $allowed_html); ?>
</div>