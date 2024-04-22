{extends file="../templates/mainPage.tpl"}

{block name=content}

<div style="width:90%; margin: 2em auto;">
	<a href="{$app_url}/app/security/logout.php" class="pure-button pure-button-active">Wyloguj</a>
    
<form action="{$app_url}/app/calc_credit.php" method="post">
    <table class="pure-table">
        <tr>
            <td><label for="id_x">Kwota </label></td>
            <td><input id="id_x" type="text" name="x" value="{$x}" /><br /></td>
        </tr>
	
        <tr>
            <td><label for="id_op">Miesiące </label></td>
            <td><input id="id_x" type="text" name="y" value="{$y}" /><br /></td>
        </tr>
	
        <tr>
            <td><label for="id_y">Oprocentowanie </label></td>
            <td><input id="id_y" type="text" name="z" value="{$z}" /><br /></td>
        </tr>
        
        <tr>
            <td/>
            <td><input type="submit" value="Oblicz" /></td>
        </tr>
    </table>
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


<div>
    {$result}
</div>

{/block}