describe ("Table Tests", function () {
	var db;
	beforeEach(function () {
		if(db) {
			db.pro.dispose();
		}
		$("#dbTarget").empty().removeClass("");
		$("#dbTarget").css({
			width: 800
		})
	});

	var createTable = function (width, height) {
		var table1 = new TableComponent ();
		table1.setCaption ("Table Component");
		table1.setDimensions (6, 6);
		table1.addColumn("foo", "Foo", {});
		table1.addColumn("bar", "Bar", {});
		table1.addColumn("str", "Stringlike");

		for(var i = 0; i < 20; i++) {
			table1.addRow ({foo: i * 2, bar: i * 2 + 1, str: "Item # " + i});
		}

		return table1;
	}

	it("Should render a basic Table", function (done) {
		db = new Dashboard ();
		var table = createTable(6, 6);

		db.addComponent(table);
	});	


})