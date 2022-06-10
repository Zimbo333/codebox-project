<?php 
$data = $_POST;
$args = array(
    'p'         => $data['id'],
    'post_type' => 'any'
);
$p = new WP_Query($args);
if ($p->post_count == 1) {
    $box_id = $data['id'];
    $codeboxType = get_post_type($box_id);
    if ($codeboxType == 'exercise-branch') {
        $parent_id = get_field('parent',$box_id);
        $due_date = get_field('due_date',$parent_id->ID);
        $now = time();
        $dateUnix = strtotime($due_date)-25200;
        if ($now<=$dateUnix) {
            update_field('html',$data['value'],$box_id);
            $feedback = array(
                'success' => 1
            );    
        }else{
            $feedback = array(
                'success' => 1473,
                'now' =>$now,
                'dateUnix' =>$dateUnix,
                'due_date' =>$due_date,
                'parent' => $parent_id->ID
            );    
        }
        
    }else{
        update_field('html',$data['value'],$box_id);
        $feedback = array(
            'success' => 1
        );    
    }
    
    echo json_encode($feedback);
}else{
    echo '404';
}
