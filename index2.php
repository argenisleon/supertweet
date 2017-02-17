<!DOCTYPE HTML>
<html>
<head>
<script src='js/jquery-2.1.0.min.js'></script>

<script>
$( document ).ready(function() {
	$('#your-input').keyup(function() {
		// referencia http://stackoverflow.com/questions/12553025/getting-line-number-in-text-area
		var t = $(this)[0];
		console.log(t);
		console.log($(this));
		//console.log(t[0]);
		line = t.text().substr(0, t.selectionStart).split("\n").length;
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
<style>
body{
	margin:0;
	padding:0;
	font-family: Tahoma;
	font-size:17px;
}
textarea{
	width:100%;
	
}
</style>
</head>
<!-- Save to file. Reference: http://stackoverflow.com/questions/12773838/how-can-i-save-txt-files-from-a-html-textarea-using-php -->
<body>
    <form name="savefile" method="post" action="">
       
        <!--<textarea contenteditable="true" id="your-input" name="textdata"></textarea><br/>-->
		<div contenteditable="true" id="your-input" name="textdata"></div><br/>
		<label>Linea:</label><div id='lineInfo'></div>
		<label>Cantidad de Caracteres:</label><div id='rowInfo'></div>
      
	</form>
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