import { Component, OnInit } from '@angular/core';
import { NoteService } from 'src/app/service/note.service';
import decode from 'jwt-decode';
import { DataService } from 'src/app/service/data.service';

@Component({
  selector: 'app-displayempty',
  templateUrl: './displayempty.component.html',
  styleUrls: ['./displayempty.component.scss']
})
export class DisplayemptyComponent implements OnInit {

  note: string[];
  word: string;
  constructor(private dataSevice:DataService,private noteService:NoteService) { }

  ngOnInit() 
  {
    this.onClick()
    this.displayResult()
  }

  onClick()
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
res

  displayResult()
  {
    this.dataSevice.getSearch().subscribe(
    (response)=>{
    this.res=response
    this.word=this.res.data;
    console.log('_____________',this.word)
      }
    );

    // res.subscribe((data: any) => {
    //   this.word = data;
    //   console.log('_____________',this.word)
    // });
  }

}
