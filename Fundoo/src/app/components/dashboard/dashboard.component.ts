import { Component, OnInit } from '@angular/core';
import { FormControl, Validators } from '@angular/forms';
import decode from 'jwt-decode';
import { ViewService } from 'src/app/service/view.service';
import { LabelComponent } from '../label/label.component';
import { MatDialog} from '@angular/material';
import { LabelService } from 'src/app/service/label.service';
import { CookieService } from 'ngx-cookie-service';
import { Router } from '@angular/router';

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
  uid;
  labels: string[];
  image: string;
 

  constructor(private viewservice: ViewService,private cookieserv:CookieService,private router: Router,public dialog: MatDialog,private labelser: LabelService) 
  { 
    this.changeView();
    // const tokens = localStorage.getItem('token');
    // const tokenPayload = decode(tokens);
    // this.email = tokenPayload.email;
    // this.uid = tokenPayload.id;
    // this.firstname = tokenPayload.firstname;
    // this.email  = this.cookieserv.get("email");
    // this.firstname = this.cookieserv.get("name");
    // this.image = this.cookieserv.get("image");
    const tokens = localStorage.getItem('token');
    const tokenPayload = decode(tokens);
    this.email = tokenPayload.email;
    this.uid = tokenPayload.id;
    this.firstname = tokenPayload.firstname;
    this.image = tokenPayload.image;
    this.displayLabels();
    
  }


  ngOnInit() {
    debugger;
    const tokens = localStorage.getItem('token');
    const tokenPayload = decode(tokens);
    this.email = tokenPayload.email;
    this.uid = tokenPayload.id;
    this.firstname = tokenPayload.firstname;
    this.image = tokenPayload.image;
      }
  

  note()
  {
    debugger;
    const tokens = localStorage.getItem('token');
    const tokenPayload = decode(tokens);
    // this.email = tokenPayload.email;
    // this.email  = this.cookieserv.get("email");
    // this.firstname = tokenPayload.firstname;
    // this.firstname = this.cookieserv.get("name");
  //  this.image = this.cookieserv.get("image");
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

  openDialog(): void {
    debugger;
    
    const open = this.dialog.open(LabelComponent,{
      data: this.uid,
      autoFocus: true,
      width: '350px',
     // height: "500px",
    });
    
  }

  displayLabels() {
    // debugger;
    let fetchl = this.labelser.displayLabels(this.uid);

    fetchl.subscribe((res: any) => {
      debugger

      this.labels = res;
    })
  }

  logout()
  {
    localStorage.removeItem('token');
    
    this.router.navigate(['/login']);
    this.cookieserv.deleteAll();
  }
}
