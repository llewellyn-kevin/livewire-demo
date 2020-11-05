<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Note;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Auth;

class Notes extends Component
{
    use AuthorizesRequests;

    public $notes, $title, $content, $note_id, $note;
    public $show_note = false;
    public $VIEW_MODE = 0;
    public $EDIT_MODE = 1;
    public $CREATE_MODE = 2;
    public $current_mode = 0;

    /**
     * Function used by Livewire default to render the component.
     */
    public function render()
    {
        $this->notes = Note::all()->filter(function($note, $key) {
            return Auth::user()->can('view', $note);
        });
        return view('livewire.notes');
    }

    /**
     * Updates the contents of the current note to a selected note.
     */
    public function show($id)
    {
        $this->note = Note::findOrFail($id);

        $this->authorize('view', $this->note);

        $this->note_id = $id;
        $this->title = $this->note->title;
        $this->content = $this->note->content;

        $this->current_mode = $this->VIEW_MODE;
        $this->openNote();
    }

    /**
     * Create or Update method, called on form submission.
     */
    public function store()
    {
        if($this->note_id != '')
        {
            $this->authorize('update', $this->note);
        }

        $this->validate([
            'title' => 'required',
            'content' => 'required',
        ]);

        $note = Note::firstOrNew(['id' => $this->note_id ?? null]);
        $note->title = $this->title;
        $note->content = $this->content;
        $note->user_id = Auth::user()->id;
        $note->save();

        session()->flash('message', 
            $this->note_id ? 'Note Updated Successfully.' : 'Note Created Successfully.');

        $this->note_id = $note->id;
        $this->current_mode = $this->VIEW_MODE;
    }

    /**
     * Deletes the current note.
     */
    public function delete()
    {
        $this->authorize('delete', $this->note);

        Note::find($this->note_id)->delete();
        session()->flash('message', 'Note Deleted Successfully.');

        $this->resetInputFields();
        $this->closeNote();
    }
     
    

    /**
     * Switch to editing the current note.
     */
    public function edit()
    {
        $this->current_mode = $this->EDIT_MODE;
    }

    /**
     * Opens an empty note in edit mode.
     */
    public function new()
    {   
        $this->note_id = '';
        $this->resetInputFields();
        $this->current_mode = $this->CREATE_MODE;
        $this->openNote();
    }

    /**
     * Utility function to bind to the cancel button when creating
     * a new note. 
     */
    public function cancel()
    {
        $this->resetInputFields();
        $this->current_mode = $this->VIEW_MODE;
        $this->closeNote();
    }

    /**
     * Utility function to make the Note window visible.
     */
    public function openNote()
    {
        $this->show_note = true;
    }

    /**
     * Utility function to make the Note window visible.
     */
    public function closeNote()
    {
        $this->show_note = false;
        $this->note_id = '';
    }

    /**
     * Utility function to clear the values of currently selected
     * note.
     */
    private function resetInputFields()
    {
        $this->title = '';
        $this->content = '';
        $this->note_id = '';
    }
}
