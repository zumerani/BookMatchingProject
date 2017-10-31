<!DOCTYPE html>
<html>
	<head>
		<title>Student view</title>
		<meta charset="UTF-8"/>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<style type="text/css">
			.search {
				float: left;
				margin-right: 100px;
			}
			.preference {
				float: left;
			}
			.block-disp {
				display: block;
				margin-bottom: 20px;
			}
		</style>
		<script type="text/javascript">
			function bookSearch() {
				var bookToSearch = document.getElementById("searchForBook").value;
				if (bookToSearch === '') {
					document.getElementById("factor-search-div").innerHTML = "Please enter a search term!";
					return;
				}else {
					document.getElementById("factor-search-div").innerHTML = '';
				}
				var xmlhttp = new XMLHttpRequest();
            	xmlhttp.open("POST", "student.php", true);
				xmlhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
				xmlhttp.send("searchterm=" + bookToSearch);
				xmlhttp.onreadystatechange = function() {
					if (this.readyState==4 && this.status==200) {
						var contents = xmlhttp.responseText;
						console.log(contents);
						document.getElementById("book-search-div").innerHTML = contents;
					}
				}
        	}

        	function factorBookSearch() {
				console.log('GOT HERE');
        		var inputs = document.getElementsByName("factor_input[]");
        		var textToFilter = [];
        		for (var i = 0; i < inputs.length; i++) {
        			if (inputs[i].value !== '') {
        				textToFilter.push(inputs[i].value + ':' + inputs[i].getAttribute('id'));
        			}
        		}
        		var xmlhttp = new XMLHttpRequest();
        		xmlhttp.open("POST", "student.php", true);
        		xmlhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        		xmlhttp.send("factorsearch=" + textToFilter.join(","));
				xmlhttp.onreadystatechange = function() {
        			if (this.readyState==4 && this.status==200) {
						var contents = xmlhttp.responseText;
						document.getElementById("factor-search-div").innerHTML = contents;
					}
				}
        	}
		</script>
	</head>
	<body>
		<div class="search">
			<input type="search" id="searchForBook" placeholder="Search book">
			<button type="submit" onclick="bookSearch();">Search</button>
			<div id="book-search-div"></div>
		</div>
		<div class="preference">
			<label class="block-disp">Select your preferences: </label>
			<div>
				<label>Lexile</label>
				<input id="lexile" type="input" name="factor_input[]">
			</div>
			<div>
				<label>Preferred Author</label>
				<input id="author_last_name" type="input" name="factor_input[]">
			</div>
			<div>
				<label>Recommended</label>
				<input id="recommended" type="input" name="factor_input[]">
			</div>
			<div>
				<label>Pages</label>
				<input id="pages" type="input" name="factor_input[]">
			</div>
			<div>
				<label>Topic</label>
				<input id="topic" type="input" name="factor_input[]">
			</div>
			<div>
				<label>Primary protagonist</label>
				<input id="primary_protagonist" type="input" name="factor_input[]">
			</div>
			<div style="margin-top: 10px;">
				<button type="submit" onclick="factorBookSearch();">Search for books with selected factors.</button>
			</div>
			<div id="factor-search-div"></div>
		</div>
	</body>
</html>
