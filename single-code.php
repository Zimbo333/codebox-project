<?php
if (isset($_GET['preview'])) {
    get_template_part('template-parts/codebox','preview');
}else if(isset($_GET['branches'])){
    get_template_part('template-parts/codebox','branches');
}else{
    get_template_part('template-parts/codebox','editor');
}
 ?>