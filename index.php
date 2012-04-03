<?php

include_once('config.inc.php');
include_once('functions.inc.php');
include_once('database.inc.php');

if (PRINT_LOG) echo "<h2>log</h2>";
if (PRINT_LOG) echo "<pre>";

$databaseList = array();
$totalSize = 0;
foreach ($loginData as $loginEntry) {
    /* CONNECT */
    $db_con = db_connect($loginEntry['host'], $loginEntry['uname'], $loginEntry['passwd']);
    if (PRINT_LOG) echo "<p>Connected to Database " . $loginEntry['name'] . "</p>";

    /* GET DATABASE SIZE */
    /*
     * thanks to:
     * http://www.mkyong.com/mysql/how-to-calculate-the-mysql-database-size/
     */
    if (PRINT_LOG) echo "<p>Get Data</p>";
    $result = mysqli_query($db_con, '
        SELECT
          TABLE_SCHEMA,
          SUM(DATA_LENGTH + INDEX_LENGTH) "table_size",
          ENGINE,
          TABLE_ROWS
        FROM
          INFORMATION_SCHEMA.TABLES
        GROUP BY
          TABLE_SCHEMA
        ORDER BY
          table_size DESC;
    ');
    if (db_hasErrors($db_con, $result)) {
        exit;
    }
    $tableList = array();
    $databaseSize = 0;
    while($row = mysqli_fetch_array($result)) {
        $tableList[] = $row;
        $databaseSize += $row['table_size'];
    }
    $totalSize += $databaseSize;

    // calculate percentage
    if ($databaseSize == 0) {
        $tableEntry['percent'] = 0;
    } else {
        foreach ($tableList as &$tableEntry) {
            $tableEntry['percent'] = $tableEntry['table_size'] / $databaseSize * 100;
        }
    }

    $databaseList[$loginEntry['name']]['tables'] = $tableList;
    $databaseList[$loginEntry['name']]['name'] = $loginEntry['name'];
    $databaseList[$loginEntry['name']]['databaseSize'] = $databaseSize;
}

// sort databases by size
if (PRINT_LOG) echo "<p>Sort Databases by Size</p>";
function sortByTotalSize($a, $b) {
    return $b['databaseSize'] - $a['databaseSize'];
}
usort($databaseList, sortByTotalSize);

//printArray($databaseList);

echo "</pre>";

include_once('templates/index_template.inc.php');
?>