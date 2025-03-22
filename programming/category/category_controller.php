<?php
    function get_categories() {
        global $connection;

        $sql = $connection->query("SELECT id, category_name FROM category ORDER BY id ASC");
        $rows = $sql->fetch_all(MYSQLI_ASSOC);

        return $rows;
    }
?>