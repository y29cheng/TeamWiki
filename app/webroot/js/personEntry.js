define(["dojo/_base/declare", "dojo/parser", "dojo/ready", "dojo/_base/fx", "dojo/fx", "dojo/dom-style", "dijit/_WidgetBase", "dijit/_TemplatedMixin", "dojo/text!templates/person_widget.html"], 
		function(declare, parser, ready, baseFx, fx, domStyle, _WidgetBase, _TemplatedMixin, template) {
			return declare([_WidgetBase, _TemplatedMixin], {
				templateString: template,
				baseClass: "personEntry",
				name: "No name",
				title: "No title",
				body: "No body",
				baseBackgroundColor: "#fff",
				mouseBackgroundColor: "#def",
				contentHidden: "true",
				constructor: function(args) {
					declare.safeMixin(this, args);
				},
				_changeBackgroundColor: function(toColor) {
					baseFx.animateProperty({
						node: this.domNode,
						properties: {
							backgroundColor: toColor
						},
						duration: 500
					}).play();
				},
				_clickOnNode: function() {
					if (!this.contentHidden) {
						fx.wipeIn({ node: this.contentNode }).play();
					} else {
						fx.wipeOut({ node: this.contentNode }).play();
					}
				},
				_setBodyContent: function(body) {
					this.bodyNode.innerHTML = body;
				},
				postCreate: function() {
					var domNode = this.domNode;
					
					domStyle.set(domNode, "backgroundColor", this.baseBackgroundColor);
					domStyle.set(this.contentNode, "display", "none");
					this._setBodyContent(this.body);
					this.connect(domNode, "click", function(e) {
						this.contentHidden = !this.contentHidden;
						this._clickOnNode();
					});
					this.connect(domNode, "onmouseover", function(e) {
						this._changeBackgroundColor(this.mouseBackgroundColor);
					});
					this.connect(domNode, "onmouseleave", function(e) {
						this._changeBackgroundColor(this.baseBackgroundColor);
					});
				}
			});
						
});