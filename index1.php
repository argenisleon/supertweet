<!DOCTYPE HTML>
<html>
<head>
<script src='js/jquery-2.1.0.min.js'></script>

<script>
$( document ).ready(function() {
	$('#your-input').keyup(function() {
		// referencia http://stackoverflow.com/questions/12553025/getting-line-number-in-text-area
		var t = $(this)[0];
		line = t.value.substr(0, t.selectionStart).split("\n").length;
		var arr = $(this).val().split("\n");
		for(var i = 0; i < arr.length; i++) {
			//console.log('linea-' + i + ":" + arr[i].charCodeAt(arr[i].length-1));
			//console.log('linea-' + i + ":" + arr[i].charCodeAt(0));
		}
		//console.log('character:'+arr[line-1].length);
		$('#lineInfo').html(line);
		$('#rowInfo').html(arr[line-1].length);
	});
	
		
			
	$('#your-input').keypress(function(e) {
		
		// Reference http://stackoverflow.com/questions/10680493/limiting-characters-per-line-in-a-textarea
		var text = $(this).val();
		var arr = text.split("\n");
		
		for(var i = 0; i < arr.length; i++) {
			//console.log('arr:' + arr[i].charCodeAt(arr[i].length-1));
			console.log('linea:' + i);
			
			var count = 141;
			/*
			if (arr.length > 1 && i < arr.length-1){
				console.log('entro:' + arr[i+1].length);
				if(arr[i+1].length>=0){ 
					count = 6;
				}
			}
			*/
			
			console.log(arr[i].length);
			console.log(count);
			
			if((arr[i].length >= count)) {
				//if(e.which != 13) {
					console.log('prevent default');
					//console.log(e.which);
					e.preventDefault(); // prevent characters from appearing
					//alert('You pressed enter!');
				//}
			}
			console.log('---');
			
		}
		
		//console.log(arr.length + " : " + JSON.stringify(arr));
	});
	
});
</script>
</head>
<!-- Save to file. Reference: http://stackoverflow.com/questions/12773838/how-can-i-save-txt-files-from-a-html-textarea-using-php -->
<body style="background-color: rgb(225,225,225)">
    <form name="savefile" method="post" action="">
        File Name: <input type="text" name="filename" value=""><br/>
        <textarea id="your-input" rows="16" cols="140" wrap="hard" name="textdata"></textarea><br/>
		<label>Linea:</label><div id='lineInfo'>lineinfo</div>
		<label>Cantidad de Caracteres:</label><div id='rowInfo'></div>
        <input type="submit" name="submitsave" value="Save Text to Server">
	</form>
    <br/><hr style="background-color: rgb(150,150,150); color: rgb(150,150,150); width: 100%; height: 4px;"><br/>
    <form name="openfile" method="post" action="">
        Open File: <input type="text" name="filename" value="">
        <input type="submit" name="submitopen" value="Submit File Request">
	</form>
    <br/><hr style="background-color: rgb(150,150,150); color: rgb(150,150,150); width: 100%; height: 4px;"><br/>
    File Contents:<br/>
    <?php
    if (isset($_POST)){
        if ($_POST['submitsave'] == "Save Text to Server"  && !empty($_POST['filename'])) {
            if(!file_exists($_POST['filename'] . ".txt")){
                $file = tmpfile();
            }
            $file = fopen($_POST['filename'] . ".txt","a+");
            while(!feof($file)){
                $old = $old . fgets($file). "<br />";
            }
            $text = $_POST["textdata"];
            file_put_contents($_POST['filename'] . ".txt", $old . $text);
            fclose($file);
        }

        if ($_POST['submitopen'] == "Submit File Request") {
            if(!file_exists($_POST['filename'] . ".txt")){
                exit("Error: File does not exist.");
            }
            $file = fopen($_POST['filename'] . ".txt", "r");
            while(!feof($file)){
                echo fgets($file). "<br />";
            }
            fclose($file);
        }
    }
    ?>
</body>
</html>