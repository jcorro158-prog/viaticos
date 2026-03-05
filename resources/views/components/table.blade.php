@props(['ths' => [], 'trs' => null, 'otherClass' => '', 'padding' => '', 'classTh' => null])
<div class="w-full overflow-x-auto scrollbar-thin scrollbar-thumb-morado-700 dark:scrollbar-thumb-gray-400 scrollbar-track-gray-200 dark:scrollbar-track-zinc-700 h-full">
    <table class="table-auto border-collapse w-full">
        <thead>
            <tr class="text-negro-letra dark:text-white h-10 text-sm text-center capitalize font-zenKakuGothicAntiqueBold">
                @foreach ($ths as $th)
                    @if ($loop->first)
                        <th class="px-4 py-2 {{$classTh}} border-b border-zinc-800/10 dark:border-gray-200/20 whitespace-nowrap">{{ $th }}</th>
                    @elseif($loop->last)
                        <th class="px-4 py-2 {{$classTh}} border-b border-zinc-800/10 dark:border-gray-200/20 whitespace-nowrap">{{ $th }}</th>
                    @else
                        <th class="px-4 py-2 {{$classTh}} border-b border-zinc-800/10 dark:border-gray-200/20 whitespace-nowrap">{{ $th }}</th>
                    @endif
                @endforeach
            </tr>
        </thead>
        <tbody class="text-negro-letra dark:text-white font-zenKakuGothicAntiqueMedium normal-case text-sm">
            @php
                $isEmpty = trim(str_replace("<!--[if BLOCK]><![endif]-->",'',str_replace("<!--[if ENDBLOCK]><![endif]-->",'',str_replace("\n",'',$trs)))) === "";
            @endphp

            @if ($trs == null || ($trs == '' || $isEmpty || empty($trs)))    
                <tr class="text-center h-12 border-b border-zinc-800/10 dark:border-gray-200/20">
                    <td colspan="{{ count($ths) }}" class="p-4">
                        No hay registros.
                    </td>
                </tr>
            @else
                {{ $trs }}
            @endif
        </tbody>
    </table>
</div>
