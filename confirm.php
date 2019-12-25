<script>
    function con_firm(message){
        var r = confirm(message);
        return "r";
    }
</script>

<?php

    echo "<script>con_firm('blah');</script>";

?>