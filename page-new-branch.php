<?php 
$data = $_POST;
$args = array(
    'p'         => $data['id'],
    'post_type' => 'any'
);
$p = new WP_Query($args);
if ($p->post_count == 1 AND is_user_logged_in()) {
    $box_id = $data['id'];
    $uid = get_current_user_id();
    $my_branch = get_user_branch($box_id,$uid);

    if (sizeof($my_branch) == 0) {
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
        if ($box_type == 'lesson' OR $box_type == 'exercise') {
            $course = get_field('in_course',$box_id);
            update_field('in_course',$course,$new_post);
        }
        wp_update_post(array(
            'ID'            => $new_post,
            'post_name'     => $box_id.'-'.$new_post,
            'post_title'    => 'Branch '.$new_post.' of '.$box_title,
        ));

        $branch_url = get_permalink($new_post);
        $feedback = array(
            'success' => 1,
            'size' => sizeof($my_branch),
            'url' => $branch_url,
            'html' => $box_html
        );
    }else{
        $feedback = array(
            'success' => 0,
            'size' => sizeof($my_branch),
            'txt' => 'already'
        );
    }
    echo json_encode($feedback);
    
}else{
    echo '404';
}
