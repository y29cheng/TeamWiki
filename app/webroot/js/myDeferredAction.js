define(["dojo/_base/declare", "dojo/_base/xhr", "dojo/_base/array", "dojo/dom", "js/tabWidget", "dojo/domReady!"], function(declare, xhr, arrayUtil, dom, tabWidget) {
	return declare(null, {
		doAction: function() {
			this.panelWidget = dom.byId("panelWidget");
			this.def = xhr.get({
				url: "/menu.json",
				handleAs: "json"
			});
			this.def.then(function(menus) {
				arrayUtil.forEach(menus, function(menu) {
					var widget = new tabWidget({ tabName: menu.name, menuItems: menu.children, id: menu.id, url: menu.url }).placeAt(panelWidget);
				});
			});
		}
	});
});