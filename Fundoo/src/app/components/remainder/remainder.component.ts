import { Component, OnInit } from '@angular/core';
import decode from 'jwt-decode';
import { RemainderService } from 'src/app/service/remainder.service';

@Component({
  selector: 'app-remainder',
  templateUrl: './remainder.component.html',
  styleUrls: ['./remainder.component.scss']
})
export class RemainderComponent implements OnInit {

  flag = true;
  note: string[];
 

  constructor(private remService:RemainderService ) {
    this.displayReminder();
   }


  ngOnInit() {
    this.displayReminder();
    
  }

  flip()
  {
    this.flag = !this.flag;
  }


  displayReminder()
  {
    debugger;
    const tokens = localStorage.getItem('token');
    const tokenPayload = decode(tokens);
    const uid = tokenPayload.id;
    let obs = this.remService.fetchreminders(uid);
      
      obs.subscribe((data: any) => {
        debugger;
        this.note = data as string[];
      });
  
  }

  addNote()
  {
    this.flag = true;
  }

}
