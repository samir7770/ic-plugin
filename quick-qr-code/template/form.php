<?php

global $wp;
$settings = get_option('qqrc_settings');
// echo"<pre>";
// echo print_r($settings);
// echo"</pre>";


?>
<div class="qqrc-form">
    <form method="post" action="<?php echo admin_url('admin-post.php');?>">
        <input type="number" placeholder="Size" id="qrc-size" name="size" value = "<?php echo $settings['size'] ?? '';?>">
        <input type="color" placeholder="bgcolor" id="qrc-bgcolor" name="bgcolor" value = "<?php echo $settings['bgcolor'] ?? '';?>">
        <input type="color" placeholder="color" id="qrc-color" name="color" value = "<?php echo $settings['color'] ?? '';?>">
        <select name="position" id="position" value = "<?php echo $settings['position'] ?? '';?>">
            <option value="top_left">Top-Left</option>
            <option value="top_right">Top-Right</option>
            <option value="bottom_right">Bottom-Left</option>
            <option value="bottom_right">Bottom-Right</option>
        </select>
        <input type="hidden" name="action" value="qqrc_settings">
        <input type="submit" value="submit">
    </form>
</div>