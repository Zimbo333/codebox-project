<?php
if (isset($_GET['preview'])) {
    get_template_part('template-parts/codebox','preview');
}else{
    get_template_part('template-parts/codebox','editor');
}
 ?>