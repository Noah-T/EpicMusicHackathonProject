<?php

require_once'../dbConn.php';

$conn = mysqli_connect ($db_host, $db_user, $db_password, $db_name) OR die ('Could not connect to MySQL: ' . mysqli_connect_error());

//$conn = mysqli_connect ('localhost', 'phpUser', 'songPass', 'songreview') OR die ('Could not connect to MySQL: ' . mysqli_connect_error());
?>

<button type="button" name="button" onclick="startRecord()">Start Record</button>
<button type="button" name="button" onclick="stopRecord()">Stop Record</button>
<script src="https://cdn.webrtc-experiment.com/MediaStreamRecorder.js"></script>
<script type="text/javascript">

  var mediaRecorder;

  function xhr(url, data, callback) {
    var request = new XMLHttpRequest();
    request.onreadystatechange = function () {
      if (request.readyState == 4 && request.status == 200) {
          callback(location.href + request.responseText);
      }
      request.open('POST', url);
      request.send(data);
    }
  };

  function onMediaSuccess(stream) {
      mediaRecorder = new MediaStreamRecorder(stream);
      mediaRecorder.mimeType = 'audio/wav';
      mediaRecorder.audioChannels = 1;
      mediaRecorder.ondataavailable = function(blob) {
        console.log("in data available");
        var fileType = 'audio';
        var fileName = 'audio.wav';  // or "wav" or "ogg"

        var formData = new FormData();
        formData.append(fileType + '-filename', fileName);
        formData.append(fileType + '-blob', blob);

        xhr('upload.php', formData, function (fileURL) {
          window.open(fileURL);
        });
      };
      mediaRecorder.start(3000);
  }

  function onMediaError(e) {
    console.error('media error', e);
  }
  function startRecord() {
    var mediaConstraints = {
      audio: true
    };
    navigator.getUserMedia(mediaConstraints, onMediaSuccess, onMediaError);
  }
  function stopRecord() {
    mediaRecorder.stop();
  }
</script>

<?php
$conn->close();


?>
