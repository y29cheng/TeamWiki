<script>
	require(["dojo/dom", "dojo/query", "dojo/dom-attr", "dojo/NodeList-dom"], function(query, domAttr) {
		def.then(function() {
			query("#panelWidget > .tabWidget > a").removeAttr("class");
			domAttr.set(dom.byId("login"), "class", "selected");
		});
	});
</script>
<?php
echo $this->Form->create('User');
echo $this->Form->input('username');
echo $this->Form->input('password');
echo $this->Form->end('login');
echo $this->Html->link('Forgot your password?', array('action' => 'reset_password'));
?>
