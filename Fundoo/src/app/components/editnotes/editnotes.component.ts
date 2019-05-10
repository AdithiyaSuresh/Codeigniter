
import { Component, OnInit, Inject } from '@angular/core';
import { MatDialogRef, MatDialog, MAT_DIALOG_DATA } from '@angular/material';
import { NoteService } from 'src/app/service/note.service';
import { FormControl, Validators } from '@angular/forms';
import * as moment from 'moment';

@Component({
  selector: 'app-editnotes',
  templateUrl: './editnotes.component.html',
  styleUrls: ['./editnotes.component.scss']
})

export class EditnotesComponent implements OnInit {
  
  title;
  description;
  id;
  date;
  color;

  Title = new FormControl('', [Validators.required, Validators.required]);
  noteContent = new FormControl('', [Validators.required, Validators.required]);
  email: any;
  model: any = {};
  currentDateAndTime: string;
  timer: any;
  isDate: any;
  image: any;

  constructor(public dialogRef: MatDialogRef<EditnotesComponent>,public dialog: MatDialog,private noteService : NoteService, @Inject(MAT_DIALOG_DATA) public data: any,) 
  { 
    // debugger;
    this.title = this.data.title;
    this.description= this.data.noteContent;
    this.id = this.data.id;
    this.date = this.data.date;
    this.color = this.data.color;
    this.image = this.data.image;

     
    // else
    // {
    //   this.isDate = true;
    // }
  }


  
  ngOnInit() {
    this.timer = false;
    this.isDate = true;
    if(this.date == "")
    {
      this.isDate = false;
    }
  }
  
  save() {
  // this.dialogRef.close(this.form.value);
  }
  stat

    edit(value:any)
    {
    
      this.dialogRef.close();
      // let updateobs = this.noteserv.updateNotes(value,this.id);
      // updateobs.subscribe((res:any)=>{
      // if( res.status=="200"){
      // this.stat = "update";
      // }
      
      // })
      
      //this.email = localStorage.getItem('email');
      debugger;
      if(this.Title.value == "")
      {
        this.Title.setValue(this.title);
      }
      if(this.noteContent.value == "")
      {
        this.noteContent.setValue(this.description);
      }
      if(this.currentDateAndTime == undefined)
      {
        
        this.currentDateAndTime = this.date;
      }


        this.model =
            {
              "Title":this.Title.value,
              "noteContent":this.noteContent.value,
              "id":this.id,
              "date":this.currentDateAndTime,
              "color":this.color
            }
            
            
              let obj = this.noteService.editNote(this.model);
              
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
      this.isDate = false;

      
    }
  
    tomorrow(id) {
     // debugger;
      var day = new Date();
      day.setDate(day.getDate() + 1);
      this.fulldate = day.toDateString();
      let currentDate = moment(this.fulldate).format("DD/MM/YYYY");
      this.currentDateAndTime = currentDate + " " + " 08:00 AM";
      this.timer = true;
      this.isDate = false;
    }
  
    nextWeek(id) {
      debugger;
      var day = new Date();
  
      this.fulldate = day.setDate(day.getDate() + ((1 + 7 - day.getDay()) % 7));
      let currentDate = moment(this.fulldate).format("DD/MM/YYYY");
      this.currentDateAndTime = currentDate + " " + " 08:00 PM";
      this.timer = true;
      this.isDate = false;
    }

    editColor(colour)
    {
      this.color = colour;
    }
      
        
  }


