import { Component, OnInit } from '@angular/core';
import { FormControl, Validators } from '@angular/forms';
import decode from 'jwt-decode';
import { ViewService } from 'src/app/service/view.service';
import { LabelComponent } from '../label/label.component';
import { MatDialog} from '@angular/material';
import { LabelService } from 'src/app/service/label.service';
import { CookieService } from 'ngx-cookie-service';
import { Router } from '@angular/router';
import { DataService } from 'src/app/service/data.service';
import { NoteService } from 'src/app/service/note.service';
import { RegisterService } from 'src/app/service/register.service';

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
  searchTerm: string;
  notes : string[];
 

  constructor(private regService:RegisterService,private noteService:NoteService,private dataservice: DataService,private viewservice: ViewService,private cookieserv:CookieService,private router: Router,public dialog: MatDialog,private labelser: LabelService) 
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
    this.displayNotes();
    
  }


  ngOnInit() {
    debugger;
    const tokens = localStorage.getItem('token');
    const tokenPayload = decode(tokens);
    this.email = tokenPayload.email;
    this.uid = tokenPayload.id;
    this.firstname = tokenPayload.firstname;
    this.image = tokenPayload.image;
    this.displayLabels();
    this.displayNotes();
      }
  
      displayNotes()
      {
        debugger;
        const tokens = localStorage.getItem('token');
        const tokenPayload = decode(tokens);
        const id = tokenPayload.id;
        let obs = this.noteService.displayNote(id);
          
          obs.subscribe((data: any) => {
            debugger;
            this.notes = data as string[];
          });
      
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

  search()
  {
    if(this.searchTerm!=undefined)
    this.dataservice.setSearchWord(this.searchTerm);
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

  closeSearch()
  {
    debugger;
    this.router.navigate(['dashboard/notes']);
    this.searchTerm = '';
  }


  public base64textString;
  Mainimage;
  imageNoteId;
  imgres;
  onSelectImage(event,noteId){
   // debugger;
		this.imageNoteId = noteId;
		var files = event.target.files;
		var file = files[0];
		if (files && file) {
			var reader = new FileReader();
			reader.onload = this._handleReaderLoaded.bind(this);
			reader.readAsBinaryString(file);
		}
  }

  _handleReaderLoaded(readerEvt) {
    debugger
		var binaryString = readerEvt.target.result;
		console.log(binaryString);
		this.base64textString = btoa(binaryString);
		this.notes.forEach(element => {
      this.imgres = element;
			if (this.imgres.id == this.imageNoteId) {
				this.imgres.image = "data:image/jpeg;base64," + this.base64textString;
			}
		});

		if (this.imageNoteId == "01") {
      this.Mainimage = "data:image/jpeg;base64," + this.base64textString;
      this.image = this.Mainimage;
      debugger;
      console.log(this.image);
      let obss = this.regService.addUserImage(this.image,this.uid);
      
      obss.subscribe((res: any) => {});
      
		} else {
      
	 }
	}



}
