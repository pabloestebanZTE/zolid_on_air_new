<html>
<head>
  <title>MSG Reader - Example</title>
  <style type="text/css">
    .info-box {
      color: #F5F5F5;
      padding: 2em;
    }

    .error-msg {
      background-color: #D80A0A;
    }

    .wizard-msg {
      background-color: #673AB7;
    }

    .field-block {
      padding: 1em 2em;
    }

    .field-block .field-label {
      font-weight: bold;
    }
  </style>
</head>
<body>
<div class="msg-example">
  <div class="info-box wizard-msg">
    1. Choose *.msg file...
  </div>
  <div class="field-block">
    <input type="file" class="src-file" multiple="multiple"/>
  </div>

  <div class="msg-info" style="display: none;">
    <div class="info-box wizard-msg">
      2. MSG info (<span class="msg-file-name"></span>)
    </div>
    <div class="field-block">
      <div class="field-label">From</div>
      <div class="msg-from"></div>
    </div>
    <div class="field-block">
      <div class="field-label">To</div>
      <div class="msg-to"></div>
    </div>
    <div class="field-block">
      <div class="field-label">Subject</div>
      <div class="msg-subject"></div>
    </div>
    <div class="field-block">
      <div class="field-label">Body</div>
      <div class="msg-body"></div>
    </div>
    <div class="field-block">
      <div class="field-label">Attachments</div>
      <div class="msg-attachment"></div>
    </div>
  </div>
</div>

<div class="incorrect-type info-box error-msg" style="display: none;">
  Sorry, the file you selected is not MSG type
</div>

<div class="file-api-not-available info-box error-msg" style="display: none;">
  Sorry, your browser isn't supported
</div>

<script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.2.1.min.js"></script>
<script type="text/javascript" src="<?= URL::to('assets/js/DataStream.js') ?>"></script>
<script type="text/javascript" src="<?= URL::to('assets/js/msg.reader.js') ?>"></script>

<script>
  function isSupportedFileAPI() {
    return window.File && window.FileReader && window.FileList && window.Blob;
  }

  function formatEmail(data) {
    return data.name ? data.name + " [" + data.email + "]" : data.email;
  }

  $(function () {
    if (isSupportedFileAPI()) {
      $('.src-file').change(function () {
        var srqs = "";

        for(var counter = 0; counter < this.files.length; counter++){
          var selectedFile = this.files[counter];
          if (!selectedFile) {
            $('.msg-info, .incorrect-type').hide();
            return;
          }
          if (selectedFile.name.indexOf('.msg') == -1) {
            $('.msg-info').hide();
            $('.incorrect-type').show();
            return;
          }
          $('.msg-example .msg-file-name').html(selectedFile.name);
          $('.incorrect-type').hide();

          // read file...
          var fileReader = new FileReader();
          fileReader.onload = function (evt) {

            var buffer = evt.target.result;
            var msgReader = new MSGReader(buffer);
            var fileData = msgReader.getFileData();
            if (!fileData.error) {
              $('.msg-example .msg-from').html(formatEmail({name: fileData.senderName, email: fileData.senderEmail}));
              $('.msg-example .msg-subject').html(fileData.subject);
              $('.msg-example .msg-body').html(
                  fileData.body ? fileData.body.substring(0, Math.min(600000, fileData.body.length))
                  + (fileData.body.length > 600000 ? '...' : '') : '');
              $('.msg-example .msg-attachment').html(jQuery.map(fileData.attachments, function (attachment, i) {
                return attachment.fileName + ' [' + attachment.contentLength + 'bytes]' +
                    (attachment.pidContentId ? '; ID = ' + attachment.pidContentId : '');
              }).join('<br/>'));
              $('.msg-info').show();

              var info = <?php echo $respuesta; ?>;

              console.log(info);
              for(var i = 0; i < info.stations.data.length; i++){
                if(info.stations.data[i].n_name_station.toLowerCase().split(".").length == 2){
                  if(fileData.subject.toLowerCase().search(info.stations.data[i].n_name_station.toLowerCase().split(".")[0]) != -1 && fileData.subject.toLowerCase().search(info.stations.data[i].n_name_station.toLowerCase().split(".")[1]) != -1){
                    console.log(info.stations.data[i].n_name_station);
                  }
                } else {
                  if(info.stations.data[i].n_name_station.toLowerCase().split(".").length == 3){
                    if(fileData.subject.toLowerCase().search(info.stations.data[i].n_name_station.toLowerCase().split(".")[0]) != -1 && fileData.subject.toLowerCase().search(info.stations.data[i].n_name_station.toLowerCase().split(".")[1] +". "+ info.stations.data[i].n_name_station.toLowerCase().split(".")[2]) != -1){
                      console.log(info.stations.data[i].n_name_station);
                    }
                  }
                }
              }
              // if(fileData.body.search("CRQ") != -1){
              //   if(fileData.body.substring(fileData.body.search("CRQ")+5, fileData.body.search("CRQ")+20).search("CRQ") != -1){
              //     console.log(fileData.subject+": "+fileData.body.substring(fileData.body.search("CRQ")+4, fileData.body.search("CRQ")+20));
              //     if(fileData.subject.toLowerCase().search("no exitoso") != -1){
              //       console.log("Escalado");
              //     }
              //     if (fileData.subject.toLowerCase().search("exitoso") != -1){
              //       if (fileData.subject.toLowerCase().search("no") == -1){
              //         if (fileData.subject.toLowerCase().search("12h") != -1){
              //           console.log("Seguimiento FO");
              //         }
              //         if (fileData.subject.toLowerCase().search("24h") != -1){
              //           console.log("Seguimiento FO");
              //         }
              //         if (fileData.subject.toLowerCase().search("36h") != -1 && fileData.subject.toLowerCase().search("inicio") == -1){
              //           console.log("Produccion");
              //         }
              //       }
              //     }
              //     if(fileData.subject.toLowerCase().search("precheck no exitoso") != -1){
              //       console.log("Escalado");
              //     }
              //     if(fileData.subject.toLowerCase().search("standby") != -1 || fileData.subject.toLowerCase().search("prorroga") != -1){
              //       console.log("queda igual");
              //     }
              //     if(fileData.subject.toLowerCase().search("reinicio") != -1){
              //       console.log("Seguimiento FO");
              //     }
              //
              //   } else {
              //     console.log(fileData.subject+": "+"crq no valido");
              //   }
              // } else {
              //   console.log(fileData.subject+": "+"Correo sin crq");
              // }

              // Use msgReader.getAttachment to access attachment content ...
              // msgReader.getAttachment(0) or msgReader.getAttachment(fileData.attachments[0])
            } else {
              $('.msg-info').hide();
              $('.incorrect-type').show();
            }
          };
          fileReader.readAsArrayBuffer(selectedFile);
        }
      });
    } else {
      $('.msg-example').hide();
      $('.file-api-not-available').show();
    }
  });
</script>
</body>
</html>
