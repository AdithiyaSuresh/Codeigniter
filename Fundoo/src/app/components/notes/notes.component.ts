
import { Component, OnInit } from '@angular/core';
import { FormControl, Validators } from '@angular/forms';
import { NoteService } from 'src/app/service/note.service';
import decode from 'jwt-decode';
import { debug } from 'util';
import * as moment from 'moment';
import { ViewService } from 'src/app/service/view.service';
import { MatDialog, MatIconRegistry, MatDialogConfig, MatSnackBar } from '@angular/material';
import { DomSanitizer } from '@angular/platform-browser';
import { EditnotesComponent } from '../editnotes/editnotes.component';

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
  chooseDate = new FormControl();
  card: any;
  currentDateAndTime: string;
  timer: any;
  view;
  wrap: string = "wrap";
	direction: string = "row";
  layout: string = this.direction + " " + this.wrap;
  public color = "";
  dateTime: any;
  notesdata: any;

  constructor(private noteService:NoteService,private viewservice :ViewService,public dialog: MatDialog,iconRegistry: MatIconRegistry,sanitizer: DomSanitizer,private snackBar: MatSnackBar) {

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
    // setInterval(() => {
		// 	this.displayNotes();
		// }, 1000);
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

  fulldate: any;
	fulltime: any;
	/**
	 * functin for set reminder for today button
	 */
	today(n) {
    debugger;
		var day = new Date();
		this.fulldate = day.toDateString();
		let currentDate = moment(this.fulldate).format("DD/MM/YYYY");
    this.currentDateAndTime = currentDate + " " + " 08:00 PM";
    this.timer = true;
    if(n.id != undefined)
    {
      this.timer = false;
      let cdate = this.noteService.changeDate(n.id,this.currentDateAndTime);
      this.currentDateAndTime = "";
      cdate.subscribe((res:any)=>{
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

	tomorrow(n) {
		debugger;
		var day = new Date();
		day.setDate(day.getDate() + 1);
		this.fulldate = day.toDateString();
		let currentDate = moment(this.fulldate).format("DD/MM/YYYY");
		this.currentDateAndTime = currentDate + " " + " 08:00 AM";
    this.timer = true;
    if(n.id != undefined)
    {
      this.timer = false;
      let cdate = this.noteService.changeDate(n.id,this.currentDateAndTime);
      this.currentDateAndTime = "";
      cdate.subscribe((res:any)=>{
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

	nextWeek(n) {
		debugger;
		var day = new Date();

		this.fulldate = day.setDate(day.getDate() + ((1 + 7 - day.getDay()) % 7));
		let currentDate = moment(this.fulldate).format("DD/MM/YYYY");
		this.currentDateAndTime = currentDate + " " + " 08:00 PM";
    this.timer = true;
    if(n.id != undefined)
    {
      this.timer = false;
      let cdate = this.noteService.changeDate(n.id,this.currentDateAndTime);
      this.currentDateAndTime = "";
      cdate.subscribe((res:any)=>{
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
  
  choosingDate(cdate)
  {
    var choose = moment(this.chooseDate.value).format("DD/MM/YYYY");
    if(cdate == 'morning')
    {
      this.currentDateAndTime = choose + " " + " 08:00 AM";
      this.timer = true;
    }
    if(cdate == 'afternoon')
    {
      this.currentDateAndTime = choose + " " + " 01:00 PM";
      this.timer = true;
    }
    if(cdate == 'evening')
    {
      this.currentDateAndTime = choose + " " + " 06:00 PM";
      this.timer = true;
    }
    if(cdate == 'night')
    {
      this.currentDateAndTime = choose + " " + " 08:00 M";
      this.timer = true;
    }
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
  
  openDialog(n): void {
    debugger;
    // const dialogconfg = new MatDialogConfig();
    
    // dialogconfg.autoFocus = true;
    // dialogconfg.width = "600px"
    // dialogconfg.maxHeight = "200px"
    // dialogconfg.panelClass = 'custom-dialog-container'
    // dialogconfg.data = { notesdata: n
    // }
    const open = this.dialog.open(EditnotesComponent,{
      data: n,
      autoFocus: true,
      width: '600px',
    //  maxHeight: "200px",
      panelClass: 'custom-dialog-container'
    });
    this.displayNotes();
      }

      openSnackbar(message:string, action: string)
      {
        this.snackBar.open(message,action,{ 
          duration: 2000,
        })
      }


  
  notestools(id) {
    debugger
    if (id == "undefined"){
      return;
    }

    let arch = this.noteService.archiveNote(id);
    arch.subscribe((res:any)=>{
     
        if (res.message == "200") 
        {
          this.displayNotes();
        } 
        else 
        {
          
        }
    })
  }

  deleteNote(n)
  {
    if (n == "undefined"){
      return;
    }
   
    let robj = this.noteService.deleteNote(n);

      robj.subscribe((res: any) => {

        if (res.message == "200") 
        {
          this.displayNotes();
        } 
        else 
        {
          
        }
      });
  }
}
