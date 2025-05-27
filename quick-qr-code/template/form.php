<?php

global $wp;
$settings = get_option('qqrc_settings');

// echo"<pre>";
// echo print_r($settings);
// echo"</pre>";


?>
<div class="qqrc-form">
    <h2>Qucik QR Code Settings</h2>
    <form method="post" id="qqrc-settings-form">
        
        <label for="size">QR Code Size</label>
        <input type="number" placeholder="Size" id="qrc-size" name="size" value = "<?php echo $settings['size'] ?? '';?>">

        <label for="size">QR Code Background Color</label>
        <input type="color" placeholder="bgcolor" id="qrc-bgcolor" name="bgcolor" value = "#<?php echo $settings['bgcolor'] ?? '';?>">

        <label for="size">QR Code Color</label>
        <input type="color" placeholder="color" id="qrc-color" name="color" value = "#<?php echo $settings['color'] ?? '';?>">

        <label for="size">QR Code Position</label>
        <?php $selected = $settings['position'] ?? 'top_left'; ?>
        <select name="position" id="position">
            <option value="top_left" <?php selected($selected, 'top_left'); ?>>Top-Left</option>
            <option value="top_right" <?php selected($selected, 'top_right'); ?>>Top-Right</option>
            <option value="bottom_left" <?php selected($selected, 'bottom_left'); ?>>Bottom-Left</option>
            <option value="bottom_right" <?php selected($selected, 'bottom_right'); ?>>Bottom-Right</option>
        </select>

        <input type="hidden" name="action" value="qqrc_ajax_save_settings">
        <input type="hidden" name="nonce" value="<?php echo wp_create_nonce('qqrc_ajax_nonce'); ?>">
        
        <input type="submit" value="submit">
        <div id="qqrc-message"></div> <!-- for showing ajax messages -->
    </form>
</div>