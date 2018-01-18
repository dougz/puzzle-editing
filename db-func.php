<?php // vim:set ts=4 sw=4 sts=4 et:
require_once "html.php";
require_once "config.php";

// PHP 7 does not include the MySQL extension. Instead, the MySQLi extension is
// included. Luckily, the API is very similar. These functions wrap the
// mysqli_* functions to have the same API as the mysql_* functions so that the
// rest of the code continues to work with any version of PHP.
if (version_compare(phpversion(), '7.0.0') >= 0) {
    function mysql_connect($server, $username, $password) {
        return mysqli_connect($server, $username, $password);
    }

    function mysql_set_charset($charset) {
        global $db;
        return mysqli_set_charset($db, $charset);
    }

    function mysql_select_db($database_name, $db) {
        return mysqli_select_db($db, $database_name);
    }

    function mysql_real_escape_string($escapestr) {
        global $db;
        return mysqli_real_escape_string($db, $escapestr);
    }

    function mysql_query($query) {
        global $db;
        return mysqli_query($db, $query);
    }

    function mysql_num_rows($result) {
        return mysqli_num_rows($result);
    }

    function mysql_fetch_array($result) {
        return mysqli_fetch_array($result);
    }

    function mysql_fetch_assoc($result) {
        return mysqli_fetch_assoc($result);
    }

    function mysql_fetch_row($result) {
        return mysqli_fetch_row($result);
    }

    function mysql_insert_id() {
        global $db;
        return mysqli_insert_id($db);
    }

    function mysql_error() {
        global $db;
        return mysqli_error($db);
    }
}

// Connect to database
if (($db = mysql_connect(DB_SERVER, DB_USER, DB_PASS)) == FALSE) {
    echo '<div class="errormsg">Could not connect to database server ' . DB_SERVER . '.</div>';
    foot();
    exit(1);
}

// Use UTF-8 character set for connection
if (!mysql_set_charset('utf8mb4')) {
    echo '<div class="errormsg">Could not set character set.</div>';
    foot();
    exit(1);
}

// Select database
if (mysql_select_db(DB_NAME, $db) == FALSE) {
    echo '<div class="errormsg">Could not select database ' . DB_NAME . '.</div>';
    foot();
    exit(1);
}

// Query database.
// Error if no result is found.
function query_db($query) {
    $result = mysql_query($query);

    if ($result == FALSE) {
        db_error($query);
    }

    return $result;
}

// Get one row from database, as an array.
// Error if no result found or if more than 1 row present.
function get_row($query) {
    $result = query_db($query);

    if (mysql_num_rows($result) != 1) {
        db_unexpected($query);
    }

    $r = mysql_fetch_array($result);
    return $r;
}

// Get one row from database, as an array.
// Return null if no result found.
// Error if more than 1 row found.
function get_row_null($query) {
    $result = query_db($query);

    if (mysql_num_rows($result) == 0) {
        return NULL;
    }

    if (mysql_num_rows($result) != 1) {
        db_unexpected($query);
    }

    $r = mysql_fetch_array($result);
    return $r;
}

// Get multiple rows from database, as an array of arrays.
// Return an empty array if no result found.
function get_rows($query) {
    $result = query_db($query);

    $rows = array();
    while ($r = mysql_fetch_array($result)) {
        $rows[] = $r;
    }

    return $rows;
}

// Get multiple rows from database, as an array of associative arrays.
// Return an empty array if no result found.
function get_row_dicts($query) {
    $result = query_db($query);

    $rows = array();
    while ($r = mysql_fetch_assoc($result)) {
        $rows[] = $r;
    }

    return $rows;
}

// Get an associative array
function get_assoc_array($query, $key_col, $val_col) {
    $arr = array();

    $result = query_db($query);
    while ($r = mysql_fetch_array($result)) {
        $arr[$r[$key_col]] = $r[$val_col];
    }

    return $arr;
}

// Get a single datum from the database.
// Error if no result found
function get_element($query) {
    $r = get_row($query);
    if ($r == NULL) {
        return NULL;
    } else {
        return $r[0];
    }
}

// Get a single datum from the database.
// Return null if no result found
function get_element_null($query) {
    $r = get_row_null($query);
    if ($r == NULL) {
        return NULL;
    } else {
        return $r[0];
    }
}

// Get a column from the database, as an array.
// Return an empty array if no result found
function get_elements($query) {
    $result = query_db($query);
    $elements = array();
    while ($r = mysql_fetch_array($result)) {
        $elements[] = $r[0];
    }

    return $elements;
}

// Check if a query returns a result
function has_result($query) {
    $result = query_db($query);
    return mysql_num_rows($result) > 0;
}

// On database error, give error and stop.
function db_fail_message($query, $message) {
    mysql_query('ROLLBACK');
    echo "<div class='errormsg'>$message<br /><code>" . htmlspecialchars($query) . "</code></div>";
    foot();
    exit(1);
}

function db_error($query) {
    db_fail_message($query, "An error has occurred while querying the database. Please try again.");
}

function db_unexpected($query) {
    db_fail_message($query, "The number of rows resulting from querying the database was unexpected. Please try again.");
}
