import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { serviceUrl } from '../ServiceUrl/serviceurl.service';

@Injectable({
  providedIn: 'root'
})
export class NoteService {

  

  constructor(private http: HttpClient,private serviceurl: serviceUrl) { }

  addNote(reg)
  {
    let addNote = new FormData();
    addNote.append('title',reg.title);
    addNote.append('noteContent',reg.noteContent);
    addNote.append('email',reg.email);
    addNote.append('date',reg.date);
    addNote.append('color',reg.color);
    return this.http.post(this.serviceurl.host+this.serviceurl.note,addNote);
  }

  displayNote(data)
  {
    debugger;
    let emaildata = new FormData();
    emaildata.append("id",data);

    return this.http.post(this.serviceurl.host+this.serviceurl.disnote,emaildata);
  }

  changeColor(id,colour)
  {
    debugger;
    let col = new FormData();
    col.append('id',id);
    col.append('colour',colour);
    return this.http.post(this.serviceurl.host+this.serviceurl.changeColor,col);
  }

  editNote(editedValue)
  {
    debugger;
    let editValue = new FormData();
    editValue.append('Title',editedValue.Title);
    editValue.append('noteContent',editedValue.noteContent);
    editValue.append('id',editedValue.id);
    editValue.append('date',editedValue.date);
    editValue.append('color',editedValue.color);
    return this.http.post(this.serviceurl.host+this.serviceurl.editNote,editValue);
  }

  changeDate(id,currentDateAndTime)
  {
    debugger;
    let editDate = new FormData();
    editDate.append('id',id);
    editDate.append('currentDateAndTime',currentDateAndTime);
    return this.http.post(this.serviceurl.host+this.serviceurl.changeDate,editDate);
  }

  archiveNote(id)
  {
    debugger;
    let arch = new FormData();
    arch.append("id",id);
    return this.http.post(this.serviceurl.host+this.serviceurl.archive,arch);
  }

  deleteNote(n)
  {
   
    let id = new FormData();
    id.append('id',n);
    return this.http.post(this.serviceurl.host+this.serviceurl.delNote,id);
  }
  
}
