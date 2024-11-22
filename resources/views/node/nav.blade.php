<div class="hidden h-full py-1 sm:flex">
    <div class="w-px h-full bg-slate-300"></div>
</div>
<ul class="flex-wrap items-center hidden space-x-2 sm:flex">
    @if ($action == 'show')
    <li>{{ $node->plural ? __($node->plural) : $node->name }} </li>
    @else
    <li class="flex items-center space-x-2">
        <a class="transition-colors text-primary hover:text-primary-focus"
            href="{{ url('model-list/'.$node->name) }}">{{ $node->plural ? __($node->plural) : $node->name }} </a>
        <svg x-ignore="" xmlns="http://www.w3.org/2000/svg" class="size-4" fill="none" viewbox="0 0 24 24"
            stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
        </svg>
    </li>
    <li>{{ $action=='create'?'Crear':'Editar' }} {{ $node->singular ? __($node->singular) : $node->name }}</li>
    @endif

</ul>
