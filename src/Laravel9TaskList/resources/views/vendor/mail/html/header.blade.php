@props(['url'])
<tr>
<td class="header">
<a href="{{ $url }}" style="display: inline-block;">
@if (trim($slot) === 'ToDoApp')
<h1>ToDoApp</h1>
@else
{{ $slot }}
@endif
</a>
</td>
</tr>
