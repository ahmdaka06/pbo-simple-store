<?php
require 'connect.php';
include 'layouts/header.php';
?>
<div class="row">
    <div class="col-md-12">
        <div class="card shadow">
            <div class="card-body">
                <pre>
                <?php
                    try {
                        $db_name = 'simple_store_native_v2';
                        $db_host = 'localhost';
                        $db_username = 'root';
                        $db_password = '';
                        $username = 'admin';
                        $password = password_hash('admin', PASSWORD_DEFAULT);
                        $datetime = date('Y-m-d H:i:s');
                        $mysqli = new mysqli($db_host, $db_username, $db_password);
                        $query = "CREATE DATABASE IF NOT EXISTS " . $db_name;
                        $mysqli->query($query);
                        if ($mysqli->error) {
                            throw new Exception($mysqli->error);
                        } else {
                            print "<li>Database " . $db_name ." berhasil di buat / sudah tersedia</li>";
                        }
                        // Pilih database
                        $mysqli->select_db($db_name);
                        if ($mysqli->error) {
                            throw new Exception($mysqli->error);
                        } else {
                            print "<li>Database " .$db_name. " berhasil di pilih</li>";
                        }
                        // Temporary variable, used to store current query
                        $templine = '';
                        // Read in entire file
                        $lines = file('simple_store_native.sql');
                        // Loop through each line
                        foreach ($lines as $line) {
                        // Skip it if it's a comment
                            if (substr($line, 0, 2) == '--' || $line == '') continue;
                            // Add this line to the current segment
                            $templine .= $line;
                            // If it has a semicolon at the end, it's the end of the query
                            if (substr(trim($line), -1, 1) == ';') {
                                // Perform the query
                                $mysqli->query($templine) or print('Error performing query \'<strong>' . $templine . '\': ' . $mysqli->connect_errno . '<br /><br />');
                                // Reset temp variable to empty
                                $templine = '';
                            }
                        }
                        print "Table berhasil di import <br />";
                        $mysqli->query("INSERT INTO `users` (`name`, `username`, `password`, `role`, `created_at`, `updated_at`) VALUES ('Administrator', '$username', '$password', 'admin', '$datetime', NULL)");
                        print "<b>Data Login</b> <br />";
                        print "Username : admin <br />";
                        print "Password : admin <br />";
                        print "Aplikasi berhasil di install silahkan klik <a href='index.php'>disini</a>";
                    } catch (\Throwable $e) {
                        print $e->getMessage();
                    }
                ?>
                </pre>
            </div>
        </div>
    </div>
</div>
<?php include 'layouts/footer.php'; ?>