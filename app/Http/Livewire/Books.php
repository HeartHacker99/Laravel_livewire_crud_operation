<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\books as library_books;

class Books extends Component
{

    public $booktitle, $author, $edition, $number_of_Pages, $book_old_id;
    public function render()
    {
        $books = library_books::all();
        return view('livewire.books',  compact('books'));
    }

    public function addNewBook()
    {
        $this->dispatchBrowserEvent('showBooksEvent');
    }

    protected $rules = [
        'booktitle' => 'required|max:255',
        'author' => 'required|max:255',
        'edition' => 'required|max:255',
        'number_of_Pages' => 'required|max:255|numeric'
    ];

    public function resetInputFields()
    {
        $this->booktitle = '';
        $this->author = '';
        $this->edition = '';
        $this->number_of_Pages = '';
        $this->book_old_id = '';
    }

    public function addEditBook()
    {
        $this->validate();

        if($this->book_old_id != null) // isset(!$this->book_old_id)
        {
            // Update
            library_books::where('id', $this->book_old_id)->update([
                'title' => $this->booktitle,
                'author' => $this->author,
                'edition' => $this->edition,
                'no_of_pages' => $this->number_of_Pages
            ]);

        }
        else{
            // Create
            library_books::create([
                'title' => $this->booktitle,
                'author' => $this->author,
                'edition' => $this->edition,
                'no_of_pages' => $this->number_of_Pages
            ]);
            session()->flash('message', 'Book Added Successfully');
        }
        $this->resetInputFields();
        $this->dispatchBrowserEvent('hideBooksEvent');
    }

    public function status($book_id, $status)
    {
        if($status == '1')
        {
            library_books::where('id', $book_id)->update(['status' => '0']);
        }
        else
        {
            library_books::where('id', $book_id)->update(['status' => '1']);
        }
        session()->flash('message', 'Status Updated Successfully!');
    }

    public function editBook($book_id)
    {

        $books = library_books::where('id',$book_id)->first();

        $this->booktitle = $books->title;
        $this->author = $books->author;
        $this->edition = $books->edition;
        $this->number_of_Pages = $books->no_of_pages;
        $this->book_old_id = $books->id;
        $this->dispatchBrowserEvent('showBooksEvent');
    }

    public function deleteBook($book_id)
    {
        $book = library_books::where('id', $book_id)->first();
        $book->delete();
        session()->flash('message', 'Record Deleted Successfully!');

    }


}
