<x-app-layout>
    @foreach ($notes as $note)
        <div class="box-border w-2/5 p-2 m-2 bg-white">
            {{ $note->title }}
        </div>
    @endforeach
</x-app-layout>