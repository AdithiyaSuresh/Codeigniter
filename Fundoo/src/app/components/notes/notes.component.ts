
import { Component, OnInit } from '@angular/core';
import { FormControl, Validators } from '@angular/forms';
import { NoteService } from 'src/app/service/note.service';
import decode from 'jwt-decode';
import { debug } from 'util';
import * as moment from 'moment';
import { ViewService } from 'src/app/service/view.service';

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
  view;
  wrap: string = "wrap";
	direction: string = "row";
  layout: string = this.direction + " " + this.wrap;
  public color = "";
  dateTime: any;
  
  constructor(private noteService:NoteService,private viewservice :ViewService) {

      this.viewservice.getView().subscribe((res=>{
        this.view =res;
        this.direction = this.view.data;
        this.layout = this.direction + " " + this.wrap;
      }))
   }


  ngOnInit() {
    this.displayNotes();
    this.timer = false;

      this.viewservice.getView().subscribe((res=>{
        this.view = res;
        this.direction = this.view.data;
        this.layout = this.direction + " "+this.wrap;
    }))

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
    const id = tokenPayload.id;
    let obs = this.noteService.displayNote(id);
      
      obs.subscribe((data: any) => {
        debugger;
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
          "email":this.email,
          "date":this.currentDateAndTime,
          "color":this.color
        }

      if(this.title.value != "" || this.noteContent.value != "" || this.currentDateAndTime != undefined)
      {
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
      debugger;
      this.flag = true; 

      if(this.currentDateAndTime == undefined)
      {
        this.dateTime = false;
      }
      else
      {
        this.dateTime = true;
      }
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
		this.currentDateAndTime = currentDate + " " + " 08:00 PM";
    this.timer = true;
	}

  setColorToTitle(changecolor) {
		this.color = changecolor;
  }

  setColor(n,colour)
  {
    debugger;
    let col = this.noteService.changeColor(n.id,colour);
    col.subscribe((res:any)=>{
      console.log(res);
      if (res.message == "200") 
        {
          this.displayNotes();
        } 
        else 
        {
          
        }
    })
  }
  
}
