import { Component, OnInit } from '@angular/core';
import { FormControl, Validators } from '@angular/forms';
import { NoteService } from 'src/app/service/note.service';
import decode from 'jwt-decode';
import { debug } from 'util';

@Component({
  selector: 'app-notes',
  templateUrl: './notes.component.html',
  styleUrls: ['./notes.component.scss']
})
export class NotesComponent implements OnInit {

  flag = true;
  model: any = {};
  email: any;
  note: string[];
  title = new FormControl('', [Validators.required, Validators.required]);
  noteContent = new FormControl('', [Validators.required, Validators.required]);
  card: any;
  constructor(private noteService:NoteService) { }

  ngOnInit() {
    this.displayNotes();
  }

  flip()
  {
    this.flag = !this.flag;
  }

  displayNotes()
  {
    debugger;
    const tokens = localStorage.getItem('token');
    const tokenPayload = decode(tokens);
    const email = tokenPayload.email;
    let obs = this.noteService.displayNote(email);
   
    obs.subscribe((data: any) => {
      debugger
      this.note = data as string[];
    });
  }

  addNote()
  {
    debugger;
    this.email = localStorage.getItem('email');
    this.model =
        {
          "title":this.title.value,
          "noteContent":this.noteContent.value,
          "email":this.email
        }

      let obj = this.noteService.addNote(this.model);
      

      obj.subscribe((res: any) => 
      {
        //debugger;
        console.log(res.message);

        if (res.message == "200") 
        {
          
        } 
        else 
        {
          
        }
      });
      
  }

  deleteNote(n)
  {
    debugger;
    console.log(n.id);
    let robj = this.noteService.deleteNote(n.id);

      robj.subscribe((res: any) => 
      {
        //debugger;
        console.log(res.message);

        if (res.message == "200") 
        {
          
        } 
        else 
        {
          
        }
      });
  }
}
