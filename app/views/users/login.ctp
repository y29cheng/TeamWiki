<script>
	require(["dojo/dom", "dojo/query", "dojo/dom-attr", "dojo/NodeList-dom", "dojo/domReady!"], function(query, domAttr) {
			query("#panelWidget > .tabWidget > a").removeAttr("class");
			domAttr.set(dom.byId("login"), "class", "selected");
	});
</script>
<?php
echo $this->Form->create('User');
echo $this->Form->input('username');
echo $this->Form->input('password');
echo $this->Form->end('login');
echo $this->Html->link('Forgot your password?', array('action' => 'reset_password'));
?>
