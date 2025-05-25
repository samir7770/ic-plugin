<?php

global $wp;
$settings = get_option('admin_menu_settings');
// echo"<pre>";
// echo print_r($settings);
// echo"</pre>";


?>
<div class="admin-form">
    <form method="post" action="<?php echo admin_url('admin-post.php');?>">
        <input type="text" placeholder="Full Name" id="name" name="name" value = "<?php echo $settings['name'] ?? '';?>">
        <input type="email" placeholder="Your Email" id="email" name="email" value = "<?php echo $settings['email'] ?? '';?>">
        <input type="text" placeholder="Your Age" id="age" name="age" value = "<?php echo $settings['age'] ?? '';?>">
        <input type="hidden" name="action" value="admin_menu_settings">
        <input type="submit" value="submit">
    </form>
</div>