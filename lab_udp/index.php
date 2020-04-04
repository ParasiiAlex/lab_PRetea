<?php
    function getListOfVideos()
    {
        $filesArray = scandir('video/');
        $filteredFilesArray = array_filter($filesArray, function ($filename){
            return preg_match('/\.mp4/', $filename) ? $filename : null;
        });
        
        return $filteredFilesArray;
    }
?>

<html lang="en">
<head>
    <title>Lab 3 PR</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
</head>
<body>
<div class="container-xs h4 p-4">
    <div class="h2 text-center text-primary">
        Welcome on my video portal !
    </div>
    <div class="row p-5">
        <div class="col-4">
            <div class="h-100 border border-danger rounded px-4">
                <?php foreach (getListOfVideos() as $key => $video): ; ?>
                    <div class="row">
                        <div class="col text-center">
                            <div class="btn btn-primary btn-lg col-7 mt-3 mx-2" id="<?= $video ; ?>" onclick="loadVideo(this.id)"><?= $video ; ?></div>
                            <div class="btn btn-success btn-lg mt-3 col-2" onclick="renderVideo()">Start</div>
                            <div class="btn btn-danger btn-lg mt-3 col-2 mx-2" onclick="stopVideo()">Stop</div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
        <div class="col-8 border border-primary rounded embed-responsive embed-responsive-16by9" style="height: 30em;">
            <video class="embed-responsive-item my-2" id="video"></video>
        </div>
    </div>
</div>
</body>
<script>
    function loadVideo(id) {
        let videoName = id;
        $('#video').attr('src', 'http://localhost/lab_udp/client.php/?name='+videoName);
        $('#video').get(0).load();
    }

    $('#video').on('error', function (e) {
        alert('Error occurred. Wait please!');
        $('#video').get(0).load();
    });
    
    function renderVideo() {
        $('#video').get(0).play();
    }

    function stopVideo() {
        $('#video').get(0).pause();
    }
</script>
</html>
