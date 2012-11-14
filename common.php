<?php // common.php

//displays whatever error text you submit in the parameters
function error($msg) {
    ?>
    <html>
        <head>
        <script language="JavaScript">
            alert("<?=$msg?>");
            history.back();
        </script>
        </head>
        <body>
        </body>
    </html>
    <?php
    exit;
}
?>