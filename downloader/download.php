<?php include_once './includes.php'; ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>Download</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous" />

    <style>
        .download-box {
                border: 2px solid #ccc;
                box-shadow: 0 0 1px 1px #ccc inset;
                padding: 10px;
        }

        #download-counter {
            font-weight: bold;
            color: blue;
            font-size: 15px;
        }
    </style>

</head>
<body>

    <div class="container">
        <div class="row">
            <?php $file = checkId(); ?>

            <?php if(($data = getFileUrl($file->id))) { ?>
                <div class="col-md-12">
                    <p class="text-center">Nutzen sie diesen Link</p>

                    <div class="text-center download-wrapper">
                        <?php 
                            $token_identifier = $data->token_identifier;

                            $time_before_expire = round(($data->time_before_expire - time())/(60*60)); 

                            include_once './download-box.php'; 
                        ?>
                    </div>

                    

                </div>
            <?php } else { ?>
               <div class="col-md-12">
                    <p class="text-center">Bitte warten Sie, ihr Link wird generiert...</p>
                    
                    <div class="text-center" id="download-counter"></div>

                    <div class="text-center download-wrapper"></div>
               </div>
            <?php } ?>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-1.12.4.min.js" integrity="sha256-ZosEbRLbNQzLpnKIkEdrPv7lOy9C27hHQ+Xp8a4MxAQ="  crossorigin="anonymous"></script>

    <script>
            var file_id = '<?= $file->id ?>';
            var project_url = '<?= PROJECT_URL ?>';
    </script>

    <script src="./scripts/scripts.js" type="text/javascript"></script>
</body>
</html>