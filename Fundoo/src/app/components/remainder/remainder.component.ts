import { Component, OnInit } from '@angular/core';
import { FormControl, Validators } from '@angular/forms';
import decode from 'jwt-decode';
import { debug } from 'util';
import { RemainderService } from 'src/app/service/remainder.service';

@Component({
  selector: 'app-remainder',
  templateUrl: './remainder.component.html',
  styleUrls: ['./remainder.component.scss']
})
export class RemainderComponent implements OnInit {

  flag = true;
  model: any = {};
  email: any;
  note: string[];
  title = new FormControl('', [Validators.required, Validators.required]);
  noteContent = new FormControl('', [Validators.required, Validators.required]);

  constructor(private noteService:RemainderService) { }

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

}
