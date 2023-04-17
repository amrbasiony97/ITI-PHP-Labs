<?php
function return_msg($msg, $status) {
        echo "
        <form action='dashboard.php' method='post' id='myForm'>
            <input type='hidden' name='msg' value='{$msg}'>
            <input type='hidden' name='status' value='{$status}'>
        </form>
        <script>
            document.getElementById('myForm').submit();
        </script>
        ";
        exit();
    }
?>