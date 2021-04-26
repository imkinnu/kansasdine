<?php
define('SECURE_PATH','http://'.$_SERVER['HTTP_HOST']."/restaurant/");
session_start();
session_destroy();
?>
<script>
    let locations = "<?php echo SECURE_PATH ?>";
    window.location = locations;
</script>
