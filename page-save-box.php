<?php 
$data = $_POST;
$args = array(
    'p'         => $data['id'],
    'post_type' => 'any'
);
$p = new WP_Query($args);
if ($p->post_count == 1) {
    $box_id = $data['id'];
    update_field('html',$data['value'],$box_id);
    $feedback = array(
        'success' => 1
    );
    echo json_encode($feedback);
}else{
    echo '404';
}
