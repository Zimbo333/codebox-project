<?php 
$data = $_POST;
$score = $data['score'];
$branch_id = $data['b_id'];
update_field('score',$data['score'],$data['b_id']);

echo 'score'.' '.$data['score'].' '.$data['b_id'];

?>