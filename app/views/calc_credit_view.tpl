{extends file="mainPage.tpl"}

{block name=content}

<div style="width:90%; margin: 2em auto;">
	<a href="{$conf->action_root}logout" class="pure-button pure-button-active">Wyloguj</a>
    
<form action="{$conf->action_url}calcCompute" method="post">
    <table class="pure-table">
        <tr>
            <td><label for="id_x">Kwota </label></td>
            <td><input id="id_x" type="text" name="x" value="{$form->x}" /></td>
        </tr>
	
        <tr>
            <td><label for="id_op">Miesiące </label></td>
            <td><input id="id_x" type="text" name="y" value="{$form->y}" /></td>
        </tr>
	
        <tr>
            <td><label for="id_y">Oprocentowanie </label></td>
            <td><input id="id_y" type="text" name="z" value="{$form->z}" /></td>
        </tr>
        
        <tr>
            <td/>
            <td><input type="submit" value="Oblicz" /></td>
        </tr>
    </table>
</form>	

<table>
    <label>Historia:</label><br />
    
    {foreach $historyData as $record}
    {strip}
       <tr bgcolor="{cycle values="#aaaaaa,#bbbbbb"}">
          {foreach $record as $data}
            <td>{$data}</td>
          {/foreach}
       </tr>
    {/strip}
    {/foreach}

</table>
            
{include file='messages.tpl'}
        
</div>


<div>
    {$result->result}
</div>

{/block}