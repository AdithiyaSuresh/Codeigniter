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
    addNote.append('image',reg.image);
    addNote.append('label',reg.labelToSend);
    return this.http.post(this.serviceurl.host+this.serviceurl.note,addNote);
  }

  displayNote(data)
  {
    //debugger;
    let emaildata = new FormData();
    emaildata.append("id",data);

    return this.http.post(this.serviceurl.host+this.serviceurl.disnote,emaildata);
  }

  changeColor(id,colour,string)
  {
    debugger;
    let col = new FormData();
    col.append('id',id);
    col.append('colour',colour);
    col.append('string',string)
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
  
  addUserImage(image,uid)
  {
    let addUserImage = new FormData();
    addUserImage.append("image",image);
    addUserImage.append("id",uid);
    return this.http.post(this.serviceurl.host+this.serviceurl.addUImageNote,addUserImage);
  }

  pinNote(id,n) 
  {
		let data = new FormData();
    data.append("id",id);
    data.append("n",n);
    return this.http.post(this.serviceurl.host+this.serviceurl.pinNotes,data);
  }
  
  // /**
	//  * @method dragAndDrop()
	//  * @return observable data
	//  * @param prevId
	//  * @param currId
	//  * @description Function to drag and drop the card
	//  */
  // dragAndDrop(diff, currId, direction, email) 
  // {
	// 	let dragAndDropData = new FormData();
	// 	dragAndDropData.append("diff", diff);
	// 	dragAndDropData.append("currId", currId);
	// 	dragAndDropData.append("direction", direction);
	// 	dragAndDropData.append("email", email);
  //   return this.http.post(this.serviceurl.host+this.serviceurl.pinNotes,dragAndDropData);
  // }
  
}
