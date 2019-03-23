import { Component, OnInit } from '@angular/core';

import decode from 'jwt-decode';

@Component({
  selector: 'app-dashboard',
  templateUrl: './dashboard.component.html',
  styleUrls: ['./dashboard.component.scss']
})

export class DashboardComponent implements OnInit {
  
  email: string = "";
  grid: boolean = false;
	list: boolean = true;

  constructor() 
  { 
    this.changeView();
  }


  ngOnInit() {
    
  }

  note()
  {
    debugger;
    const tokens = localStorage.getItem('token');
    const tokenPayload = decode(tokens);
    this.email = tokenPayload.email;
  }

  changeView() 
  {
		debugger;
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

	//	this.viewServiceObj.gridview();
  }
  
}
