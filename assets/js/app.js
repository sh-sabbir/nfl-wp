window.onload = (event) => {
	console.log("hola");

	let nflTable = document.querySelector("[nfl-style-4]");

	new simpleDatatables.DataTable('#basic', {
		searchable: true,
		fixedHeight: false,
        paging: false,
		fixedHeight: true,
	});
};
