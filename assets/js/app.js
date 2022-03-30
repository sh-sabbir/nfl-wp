window.onload = (event) => {
	// console.log("hola");

	let nflTables = document.querySelectorAll("[data-nfl-style-4]");

	nflTables.forEach(function (nflTable) {
		new simpleDatatables.DataTable(nflTable, {
			searchable: true,
			fixedHeight: false,
			paging: false,
			fixedHeight: true,
			filters: {
				Division: ["East", "West", "North", "South"],
				Conference: [
					"National Football Conference",
					"American Football Conference",
				],
			},
		});
	});
};
