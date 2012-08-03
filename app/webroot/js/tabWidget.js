define(["dojo/_base/declare", "dojo/fx", "dojo/dom-style", "dojo/dom-attr", "dojo/_base/array", "dijit/_WidgetBase", "dijit/_TemplatedMixin", "dojo/text!templates/tabWidget.html"], 
		function(declare, fx, domStyle, domAttr, arrayUtil, _WidgetBase, _TemplatedMixin, template) {
			return declare([_WidgetBase, _TemplatedMixin], {
				templateString: template,
				baseClass: "tabWidget",
				tabName: "no name",
				menuItems: [],
				id: "",
				url: "#",
				backgroundColor: "#1c1c1c",
				baseTextColor: "#777",
				mouseTextColor: "#fff",
				constructor: function(args) {
					declare.safeMixin(this, args);
				},
				postCreate: function() {
					var domNode = this.domNode;
					domStyle.set(domNode, "backgroundColor", this.backgroundColor);
					domStyle.set(domNode, "color", this.baseTextColor);
					domStyle.set(this.menuNode, "display", "none");
					domAttr.set(this.nameNode, "href", this.url);
					domAttr.set(this.nameNode, "id", this.id);
					var innerHtml = "";
					arrayUtil.forEach(this.menuItems, function(menuItem) {
						innerHtml = innerHtml + "<div><a href=\"" + menuItem.url + "\" class=\"itemTextLink\">" + menuItem.name + "</a></div>";
					});
					this.menuNode.innerHTML = innerHtml;
					this.connect(domNode, "onmouseenter", function(e) {
						if (this.menuNode.childNodes.length > 0) fx.wipeIn({ node: this.menuNode }).play();
					});
					this.connect(domNode, "onmouseleave", function(e) {
						fx.wipeOut({ node: this.menuNode }).play();
					});
				}
			});
});