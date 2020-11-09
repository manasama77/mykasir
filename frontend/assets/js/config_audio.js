var audioElement = document.createElement('audio');
audioElement.setAttribute('src', 'assets/mp3/Store_Door_Chime-Mike_Koenig-570742973.mp3');
audioElement.load()
$.get();
audioElement.addEventListener("load", function() {
	audioElement.play();
}, true);