<?php
include 'db_connect.php';
$db = connect_db();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $documentname = $_POST['documentname'];
    $documentimglink = $_POST['documentimglink'];
    $steps = json_decode($_POST['steps']);  // Chuyển chuỗi JSON thành mảng
    $imageLinks = json_decode($_POST['imageLinks']); // Chuyển chuỗi JSON thành mảng

    // Gộp steps và imageLinks thành một mảng kết hợp
    $combinedArray = array();
    foreach ($steps as $key => $step) {
        $combinedArray[] = array(
            'step' => $step,
            'imageLink' => isset($imageLinks[$key]) ? $imageLinks[$key] : ''
        );
    }

    save_document($documentname,$documentimglink, $combinedArray , $db);
    // In ra mảng kết hợp
    echo 'Document Name: ' . $documentname . '<br>';
    echo 'Document Image Link: ' . $documentimglink . '<br>';
    echo 'Combined Array: <br>';
    foreach ($combinedArray as $item) {
        echo 'Step: ' . $item['step'] . ' - Image Link: ' . $item['imageLink'] . '<br>';
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script>
        function createStepInputs(stepCount) {
            var inputDiv = document.getElementById('stepInputs');
            inputDiv.innerHTML = '';  // Xóa các input cũ
            for (var i = 0; i < stepCount; i++) {
                var input = document.createElement('input');
                input.type = 'text';
                input.name = 'step' + (i + 1);
                input.placeholder = 'Step ' + (i + 1);
                inputDiv.appendChild(input);

                // Thêm input cho link ảnh
                var imageInput = document.createElement('input');
                imageInput.type = 'text';
                imageInput.name = 'imageLink' + (i + 1);
                imageInput.placeholder = 'Step Image Link ' + (i + 1);
                inputDiv.appendChild(imageInput);

                inputDiv.appendChild(document.createElement('br'));
            }
        }

        function collectData() {
            var documentname = document.getElementById('documentname').value;
            var documentimglink =  document.getElementById('documentimglink').value;
            var steps = [];
            var imageLinks = [];
            var stepCount = document.getElementById('steps').value;

            for (var i = 0; i < stepCount; i++) {
                var stepInput = document.getElementsByName('step' + (i + 1))[0];
                var imageLinkInput = document.getElementsByName('imageLink' + (i + 1))[0];

                // Thêm đường dẫn trước tên link ảnh nếu chưa có
                var stepValue = stepInput.value.trim();
                var imageLinkValue = imageLinkInput.value.trim();

                steps.push(stepValue);
                imageLinks.push(imageLinkValue ? "../document_images/" + imageLinkValue : "");
            }

            // Tạo các input ẩn để gửi mảng steps và imageLinks dưới dạng chuỗi JSON
            var stepsInput = document.createElement('input');
            stepsInput.type = 'hidden';
            stepsInput.name = 'steps';
            stepsInput.value = JSON.stringify(steps);
            document.getElementById('inputForm').appendChild(stepsInput);

            var imageLinksInput = document.createElement('input');
            imageLinksInput.type = 'hidden';
            imageLinksInput.name = 'imageLinks';
            imageLinksInput.value = JSON.stringify(imageLinks);
            document.getElementById('inputForm').appendChild(imageLinksInput);

            // Gửi form
            document.getElementById('inputForm').submit();
        }
    </script>
</head>
<body>
    <form id="inputForm" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <label for="documentname">Document Name:</label>
        <input type="text" id="documentname" name="documentname"><br><br>
        <label for="documentimglink">Document IMG Link:</label>
        <input type="text" id="documentimglink" name="documentimglink"><br><br>
        <label for="steps">Number of Steps (1-10):</label>
        <input type="number" id="steps" name="steps" min="1" max="10" oninput="createStepInputs(this.value)"><br><br>
        <div id="stepInputs"></div>
        <input type="button" value="Submit" onclick="collectData()">
    </form>
</body>
</html>
