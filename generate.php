<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Instalasi</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <meta name="theme-color" content="#712cf9">

    <!-- Custom styles for this template -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" crossorigin="anonymous"></script>
    <style>
        a.badge {
            text-decoration: none;
        }
    </style>
</head>
<body>
    <main class="container">
        <nav class="navbar navbar-expand-md navbar-dark bg-dark mb-4">
            <div class="container">
                <a class="navbar-brand" href="#">INSTALL</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse"
                    aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarCollapse">
                    <ul class="navbar-nav ms-auto mb-2 mb-md-0">
                    </ul>
                </div>
            </div>
        </nav>
    <div class="row">
        <div class="col-md-12">
            <div class="card shadow">
                <div class="card-body">
                    <pre>
                    <?php
                        try {
                            $db_name = 'simple_store_native'; // set database name
                            $db_host = 'localhost'; // set database host
                            $db_username = 'root'; // set database username
                            $db_password = ''; // set database password
                            $username = 'admin'; // set username admin
                            $password = 'admin'; // set password admin
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

                            ## START IMPORT DATABASE ##
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
                            ## END IMPORT DATABASE ##

                            print "Table berhasil di import <br />";
                            $mysqli->query("INSERT INTO `users` (`name`, `username`, `password`, `role`, `created_at`, `updated_at`) VALUES ('Administrator', '$username', '" .password_hash($password, PASSWORD_DEFAULT). "', 'admin', '$datetime', NULL)");
                            print "<b>Data Login</b> <br />";
                            print "Username : $username <br />";
                            print "Password : $admin <br />";
                            print "Aplikasi berhasil di install silahkan klik <a href='index.php'>disini</a>";
                        } catch (\Throwable $e) {
                            if (preg_match('/already exists/i', $e->getMessage())) {
                                print 'Aplikasi sudah terinstall silahkan klik <a href="index.php">disini</a>';
                            } else {
                                print $e->getMessage() . '<br />';
                            }
                        }
                    ?>
                    </pre>
                </div>
            </div>
        </div>
    </div>
    </main>
    <div class="container">
        <footer class="d-flex flex-wrap justify-content-between align-items-center py-3 my-4 border-top">
            <div class="col-md-4 d-flex align-items-center">
            <a href="/" class="mb-3 me-2 mb-md-0 text-body-secondary text-decoration-none lh-1">
                <svg class="bi" width="30" height="24"><use xlink:href="#bootstrap"/></svg>
            </a>
            <span class="mb-3 mb-md-0 text-body-secondary">&copy; 2023 -, Inc</span>
            </div>
        </footer>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>