define(["dojo/_base/declare", "dojo/fx", "dojo/dom-style", "dojo/dom-attr", "dojo/_base/array", "dijit/_WidgetBase", "dijit/_TemplatedMixin", "dojo/text!templates/tabWidget.html"], 
		function(declare, fx, domStyle, domAttr, arrayUtil, _WidgetBase, _TemplatedMixin, template) {
			return declare([_WidgetBase, _TemplatedMixin], {
				templateString: template,
				baseClass: "tabWidget",
				tabName: "no name",
				menuItems: [],
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
					var innerHtml = "";
					arrayUtil.forEach(this.menuItems, function(menuItem) {
						innerHtml = innerHtml + "<div><a href=\"" + menuItem.url + "\">" + menuItem.name + "</a></div>";
					});
					this.menuNode.innerHTML = innerHtml;
					this.connect(domNode, "onmouseenter", function(e) {
						domStyle.set(domNode, "color", this.mouseTextColor);
						if (this.menuNode.childNodes.length > 0) fx.wipeIn({ node: this.menuNode }).play();
					});
					this.connect(domNode, "onmouseleave", function(e) {
						domStyle.set(domNode, "color", this.baseTextColor);
						fx.wipeOut({ node: this.menuNode }).play();
					});
				}
			});
});