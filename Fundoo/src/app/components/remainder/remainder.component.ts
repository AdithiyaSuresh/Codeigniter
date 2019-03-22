import { Component, OnInit } from '@angular/core';
import { FormControl, Validators } from '@angular/forms';
import decode from 'jwt-decode';
import { debug } from 'util';
import { RemainderService } from 'src/app/service/remainder.service';
import * as moment from 'moment';

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
  card: any;
  currentDateAndTime: string;
  timer: any;

  constructor(private remainderService:RemainderService) { }

  ngOnInit() {
    this.displayRemainder();
    this.timer = false;
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
          this.displayRemainder();
          this.flag = true;
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
          this.displayRemainder();
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
