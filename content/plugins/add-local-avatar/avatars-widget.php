<?php
/*
    Name:    Avatars Widget
    URI:            http://www.sterling-adventures.co.uk/blog/2008/03/01/avatars-plugin/
    Description:    A widget interface for the Avatars plugin.
    Author:            Peter Sterling
    Version:        2.0
    Changes:        1.0 - Initial release.
                    2.0 - Update for Marc Adrian to provide option for showing text.
*/
define('PROFILE_SIZE', 50);

function avatars_logged_in_user_widget_init()
{
    // Check widgets are activated.
    if(!function_exists('register_sidebar_widget')) return;

    function logged_in_user_widget($args)
    {
        if(class_exists('add_local_avatars')) {
            global $add_local_avatars;
            $avatar_options = $add_local_avatars->avatar_options;
        }
        else global $avatar_options;

        global $current_user;

        if(!$current_user->ID) return;

        if(wp_verify_nonce($_POST['avatar_widget_noncename'], plugin_basename(__FILE__))) {
            if(!function_exists('wp_load_image')) include_once(ABSPATH . '/wp-admin/includes/image.php');
            if(class_exists('add_local_avatars')) $add_local_avatars->avatar_upload($current_user->ID);
            else avatar_upload($current_user->ID);
            $current_user = get_userdata($current_user->ID);
        }

        extract($args, EXTR_SKIP);
        $options = get_option('logged_in_user');
        $title = empty($options['title']) ? $current_user->display_name . "’" . (substr($name, -1) == 's' ? " " : "s ") . __('Profile', 'avatars') : apply_filters('widget_title', $options['title']);
        echo $before_widget;
            echo $before_title, $title, $after_title;
            echo __('<h2 id="avatar_widget_heading">Avatar</h2>', 'avatars');

            if($current_user->avatar_error) { ?>
                <div id='message' class='error fade'><b><?php echo __('Upload error:', 'avatars'); ?></b> <?php echo $current_user->avatar_error; ?></div>
            <?php }
            delete_usermeta($current_user->ID, "avatar_error");

            ?><form enctype="multipart/form-data" action="<?php echo $PHP_SELF; ?>" method="post" ><?php
                if(class_exists('add_local_avatars')) $add_local_avatars->avatar_uploader_table($current_user, (empty($options['size']) ? PROFILE_SIZE : $options['size']), true, $options['show_text'] == 'on');
                else avatar_uploader_table($current_user, (empty($options['size']) ? PROFILE_SIZE : $options['size']), true, $options['show_text'] == 'on'); ?>
                <input type="hidden" name="avatar_widget_noncename" id="avatar_widget_noncename" value="<?php echo wp_create_nonce(plugin_basename(__FILE__)); ?>" />
                <?php if($avatar_options['upload_allowed'] == 'on') { ?>
                    <input type="submit" value="Update Avatar" />
                <?php } ?>
            </form><?php

            if($options['show_bio'] == 'on') echo '<p class="avatar_widget_bio">', $current_user->description, '</p>';
        echo $after_widget;
    }


    function logged_in_user_widget_control()
    {
        if(class_exists('add_local_avatars')) {
            global $add_local_avatars;
            $avatar_options = $add_local_avatars->avatar_options;
        }
        else global $avatar_options;

        $options = $newoptions = get_option('logged_in_user');
        if(isset($_POST["logged_in_user-submit"])) {
            $newoptions['title'] = strip_tags(stripslashes($_POST["logged_in_user-title"]));
            $newoptions['size'] = strip_tags(stripslashes($_POST["logged_in_user-size"]));
            $newoptions['show_text'] = strip_tags(stripslashes($_POST["show_text"]));
            $newoptions['show_bio'] = strip_tags(stripslashes($_POST["show_bio"]));
        }
        if($options != $newoptions) {
            $options = $newoptions;
            update_option('logged_in_user', $options);
        }
        $title = attribute_escape($options['title']);
        $size = attribute_escape($options['size']);
        ?>
        <p><label for="logged_in_user-title">Title: <input class="widefat" id="logged_in_user-title" name="logged_in_user-title" type="text" value="<?php echo $title; ?>" /></label></p>
        <?php
            if($avatar_options['upload_allowed'] == 'on') { ?>
                <p><label for="logged_in_user-size">Size: <input style="width: 40px; text-align: center;" id="logged_in_user-size" name="logged_in_user-size" type="text" value="<?php echo empty($size) ? PROFILE_SIZE : $size; ?>" /> px</label></p>
            <?php }
        ?>
        <p><label for="show_text">Show widget text: </label> <input type="checkbox" name="show_text" <?php echo $options['show_text'] == 'on' ? 'checked' : ''; ?> /></p>
        <p><label for="show_bio">Show user biography: </label> <input type="checkbox" name="show_bio" <?php echo $options['show_bio'] == 'on' ? 'checked' : ''; ?> /></p>
        <input type="hidden" id="logged_in_user-submit" name="logged_in_user-submit" value="1" />
    <?php }


    // Register widget and it's control.
    wp_register_sidebar_widget('logged_in_user', 'Logged-in User', logged_in_user_widget, array('classname' => 'logged_in_user', 'description' => 'Widget for logged in user profile changes.'));
    wp_register_widget_control('logged_in_user', 'Logged-in User', 'logged_in_user_widget_control', array('width' => 300));
}
?>