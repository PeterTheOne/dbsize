<!doctype html>
<!-- paulirish.com/2008/conditional-stylesheets-vs-css-hacks-answer-neither/ -->
<!--[if lt IE 7]> <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang="en"> <![endif]-->
<!--[if IE 7]>    <html class="no-js lt-ie9 lt-ie8" lang="en"> <![endif]-->
<!--[if IE 8]>    <html class="no-js lt-ie9" lang="en"> <![endif]-->
<!-- Consider adding a manifest.appcache: h5bp.com/d/Offline -->
<!--[if gt IE 8]><!--> <html class="no-js" lang="en"> <!--<![endif]-->
<head>
    <meta charset="utf-8">

    <!-- Use the .htaccess and remove these lines to avoid edge case issues.
 More info: h5bp.com/i/378 -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

    <title>Database Sizes</title>
    <meta name="description" content="Gives an overview over Database Sizes">

    <!-- Mobile viewport optimized: h5bp.com/viewport -->
    <meta name="viewport" content="width=device-width">

    <!-- Place favicon.ico and apple-touch-icon.png in the root directory: mathiasbynens.be/notes/touch-icons -->

    <link rel="stylesheet" href="css/style.css">

    <!-- More ideas for your <head> here: h5bp.com/d/head-Tips -->
</head>
<body>
    <header>
        <h1>Database Sizes</h1>
    </header>

    <div class="overview">
        <h2 id="overview">Overview</h2>

        <table>
            <tr>
                <th id="db_name">
                    Name
                </th>
                <th id="db_percent">
                    Percent
                </th>
                <th id="db_size">
                    Total Size
                </th>
                <th id="db_tables">
                    Num Tables
                </th>
            </tr>
<?php
foreach ($databaseList as &$databaseEntry) {
?>
            <tr>
                <td>
                    <a href="#<?php echo $databaseEntry['name']; ?>">
                        <?php echo $databaseEntry['name']; ?>
                    </a>
                </td>
                <td class="percent">
                    <div style="width: <?php echo round($databaseEntry['databaseSize'] / $totalSize * 100 , 2) . "px"; ?>">
                        <?php echo round($databaseEntry['databaseSize'] / $totalSize * 100 , 2) . "%"; ?>
                    </div>
                </td>
                <td>
                    <?php echo formatSize($databaseEntry['databaseSize']); ?>
                </td>
                <td>
                    <?php echo sizeof($databaseEntry['tables']); ?>
                </td>
            </tr>
<?php
}
?>
            <tr class="total">
                <td>
                    Total
                </td>
                <td>
                    -
                </td>
                <td>
                    <?php echo formatSize($totalSize); ?>
                </td>
                <td>
                    -
                </td>
            </tr>
        </table>
    </div>

<?php
foreach ($databaseList as &$databaseEntry) {
?>

    <div class="details">
        <h3 id="<?php echo $databaseEntry['name']; ?>">
            <?php echo $databaseEntry['name']; ?> details
        </h3> -
        <a href="#overview">back to Overview</a>


        <table>
            <tr>
                <th class="t_name">
                    Name
                </th>
                <th class="t_percent">
                    Percent
                </th>
                <th class="t_size">
                    Size
                </th>
                <th class="t_engine">
                    Engine
                </th>
                <th class="t_rows">
                    Table Rows
                </th>
            </tr>
<?php
    foreach ($databaseEntry['tables'] as &$tableEntry) {
?>
            <tr>
                <td>
                    <?php echo $tableEntry['TABLE_SCHEMA'] ?>
                </td>
                <td class="percent">
                    <div style="width: <?php echo round($tableEntry['percent'], 2) . "px"; ?>">
                        <?php echo round($tableEntry['percent'], 2) . "%"; ?>
                    </div>
                </td>
                <td>
                    <?php echo formatSize($tableEntry['table_size']); ?>
                </td>
                <td>
                    <?php echo $tableEntry['ENGINE'] ?>
                </td>
                <td>
                    <?php echo $tableEntry['TABLE_ROWS'] ?>
                </td>
            </tr>
<?php
    }
?>
            <tr class="total">
                <td>
                    Total
                </td>
                <td>
                    -
                </td>
                <td>
                    <?php echo formatSize($databaseEntry['databaseSize']); ?>
                </td>
                <td>
                    -
                </td>
                <td>
                    -
                </td>
            </tr>
        </table>
    </div>

<?php
}
?>
    <footer>
        <p>
            by <a href="http://petergrassberger.at">Peter Grassberger</a> |
            <a href="http://www.websafari.eu">websafari</a>
        </p>
    </footer>
</body>
</html>
