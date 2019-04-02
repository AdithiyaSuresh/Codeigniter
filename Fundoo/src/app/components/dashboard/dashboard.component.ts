import { Component, OnInit } from '@angular/core';
import { FormControl, Validators } from '@angular/forms';
import decode from 'jwt-decode';
import { ViewService } from 'src/app/service/view.service';

@Component({
  selector: 'app-dashboard',
  templateUrl: './dashboard.component.html',
  styleUrls: ['./dashboard.component.scss']
})

export class DashboardComponent implements OnInit {
  
  email: string;
  grid: boolean = false;
  list: boolean = true;
  firstname: string;
  dialog: any;

  constructor(private viewservice: ViewService) 
  { 
    this.changeView();
    const tokens = localStorage.getItem('token');
    const tokenPayload = decode(tokens);
    this.email = tokenPayload.email;
    this.firstname = tokenPayload.firstname;
  }


  ngOnInit() {
    
  }

  note()
  {
    // debugger;
    const tokens = localStorage.getItem('token');
    const tokenPayload = decode(tokens);
    this.email = tokenPayload.email;
    this.firstname = tokenPayload.firstname;
  }

  changeView() 
  {
		// debugger;
    if (this.list == true) 
    {
			this.grid = true;
      this.list = false;
     
    } 
    else 
    {
			this.list = true;
      this.grid = false;

		}
    this.viewservice.gridview();
  }

  openDialog(n): void {
    debugger;
    
    const open = this.dialog.open({
      data: n,
      autoFocus: true,
      width: '600px',
    //  maxHeight: "200px",
      panelClass: 'custom-dialog-container'
    });
    
      }

}
