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

  constructor(private remainderService:RemainderService) { }

  ngOnInit() {
    this.displayRemainder();
  }

  flip()
  {
    this.flag = !this.flag;
  }

  displayRemainder()
  {
    debugger;
    const tokens = localStorage.getItem('token');
    const tokenPayload = decode(tokens);
    const email = tokenPayload.email;
    let obs = this.remainderService.displayRemainder(email);
   
    obs.subscribe((data: any) => {
      debugger
      this.note = data as string[];
    });
  }

  addRemainder()
  {
    debugger;
    this.email = localStorage.getItem('email');
    this.model =
        {
          "title":this.title.value,
          "noteContent":this.noteContent.value,
          "email":this.email
        }

      let obj = this.remainderService.addRemainder(this.model);
      

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

  deleteRemainder(n)
  {
    debugger;
    console.log(n.id);
    let robj = this.remainderService.deleteRemainder(n.id);

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
