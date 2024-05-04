{extends file="mainPage.tpl"}

{block name=content}

<div style="width:90%; margin: 2em auto;">

<form action="{$conf->action_url}login" method="post" class="pure-form pure-form-stacked">
	<legend>Logowanie</legend>
	<fieldset>
		<label for="id_login">login: </label>
		<input id="id_login" type="text" name="login" />
		<label for="id_pass">pass: </label>
		<input id="id_pass" type="password" name="pass" />
	</fieldset>
	<input type="submit" value="zaloguj" class="pure-button pure-button-primary"/>
</form>	

{include file='messages.tpl'}


</div>

{/block}