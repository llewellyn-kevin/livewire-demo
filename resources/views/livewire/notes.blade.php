<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        My Notes
    </h2>
</x-slot>

    <div class="container mx-auto my-2 p-2 lg:w-8/12">
        <div class="inline-block w-4/12">
            <div 
                class="transition duration-500 ease-in-out container bg-teal-500 text-white m-2 p-2 text-center cursor-pointer hover:bg-teal-400"
                wire:click="new()">
                Create New
            </div>
            @foreach($notes as $note)
                @if($note->id == $note_id)
                <div 
                    class="border-l-4 border-teal-500 transition duration-500 ease-in-out container text-gray-800 bg-white m-2 p-2 border border-gray-200 cursor-pointer hover:bg-gray-200 hover:border-0"
                    wire:click="show({{ $note->id }})">
                    <strong>{{ $note->title }}</strong>
                </div>
                @else
                <div 
                    class="transition duration-500 ease-in-out container text-gray-800 bg-white m-2 p-2 border border-gray-200 cursor-pointer hover:bg-gray-200 hover:border-0"
                    wire:click="show({{ $note->id }})">
                    <strong>{{ $note->title }}</strong>
                </div>
                @endif
            @endforeach
        </div>
        <div class="relative inline-block w-7/12 bg-white align-top my-2 mx-4 p-4 border border-gray-200">
            @if($show_note)
                @if($current_mode == $VIEW_MODE)
                @if (session()->has('message'))
                    <div class="text-green-500">
                            {{ session('message') }}
                        </div>
                    @endif

                    <h3 class="my-2 font-semibold text-xl text-gray-800">
                        {{ $title }}
                    </h3>
                    <p 
                        class="absolute font-hairline top-0 right-0 text-2xl text-gray-500 cursor-pointer p-4"
                        wire:click="closeNote()">
                        X
                    </p>
                    <hr />
                    <p class="text-gray-800 my-2">
                        {{ $content }}
                    </p>
                    <br><br>
                    <div wire:click.prevent="edit()" class="transition duration-500 ease-in-out inline-block bg-teal-500 text-white cursor-pointer px-4 py-2 w-48 text-center hover:bg-teal-400">
                        Edit
                    </div>
                @else
                    <input 
                        class="font-semibold text-xl text-gray-800 container"
                        type="text" 
                        placeholder="Enter Title" 
                        wire:model="title">
                    <hr />
                    <textarea 
                        class="container my-2 text-gray-800 h-48"
                        placeholder="Enter Body" 
                        wire:model="content"></textarea>
                    <br><br>
                    <div wire:click.prevent="store()" class="transition duration-500 ease-in-out inline-block bg-teal-500 text-white cursor-pointer px-4 py-2 w-48 text-center hover:bg-teal-400">
                        Save
                    </div>
                    @if($current_mode === $CREATE_MODE)
                        <div wire:click.prevent="cancel" class="transition duration-500 ease-in-out inline-block bg-red-500 text-white cursor-pointer px-4 py-2 w-48 text-center hover:bg-red-400">
                            Cancel
                        </div>
                    @else
                        <div wire:click.prevent="delete" class="transition duration-500 ease-in-out inline-block bg-red-500 text-white cursor-pointer px-4 py-2 w-48 text-center hover:bg-red-400">
                            Delete
                        </div>
                    @endif
                    </div>
                @endif
            @else
                <em>Click on Note or Create New button.</em>
            @endif
        </div>
    </div>