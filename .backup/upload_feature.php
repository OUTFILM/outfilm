<script>
       /* preview the pic before upload*/
	   function readFile (evt) {
		var files = evt.target.files;
		/* single select */
		var file = files[0];           
		var reader = new FileReader();
		/* onload function */
		reader.onload = (function() {
			return function(e) {
				var span = document.createElement('span');
				span.innerHTML = ['<img id="M_rightbar_bot_main_coverpic" src="', e.target.result,'" title="', escape(file.name), '"/>'].join('');
				document.getElementById('M_rightbar_bot_main_coverpic').insertBefore(span, null);
			};
			
			console.log(this.result);
			// Render thumbnail.
			            
		})(file);
		reader.readAsDataURL(file);
		
		//reader.readAsText(file)
		}
		/* reload the onload function each time when change the file */
		document.getElementById('file').addEventListener('change', readFile, false);
</script>