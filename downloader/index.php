<?php include_once 'downloader/includes.php'; ?>
<!DOCTYPE html>
<html>
<head>
    <style>
        .bottom-spacing { margin-bottom: 10px; }
    </style>
</head>
<body>
    
    <div class="container">
        <br><br>
        <h2>Downloads</h2>
            <br><br>
            <p>Klicken Sie auf einen der unten stehenden Download-Links</p>
            <br><br>
            <?php foreach (getFiles() as $row): ?>
                <div class="row bottom-spacing">
                    <div class="col-md-6"><strong><?= $row->filename ?></strong></div>
                    <div class="col-md-6"><a href="downloader/download.php?id=<?= $row->id ?>" class="btn btn-success center-block">Herunterladen</a></div>
                </div>
            <?php endforeach ?>
        <br><br><br><br><br>
    </div>
</body>