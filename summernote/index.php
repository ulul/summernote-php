<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Summernote</title>
  <link href="http://netdna.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.css" rel="stylesheet">
  <script src="http://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.js"></script> 
  <script src="http://netdna.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.js"></script> 
  <link href="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote.css" rel="stylesheet">
  <script src="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote.js"></script>
</head>
<body>
  <div id="summernote"></div>
  <script>
    $(document).ready(function() {
        $('#summernote').summernote({
          height:300,
          callbacks: {
                onImageUpload : function(files, editor, welEditable) {

                     for(var i = files.length - 1; i >= 0; i--) {
                             sendFile(files[i], this);
                    }
                }
            }
        });

        function sendFile(file, el) {
          var form_data = new FormData();
          form_data.append('file', file);
          $.ajax({
              data: form_data,
              type: "POST",
              url: 'saveimage.php',
              cache: false,
              contentType: false,
              processData: false,
              success: function(url) {
                  //$(el).summernote('editor.insertImage', url);
                  console.log(url);
                  $("#summernote").summernote("insertImage", url);
              }
          });
          }
    });
  </script>
</body>
</html>