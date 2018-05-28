$(".profile-picture-delete, .user-profile-delete").click(function(event){
	event.preventDefault();

	linkClassName = this.className;

	console.log(linkClassName);

	switch(linkClassName)
	{
		case 'profile-picture-delete':
			message = confirm("Are you sure you want to delete this image?");

			if (message) {
				window.location.href = "http://wwdh.test/index.php?r=profile%2Fpicture";
			}
			break;
		case 'user-profile-delete':
			message = confirm("Are you sure you want to delete this profile?");

			if (message) {
				window.location.href = "http://wwdh.test/index.php?r=profile%2Fdelete";
			}
			break;
	}

})