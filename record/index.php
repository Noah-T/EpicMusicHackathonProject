<?php

require_once'../dbConn.php';

$conn = mysqli_connect ($db_host, $db_user, $db_password, $db_name) OR die ('Could not connect to MySQL: ' . mysqli_connect_error());

//$conn = mysqli_connect ('localhost', 'phpUser', 'songPass', 'songreview') OR die ('Could not connect to MySQL: ' . mysqli_connect_error());

$sql = "UPDATE submissions SET description='Doe' WHERE submissionId=2";

if ($conn->query($sql) === TRUE) {
    echo "Record updated successfully";
} else {
    echo "Error updating record: " . $conn->error;
}


if (isset($_POST['submit']))
{
	/* Create String for error collection */
	$error = '';

	/* Check for empty vars */
	if (empty($_POST['songName'])) {
		$error = $error . ' Err: songName is a required field';
	}

	if (empty($_POST['description'])) {
		$error = $error . ' Err: description is a required field';
	}

	if (empty($_POST['composer'])) {
		$error = $error . ' Err: composer is a required field';
	}
}
?>
<!-- <script src='https://cdnjs.cloudflare.com/ajax/libs/p5.js/0.4.13/addons/p5.dom.js'></script>

<script>

var mic, recorder, soundFile;
var state = 0;

function setup() {
  background(200);
  // create an audio in
  mic = new p5.AudioIn();

  // prompts user to enable their browser mic
  mic.start();

  // create a sound recorder
  recorder = new p5.SoundRecorder();

  // connect the mic to the recorder
  recorder.setInput(mic);

  // this sound file will be used to
  // playback & save the recording
  soundFile = new p5.SoundFile();

  text('Click button to record', 20, 20);
}

function keyPressed() {
  // make sure user enabled the mic
  if (state === 0 && mic.enabled) {

    // record to our p5.SoundFile
    recorder.record(soundFile);

    background(255,0,0);
    text('Recording!', 20, 20);
    state++;
  }
  else if (state === 1) {
    background(0,255,0);

    // stop recorder and
    // send result to soundFile
    recorder.stop();

    text('Stopped', 20, 20);
    state++;
  }

  else if (state === 2) {
    soundFile.play(); // play the result!
    save(soundFile, 'mySound.wav');
    state=0;
  }
}


</script> -->
<button type="button" name="button" onclick="startRecord()">Start Record</button>
<button type="button" name="button" onclick="mediaRecorder.stop()"></button>
<script src="https://cdn.webrtc-experiment.com/MediaStreamRecorder.js"></script>
<script type="text/javascript">

  function xhr(url, data, callback) {
    var request = new XMLHttpRequest();
    request.onreadystatechange = function () {
      if (request.readyState == 4 && request.status == 200) {
          callback(location.href + request.responseText);
      }
      request.open('POST', url);
      request.send(data);
  };

  function onMediaSuccess(stream) {
      var mediaRecorder = new MediaStreamRecorder(stream);
      mediaRecorder.mimeType = 'audio/wav';
      mediaRecorder.audioChannels = 1;
      mediaRecorder.ondataavailable = function(blob) {
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

  var mediaConstraints = {
    audio: true
  };
  function startRecord() {
    navigator.getUserMedia(mediaConstraints, onMediaSuccess, onMediaError);
  }

}
</script>

<?php
$conn->close();


?>
