<?php 
$data = $_POST;
$args = array(
    'p'         => $data['id'],
    'post_type' => 'any'
);
$p = new WP_Query($args);
if ($p->post_count == 1) {
    $box_id = $data['id'];
    $box_type = get_post_type($box_id);
    $box_title = get_the_title($box_id);
    $box_html = $data['value'];
    $branch_type = $box_type.'-branch';
    $new_post_arr = array(
        'post_title'    => 'Branch of '.$box_title,
        'post_status'   => 'publish',
        'post_parent'   => $box_id,
        'post_type'     => $branch_type
    );  
    $new_post = wp_insert_post($new_post_arr);
    update_field('html',$box_html,$new_post);
    update_field('parent',$box_id,$new_post);
    wp_update_post(array(
        'ID'            => $new_post,
        'post_name'     => $box_id.'-'.$new_post,
        'post_title'    => 'Branch '.$new_post.' of '.$box_title,
    ));
    
    $branch_url = get_permalink($new_post);
    $feedback = array(
        'success' => 1,
        'url' => $branch_url,
        'html' => $box_html
    );
    echo json_encode($feedback);
}else{
    echo '404';
}
