<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta http-equiv="refresh" content="5">

    <title>Combination Lock - Ansible, live on stage</title>

    <style>
        html, body {
            margin: 0;
            padding: 0;
            height: 100%;
            width: 100%;
            font-size: 40px;
        }
        .container {
            height: 100%;
            width: 100%;
            display: table;
        }
        .step {
            display: table-row;
            text-align: center;
            font-family: consolas, menlo, monaco, monospace;
        }
        .step .label {
            display: table-cell;
            vertical-align: middle;
            border-top: 1px solid #000;
            border-bottom: 1px solid #000;
        }
        .passed {
            background-color: #5a0;
            color: #000;
        }
        .failed {
            background-color: #a00;
            color: #fff;
        }
    </style>

</head>
<body>
    <div class="container">
        <div class="step <?php echo isset($composer) ? 'passed' : 'failed'; ?>">
            <div class="label">Composer</div>
        </div>
        <div class="step <?php echo isset($envApp) ? 'passed' : 'failed'; ?>">
            <div class="label">ENV</div>
        </div>
        <div class="step <?php echo isset($dbConnection) ? 'passed' : 'failed'; ?>">
            <div class="label">DB Connection</div>
        </div>
        <div class="step <?php echo isset($dbTables) ? 'passed' : 'failed'; ?>">
            <div class="label">DB Tables</div>
        </div>
        <div class="step <?php echo isset($scheduler) ? 'passed' : 'failed'; ?>">
            <div class="label">Scheduler</div>
        </div>
        <div class="step <?php echo isset($queue) ? 'passed' : 'failed'; ?>">
            <div class="label">Queue Worker</div>
        </div>
        <div class="step failed">
            <div class="label">???</div>
        </div>
    </div>
</body>
</html>
