<?php
    function get_authors() {
        global $connection;

        $sql = $connection->query("SELECT id, author_name FROM author ORDER BY id ASC");
        $rows = $sql->fetch_all(MYSQLI_ASSOC);

        return $rows;
    }
?>