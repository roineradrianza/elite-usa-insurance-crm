document.addEventListener("DOMContentLoaded", (e) => {
	$ = jQuery
	var app_container = $('#app')
	var pre_container = $('#preload-container')
	setTimeout(removePreload, 1000, app_container, pre_container)
});
function removePreload(app, preloader_container) {
	preloader_container.css('display', 'none')
	app.css('display', 'block')
}