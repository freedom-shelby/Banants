<input id="input-704" name="kartik-input-704[]" type="file" multiple=true class="file-loading">
<script>
    $("#input-704").fileinput({
        uploadUrl: "http://localhost/file-upload-batch/2", // server upload action
        uploadAsync: false,
        minFileCount: 1,
        maxFileCount: 5
    });
</script>
<?php
// ...
// SERVER CODE that processes ajax upload and returns a JSON response. Your server action
// must return a json object containing initialPreview, initialPreviewConfig, & append.
// An example for PHP Server code is mentioned below.
// ...
$p1 = $p2 = [];
if (empty($_FILES['kartik-input-704']['name'])) {
    echo '{}';
    return;
}
for ($i = 0; $i < count($_FILES['kartik-input-704']['name']); $i++) {
    $j = $i + 1;
    $key = '<code to parse your image key>';
    $url = '<your server action to delete the file>';
    $p1[$i] = "<img style='height:160px' src='http://path.to.uploaded.file/{$key}.jpg' class='file-preview-image'>";
    $p2[$i] = ['caption' => "Animal-{$j}.jpg", 'width' => '120px', 'url' => $url, 'key' => $key];
}
echo json_encode([
    'initialPreview' => $p1,
    'initialPreviewConfig' => $p2,
    'append' => true // whether to append these configurations to initialPreview.
    // if set to false it will overwrite initial preview
    // if set to true it will append to initial preview
    // if this propery not set or passed, it will default to true.
]);
?>