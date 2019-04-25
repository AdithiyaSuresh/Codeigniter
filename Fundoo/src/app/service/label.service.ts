import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { serviceUrl } from '../ServiceUrl/serviceurl.service';

@Injectable({
  providedIn: 'root'
})
export class LabelService {

  constructor(private http :HttpClient,private serviceurl:serviceUrl) { }

  setLabel(id,model){
    debugger;
    let label = new FormData();
    label.append("uid",id);
    label.append("label",model.labelname);
    label.append("noteid",model.id);
    return this.http.post(this.serviceurl.host+this.serviceurl.addLabels,label);
  }

  displayLabel(uid){
    debugger;
    let labelf = new FormData();
    labelf.append("uid",uid);
    return this.http.post(this.serviceurl.host+this.serviceurl.getLabel,labelf);
  }

  displayLabels(uid)
  {
   // debugger;
    let dlabel = new FormData();
    dlabel.append("uid",uid);
    return this.http.post(this.serviceurl.host+this.serviceurl.getLabel,dlabel);
  }

  deleteLabel(id,flag,updatevalue)
  {
    let del = new FormData();
    del.append("id",id);
    del.append("flag",flag);
    del.append("updatevalue",updatevalue);
    return this.http.post(this.serviceurl.host+this.serviceurl.deletelname,del);
  }

  addLabelToNote(idmodel)
  {
    debugger;
    let addltn = new FormData();
    addltn.append('note_id',idmodel.note_id);
    addltn.append('label_id',idmodel.label_id);
    return this.http.post(this.serviceurl.host+this.serviceurl.addLtoN,addltn);
  }

  displayLabelNote(id)
  {
    debugger;
    let labelnote = new FormData();
    labelnote.append('id',id);
    return this.http.post(this.serviceurl.host+this.serviceurl.labelNoteDis,labelnote);
  }

}
