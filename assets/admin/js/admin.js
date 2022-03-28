window.onload = (event) => {
	initializeNBA();
};

function initializeNBA() {
	const layoutSelector = document.getElementById("designSelector");
	const apiForm = document.getElementById("apiForm");
	const cacheTimeWrap = document.getElementById("cache-time-wrap");
	const isCache = document.getElementById("isCache");
	const copyButton = document.getElementById("copyShortcode");
	const shortcodeText = document.getElementById("shortcode");

	let handleCopy = (event) => {
		shortcodeText.select();
		document.execCommand("copy");
		
		const selection = window.getSelection();
		selection.removeAllRanges();
		shortcodeText.blur();
	};

	let handleLayoutChange = (event) => {
		let activeLayout = event.target.value;
		let preview = document.getElementById("layout-" + activeLayout);
		let shortCode = document.getElementById("shortcode");

		shortCode.value = `[nfl layout=${activeLayout}]`;

		hideAllLayout();
		show(preview);
	};

	let handleApiForm = (event) => {
		event.preventDefault();

		let apiKey = document.getElementById("apiKey").value;
		let cacheEnabled = isCache.checked;
		let cacheTime = document.getElementById("cacheTime").value;
		let submitBtn = apiForm.querySelector("#submit");

		submitBtn.value = "Saving...";
		submitBtn.disabled = true;

		let settings = {
			apiKey: apiKey,
			isCache: cacheEnabled,
			cacheTime: cacheTime,
		};

		let data = {
			action: "nflwp_settings_save",
			settings: JSON.stringify(settings),
		};

		let request = new XMLHttpRequest();
		request.open("POST", ajaxurl, true);
		request.setRequestHeader(
			"Content-Type",
			"application/x-www-form-urlencoded; charset=UTF-8"
		);
		request.onload = function () {
			if (this.status >= 200 && this.status < 400) {
				// Success!
				submitBtn.value = "Saved";
				var resp = this.response;
			} else {
				submitBtn.value = "Failed";
				// We reached our target server, but it returned an error
			}

			setTimeout(function () {
				submitBtn.value = "Save Changes";
				submitBtn.disabled = false;
			}, 2000); //wait 2 seconds
		};
		request.send(objectToQueryString(data));
	};

	let handleIsCache = (event) => {
		let checked = event.target.checked;

		if (checked) {
			cacheTimeWrap.classList.remove("disabled");
		} else {
			cacheTimeWrap.classList.add("disabled");
		}
		console.log(event.target.checked);
	};

	// Show an element
	var show = function (elem) {
		elem.style.display = "block";
	};

	// Hide an element
	var hide = function (elem) {
		elem.style.display = "none";
	};

	var hideAllLayout = function () {
		let previews = document.getElementsByClassName("layout-wrap");

		for (const layout of previews) {
			hide(layout);
		}
	};

	var objectToQueryString = (obj) => {
		return Object.keys(obj)
			.map((key) => key + "=" + obj[key])
			.join("&");
	};
	// Save settings data

	apiForm.addEventListener("submit", handleApiForm);
	layoutSelector.addEventListener("change", handleLayoutChange);
	isCache.addEventListener("change", handleIsCache);
	copyButton.onclick = () => {
		handleCopy();
	};
}
