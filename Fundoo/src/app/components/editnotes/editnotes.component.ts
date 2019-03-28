import { Component, OnInit, Inject } from '@angular/core';
import { MatDialogRef, MatDialog, MAT_DIALOG_DATA } from '@angular/material';
import { NoteService } from 'src/app/service/note.service';
import { FormControl, Validators } from '@angular/forms';

@Component({
  selector: 'app-editnotes',
  templateUrl: './editnotes.component.html',
  styleUrls: ['./editnotes.component.scss']
})

export class EditnotesComponent implements OnInit {
  
  title;
  description;
  id;

  Title = new FormControl('', [Validators.required, Validators.required]);
  noteContent = new FormControl('', [Validators.required, Validators.required]);
  email: any;
  model: any = {};

  constructor(public dialogRef: MatDialogRef<EditnotesComponent>,public dialog: MatDialog,private noteService : NoteService, @Inject(MAT_DIALOG_DATA) public data: any,) 
    { 
    debugger
    this.title = this.data.notesdata.title;
    this.description= this.data.notesdata.noteContent  ;
    this.id = this.data.notesdata.id;
    }
  
  
  ngOnInit() {
  
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
    // if(this.Title.value == "")
    // {
    //   this.Title = this.title;
    // }
    // if(this.noteContent.value == "")
    // {
    //   this.noteContent = this.description;
    // }

      this.model =
          {
            "Title":this.Title.value,
            "noteContent":this.noteContent.value,
            "id":this.id
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
      
        
  }


