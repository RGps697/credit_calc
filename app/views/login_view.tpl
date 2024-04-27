{extends file="mainPage.tpl"}

{block name=content}

<div style="width:90%; margin: 2em auto;">

<form action="{$conf->app_url}/app/security/login.php" method="post" class="pure-form pure-form-stacked">
	<legend>Logowanie</legend>
	<fieldset>
		<label for="id_login">login: </label>
		<input id="id_login" type="text" name="login" value="{$login}" />
		<label for="id_pass">pass: </label>
		<input id="id_pass" type="password" name="pass" />
	</fieldset>
	<input type="submit" value="zaloguj" class="pure-button pure-button-primary"/>
</form>	


<table>
    {foreach $messages as $message}
    {strip}
       <tr bgcolor="{cycle values="#aaaaaa,#bbbbbb"}">
          <td>{$message}</td>
       </tr>
    {/strip}
    {/foreach}
</table>

</div>

{/block}