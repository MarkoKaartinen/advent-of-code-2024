<div>
    @foreach($days as $day)
        <div><a href="{{ route('day', [$day]) }}" wire:navigate>Day {{ $day }}</a></div>
    @endforeach
</div>
