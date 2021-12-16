<?php
// Exit if accessed directly.
defined('ABSPATH') || exit;

extract($args);
$value = get_option($name, '');
$classes = array('regular-text');
switch($type) {
  case 'url':
    $classes[] = 'code';
    break;
  case 'email':
    $classes[] = 'ltr';
    break;
}
?>

<fieldset>
  <label for="<?= esc_attr($name); ?>" class="screen-reader-text"><?= esc_html($label) ?></label>
  <input type="<?= esc_attr($type); ?>" class="<?= esc_attr( implode(' ', $classes) ); ?>" name="<?= esc_attr($name); ?>" id="<?= esc_attr($name); ?>" value="<?= esc_attr($value); ?>"<?php if( !empty($description) ){echo ' aria-describedby="'. $name .'-description"';} ?> />
  <?php if( !empty($description) ): ?>
    <p class="description" id="<?= esc_attr("{$name}-description"); ?>"><?= wp_kses_post($description); ?></p>
  <?php endif; ?>
</fieldset>
