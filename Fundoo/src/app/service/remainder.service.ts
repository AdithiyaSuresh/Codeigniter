import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { serviceUrl } from '../ServiceUrl/serviceurl.service';

@Injectable({
  providedIn: 'root'
})
export class RemainderService {

  constructor(private http: HttpClient,private serviceurl: serviceUrl) { }

  addNote(reg)
  {
   
    let addNote = new FormData();
    addNote.append('title',reg.title);
    addNote.append('noteContent',reg.noteContent);
    addNote.append('email',reg.email);
     return this.http.post(this.serviceurl.host+this.serviceurl.note,addNote);
  }

  displayNote(data)
  {
    debugger;
    let emaildata = new FormData();
    emaildata.append("email",data);

    return this.http.post(this.serviceurl.host+this.serviceurl.disnote,emaildata);
  }
  
}