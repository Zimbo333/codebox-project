<?php 
if (is_user_logged_in()) {
    $data = $_POST;
    $box_id = $data['id'];
    $box_title = $data['title'];
    $box_html = $data['value'];
    $new_post_arr = array(
        'post_title'    => 'Copy of '.$box_title,
        'post_status'   => 'publish',
        'post_type'     => 'code'
    );  
    $new_post = wp_insert_post($new_post_arr);
    update_field('html',$box_html,$new_post);
    wp_update_post(array(
        'ID'            => $new_post,
        'post_name'     => $new_post
    ));
    $url = get_permalink($new_post);
    $feedback = array(
        'success' => 1,
        'url' => $url
    );
    echo json_encode($feedback);
}else{
    echo 'login only';
}
