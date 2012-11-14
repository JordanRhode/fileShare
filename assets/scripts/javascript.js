function checkUpload(submitData) {
	var validExtensions = [".jpg", ".jpeg"];
	//get data from submitted file
	var checkFile = submitData.getElementsByTagName("input");
	for(var i = 0; i < checkFile.length; i++) {
		var input = checkFile[i];
		if(input.type == "file") {
			//get filename from input
			var fileName = input.value;
			if(fileName.length > 0) {
				var fileValid = false;
				for (var j = 0; j < validExtensions.length; j++) {
					//check if file extension matches one in ValidExtensions array
					var currentExtension = validExtensions[j];
					if(fileName.substr(fileName.length - currentExtension.length, currentExtension.length).toLowerCase() == currentExtension.toLowerCase()){
						fileValid = true;
						break;
					}
				}
				if(!fileValid) {
					alert ("Sorry, your file is invalid. \n"
						+ "Please try again with a valid file type of .jpg or .jpeg.");
					return false;
				}
			}
		}
	}
	return true;
}