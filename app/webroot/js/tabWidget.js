define(["dojo/_base/declare", "dojo/fx", "dojo/dom-style", "dojo/_base/array", "dijit/_WidgetBase", "dijit/_TemplatedMixin", "dojo/text!templates/tabWidget.html"], 
		function(declare, fx, domStyle, arrayUtil, _WidgetBase, _TemplatedMixin, template) {
			return declare([_WidgetBase, _TemplatedMixin], {
				templateString: template,
				baseClass: "tabWidget",
				tabName: "no name",
				menuItems: [],
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
					var innerHtml = "";
					arrayUtil.forEach(this.menuItems, function(menuItem) {
						innerHtml = innerHtml + "<div>" + menuItem + "</div>";
					});
					this.menuNode.innerHTML = innerHtml;
					this.connect(domNode, "onmouseenter", function(e) {
						domStyle.set(domNode, "color", this.mouseTextColor);
						fx.wipeIn({ node: this.menuNode }).play();
					});
					this.connect(domNode, "onmouseleave", function(e) {
						domStyle.set(domNode, "color", this.baseTextColor);
						fx.wipeOut({ node: this.menuNode }).play();
					});
				}
			});
});