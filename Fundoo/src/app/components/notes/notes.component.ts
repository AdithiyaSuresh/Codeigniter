import { Component, OnInit } from '@angular/core';
import { FormControl, Validators } from '@angular/forms';
import { NoteService } from 'src/app/service/note.service';
import decode from 'jwt-decode';
import { debug } from 'util';
import * as moment from 'moment';

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
  currentDateAndTime: string;
  timer: any;
  constructor(private noteService:NoteService) { }

  ngOnInit() {
    this.displayNotes();
    this.timer = false;
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
          this.displayNotes();
          this.flag = true;
        } 
        else 
        {
          
        }
      });
      
  }

  deleteNote(n)
  {
    
    console.log(n.id);
    let robj = this.noteService.deleteNote(n.id);

      robj.subscribe((res: any) => 
      {
       debugger;
        console.log(res.message);

        if (res.message == "200") 
        {
          this.displayNotes();
        } 
        else 
        {
          
        }
      });
  }

  fulldate: any;
	fulltime: any;
	/**
	 * functin for set reminder for today button
	 */
	today(id) {
		var day = new Date();
		this.fulldate = day.toDateString();
		let currentDate = moment(this.fulldate).format("DD/MM/YYYY");
    this.currentDateAndTime = currentDate + " " + " 08:00 PM";
    this.timer = true;
		
	}

	tomorrow(id) {
		debugger;
		var day = new Date();
		day.setDate(day.getDate() + 1);
		this.fulldate = day.toDateString();
		let currentDate = moment(this.fulldate).format("DD/MM/YYYY");
		this.currentDateAndTime = currentDate + " " + " 08:00 AM";
    this.timer = true;
	}

	nextWeek(id) {
		debugger;
		var day = new Date();

		this.fulldate = day.setDate(day.getDate() + ((1 + 7 - day.getDay()) % 7));
		let currentDate = moment(this.fulldate).format("DD/MM/YYYY");
		this.currentDateAndTime = currentDate + " " + " 08:00 AM";
    this.timer = true;
	}

}
