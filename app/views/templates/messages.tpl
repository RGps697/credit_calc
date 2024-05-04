<table>
{foreach $msgs as $message}
{strip}
   <tr bgcolor="{cycle values="#aaaaaa,#bbbbbb"}">
      <td>{$message}</td>
   </tr>
{/strip}
{/foreach}

{if $msgs->isError()}
    <h4>Wystąpiły błędy: </h4>
    {foreach $msgs->getErrors() as $err}
    {strip}
    <tr bgcolor="{cycle values="#aaaaaa,#bbbbbb"}">
        <td>{$err}</td>
    </tr>
    {/strip}
    {/foreach}
{/if}

</table>